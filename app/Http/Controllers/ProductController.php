<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::get();        
        return view('products', ['products' => $products]);
    }

    public function show(Request $request, $id) {
        $product = Product::find($id);
        // user login is needed
        // for test purpose i used user id 1 
        //auth()->user()
        $user = User::find(1);        
        $intent = $user->createSetupIntent();
        return view('product-detail', ['product' => $product, 'intent' => $intent]);
    }

    public function subscription(Request $request)
    {
        $plan = Product::find($request->plan);
        $user = User::find(1);
        try {        
            $payment_id = $request->token;
            // user login is needed
            // for test purpose i used user id 1
            $user->charge($plan->price * 100, $payment_id);
            $subscription = $user->newSubscription($request->plan, $plan->stripe_plan)->create($payment_id);            

            //store the responses in payment history table
            \Log::info("subscription");
            \Log::info($subscription);
            return view("subscription_success");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
