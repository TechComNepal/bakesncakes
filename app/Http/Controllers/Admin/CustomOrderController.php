<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CustomOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserCustomOrder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\CustomOrderStoreRequest;
use App\Http\Requests\CustomOrderUpdateRequest;

class CustomOrderController extends Controller
{
    private $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function index()
    {
        $this->setPageTitle('Custom Order', '');
        return request()->ajax()
            ? $this->datatable()
            : view('cms.admin.pages.customOrder.index');
    }


    public function create()
    {
        $this->setPageTitle(' Custom Order', '');

        return view('cms.admin.pages.customOrder.create');
    }

    public function store(CustomOrderStoreRequest $request)
    {
        try {
            $validate = $request->validated();
            $collection = collect($validate)->except('user_id');
            $user_id = Auth::id();
            $merge = $collection->merge(compact('user_id'));
            $customOrder=CustomOrder::create($merge->all());
       
            if ($customOrder) {
                $this->imageUploadService->uploadMultipleMediaFromRequest($request, $customOrder, 'gallery_image', 'gallery_image');
                $this->imageUploadService->uploadImageFromRequest($request, $customOrder, 'image', 'image');
            }
            return $customOrder
                ? $this->responseRedirect('admin.customOrder.index', 'Custom Order Successfully Created.', 'success')
                : $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }


    public function edit(CustomOrder $customOrder)
    {
        $gallerys=$customOrder->getMedia('gallery_image');

        return view('cms.admin.pages.customOrder.edit', [
            'pagetitle' =>  $this->setPageTitle('Status', 'Change the status '),
            'customOrder'=>$customOrder,
            'gallerys'=>$gallerys,

    ]);
    }

    public function update(Request $request, CustomOrder $customOrder)
    {
        try {
            $validate=$request->validate([
            'status'=>'required',
        ]);

            return $customOrder->update(['status' => $request->status])
        ? $this->responseRedirect('admin.customOrder.index', 'Custom Order Successfully Updated', 'success')
        : $this->responseRedirectBack('Custom Order Successfully Created Error.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

        return $this->responseRedirect('admin.customOrder.index', 'Custom Order Successfully Created.', 'success');

        // return $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
    }




    public function delete(CustomOrder $cusomOrder)
    {
        return  $cusomOrder->delete()
        ? response()->json(['success' => 'Custom Order deleted Successfully.'])
        : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }


    protected function datatable()
    {
        $data = CustomOrder::latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' . route('admin.customOrder.edit', $data) . '"
                            type="button"
                            class="btn btn-success waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit"
                            data-bs-original-title="Edit"
                        ><i class="bx bx-show-alt font-size-16 align-middle"></i></a>
                      
                    </div>
                ';
            })

   

            ->editColumn('description', function ($data) {
                return '
                <div class="d-flex flex-column">    
                <p
                        class="text-body font-size-16 "
                                title="' . $data->description . '"
                                data-bs-original-title="' . $data->description . '"

                            >'. Str::limit($data->address, 42) .'

                     </p>
                     </div>
                    ';
            })

          
            ->editColumn('email', function ($data) {
                return '
                <div class="d-flex flex-column">
                    <p
                        class="text-body font-size-14 "
                                title="' . $data->email . '"
                                data-bs-original-title="' . $data->email . '"
                            >'. $data->email . '
                     </p>
                     </div>

                    ';
            })


           
                 ->editColumn('address', function ($data) {
                     return '
                <div class="d-flex flex-column">

                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                >'. Str::limit($data->address, 42) .'
                                </h5>

                        </div>
                ';
                 })

            ->editColumn('date', function ($data) {
                return '
                    <p
                        class="text-body font-size-14 "
                                title="' . $data->date . '"
                                data-bs-original-title="' . $data->date . '"
                                >' . Carbon::parse($data->date)->isoFormat('LLL') . '
                            
                     </p>

                    ';
            })
            // <span>{{ $blog->created_at->isoFormat('LL') }}</span>

            //                            >' . Carbon::parse($data->date)->diffForHumans() .
              
          


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

        
            ->addIndexColumn()
            ->rawColumns(['actions', 'name', 'email', 'description','address', 'quantity', 'date', 'status'])
            ->make(true);
    }


    //  toggle status
        //   public function toggleIsStatus(Request $request): JsonResponse
        //   {
        //       $customOrder = CustomOrder::findOrFail($request['id']);
        //       $customOrder->status = !$customOrder->status;
        //               return $customOrder->update()
        //           ? response()->json(['message' => 'Custom Order Responded.',  'status' => 'success'])
        //           : response()->json(['message' => 'Error occurred while updating category status.', 'status' => 'error']);
        //   }
}
