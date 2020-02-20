<?php

namespace App\Http\Controllers;

use App\Article;
use App\Author;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ArticleSearchCollection;
use App\Http\Resources\AuthorSearchCollection;
use App\Http\Resources\AuthorSearchResource;
use App\Http\Resources\SegmentSearchCollection;
use App\Segment;
use function Deployer\get;
use function GuzzleHttp\Promise\all;
use function MongoDB\BSON\toJSON;

class SearchController extends Controller
{
    public function Search(SearchRequest $request) {
        $searchTerm = $request->query('term');

        //todo: looks like resources are not good for transforming of data in order to combine them before actual returning of response
        // consider usage of some transform-specialized class/solution
        $searchResult[] =  new ArticleSearchCollection(Article::search($searchTerm)->get());
        $searchResult[] =  new AuthorSearchCollection(Author::search($searchTerm)->get());
        $searchResult[] =  new SegmentSearchCollection(Segment::search($searchTerm)->get());

        dd($searchResult[2]->toResponse(app('response'))->getContent());
        return new SegmentSearchCollection($searchResult);
    }
}
