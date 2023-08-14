<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\sliders;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\Redis;
use PDO;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        if (Auth::id()) {
            $cate = Auth::user()->categories;
            if ($cate == '1') {
                $data = category::all();
                return view('admin.category', compact('data'));
            } else {
                return view('admin.noac');
            }
        } else {
            return redirect('login');
        }
    }
    public function add_category(Request $request)
    {
        $data = new category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    public function view_product()
    {
        if (Auth::id()) {
            $addproduct = Auth::user()->add_products;
            if ($addproduct == '1') {
                $category = category::all();
                return view('admin.product', compact('category'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function add_product(Request $request)
    {

        if (Auth::id()) {
            $addproduct = Auth::user()->add_products;
            if ($addproduct == '1') {
                $product = new Product();
                $product->title = $request->title;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->category = $request->category;
                $product->discount_price = $request->dis_price;
                $image = $request->image;
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('uplouds/products', $image_name);
                $product->image = $image_name;
                $product->save();
                return redirect()->back()->with('message', 'Product Added Successfully');
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function show_product()
    {

        if (Auth::id()) {
            $showproduct = Auth::user()->products;
            if ($showproduct == '1') {
                $product = product::all();
                return view('admin.show_product', compact('product'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function delete_product($id)
    {
        if (Auth::id()) {
            $showproduct = Auth::user()->products;
            if ($showproduct == '1') {
                $product = product::find($id);
                $product->delete();
                return redirect()->back()->with('message', 'Product Deleted Successfully');
                ;
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function update_product($id)
    {
        $product = product::find($id);
        $cate = category::all();
        return view('admin.update_product', compact('product', 'cate'));
    }
    public function search_product(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%")->orWhere('category', 'LIKE', "%$search%")->get();
        return view('admin.show_product', compact('product'));
    }
    public function add_product_confirm(Request $request, $id)
    {
        if (Auth::id()) {
            $product = product::find($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;
            $product->discount_price = $request->dis_price;
            $image = $request->image;
            if ($image) {
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('uplouds/products', $image_name);
                $product->image = $image_name;
            }
            $product->save();
            return redirect()->back()->with('message', 'Product Updated Successfully');
        } else {
            return redirect('login');
        }
    }
    public function order()
    {
        if (Auth::id()) {
            $orders = Auth::user()->orders;
            if ($orders == '1') {
                $order = order::all();
                return view('admin.order', compact('order'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function delivered($id)
    {
        if (Auth::id()) {
            $orders = Auth::user()->orders;
            if ($orders == '1') {
                $order = order::find($id);
                $order->delivery_status = "Delivered";
                $order->payment_status = "Paid";
                $order->save();
                return redirect()->back();
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function print_pdf($id)
    {
        if (Auth::id()) {
            $orders = Auth::user()->orders;
            if ($orders == '1') {
                $order = order::find($id);
                $pdf = PDF::loadView('admin.pdf', compact('order'));
                return $pdf->download('order_details.pdf');
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function send_email($id)
    {
        if (Auth::id()) {
            $orders = Auth::user()->orders;
            if ($orders == '1') {
                $order = order::find($id);
                return view('admin.email_info', compact('order'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function send_user_email(Request $request, $id)
    {
        $order = order::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firsline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $order = order::where('name', 'LIKE', "%$search%")->orWhere('phone', 'LIKE', "%$search%")->orWhere('product_title', 'LIKE', "%$search%")->get();
        return view('admin.order', compact('order'));
    }
    public function vadduser()
    {
        if (Auth::id()) {
            $add_user = Auth::user()->add_user;
            if ($add_user == '1') {
                return view('admin.add_user');
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function adduser(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->usertype = $request->susertype;
        $user->products = $request->sproducts;
        $user->add_products = $request->saddproduct;
        $user->categories = $request->scategories;
        $user->orders = $request->sorders;
        $user->show_users = $request->susers;
        $user->add_user = $request->sadduser;
        $user->sliders = $request->sliders;
        $user->save();
        return redirect()->back();
    }
    public function showusers()
    {
        if (Auth::id()) {
            $show_users = Auth::user()->show_users;
            if ($show_users == '1') {
                $all_users = User::all();
                return view('admin.show_users', compact('all_users'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function update_user($id)
    {
        if (Auth::id()) {
            $show_users = Auth::user()->show_users;
            if ($show_users == '1') {
                $userid = User::find($id);
                return view('admin.updateuser', compact('userid'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function edit_user(Request $request, $id)
    {
        if (Auth::id()) {
            $user = User::find($id);
            $user->name = $request->username;
            $user->email = $request->email;
            if ($request->password == "") {

            } else {
                $user->password = Hash::make($request->password);
            }
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->usertype = $request->susertype;
            $user->products = $request->sproducts;
            $user->categories = $request->scategories;
            $user->add_products = $request->saddproduct;
            $user->orders = $request->sorders;
            $user->add_user = $request->sadduser;
            $user->show_users = $request->susers;
            $user->sliders = $request->sliders;
            $user->save();
            return redirect()->back()->with('message', 'User Updated Successfully');
        } else {
            return redirect('login');
        }
    }
    public function delete_user($id)
    {
        if (Auth::id()) {
            $show_users = Auth::user()->show_users;
            if ($show_users == '1') {
                $user = User::find($id);
                $user->delete();
                return redirect()->back()->with('message', 'User Deleted Successfully');
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function search_user(Request $request)
    {
        $search = $request->search;
        $all_users = User::where('email', 'LIKE', "%$search%")->orWhere('phone', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%")->get();
        return view('admin.show_users', compact('all_users'));
    }
    public function show_sliders()
    {
        if (Auth::id()) {
            $sliders = Auth::user()->sliders;
            if ($sliders == '1') {
                $all_sliders = sliders::all();
                return view('admin.show_sliders', compact('all_sliders'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function update_slider($id)
    {
        if (Auth::id()) {
            $sliders = Auth::user()->sliders;
            if ($sliders == '1') {
                $slider = sliders::find($id);
                return view('admin.update_slider', compact('slider'));
            } else {
                return view('admin.noac');
            }

        } else {
            return redirect('login');
        }
    }
    public function edit_slider(Request $request, $id)
    {
        if (Auth::id()) {
            $slider = sliders::find($id);
            $slider->redtitle = $request->red;
            $slider->bluetitle = $request->blue;
            $slider->desc = $request->desc;
            $slider->save();
            return redirect()->back()->with('message', 'Slider Updated Successfully');
        } else {
            return redirect('login');
        }
    }
}