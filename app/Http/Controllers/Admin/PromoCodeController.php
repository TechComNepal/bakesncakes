<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Promocodes\PromocodeContract;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromoCodeStoreRequest;
use App\Repositories\Promocodes\PromocodeRepository;

class PromoCodeController extends Controller
{
    public function __construct(PromocodeContract $promocodeRepository)
    {
        $this->promocodeRepository=$promocodeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Promocodes', '');
        return (request()->ajax())
        ? $this->datatable()
        : view('cms.admin.promocodes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Promocodes', '');
        return view('cms.admin.promocodes.create', [
            'products' => $this->promocodeRepository->listProducts(),
            'categories' => $this->promocodeRepository->listActiveCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoCodeStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->promocodeRepository->storePromocode($request->validated());
            });
            return $this->responseRedirect('admin.promocodes.index', 'Promocode has been created Successfully.', 'success');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

        return $this->responseRedirectBack('There is some problem with the server. Please try again later.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocode $promocode)
    {
        return $promocode->delete()
            ? response()->json(['success' => 'PromoCode Successfully Deleted.'])
            : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }

    protected function datatable()
    {
        $promocode = $this->promocodeRepository->listPromocodes('created_at', 'desc');

        return DataTables::of($promocode)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">

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
            ->editColumn('start_from', function ($data) {
                return $data->start_from->toDateString();
            })
            ->editColumn('expires_on', function ($data) {
                return $data->expires_on->toDateString();
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make(true);
    }
}
