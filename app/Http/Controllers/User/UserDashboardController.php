<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';
        return view('cms.users.new_dashboard', compact('pageTitle'));
        // return view('cms.users.dashboard', compact('pageTitle'));
    }

    public function showOrder()
    {
        $this->setPageTitle('Orders', '');
        if (Auth::check()) {
            return (request()->ajax())
                ? $this->datatable()
                :view('cms.users.orders.new_show');
        }
    }
    protected function datatable()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return DataTables::of($orders)
            ->addColumn('actions', function ($data) {
                if ($data->status=='pending') {
                    $cancel = '<a
                                href="#"
                                id="cancel-btn"
                                data-id="' . $data->id . '"
                                type="button"
                                class="btn btn-danger "
                                data-bs-toggle="tooltip"
                                title="Cancel Order"
                            >Cancel</a>';
                } else {
                    $cancel = '';
                }
                $view = '<a
                                href="'.route('user.orders.details.view', $data->id).'"
                                id="view-btn"
                                data-id="' . $data->id . '"
                                type="button"
                                class="btn btn-warning text-white"
                                data-bs-toggle="tooltip"
                                title="View Order"
                            ><i class="fa fa-eye"></i> </a>';
                return $cancel .' '. $view;
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'cancel') {
                    $badge = 'danger';
                } elseif ($data->status == 'pending') {
                    $badge = 'primary';
                } elseif ($data->status == 'accepted') {
                    $badge = 'info';
                } elseif ($data->status == 'completed') {
                    $badge = 'success';
                } else {
                    $badge = 'secondary';
                }
                return '<span class="badge bg-'.$badge.'">'.ucfirst($data->status).'</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function statusChange(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $order = Order::findOrFail($request['order_id']);
                if ($order->status == 'pending') {
                    $order->status = $request['status'];
                    if ($request['status'] == 'cancel') {
                        foreach ($order->products as $product) {
                            $product->quantity = $product->pivot->quantity + $product->quantity;
                            $product->update();
                        }
                    }
                    return $order->update()
                        ? response()->json(['message' => 'Order Status Updated Successfully.', 'order' => $order, 'status' => 'success'])
                        : response()->json(['message' => 'Error occurred while updating order status.', 'status' => 'error']);
                }
                return response()->json(['message' => 'Error occurred while updating order status.', 'status' => 'error']);
            });
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

        return response()->json(['message' => 'Error occurred while updating order status.', 'status' => 'error']);
    }

    public function viewOrderDetail($id)
    {
        $this->setPageTitle('Detail Order View', '');
        $order = Order::with(['products'])->where('id', $id)->where('user_id', Auth::user()->id)->first();
        return view('cms.users.orders.new_viewDetail', [
            'order' => $order,
            'shipping_address' => json_decode($order->shipping_address, true)
        ]);
    }
}
