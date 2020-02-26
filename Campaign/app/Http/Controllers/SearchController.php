<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Campaign;
use App\Http\Resources\SearchResource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->query('term');

        $searchResult['banners'] = Banner::search($searchTerm)->get();
        $searchResult['campaigns'] = Campaign::search($searchTerm)->get();

        $searchCollection = collect($searchResult);

        return new SearchResource($searchCollection);
    }
}
