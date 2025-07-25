<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Inertia\Inertia;

class Post extends Model
{

    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'title',
        'content', 
        'user_id',
        'category_id',
        'slug',
        'views'
    ];


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
