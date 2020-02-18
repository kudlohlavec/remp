<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'pivot',
    ];

    /**
     * Index only fillable data + id
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $indexable = $this->getFillable();
        array_push($indexable, $this->getKeyName());

        return array_filter($this->getAttributes(), function ($key) use ($indexable) {
            return in_array($key, $indexable);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function conversions()
    {
        return $this->hasManyThrough(Conversion::class, ArticleAuthor::class, 'article_author.author_id', 'conversions.article_id', 'id', 'article_id');
    }
}
