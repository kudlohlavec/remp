<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Campaign;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $searchTerm = $request->query('term');

        $searchResult['banners'] = Banner::search($searchTerm)->get();
        $searchResult['campaigns'] = Campaign::search($searchTerm)->get();

        $searchCollection = collect($searchResult);

        return new SearchResource($searchCollection);
    }
}
