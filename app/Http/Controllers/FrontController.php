<?php

namespace App\Http\Controllers;

use App\News;
use App\ContactUs;
use App\Mail\SentToUser;
use App\Mail\OrderShipped;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function product_detail()
    {
        return view('front/product_detail');
    }


    //購物
    public function add_cart()
    {
        // $productId 1;
        // //darryldecode/laravelshoppingcart
        // $Product = products::find($productId); // assuming you have a Product model with id, name, description & price
        // $rowId = 456; // generate a unique() row ID
        // $userID = Auth::user()->id; // the user ID to bind the cart contents

        // // add the product to cart
        // \Cart::session($userID)->add(array(
        //     'id' => $rowId,
        //     'name' => $Product->name,
        //     'price' => $Product->price,
        //     'quantity' => 4,
        //     'attributes' => array(),
        //     'associatedModel' => $Product
        // ));

        // return view('front/cart');
    }
    public function cart()
    {
        $userID = Auth::user()->id;
        $items = \Cart::session($userID)->getContent();
        // dd($items);
        return view('front.cart'.compact('$items'));
    }

    //聯絡我們
    public function contactUs()
    {
        return view('front.contactUs');
    }

    public function contactstore(Request $request)
    {
       $contact = $request->all();
       ContactUs::create($contact);

       Mail::to('gensoso@gmail.com')->send(new SentToUser($contact));//寄信

        return redirect('/contactUs');
    }

}
