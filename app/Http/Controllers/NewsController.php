<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('auth/news/index');
    }

    public function store(Request $request){
        $News_data = $request ->all();
        News::create($News_data) -> save();
        return redirect('/home/news');
    }
}
