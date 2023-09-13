<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['lesson'=>fn($q)=>$q->with('subject','academicYear')])->latest()->get();

        return view('admin.subscriptions.index',get_defined_vars());
    }

    function orders() {
        $orders = Order::latest()->get();

        return view('admin.subscriptions.orders',get_defined_vars());
    }
}
