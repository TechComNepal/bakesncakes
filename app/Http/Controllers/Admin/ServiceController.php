<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{

    private $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function index()
    {
        $this->setPageTitle('Services', '');
        return request()->ajax()
            ? $this->datatable()
            : view('cms.admin.pages.services.index');
    }

    public function create()
    {
        $this->setPageTitle('Services', 'Fill in the required fields to create a new Service.');
        return view('cms.admin.pages.services.create');
    }

    public function store(ServiceStoreRequest $request)
    {
     try {
        $service = Service::create($request->validated());
            if($service)
            {
                $this->imageUploadService->uploadImageFromRequest($request, $service,'image','image');
            }
                
            return $service
            ? $this->responseRedirect('admin.services.index', 'Service created Sucessfully', 'success')
            : $this->responseRedirectBack('Error while inserting the image', 'error');
        }
        catch (FileCannotBeAdded $e) {
            abort(413, 'File size to big or there was some issue with the upload. Please try again later.' . $e->getMessage());
        }
    }

    public function edit(Service $service)
    {
    return view('cms.admin.pages.services.edit',[
        'pageTitle'=> $this->setPageTitle('Service','Please Update the reuired field'),
        'service' => $service
    ]);

    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        try {
                   
            if ($service) {

                $this->imageUploadService->uploadImageFromRequest($request, $service, 'image', 'image');

                return $service->update($request->all())
                    ? $this->responseRedirect('admin.services.index', 'Service created Sucessfully', 'success')
                    : $this->responseRedirectBack('Error while inserting the image', 'error');
            }
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(Service $service)
    {
        return  $service->delete()
            ? response()->json(['success' => 'Service Successfully Deleted.'])
            : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }
    protected function datatable()
    {
        $data = Service::latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' . route('admin.services.edit', $data) . '"
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
                            data-id="' . $data->slug . '"
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

            ->editColumn('title', function ($data) {
                return '
                        <div class="d-flex flex-column">
                            <p
                                class="text-body font-size-14 "
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="' . $data->title . '"
                                data-bs-original-title="' . $data->title . '"
                            >' . Str::limit($data->title, 17) . '</p>
                            
                        </div>
                    ';
            })

            ->editColumn('slug', function ($data) {
                return '
                <p
                    class="text-body font-size-14 "
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="' . $data->slug . '"
                    data-bs-original-title="' . $data->slug . '"
                    >' . Str::limit($data->slug, 22) .
                '</p>
                ';
            })

            ->editColumn('image', function ($data) {
                return ' <img src="'. $data->getFirstOrDefaultMediaUrl("image", 'thumb') .'" style="width: 80px; height:80px;">
                    ';
            })

            ->editColumn('description', function ($data) {
                return '
                <div class="d-flex flex-column">
                                     
                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                >'. Str::limit($data->description, 60) .'
                                </h5>
                        </div>
                ';
            })

            // ,'image'
            ->addIndexColumn()
            ->rawColumns(['actions', 'title', 'slug','image', 'description'])
            ->make(true);
    }
}
