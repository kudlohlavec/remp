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
        $banners = $this->get('banners');
        $campaigns = $this->get('campaigns');

        return [
            $this->when($banners->isNotEmpty(), new BannerSearchCollection($banners)),
            $this->when($campaigns->isNotEmpty(), new CampaignSearchCollection($campaigns)),
        ];
    }
}
