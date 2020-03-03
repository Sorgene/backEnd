<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $all_news = DB::table('news')->get();

        return view('admin/news/index',compact('all_news'));
    }

    public function store(Request $request){
        $News_data = $request ->all();
        News::create($News_data) ;
        return redirect('/home/news');
    }
    
}
