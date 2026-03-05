<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $order = order::findOrFail($id);
        $incoming = $request->status;
        $map = [
            'en_cours' => 'shipped',
            'livre' => 'delivered',
            'annule' => 'cancelled',
            'pending' => 'pending',
            'confirmed' => 'confirmed',
            'shipped' => 'shipped',
            'delivered' => 'delivered',
            'cancelled' => 'cancelled',
        ];
        $status = $map[$incoming] ?? 'pending';
        $order->status = $status;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Statut mis à jour');
    }
}

