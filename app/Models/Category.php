<?php

namespace App\Models;

//use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['name', 'slug'];

    // protected $cast = ['slug' => 'array'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

//    public function products(): HasMany
//    {
//        return $this->hasMany(Product::class);
//    }

    public static function slug($string, $separator = '-'): array|string|null
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");

        // Replace slashes
        $string = str_replace(['/', '\\'], $separator, $string);
        // Remove unwanted characters
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Reduce spaces to a single separator
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Replace spaces with the separator
        return preg_replace("/[\s_]/", $separator, $string);
    }
}
