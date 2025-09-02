<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaraZeus\Sky\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{

    public function pages(Request $request): JsonResponse
    {
        $pages = Post::where([
            ['status', '=', 'publish'], ['post_type', '=', 'page'],
        ])->paginate(8);

        if ($pages->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.no_pages_found'),
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map the pages data
        $pagesData = PageResource::collection($pages);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.pages_found'),
            'data' => $pagesData,
            'pagination' => [
                'currentPage' => $pages->currentPage(), 'lastPage' => $pages->lastPage(),
                'perPage' => $pages->perPage(), 'total' => $pages->total(),
            ],
        ], Response::HTTP_OK);
    }

    public function getPageBySlug(Request $request, $slug): JsonResponse
    {
        // Query the post by slug, status, and post_type
        $page = Post::where([
            ['status', '=', 'publish'], ['post_type', '=', 'page'], ['slug', '=', $slug],
        ])->first();

        // Check if the page exists
        if (!$page) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.no_page_found'),
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Prepare page data
        $pageData = PageResource::make($page);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.page_found'),
            'data' => $pageData,
        ], Response::HTTP_OK);
    }

    public function getPageById(Request $request, $id): JsonResponse
    {
        // Query the post by slug, status, and post_type
        $page = Post::where([
            ['status', '=', 'publish'], ['post_type', '=', 'page'], ['id', '=', $id],
        ])->first();

        // Check if the page exists
        if (!$page) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.no_page_found'),
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Prepare page data
        $pageData = PageResource::make($page);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.page_found'),
            'data' => $pageData,
        ], Response::HTTP_OK);
    }

    public function posts(Request $request): JsonResponse
    {
        $lang = $request->header('Accept-Language', app()->getLocale());

        // Fetch the blogs with the specified conditions
        $posts = Post::with([
            'media' => function ($query) {
                $query->whereIn('mime_type', ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/avif']);
            }
        ])
            ->where('status', '=', 'publish')
            ->where('post_type', '=', 'post')
            ->paginate(10);

        // Check if there are no blogs
        if ($posts->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.no_posts_found'),
                'data' => [],
            ], Response::HTTP_OK);
        }

        // Map the blog data
        $postsData = PostResource::collection($posts);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.posts_found'),
            'data' => $postsData,
            'pagination' => [
                'currentPage' => $posts->currentPage(),
                'lastPage' => $posts->lastPage(),
                'perPage' => $posts->perPage(),
                'total' => $posts->total(),
            ],
        ], Response::HTTP_OK);
    }

    public function getPostBySlug(Request $request, $slug): JsonResponse
    {
        $post = Post::with([
            'media' => function ($query) {
                $query->whereIn('mime_type', ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/avif']);
            }
        ])->where([
            ['status', '=', 'publish'], ['post_type', '=', 'post'], ['slug', '=', $slug],
        ])->first();

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => __('strings.no_post_found'),
                'data' => null,
            ], Response::HTTP_OK);
        }

        // Map the data of the single blog
        $postData = PostResource::make($post);

        return response()->json([
            'status' => 'success',
            'message' => __('strings.post_found'),
            'data' => $postData,
        ], Response::HTTP_OK);
    }

}
