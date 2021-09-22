<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
class Post extends Controller
{
    public function index( Request $request ) {
        return view('post');
    }

    public function datatable( Request $request ) {

        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $repositories = $response->json();

        return Datatables::of($repositories)->make(true);
    }
}
