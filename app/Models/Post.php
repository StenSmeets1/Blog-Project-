<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;
    protected $guarded = [];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create ()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
