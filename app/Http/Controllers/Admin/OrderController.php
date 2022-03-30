<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $this->setPageTitle('Orders', '');
        return (request()->ajax())
            ? $this->datatable($request)
            : view('cms.admin.orders.index');
    }

    public function show(Order $order)
    {
        $this->setPageTitle('Order', '');
        $order->load('user', 'products');
        return view('cms.admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        try {
            $data=$request->validate([
                'status'=>'required',
            ]);
            $order->update($data);

            if ($request->status=='cancel') {
                foreach ($order->products as $product) {
                    $product->quantity =$product->pivot->quantity + $product->quantity;
                    $product->update();
                }
            }
        } catch (\Throwable $exception) {
            return $this->responseRedirectBack($exception->getMessage(), 'error', true, true);
        }
        return $this->responseRedirect('admin.orders.index', 'Order Status Updated Successfully.', 'success');
    }

    protected function datatable(Request $request)
    {
        $query = Order::latest();

        $query->when($request['order_code'], function ($q) {
            return $q->where('order_code', 'like', '%' . request('order_code') . '%');
        });

        $query->when($request['username'], function ($q) use ($request) {
            $q->whereHas('user', function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%' . $request['username'] . '%');
            });
        });

        $query->when($request['order_status'], function ($q) {
            return $q->where('status', 'like', '%' . request('order_status') . '%');
        });

        $query->when($request['billing_email'], function ($q) {
            return $q->where('billing_email', 'like', '%' . request('billing_email') . '%');
        });

        if ($request['from_date'] && $request['to_date']) {
            $start_date = Carbon::parse($request['from_date'])->toDateTimeString();
            $end_date =  Carbon::parse($request['to_date'])->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date])->get();
        }

        $orders = $query->get();

        return DataTables::of($orders)
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
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
                return '<a href="javascript:void(0)" class="btn btn-sm btn-'.$badge.'">'.ucfirst($data->status).'</a>';
            })
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                    <a
                    href="' . route('admin.orders.show', $data) . '"
                        type="button"
                        class="btn btn-success waves-effect waves-light btn-md"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="View"
                        data-bs-original-title="View"
                    ><i class="bx bx-show-alt font-size-16 align-middle"></i></a>

                </div>
            ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions','status'])
            ->make(true);
    }
}
