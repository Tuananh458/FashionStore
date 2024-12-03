<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use App\Notifications\OrderConfirmed;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * BrandController constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
    public function index()
    {
        return view('admin.order.index', $this->orderService->index());
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', $this->orderService->edit($order));
    }

    public function update(Order $order, Request $request)
    {
        // Kiểm tra nếu đơn hàng đã được xác nhận hoặc đã được xử lý trước đó
        if ($order->order_status == Order::STATUS_ORDER['received']) {
            return redirect()->route('admin.orders_index')->with('error', 'Đơn hàng đã được xác nhận trước đó');
        }

        // Cập nhật trạng thái đơn hàng thành 'received' (đã xác nhận)
        $order->order_status = Order::STATUS_ORDER['received'];  
        $order->save();  // Lưu lại trạng thái mới của đơn hàng

        // Gửi sự kiện OrderConfirmed
        event(new OrderConfirmed($order));  // Gọi sự kiện OrderConfirmed

        // Kiểm tra nếu người dùng có đăng ký nhận thông báo
        if ($order->user->notifications_enabled) {
            // Gửi thông báo qua email khi đơn hàng được xác nhận
            $order->user->notify(new OrderConfirmed($order));
        }

        // Gọi hàm update trong service để xử lý các logic khác
        $this->orderService->update($order, $request);

        // Trả về kết quả sau khi cập nhật, hiển thị thông báo thành công
        return redirect()->route('admin.orders_index')->with('success', 'Đơn hàng đã được xác nhận');
    }

    public function delete(Request $request)
    {
        return $this->orderService->delete($request);
    }
}
