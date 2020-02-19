<?php

namespace App\Http\Controllers;

use App\Article;
use App\Author;
use App\Http\Resources\AuthorSearchCollection;
use App\Http\Resources\AuthorSearchResource;
use App\Segment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function Search(Request $request) {
        $collection =  Author::search('Prof')->get();
//        dd($collection);

        return new AuthorSearchCollection($collection);
//        return AuthorSearchResource::collection($collection);
    }
}
