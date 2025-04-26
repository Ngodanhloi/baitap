<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Hiển thị chi tiết đơn hàng.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Lấy thông tin đơn hàng với các sản phẩm liên quan (eager loading)
        $order = Order::with('products')->findOrFail($id);

        // Kiểm tra xem đơn hàng có sản phẩm hay không
        if ($order->products->isEmpty()) {
            $productCount = 0;
        } else {
            $productCount = $order->products->count();
        }

        // Trả về view với dữ liệu đơn hàng và số lượng sản phẩm
        return view('orders.show', compact('order', 'productCount'));
    }

    /**
     * Hiển thị danh sách đơn hàng của người dùng.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy tất cả đơn hàng với eager loading
        $orders = Order::with('products')->paginate(10);

        // Trả về view với dữ liệu đơn hàng
        return view('orders.index', compact('orders'));
    }

    /**
     * Xóa đơn hàng.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Tìm và xóa đơn hàng
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công');
    }
}
