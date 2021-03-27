<?php
namespace App\Providers;
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Db;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('product', ['products'=>$data]);
    }

    public function detail($id)
    {
        $data =  Product::find($id);
        return view('detail', ['product'=>$data]);
    }

    public function search(Request $req)
    {
        
        $data = Product::where('name','like','%'.$req->input('query').'%')->get(

        );
        return view('search', ['products'=>$data]);
    }

    public function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart = new Cart();
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req['test'];
            $cart->save();
            return redirect('/');

        }
        else
        {
            return redirect('/login');
        }
    }

    static public function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    public function cartList(Request $req)
    {
        if($req->session()->has('user'))
        {
            $userId = Session::get('user')['id'];
            $products = DB::table('cart')
                        ->join('products', 'cart.product_id', '=', 'products.id')
                        ->where('cart.user_id', $userId)
                        ->select('products.*', 'cart.id as cart_id')
                        ->get();
            return view('cartList', ['products'=>$products]);
        }else{
            return redirect('/login');
        }
        
    }

    public function removecart($id)
    {
        Cart::destroy($id);
        return redirect('/cartList');
    }

    public function ordernow(Request $req)
    {
        if($req->session()->has('user'))
        {
            $userId = Session::get('user')['id'];
            $total = DB::table('cart')
                        ->join('products', 'cart.product_id', '=', 'products.id')
                        ->where('cart.user_id', $userId)
                        ->sum('products.price');
            return view('ordernow', ['total'=>$total]);
        }else{
            return redirect('/login');
        }
    }

    public function orderplace(Request $req)
    {
        if($req->session()->has('user'))
        {
            $userId = Session::get('user')['id'];
            $allCart = Cart::where('user_id', $userId)->get();
            foreach($allCart as $cart)
            {
                $order = new Order;
                $order->product_id = $cart['product_id'];
                $order->user_id = $cart['user_id'];
                $order->status = "pending";
                $order->payment_method=$req->payment;
                $order->payment_status = "pending";
                $order->address = $req->address;
                $order->save();
                Cart::where('user_id', $userId)->delete();
                $req->input();
                return redirect('/');
            }
        }else{
            return redirect('/login');
        }
    }
}
