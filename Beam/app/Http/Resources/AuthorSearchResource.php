<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArticleResource
 *
 * @mixin Author
 * @package App\Http\Resources
 */
class AuthorSearchResource extends JsonResource
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
            'name' => $this->name
        ];
    }
}
