<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TestimonialResource;
use App\Http\Resources\UserResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TestimonialController extends Controller
{

    public function index(): \Illuminate\Http\JsonResponse
    {
        $testimonials = Testimonial::with('user')->latest()->take(10)->get();

        if ($testimonials->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.testimonials_not_found'),
                'data' => [],
            ], 200);
        }

        $testimonials = TestimonialResource::collection($testimonials);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.get_testimonials_successfully'),
            'data' => $testimonials,
        ], 200);
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $testimonial = Testimonial::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.created_successfully'),
            'data' => TestimonialResource::make($testimonial),
        ], 200);
    }

}
