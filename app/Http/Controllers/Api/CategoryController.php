<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SimpleCategoryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        // Fetch categories with relationships, including subcategories and their products
        $categories = Category::with([
            'parent',
            'subcategories' => function ($query) {
                $query->with([
                    'products' => function ($query) {
                        $query->take(8);
                    }
                ]);
            },
//            'products' => function ($query) {
//                $query->take(8);
//            }
        ])->get();

        // Check if the categories collection is empty
        if ($categories->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Categories are empty',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Format the categories into the desired format
        $formattedCategories = CategoryResource::collection($categories);
        // Check if the formatted categories collection is empty after filtering
        if ($formattedCategories->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No valid categories found',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Return the formatted categories
        return response()->json([
            'status' => 'success',
            'message' => 'Categories retrieved successfully',
            'data' => $formattedCategories, // Reset array keys after filtering
        ], Response::HTTP_OK);
    }


    public function productWithCategory($slug, Request $request)
    {

        // Get the language from the request header (default to 'ar').
        $acceptLanguage = $request->header('Accept-Language', 'ar');

        // Set the language for the current request.
        app()->setLocale($acceptLanguage);

        // Retrieve the category based on the language-specific slug.
        $category = Category::whereJsonContains('slug->' . $acceptLanguage, $slug)
            ->orWhereJsonContains('slug->ar', $slug)
            ->first();

        // If the category is not found, return an error response.
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
                'data' => [],
            ], Response::HTTP_NOT_FOUND);
        }

        // Retrieve all products under this category.
        $categoryId = $category->id;
        $products = Product::with(['comment', 'category'])->where('category_id', $categoryId)->paginate(6);

        // Filter the products based on the locale and ensure the product name and other fields are not null or empty.
        $filteredProducts = $products;

        // Check if there are any products left after filtering.
        if ($filteredProducts->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No products found for the selected locale',
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map the filtered products data.
        $formattedProducts = ProductResource::collection($filteredProducts);

        // Return the formatted products response.
        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'data' => $formattedProducts,
            'pagination' => [
                'currentPage' => $products->currentPage(),
                'lastPage' => $products->lastPage(),
                'perPage' => $products->perPage(),
                'total' => $products->total(),
            ],
        ], Response::HTTP_OK);
    }

    public function categoriesByType($type, Request $request)
    {

        // Get the language from the request header (default to 'ar').
        $acceptLanguage = $request->header('Accept-Language', 'ar');

        // Set the language for the current request.
        app()->setLocale($acceptLanguage);

        // Retrieve the category based on the language-specific type.
        $categories = Category::with('products')->where('type', $type)
            ->paginate();

        // If the category is not found, return an error response.
        if (!$categories) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
                'data' => [],
            ], Response::HTTP_NOT_FOUND);
        }



        // Map the filtered products data.
        $formattedCategories = SimpleCategoryResource::collection($categories);

        // Return the formatted products response.
        return response()->json([
            'status' => 'success',
            'message' => 'Categories retrieved successfully',
            'data' => $formattedCategories,
        ], Response::HTTP_OK);
    }
}
