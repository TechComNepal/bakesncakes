<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Sliders\SliderContract;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Repositories\Sliders\SliderRepository;
use App\Services\ImageUploadService;

class SliderController extends Controller
{
    public function __construct(SliderContract $sliderRepository, ImageUploadService $imageUploadService)
    {
        $this->sliderRepository=$sliderRepository;
        $this->imageUploadService=$imageUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setpageTitle('Slider', '');
        return (request()->ajax())
        ? $this->datatable()
        : view('cms.admin.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Slider', 'Fill in the required fills to create a new slider.');
        return view('cms.admin.sliders.create', [
            'brands'=>$this->sliderRepository->listBrands()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {
        try {
            $slider= $this->sliderRepository->storeSlider($request->validated());
            if ($slider) {
                $this->imageUploadService->uploadImageFromRequest($request, $slider, 'image', 'desktop') ;
            }
            return $slider
                ? $this->responseRedirect('admin.sliders.index', 'Slider Successfully Created.', 'success')
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
    public function edit(Slider $slider)
    {
        $this->setPageTitle('Slider', '');
        return view('cms.admin.sliders.edit', [
            'brands'=>$this->sliderRepository->listBrands(),
            'slider'=>$slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        try {
            $slider=$this->sliderRepository->updateSlider($slider->id, $request->validated());
            if ($slider) {
                $this->imageUploadService->uploadImageFromRequest($request, $slider, 'image', 'desktop');
            }
            return $slider
                ? $this->responseRedirect('admin.sliders.index', 'Slider Updated Successfully', 'success')
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
    public function destroy(Slider $slider)
    {
        return $slider->delete()
        ?response()->json(['success'=>'Slider Successfully Deleted'])
        :response()->json(['success'=>'There was some issue with the server. Please try again']);
    }

    protected function datatable()
    {
        $sliders=$this->sliderRepository->listSliders('created_at', 'desc');
        return DataTables::of($sliders)
        ->addColumn('actions', function ($data) {
            return '
                <div class="d-flex flex-wrap gap-2">
                    <a
                    href="' . route('admin.sliders.edit', $data) . '"
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

          ->editColumn('brand_id', function ($data) {
              return $data->brand->name ?? '';
          })
          ->editColumn('image', function ($data) {
              return '<img src="'.$data->getFirstOrDefaultMediaUrl('desktop', 'thumb').'" alt="">';
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
            ->editColumn('is_popup', function ($data) {
                $checked = $data->is_popup == 1 ? 'checked' : '';

                return '
                <label for="is-popup-switch-' . $data->id . '"></label>
                <input
                    type="checkbox"
                    id="is-popup-switch-' . $data->id . '"
                    data-id="' . $data->id . '"
                    name="is_popup"
                    class="js-switch"
                    ' . $checked . '
                    autocomplete="off"
                    onchange="toggleIsPopup(' . $data->id . ')"
                />
            ';
            })
          ->addIndexColumn()
            ->rawColumns(['actions','image','status', 'is_popup'])
            ->make(true);
    }

    public function toggleIsStatus(Request $request)
    {
        return $this->sliderRepository->updateSliderStatus($request->all())
            ? response()->json(['message' => 'Slider Status Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating slider status.', 'status' => 'error']);
    }

    public function toggleIsPopup(Request $request)
    {
        return $this->sliderRepository->updateSliderPopup($request->all())
            ? response()->json(['message' => 'Slider Popup Status Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating slider Popup status.', 'status' => 'error']);
    }
}
