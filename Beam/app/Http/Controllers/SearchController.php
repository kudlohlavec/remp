<?php

namespace App\Http\Controllers;

use App\Article;
use App\Author;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Segment;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $searchTerm = $request->query('term');

        $searchResult['articles'] = Article::search($searchTerm)->get();
        $searchResult['authors'] = Author::search($searchTerm)->get();
        $searchResult['segments'] = Segment::search($searchTerm)->get();

        $searchCollection = collect($searchResult);

        return new SearchResource($searchCollection);
    }
}
