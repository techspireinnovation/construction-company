<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
{
    $subscriptions = Subscription::latest()->paginate(15);
    return view('admin.subscriptions.index', compact('subscriptions'));
}


}
