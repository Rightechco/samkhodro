<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController
{
    public function index()
    {
        $orders = Order::query()->latest()->paginate(50);
        return view('admin.order.index',compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit',compact('order'));
    }

    public function update(Request $request,Order $order)
    {
        $request->validate([
            'status' => ['required',Rule::in(Order::$statuses)],
            'note' => 'nullable|string|max:5500',
        ]);

        $order->status = $request->status;
        $order->note = $request->note ?? '-';
        $order->save();

        return redirect('/admin/order/')->with([
            'message' => 'سفارش با موفقیت ویرایش شد'
        ]);
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect('/admin/order/')->with([
            'message' => 'سفارش با موفقیت حذف شد'
        ]);
    }
}
