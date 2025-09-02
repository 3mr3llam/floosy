<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', app()->getLocale());
        return [
            'id' => $this->id,
            'pageType' => $this->post_type,
            'title' => $this->getTranslation('title', $lang),
            'slug' => $this->slug,
            'featuredImage' => $this->featured_image ? url("/storage/app/public/{$this->featured_image}") : null,
            'description' => $this->getTranslation('description', $lang),
            'content' => $this->getTranslation('content', $lang),
        ];
    }
}
