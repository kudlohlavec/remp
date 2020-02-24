<?php

namespace App\Http\Resources;

use App\Segment;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArticleResource
 *
 * @mixin Segment
 * @package App\Http\Resources
 */
class SegmentSearchResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'search_result_url' => route('segments.edit', $this)
        ];
    }
}
