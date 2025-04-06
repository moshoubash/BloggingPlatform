<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Price;
use Stripe\Product;
use Stripe\Subscription;
use App\Models\User;

class PaymentController extends Controller
{
    public function checkout()
    {
        // Display the checkout view
        return view('checkout');
    }

    public function process(Request $request)
    {
        // Ensure the user is authenticated
        $user = $request->user();

        // Set your secret Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Check if the user already has an active subscription
        if ($user->stripe_subscription_id) {
            // Retrieve the subscription details from Stripe
            $subscription = Subscription::retrieve($user->stripe_subscription_id);

            if ($subscription->status === 'active') {
                return redirect()->back()->with('error', 'You already have an active subscription.');
            }
        }

        try {
            // Create a Stripe customer if the user doesn't already have one
            if (!$user->stripe_customer_id) {
                $customer = \Stripe\Customer::create([
                    'email' => $user->email,
                    'name' => $user->name,
                ]);

                // Save the Stripe customer ID to the user
                $user->stripe_customer_id = $customer->id;
                $user->save();
            }

            // Create or retrieve the product
            $product = Product::create([
                'name' => 'Premium Membership',
                'description' => 'Access to all premium content',
            ]);

            // Create a recurring price for the subscription
            $price = Price::create([
                'unit_amount' => 999, // Price in cents ($9.99)
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $product->id,
            ]);

            // Create a Stripe Checkout session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $price->id,
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'subscription',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}', // Properly include session ID
                'cancel_url' => route('checkout.cancel'),
                'customer' => $user->stripe_customer_id,
            ]);

            // Redirect to the Stripe Checkout page
            return redirect($session->url);

        } catch (\Exception $e) {
            // Handle errors during session creation
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        // Retrieve session_id from the query string
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return response()->json(['error' => 'Session ID is missing'], 400);
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Retrieve the session from Stripe
            $session = Session::retrieve($sessionId);

            // Find the user associated with the customer ID
            $user = User::where('stripe_customer_id', $session->customer)->first();

            if ($user) {
                // Update user subscription info
                $user->stripe_subscription_id = $session->subscription;

                // Retrieve the subscription to get the price ID
                $subscription = Subscription::retrieve($session->subscription);
                
                if (isset($subscription->items->data[0]->price->id)) {
                    $user->stripe_plan_id = $subscription->items->data[0]->price->id;
                }

                $user->save();

                return view('checkout-success'); // Return the success view
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle errors during session retrieval
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function cancel()
    {
        // Return a cancel view when payment is canceled
        return view('checkout-cancel');
    }
}
