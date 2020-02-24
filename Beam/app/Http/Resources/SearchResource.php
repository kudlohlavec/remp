<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $authors = $this->get('authors');
        $articles = $this->get('articles');
        $segments = $this->get('segments');

        return [
            $this->when(!$authors->isEmpty(), new AuthorSearchCollection($authors)),
            $this->when(!$articles->isEmpty(), new ArticleSearchCollection($articles)),
            $this->when(!$segments->isEmpty(), new SegmentSearchCollection($segments))
        ];
    }
}
