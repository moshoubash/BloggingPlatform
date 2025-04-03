<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;
use Stripe\Price;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        // Set the Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the authenticated user
        $user = $request->user();

        // Check if the user already has a Stripe customer ID
        $stripeCustomerId = $user->stripe_customer_id;

        // If no Stripe customer ID, create a new Stripe customer
        if (!$stripeCustomerId) {
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            // Save the Stripe customer ID to the user
            $user->stripe_customer_id = $customer->id;
            $user->save();
        } else {
            // Retrieve the existing Stripe customer
            $customer = Customer::retrieve($stripeCustomerId);
        }

        // Create a price for the subscription (you can store this in your DB for reusability)
        $price = Price::create([
            'unit_amount' => 1000, // Amount in cents (1000 = $10.00)
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'], // Monthly recurring subscription
            'product_data' => [
                'name' => 'Premium Monthly Subscription',
                'description' => 'Access to premium content for 1 month',
            ]
        ]);

        // Create a new checkout session for the subscription
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => $price->id, // Use the created price ID
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription', // Subscription mode for recurring payments
            'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('checkout.cancel'),
            'customer' => $customer->id, // Attach the user to the Stripe customer
        ]);

        // Redirect the user to the Stripe checkout page
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        // Get the session ID from the URL
        $sessionId = $request->get('session_id');

        // Set your secret Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve the session details from Stripe
        $session = Session::retrieve($sessionId);

        // Fetch the subscription details from the session
        $subscriptionId = $session->subscription;

        // Get the authenticated user
        $user = $request->user();

        // Optionally, you can update the user's subscription details in your database
        // Save the subscription ID and plan ID (if needed)
        $user->stripe_subscription_id = $subscriptionId;
        $user->stripe_plan_id = 'premium_monthly_plan';  // Or you can map it dynamically from Stripe
        $user->save();

        // Return the checkout-success view
        return view('checkout-success');
    }

    public function cancel(Request $request)
    {
        // Handle payment cancellation
        return view('checkout');  // Show the checkout view on cancellation
    }
}

