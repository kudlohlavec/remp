<?php

namespace App\Http\Resources;

use App\Article;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArticleSearchResource
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
            'tags' => $this->tags->pluck('name'),
            'sections' => $this->sections->pluck('name'),
            'search_result_url' => route('articles.show', $this)
        ];
    }
}
