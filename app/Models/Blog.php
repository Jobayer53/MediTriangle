<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Unknown',
            'slug' => 'Unknown',
        ]);
    }

    public function parts()
    {
        return $this->hasMany(BlogParts::class, 'blog_id');
    }

    public function parentParts()
    {
        return $this->hasMany(BlogParts::class, 'part_id');
    }

    public function gettingDate()
    {
        return $this->created_at->format('d M y');
    }

    public function description()
    {
        $text = $this->seo_description;
        if (strlen($text) >= 100) {
            $text = substr($text, 0, 100) . ' ...';
        }
        return $text;
    }
}
