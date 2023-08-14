<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\sliders;
use Illuminate\Http\RedirectResponse;
use Session;
use Stripe;



class HomeController extends Controller
{
    public function index()
    {
        $product = Product::orderby('id', 'desc')->Paginate(6);
        $comment = Comment::orderby('id', 'desc')->paginate(5);
        $reply = Reply::orderby('id', 'desc')->paginate(3);
        $slider0 = sliders::find('1');
        $slider1 = sliders::find('2');
        $slider2 = sliders::find('3');
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
        } else {
            $count_cart = 0;
        }
        return view('home.userpage', compact('product', 'comment', 'reply', 'count_cart', 'slider0', 'slider1', 'slider2'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $Products = Product::all()->count();
            $Orders = Order::all()->count();
            $Users = User::all()->count();
            $Revenue = Order::all();
            $All_Revenue = 0;
            foreach ($Revenue as $Revenue) {
                $All_Revenue = $All_Revenue + $Revenue->price;
            }
            $All_Delivery = Order::where('delivery_status', '=', 'Delivered')->get()->count();
            $All_pro = Order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', compact('Products', 'Orders', 'Users', 'All_Revenue', 'All_Delivery', 'All_pro'));
        } else {
            $product = Product::orderby('id', 'desc')->Paginate(6);
            $product = Product::orderby('id', 'desc')->Paginate(6);
            $comment = Comment::orderby('id', 'desc')->paginate(5);
            $reply = Reply::all();
            if (Auth::id()) {
                $userid = Auth::user()->id;
                $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
            } else {
                $count_cart = 0;
            }
            return view('home.userpage', compact('product', 'comment', 'reply', 'count_cart'));
        }
    }
    public function product_details($id)
    {
        $product = product::find($id);
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
        } else {
            $count_cart = 0;
        }
        return view('home.product_details', compact('product', 'count_cart'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $product = product::find($id);
            $product_exist_id = cart::where('Product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();
            if ($product_exist_id != null) {
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $price = $cart->price;
                    $cart->price = $price + $product->discount_price * $request->quantity;
                } else {
                    $price = $cart->price;
                    $cart->price = $price + $product->price * $request->quantity;
                }
                $cart->save();
                Alert::success('Product Added Successfully', 'We Have Added Product To The Cart');
                return redirect()->back();
            } else {
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product Added Successfully', 'We Have Added Product To The Cart');
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
            return view('home.showcart', compact('cart', 'count_cart'));
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = cart::where('user_id', '=', $user_id)->get();
        foreach ($data as $data) {
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have Received your Order. we will connect with you soon...');
    }
    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }
    public function stripePost(Request $request, $totalprice): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $data = cart::where('user_id', '=', $user_id)->get();
        foreach ($data as $data) {
            $order = new order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return back()
            ->with('success', 'Payment successful!');
    }
    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $order = order::where('user_id', '=', $user_id)->get();
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
            return view('home.order', compact('order', 'count_cart'));
        } else {
            return redirect('login');
        }
    }
    public function cancel_cart($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You Canceled the order';
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment = new comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }

    }
    public function product_search(Request $request)
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
        } else {
            $count_cart = 0;
        }
        $slider0 = sliders::find('1');
        $slider1 = sliders::find('2');
        $slider2 = sliders::find('3');
        $comment = Comment::orderby('id', 'desc')->paginate(5);
        $reply = Reply::orderby('id', 'desc')->get();
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orwhere('category', 'LIKE', "%$search_text%")->paginate(6);
        return view('home.userpage', compact('product', 'comment', 'reply', 'count_cart', 'slider0', 'slider1', 'slider2'));
    }
    public function product()
    {
        $product = Product::orderby('id', 'desc')->Paginate(6);
        $comment = Comment::orderby('id', 'desc')->paginate(5);
        $reply = Reply::orderby('id', 'desc')->get();
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
        } else {
            $count_cart = 0;
        }
        return view('home.all_products', compact('product', 'comment', 'reply', 'count_cart'));
    }
    public function search_product(Request $request)
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $count_cart = Cart::where('user_id', '=', $userid)->get()->count();
        } else {
            $count_cart = 0;
        }
        $comment = Comment::orderby('id', 'desc')->paginate(5);
        $reply = Reply::orderby('id', 'desc')->get();
        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orwhere('category', 'LIKE', "%$search_text%")->paginate(6);
        return view('home.all_products', compact('product', 'comment', 'reply', 'count_cart'));
    }
}