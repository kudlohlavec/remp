<?php

namespace App\Http\Resources;

use App\Article;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AuthorSearchCollection
 *
 * @mixin Article
 * @package App\Http\Resources
 */
class ArticleSearchCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\ArticleSearchResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'article' => [
                $this->collection
            ]
        ];
    }
}
