<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function all()
    {
        $order = ProductOrder::with('product', 'user');

        if (request()->status) {
            $status = request()->status;
            $order->where('status', $status);
        }

        $order = $order->latest()->paginate(10);
        return view('admin.order.all', compact('order'));
    }
    public function changeOrderList(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $product_order = ProductOrder::where('id', $id);

        $product_order->update([
            'status' => $status
        ]);

        Product::where('id', $product_order->first()->product_id)->update([
            'total_quantity' => DB::raw('total_quantity-1')
        ]);

        return redirect('/admin/order-list')->with('success', 'Order status changed');
    }
}
