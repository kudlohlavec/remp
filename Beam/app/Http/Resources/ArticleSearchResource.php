<?php

namespace App\Http\Resources;

use App\Article;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArticleResource
 *
 * @mixin Article
 * @package App\Http\Resources
 */
class ArticleSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'search_result_url' => route('articles.show', $this)
        ];
    }
}
