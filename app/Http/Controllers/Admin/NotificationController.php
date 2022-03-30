<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $this->setPageTitle('Notifications', '');
        return (request()->ajax())
            ? $this->datatable()
            : view('cms.admin.notifications.index');
    }

    public function orderlist()
    {
        $this->setPageTitle('Orders Notifications', '');
        return (request()->ajax())
            ? $this->orderDatatable()
            : view('cms.admin.notifications.index');
    }


    
    protected function datatable()
    {
        $notifications =auth()->user()->notifications->where('type', 'App\Notifications\UserCustomOrder')->sortByDesc('created_at');

        return DataTables::of($notifications)
            ->addColumn('email', function ($data) {
                return $data->data['email'];
            })
             ->addColumn('city', function ($data) {
                 return $data->data['city'];
             })
              ->addColumn('delivery_date', function ($data) {
                  return Carbon::parse($data->data['date'])->format('d-M-Y G:ia');
              })
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                      
                        <a
                            href="#"
                            id="delete-btn"
                            data-id="' . $data->id . '"
                            type="button"
                            class="btn btn-danger waves-effect waves-light btn-md "
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Delete"
                            data-bs-original-title="Delete"
                        ><i class="bx bx-trash font-size-16 align-middle"></i></a>
                    </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
         
            ->make(true);
    }

    protected function orderDatatable()
    {
        $notifications =auth()->user()->notifications->where('type', 'App\Notifications\UserOrderNotification')->sortByDesc('created_at');

        return DataTables::of($notifications)
            ->addColumn('order_code', function ($data) {
                return $data->data['order_code'];
            })
             ->addColumn('billing_email', function ($data) {
                 return $data->data['billing_email'];
             })
              ->addColumn('payment_method', function ($data) {
                  return $data->data['payment_method'];
              })
              ->editColumn('created_at', function ($data) {
                  return Carbon::parse($data->created_at)->format('d-M-Y G:ia');
              })
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                      
                        <a
                            href="#"
                            id="delete-btn"
                            data-id="' . $data->id . '"
                            type="button"
                            class="btn btn-danger waves-effect waves-light btn-md "
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Delete"
                            data-bs-original-title="Delete"
                        ><i class="bx bx-trash font-size-16 align-middle"></i></a>
                    </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
         
            ->make(true);
    }
}
