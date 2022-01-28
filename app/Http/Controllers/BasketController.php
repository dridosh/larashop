<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BasketController extends Controller
{
    public function index ()
    {
        $ids = session('products');
        $mainAddress = null;
        $email = null;
        $name = null;
        $user = Auth::user();
        if ($user) {
            $mainAddress = Address::where('user_id', Auth::user()->id)->where('main', 1)->first();
            $email = $user->email;
            $name = $user->name;
        }
        $products = collect($ids)->map(function ($quantity, $id) {
            $product = Product::find($id);
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        })->values();

        return view('basket', compact('products', 'mainAddress', 'email', 'name'));
    }

    public function add ()
    {
        $id = request('id');
        $products = session('products', []);

        if (isset($products[$id])) {
            $products[$id] = $products[$id] + 1;
        } else {
            $products[$id] = 1;
        }

        session()->put('products', $products);
        session()->save();
        return [
            'quantity' => $products[$id],
            'basketProductsQuantity' => collect($products)->sum()
        ];
    }

    public function remove()
    {
        $id = request('id');
        $products = session('products', []);

        try {
            if ($products[$id] == 1) {
                unset($products[$id]);
            } else {
                $products[$id] -= 1;
            }
        } catch (Exception $e) {
            Log::info("Нажали на кнопку минус, когда товара не было в корзине {$id}");
        }

        session()->put('products', $products);
        session()->save();
        return [
            'quantity' => $products[$id] ?? 0,
            'basketProductsQuantity' => collect($products)->sum()
        ];
    }

    public function createOrder (Request $request)
    {

        $user = Auth::user();
        $uniqueRule = $user ? "unique:users,email,{$user->id}" : 'unique:users';

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => "required|email|$uniqueRule",
        ]);

        if (!$user) {
            $password = $this->generatePassword(4, 8);
            $name = request('name');
            $email = request('email');
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            Address::create([
                'user_id' => $user->id,
                'address' => request('address'),
                'main' => 1
            ]);
            Auth::loginUsingId($user->id);
        }

        $address = Address::where('user_id', $user->id)->where('main', 1)->first();

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $address->id
        ]);

        $products = collect();
        collect(session('products'))->each(function ($quantity, $id) use ($order, $products) {
            $product = Product::find($id);
            $order->products()->attach($product, [
                'quantity' => $quantity,
                'price' => $product->price
            ]);

            $products->push([
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ]);
        });

        $email = $user ? $user->email : $request['email'];
        $data = [
            'user' => [
                'email' => $email,
                'name' => $user ? $user->name : $request['name']
            ],
            'products' => $products
        ];

        Mail::to($email)->send(new OrderCreated($data));

        session()->forget('products');
        return back();
    }

    public function getProductsQuantity ()
    {
        $products = session('products', []);
        return collect($products)->sum();
    }

    protected function generatePassword ($type, $lenght)
    {
        switch ($type) {
            case 1: {
                $input = '1234567890';
                break;
            }
            case 2: {
                $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            }
            case 3: {
                $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@&?^%';
                break;
            }
            case 4: {
                $input = '0123456789abcdefghijklmnopqrstuvwxyz';
                break;
            }
            default: {
                $input = null;
            }
        }
 
        return $input ? substr(str_shuffle($input), 0, $lenght) : null;
    }
}
