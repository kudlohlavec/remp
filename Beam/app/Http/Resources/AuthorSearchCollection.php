<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AuthorSearchCollection
 *
 * @mixin Author
 * @package App\Http\Resources
 */
class AuthorSearchCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\AuthorSearchResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'author' => [
                $this->collection
            ]
        ];
    }
}
