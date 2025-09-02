<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'default_lang' => $this->default_lang,
            'default_payment' => $this->default_payment,
            'site_name' => $this->site_name,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keyWords' => $this->meta_keyWords,
            'fav_icon' => $this->fav_icon,
            'email' => $this->email,
            'is_open' => $this->is_open,
            'telr_is_testing' => $this->telr_is_testing,
            'mobile' => $this->mobile,
            'second_mobile' => $this->second_mobile,
            'socials' => [
                'twitter' => $this->twitter,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'tiktok' => $this->tiktok,
                'snapchat' => $this->snapchat,
                'whatsapp' => $this->whatsapp,
            ]
        ];
    }
}
