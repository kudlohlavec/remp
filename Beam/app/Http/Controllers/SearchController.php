<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function Search(Request $request) {
        return Author::search('Grac')->get();
    }
}
