<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionConfirmed;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        // Save subscription
        $subscription = Subscription::create([
            'email' => $request->email,
            
        ]);
        

        // Send confirmation email
        Mail::to($subscription->email)->send(new SubscriptionConfirmed());

        // Redirect or return response
        return redirect()->back()->with('message', 'Subscription successful! Please check your email for confirmation.');
    }
}
