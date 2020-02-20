<?php

namespace App\Http\Resources;

use App\Segment;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AuthorSearchCollection
 *
 * @mixin Segment
 * @package App\Http\Resources
 */
class SegmentSearchCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\SegmentSearchResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'segment' => [
                $this->collection
            ]
        ];
    }
}
