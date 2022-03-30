<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingStoreRequest;

class ShippingController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $this->setPageTitle('Shipping', '');

        return (request()->ajax())
        ? $this->datatable()
        : view('cms.admin.shippings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Shipping', '');
        return view('cms.admin.shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingStoreRequest $request)
    {
        try {
            $shipping= Shipping::create($request->validated());
            return $shipping
                ? $this->responseRedirect('admin.shippings.index', 'Shipping Successfully Created.', 'success')
                : $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $this->responseRedirectBack($exception->getMessage(), 'error', true, true);
        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        $this->setPageTitle('Shipping', '');
        return view('cms.admin.shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingStoreRequest $request, Shipping $shipping)
    {
        try {
            $shipping->update($request->validated());
        } catch (\Throwable $exception) {
            $this->responseRedirectBack($exception->getMessage(), 'error', true, true);
        }
        return $this->responseRedirect('admin.shippings.index', 'Shipping Updated Successfully.', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        return $shipping->delete()
        ?response()->json(['success'=>'Shipping Successfully Deleted.'])
        :response()->json(['success'=>'There was some issue with the server. Please try again.']);
    }

    protected function datatable()
    {
        $shipping=Shipping::all();

        return DataTables::of($shipping)
        ->addColumn('actions', function ($data) {
            return '
                <div class="d-flex flex-wrap gap-2">
                    <a
                    href="' . route('admin.shippings.edit', $data) . '"
                        type="button"
                        class="btn btn-success waves-effect waves-light btn-md"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Edit"
                        data-bs-original-title="Edit"
                    ><i class="bx bx-pencil font-size-16 align-middle"></i></a>
                    <a
                        href="#"
                        id="delete-btn"
                        data-id="' . $data->id . '"
                        type="button"
                        class="btn btn-danger waves-effect waves-light btn-md"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Delete"
                        data-bs-original-title="Delete"
                    ><i class="bx bx-trash font-size-16 align-middle"></i></a>
                </div>
            ';
        })

          ->editColumn('created_at', function ($data) {
              return $data->created_at->diffForHumans();
          })
           
          ->addIndexColumn()
            ->rawColumns(['actions','created_at'])
            ->make(true);
    }
}
