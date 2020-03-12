<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front/index');
    }
    public function news()
    {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/news', compact('news_data'));
    }
    // public function test(Request $request){
    //     $id = $request->id;
    //     dd($id);
    // }
    public function news_detail($id)
    {
        $news = News::find($id);
        return view('front/news_detail', compact('news'));
    }

    public function products()
    {
        return view('front/products');
    }

    public function product_inner()
    {
        return view('front/product_inner');
    }

    public function contact()
    {
        return view('front/contact');
    }

}
