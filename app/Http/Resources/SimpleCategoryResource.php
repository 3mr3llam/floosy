<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->getTranslation('name', app()->getLocale()),
            'slug' => $this->getTranslation('slug', app()->getLocale()),
            'image' => isset($this->image) && !is_null($this->image) ? url("public/storage/{$this->image}") : null,
            'type' => $this->type,
            'parentId' => $this->parent_id,
        ];
    }
}
