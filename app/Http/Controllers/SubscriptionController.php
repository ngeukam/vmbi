<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;

class SubscriptionController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));
        $user = $request->user();
        $user->createOrGetStripeCustomer();
        $user->newSubscription('default', $plan->stripe_plan)
            ->create($request->token, [
                'email' => $user->email,
            ]);

        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }


    public function createPlan()
    {
        return view('plans.create');
    }

    public function storePlan(Request $request)
    {
        $data = $request->except('_token');

        $data['slug'] = strtolower($data['name']);
        $price = $data['cost'];
        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
        ]);

        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'XAF',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        $data['stripe_plan'] = $stripePlanCreation->id;

        Plan::create($data);

        echo 'plan has been created';
    }

}
