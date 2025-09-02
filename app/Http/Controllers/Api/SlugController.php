<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use LaraZeus\Sky\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class SlugController extends Controller
{

    public function slugCategory(): JsonResponse
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {

            return response()->json([
                'status' => 'success',
                'message' => 'Categories are empty',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map over the products to extract slug, created_at, and updated_at.
        $category = CategoryResource::collection($categories);

        // Return a success response with the product data.
        return response()->json([
            'status' => 'success',
            'message' => 'Categories retrieved successfully',
            'data' => $category,
        ], Response::HTTP_OK);
    }

    public function slugPage(): JsonResponse
    {
        // Retrieve all blog from the Post model where post_type is 'page'.
        $pages = Post::where('post_type', 'page')->get();

        // Check if the blog collection is empty.
        if ($pages->isEmpty()) {

            return response()->json([
                'status' => 'success',
                'message' => 'Pages are empty',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map over the blog to extract slug, created_at, and updated_at (formatted as date).
        $pagesData = $pages->map(function ($blog) {
            return [
                'slug' => $blog->slug,
                'CreatedAt' => $blog->created_at->format('Y-m-d'),
                'UpdatedAt' => $blog->updated_at->format('Y-m-d'),
            ];
        });

        // Return a success response with the blog data.
        return response()->json([
            'status' => 'success',
            'message' => 'Pages retrieved successfully',
            'data' => $pagesData,
        ], Response::HTTP_OK);
    }

    public function slugBlog(): JsonResponse
    {
        // Retrieve all blog from the Post model where post_type is 'page'.
        $pages = Post::where('post_type', 'post')->get();

        // Check if the blog collection is empty.
        if ($pages->isEmpty()) {

            return response()->json([
                'status' => 'success',
                'message' => 'blogs are empty',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map over the blog to extract slug, created_at, and updated_at (formatted as date).
        $pagesData = $pages->map(function ($page) {
            return [
                'slug' => $page->slug,
                'CreatedAt' => $page->created_at->format('Y-m-d'),
                'UpdatedAt' => $page->updated_at->format('Y-m-d'),
            ];
        });

        // Return a success response with the blog data.
        return response()->json([
            'status' => 'success',
            'message' => 'blogs retrieved successfully',
            'data' => $pagesData,
        ], Response::HTTP_OK);
    }

}
