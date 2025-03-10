<?php

namespace App\Http\Controllers\Profile;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController
{
    public function storeOrder(Request $request)
    {
        $request->validate([
            'number' => ['nullable','numeric','regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'product' => 'required|numeric|exists:products,id',
        ]);

        if ($request->number) {
            $user = auth()->user();
            $user->number = $request->number;
            $user->save();
        }

        $order = Order::query()->create([
           'user_id' => auth()->user()->id,
           'product_id' => $request->product
        ]);

        return redirect()->back()->with([
            'message' => 'سفارش با موفقیت ایجاد شد'
        ]);
    }
}
