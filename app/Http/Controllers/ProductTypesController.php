<?php

namespace App\Http\Controllers;

use App\ProductTypes;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function index()
    {
        $all_types = ProductTypes::all();
        return view('admin/productTypes/index',compact('all_types'));
    }

    public function create()
    {
        return view('admin/productTypes/create');
    }

    public function store(Request $request){
        $products_data = $request->all();

        $product_types = ProductTypes::create($products_data);
        $product_types->save();
        return redirect('home/productTypes/');
    }

    public function edit($id) {
        // $news_data = $request -> first();
        $products_type = ProductTypes::find($id);

        return view('admin/ProductTypes/edit',compact('products_type'));
    }

    public function update(Request $request,$id){

        //法一
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        //法二
            ProductTypes::find($id)->update($request->all());

            return redirect('home/productTypes/');
    }


    public function delete(Request $request,$id) {
        ProductTypes::find($id)->delete();
        return redirect('home/productTypes/');
    }
}
