<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', app()->getLocale());
        $mediaImage = $this->media->whereIn('mime_type', ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/avif'])->first();

        return [
            'id' => $this->id,
            'pageType' => $this->post_type,
            'title' => $this->getTranslation('title', $lang),
            'slug' => $this->slug,
            'featuredImage' => $this->featured_image ? url("/storage/app/public/{$this->featured_image}") : (($mediaImage?->file_name) ? url("/storage/app/public/{$mediaImage?->id}/{$mediaImage?->file_name}") : null),
            'description' => $this->getTranslation('description', $lang),
            'content' => $this->getTranslation('content', $lang),
        ];
    }
}
