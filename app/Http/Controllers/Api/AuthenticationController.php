<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ResetPasswordRequest;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\RefreshToken;
use Illuminate\Http\Request;
use App\Traits\HasSendMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\VerifyOTPRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    use HasSendMessage;

    public function register(RegisterRequest $request): JsonResponse
    {
        // Validate incoming request data
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // Create the user
            $mobile = $this->normalizeMobileNumber($validated['mobile']);
            $data = [
                'name' => $validated['name'],
                'mobile' => $mobile,
                'role' => 'user',
                'birth' => Carbon::parse($validated['birth'])->format('Y-m-d'),
            ];

            if (!empty($validated['email'])) {
                $data['email'] = $validated['email'];
            }
            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user = User::query()->create($data);

            DB::commit();

            // Create access and refresh tokens
            list($accessToken, $refreshToken) = $this->createTokens($request, $user);
            // Check if the user was created successfully
            return response()->json([
                'status' => 'success',
                'message' => __('strings.register_successfully'),
                'data' => $validated['path'] == 'register' ? [
                    'user' => new UserResource($user),
                    'token' => $accessToken,
                    'refresh_token' => $refreshToken,
                ] : null,
            ], Response::HTTP_CREATED);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => __('strings.registration_failed'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        // Validate the incoming request
        $validated = $request->validated();

        // Normalize mobile number first to ensure consistent validation
        $normalizedMobile = $this->normalizeMobileNumber($validated['mobile']);
        // Attempt to log the user in
        if (!Auth::attempt([
            'mobile' => $normalizedMobile,
            'password' => $validated['password']
        ])) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.mobile_or_password_invalid'),
                'data' => [],
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        if ($user->email_verified_at == null) {
            // Revoke any existing tokens (security measure)
            $user->tokens()->delete();

            return response()->json([
                'status' => 'error',
                'message' => __('strings.account_not_verified'),
                'data' => [
                    'redirect_to' => 'send-otp'
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Create access and refresh tokens
        list($accessToken, $refreshToken) = $this->createTokens($request, $user);

        // Start database transaction for token creation
        DB::beginTransaction();
        try {

            // Return the response with user, access token, and refresh token
            return response()->json([
                'status' => 'success',
                'message' => __('strings.login_successfully'),
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $accessToken,
                    'refresh_token' => $refreshToken,

                ],
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Login failed: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => __('strings.login_failed'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function logout(Request $request): JsonResponse
    {

        try {
            if (!Auth::check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => ['user' => __('strings.something_went_wrong')]
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user = auth()->user();

            DB::beginTransaction();

            // Revoke ALL access tokens (full logout)
            $user->tokens()->delete();

            // Revoke ALL refresh tokens
            RefreshToken::where('user_id', $user->id)->delete();

            // Clear web session if exists
            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => ['user' => __('strings.successfully_logout')],
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Full logout failed: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => ['user' => __('strings.something_went_wrong')]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function logoutDevice(Request $request): JsonResponse
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Authentication required',
                ], Response::HTTP_UNAUTHORIZED);
            }


            DB::beginTransaction();

            // Revoke only the current access token
            $user = $request->user();
            $currentToken = $user->currentAccessToken();
            $currentToken?->delete();

            // 2. Delete only the matching refresh token
            if ($currentToken) {
                $deviceType = $this->getDeviceType($request);
                $token = $deviceType.'-token-';
                RefreshToken::where('user_id', $user->id)
                    ->where('token', 'LIKE', $token.'%')
                    ->delete();
            }

            if ($request->hasSession()) {
                $request->session()->invalidate();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out from current device',
                'data' => [
                    'device_id' => $currentToken->id,
                    'device_name' => $currentToken->name,
                ]
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Device logout failed: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Device logout failed',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sendOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $mobile = $this->normalizeMobileNumber($request->mobile);
        $user = User::where('mobile', $mobile)
                    ->get()
                    ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.mobile_not_exist'),
                'data' => [],
            ], 400);
        }

        // Generate a 6-digit random OTP
        $otp = mt_rand(0, 999999);
        $otp = str_pad($otp, 6, '0', STR_PAD_LEFT);
        //save otp
        $user->otp = $otp;

        // Send the OTP to the user's mobile number
        $message = "Your OTP is:\r\n $otp\r\n";
        $message .= "كود التأكيد هو:\r\n $otp";

        if ($user->password == null) {
            $password = $this->generateSecureRandomPassword(6);
            $user->password = Hash::make($password);
            $message .= " \r\n\r\n your password is: \r\n $password";
            $message .= " \r\n كلمة المرور لعضويتك هى: \r\n $password";
        }
        $user->save();

        $connect = $this->sendMessage($user->mobile, $message);

        if (!$connect) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.otp_send_failed'),
                'data' => [],
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('strings.otp_send_success'),
            'data' => [],
        ], Response::HTTP_OK);

    }

    public function verifyOtp(VerifyOTPRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $mobile = $this->normalizeMobileNumber($validated['mobile']);

        $user = User::where('mobile', $mobile)
            ->get()
            ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.mobile_not_exist'),
                'data' => [],
            ], 400);
        }

        if ($user->otp != $request->otp) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.otp_not_match'),
                'data' => [],
            ], 400);
        }

        $user->otp = null;
        $user->email_verified_at = now();
        $user->save();

        // Log the user in (establish session)
        Auth::login($user);

        list($accessToken, $refreshToken) = $this->createTokens($request, $user);

        // Return the response with user, access token, and refresh token
        return response()->json([
            'status' => 'success',
            'message' => __('strings.otp_success'),
            'data' => [
                'user' => new UserResource($user),
                'token' => $accessToken,
                'refresh_token' => $refreshToken,
            ],
        ], Response::HTTP_OK);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('mobile', str_replace('+', '', $validated['mobile']))->get()->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.mobile_not_exist'),
                'data' => [],
            ], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'status' => 'error',
            'message' => __('strings.password_reset_success'),
            'data' => [],
        ], Response::HTTP_OK);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.unauthorized'),
                'data' => [],
            ], 400);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.old_password_wrong'),
                'data' => [],
            ], 400);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => __('strings.password_change_success'),
            'data' => [],
        ], Response::HTTP_OK);
    }

    public function refreshToken(Request $request): JsonResponse
    {
        $request->validate([
            'refresh_token' => 'required',
        ]);

        $hashedToken = hash('sha256', $request->refresh_token);
        $refreshToken = RefreshToken::where('token', $hashedToken)->first();

        if (!$refreshToken) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.invalid_refresh_token'),
                'data' => [],
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Check if the refresh token has expired
        if ($refreshToken->expires_at < now()) {
            $refreshToken->delete();
            return response()->json([
                'status' => 'error',
                'message' => __('strings.expired_refresh_token'),
                'data' => [],
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $refreshToken->user;
        $newAccessToken = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => __('strings.refresh_token_successfully'),
            'data' => [
                'token' => $newAccessToken,
            ],
        ], Response::HTTP_OK);
    }

    public function createTokens(Request $request, Model|User $user): array
    {
        $deviceType = $this->getDeviceType($request);
//        $tokenName = $deviceType.'-token-'.Str::random(4);

        // Create tokens
        $accessToken = $user->createToken('access_token', ['*'], now()->addDays(30))->plainTextToken;

        // Generate refresh token
        $refreshToken = Str::random(64);

        // Save refresh token in the database
        $data = RefreshToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $refreshToken),
            'expires_at' => now()->addDays(60),
        ]);

        return array($accessToken, $refreshToken);
    }

    function generateSecureRandomPassword($length = 6): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $max)];
        }

        return $password;
    }

    function checkMobileExists(Request $request): JsonResponse
    {
        $request->validate([
            'mobile' => 'required|string',
        ]);

        // Clean & standardize mobile number (remove +, spaces, etc.)
        $mobile = Str::remove(' ', str_replace('+', '', $request->mobile));
        $exists = User::where('mobile', $mobile)->exists();

        return response()->json([
            'status' => 'success',
            'message' => $exists ? __('pages.mobile_exists') : __('pages.mobile_not_exists'),
            'data' => [
                'exists' => $exists,
            ],
        ], Response::HTTP_OK);
    }

    protected function normalizeMobileNumber($mobile): string
    {
        // Remove all non-digit characters except optional leading +
        $normalized = preg_replace('/[^\d+]/', '', $mobile);

        // Remove leading + if present
        return ltrim($normalized, '+');
    }

    protected function getDeviceType(Request $request): string
    {
        $userAgent = strtolower($request->userAgent());

        if (str_contains($userAgent, 'android')) {
            return 'android';
        }

        if (str_contains($userAgent, 'iphone') || str_contains($userAgent, 'ipad')) {
            return 'ios';
        }

        return 'web';
    }

}
