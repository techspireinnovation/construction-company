<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
{
    $subscriptions = Subscription::latest()->paginate(15);
    return view('admin.subscriptions.index', compact('subscriptions'));
}

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:subscriptions,email'
    ]);

    Subscription::create([
        'email' => $request->email
    ]);

    return back()->with('success', 'Subscribed successfully!');
}
}
