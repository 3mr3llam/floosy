<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    protected $guarded = [];
    protected $translatable = ['name'];
    protected $casts = ['name' => 'array'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
