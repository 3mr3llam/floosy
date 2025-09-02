<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProfileRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'message' => 'User profile',
            'data' => UserResource::make($user),
        ], Response::HTTP_OK);
    }

    // Update user profile
    public function updateProfile(ProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        // Get the authenticated user
        $user = Auth::user();
        // Delete old avatar if exists
        if ($user->image) {
            Storage::disk('public')->delete('uploads/users/' . $user->image);
        }
        // Update user data
        $user->name = $validated['name']  ?? $user->name;
        $user->mobile = $validated['mobile']  ?? $user->mobile;
        $user->email = $validated['email']  ?? $user->email;
        $user->image = $request->hasFile('image') ? basename($request->file('image')->store('uploads/users', 'public')) : $user->image;
        $user->birth = Carbon::parse($validated['birth'] ?? $user->birth)->format('Y-m-d');
        $user->state = $validated['state'] ?? $user->state;
        $user->city = $validated['city'] ?? $user->city;

        // Handle password update
        if (isset($validated['password']) && !is_null($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User profile has been updated successfully.',
            'data' => UserResource::make($user),
        ], Response::HTTP_OK);
    }

    public function updateAvatar(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Get the authenticated user
        $user = Auth::user();
        // Delete old avatar if exists
        if ($user->image) {
            Storage::disk('public')->delete('uploads/users/' . $user->image);
        }

        $user->image = $request->hasFile('image') ? basename($request->file('image')->store('uploads/users', 'public')) : $user->image;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User avatar has been updated successfully.',
            'data' => UserResource::make($user),
        ], Response::HTTP_OK);
    }
}
