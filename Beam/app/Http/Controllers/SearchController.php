<?php

namespace App\Http\Controllers;

use App\Article;
use App\Author;
use App\Http\Requests\SearchRequest;
use App\Segment;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $searchTerm = $request->query('term');

        $searchResult['article'] =  $this->normalizeSearchResult(Article::search($searchTerm)->get());
        $searchResult['author'] =  $this->normalizeSearchResult(Author::search($searchTerm)->get());
        $searchResult['segment'] =  $this->normalizeSearchResult(Segment::search($searchTerm)->get());

        //get rid of empty results
        $searchResult = array_filter($searchResult);

        return response()->json($searchResult);
    }

    private function normalizeSearchResult(Collection $searchResultCollection)
    {
        /**
         * @var Searchable $model
         */
        $normalizedCollection = $searchResultCollection->map(function ($model) {
            if (!isset($model->searchable)) {
                return;
            }

            $model->makeHidden(array_keys($model->getAttributes()));
            $model->makeVisible($model->searchable);
            $model->append('search_result_url');

            return $model;
        });

        return $normalizedCollection->isEmpty() ? '' : $normalizedCollection;
    }
}
