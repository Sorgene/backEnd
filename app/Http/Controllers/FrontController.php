<?php

namespace App\Http\Controllers;

use Cart;
use App\News;
use App\Order;
use App\Products;
use App\ContactUs;
use App\OrderDetail;
use App\Mail\SentToUser;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use TsaiYiHua\ECPay\Checkout;


class FrontController extends Controller
{
//金流測試用
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function test_check_out()
    {
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'ItemName' => 'Product Name',
            'TotalAmount' => '2000',
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        return $this->checkout->setPostData($formData)->send();
    }



    public function index()
    {
        return view('front/index');
    }

    public function test()
    {
        return view('front/test');
    }

    public function news()
    {
        $news_data = News::orderBy('sort', 'desc')->get();
        return view('front/news', compact('news_data'));
    }

    public function news_detail($id)
    {
        $news = News::with('news_imgs')->find($id);
        return view('front/news_detail', compact('news'));
    }

    public function products()
    {
        $products = Products::all();
        return view('front/products',compact('products'));
    }

    public function product_detail($productId)
    {
        $Product = Products::find($productId);
        return view('front.product_detail',compact('Product'));
    }


    //購物車Cart
    public function add_cart($productId)
    {
        // $productId 1;
        // //darryldecode/laravelshoppingcart
        $Product = products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId =  $productId;// generate a unique() row ID
        // $userID = Auth::user()->id; // the user ID to bind the cart contents

        // add the product to cart
        Cart::add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('cart');
    }
    // public function cart()
    // {
    //     $userID = Auth::user()->id;
    //     $items = \Cart::session($userID)->getContent();
    //     // dd($items);
    //     return view('front.cart'.compact('$items'));
    // }
    public function update_cart(Request $request,$product_id)
    {
        $quantity = $request->quantity;

        Cart::update($product_id, array(
            'quantity' => $quantity, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
          ));

        return 'success';
    }

    public function delete_cart(Request $request,$product_id)
    {
        Cart::remove($product_id);

        return 'success';
    }

    public function cart_total()
    {
        $items = \Cart::getContent()->sort();

        return view('front.cart', compact('items'));
    }

    public function cart_checkout()
    {
        $items = \Cart::getContent()->sort();
        return view('front.cart_checkout', compact('items'));
    }

    public function post_cart_checkout(Request $request)
    {
        $recipient_name = $request->recipient_name;
        $recipient_phone = $request->recipient_phone;
        $recipient_address = $request->recipient_address;
        $shipment_time = $request->shipment_time;

        //建立訂單
        $total_price = \Cart::getTotal();
        if($total_price > 1200){
            $shipment_price = 0;
        }else{
            $shipment_price = 120;
        }

        $order = new Order();
        $order->recipient_name = $recipient_name;
        $order->recipient_phone =  $recipient_phone;
        $order->recipient_address =  $recipient_address;
        $order->shipment_time =  $shipment_time;
        $order->total_price =  $total_price;
        $order->shipment_price =  $shipment_price;
        $order->save();

        $new_order_id = $order->id;

        //建立訂單詳細
        $items = Cart::getContent();
        foreach($items as $row) {
            $order_detail = new OrderDetail();
            $order_detail->order_id =  $new_order_id;
            $order_detail->product_id =  $row->id;;
            $order_detail->qty =  $row->quantity;
            $order_detail->price =  $row->price;
            $order_detail->save();
        }


        //產生訂單編號

        //送出訂單至第三方支付
        //

    }





    //聯絡我們
    public function contactUs()
    {
        return view('front.contactUs');
    }

    public function contactstore(Request $request)
    {
       $user_data = $request->all();
       $content = ContactUs::create($user_data);

       Mail::to('gensoso@gmail.com')->send(new SentToUser($content));//寄信

        return redirect('/contactUs');
    }

}
