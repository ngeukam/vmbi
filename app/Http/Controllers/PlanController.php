<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $plans = Plan::all();
        return view('stats.pricing', compact('plans'));
    }

    /**
     * Show the Plan.
     *
     * @return mixed
     */
    public function show(Plan $plan, Request $request)
    {
        $paymentMethods = $request->user()->paymentMethods();
        $intent = $request->user()->createSetupIntent();

        return view('stats.checkout', compact('plan', 'intent'));
    }
}
