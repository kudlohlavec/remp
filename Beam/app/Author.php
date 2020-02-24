<?php

namespace App;

use App\Traits\SearchableAttributes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
    use Searchable, SearchableAttributes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'pivot',
    ];

    public $searchable = [
        'name'
    ];

    /**
     * Accessor for runtime-appended search_result_url attribute
     *
     * @return string
     */
    public function getSearchResultUrlAttribute()
    {
        return route('authors.show', $this);
    }

    /**
     * Index only searchable data
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->getSearchableAttributes($this->searchable, $this->getKeyName(), $this->getAttributes());
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
