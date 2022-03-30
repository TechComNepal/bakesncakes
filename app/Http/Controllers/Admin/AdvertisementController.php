<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Advertisements\AdvertisementContract;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdvertisementPlacement;
use App\Http\Requests\AdvertisementStoreRequest;
use App\Http\Requests\AdvertisementUpdateRequest;
use App\Repositories\Advertisements\AdvertisementRepository;
use App\Services\ImageUploadService;

class AdvertisementController extends Controller
{
    public function __construct(AdvertisementContract $advertisementRepository, ImageUploadService $imageUploadService)
    {
        $this->advertisementRepository=$advertisementRepository;
        $this->imageUploadService=$imageUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Advertisement', '');
        return (request()->ajax())
        ? $this->datatable()
        : view('cms.admin.advertisements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Advertisement', '');

        return view('cms.admin.advertisements.create', [
            'brands'=>$this->advertisementRepository->listActiveBrands(),
            'advertisementPlacements'=>$this->advertisementRepository->listActivePlacements(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementStoreRequest $request)
    {
        try {
            $advertisement=$this->advertisementRepository->storeAdvertisement($request->validated());
            if ($advertisement) {
                $this->imageUploadService->uploadImageFromRequest($request, $advertisement, 'image_url', 'image') ;
            }
            return $advertisement
                ? $this->responseRedirect('admin.advertisements.index', 'Advertisement added successfully.', 'success')
                : $this->responseRedirectBack('Oops! Some problem occurred. Please try again later.', 'error');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        $this->setPageTitle('Advertisement');

        return view('cms.admin.advertisements.edit', [
            'advertisement' => $advertisement,
            'brands' =>$this->advertisementRepository->listActiveBrands(),
            'advertisementPlacements' => $this->advertisementRepository->listActivePlacements(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        try {
            $advertisement= $this->advertisementRepository->updateAdvertisement($advertisement->id, $request->validated());
            if ($advertisement) {
                $this->imageUploadService->uploadImageFromRequest($request, $advertisement, 'image_url', 'image');
            }
            return $advertisement
                ? $this->responseRedirect('admin.advertisements.index', 'Advertisement Updated Successfully', 'success')
                : $this->responseRedirectBack('There was some problem with server. Please try again later.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $this->responseBackWithException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        return $advertisement->delete()
            ? response()->json(['success' => 'Advertisement Successfully Deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }



    protected function datatable()
    {
        $advertisement=$this->advertisementRepository->listAdvertisements('created_at', 'desc');
    
        return DataTables::of($advertisement)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                            href="' . route('admin.advertisements.edit', $data) . '"
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
            ->editColumn('advertisement_placement_id', function ($data) {
                return $data->advertisementPlacement->name;
            })
            ->editColumn('brand_id', function ($data) {
                return $data->brand->name ?? '-';
            })
            ->editColumn('status', function ($data) {
                $checked = $data->status == 1 ? 'checked' : '';

                return '
                    <label for="is-status-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-status-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_status"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsStatus(' . $data->id . ')"
                    />
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function toggleIsStatus(Request $request)
    {
        return $this->advertisementRepository->toggleAdvertisementStatus($request->all())
            ? response()->json(['status' => 'success', 'message' => 'Advertisement Status Updated Successfully..'])
            : response()->json(['status' => 'error', 'message' => 'There was some issue with the server. Please try again.']);
    }
}
