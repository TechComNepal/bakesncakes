<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Users\UserContract;
use App\Http\Requests\ShippingRequest;
use App\Imports\UsersImport;
use App\Models\Cart;
use App\Models\CustomerShippingAddress;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Users\UserRepository;

class AdminCustomerController extends Controller
{
    public function __construct(UserContract $userRepository, ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $this->setPagetitle('User', '');
        return (request()->ajax())
            ? $this->datatable($request)
            : view('cms.admin.customers.index');
    }


    protected function datatable($request)
    {
        //  $users= $this->userRepository->listUsers('created_at', 'desc');
        $query=User::query();
        if ($request['name']) {
            $query->where('name', 'LIKE', '%' . $request['name'] . '%');
        }
        if ($request['username']) {
            $query->where('username', 'LIKE', '%' . $request['username'] . '%');
        }
        if ($request['email']) {
            $query->where('email', 'LIKE', '%' . $request['email'] . '%');
        }
        if ($request['phone']) {
            $query->where('phone', 'LIKE', '%' . $request['phone'] . '%');
        }
        if ($request['name'] && $request['username']) {
            $query->where('name', 'LIKE', '%' . $request['name'] . '%')
                ->where('username', 'LIKE', '%' . $request['username'] . '%');
        }
        if ($request['name'] && $request['email']) {
            $query->where('name', 'LIKE', '%' . $request['name'] . '%')
                ->where('email', 'LIKE', '%' . $request['email'] . '%');
        }
        if ($request['name'] && $request['phone']) {
            $query->where('name', 'LIKE', '%' . $request['name'] . '%')
                ->where('phone', 'LIKE', '%' . $request['phone'] . '%');
        }
        if ($request['username'] && $request['email']) {
            $query->where('username', 'LIKE', '%' . $request['username'] . '%')
                ->where('email', 'LIKE', '%' . $request['email'] . '%');
        }
        if ($request['username'] && $request['phone']) {
            $query->where('username', 'LIKE', '%' . $request['username'] . '%')
                ->where('phone', 'LIKE', '%' . $request['phone'] . '%');
        }

        if ($request['email'] && $request['phone']) {
            $query->where('email', 'LIKE', '%' . $request['email'] . '%')
                ->where('phone', 'LIKE', '%' . $request['phone'] . '%');
        }

        $users=$query->role(['user','employee'])->get();

        return DataTables::of($users)
            ->editColumn('role_id', function ($data) {
                return $data->getRoleNames()->first();
            })
             ->editColumn('username', function ($data) {
                 return $data->username;
             })
          
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                          <a
                            href="' . route('admin.users.edit', $data) . '"
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

                        <a
                            href="' . route('admin.users.info', $data) . '"
                            type="button"
                            class="btn btn-warning waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Info"
                            data-bs-original-title="Info"
                        ><i class="bx bx-info-circle font-size-16 align-middle"></i></a>

                    </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions','address'])
            ->make(true);
    }


    public function create()
    {
        $this->setPageTitle('User', '');
        $roles = \Spatie\Permission\Models\Role::all();
        return view('cms.admin.customers.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->userRepository->storeUser($request->validated());

            if ($user) {
                $this->imageUploadService->uploadImageFromRequest($request, $user, 'image', 'image');
            }

            return $user
                ? $this->responseRedirect('admin.users.index', 'User Created Successfully', 'success')
                : $this->responseRedirectBack('User Created Successfully', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function edit(User $user)
    {
        $this->setPageTitle('User', '');
        $user->load('roles');
        $roles = \Spatie\Permission\Models\Role::all();
        return view('cms.admin.customers.edit', [
            'user' => $user,
            'roles'=>$roles,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        try {
            $user=$this->userRepository->updateUser($user->id, $request->validated());
            if ($user) {
                $this->imageUploadService->uploadImageFromRequest($request, $user, 'image', 'image');
            }
            return $user
                ? $this->responseRedirect('admin.users.index', 'User Updated Successfully', 'success')
                : $this->responseRedirectBack('There was some problem with the server. Please try again later.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(User $user)
    {
        return $user->delete()
            ? response()->json(['success' => 'User Successfully Deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }

    public function info(User $user)
    {
        $this->setPageTitle('User', '');

        return view('cms.admin.customers.info', [
            'user' => $user,
            'roles' => Role::all(),
            'shippings' => Shipping::all(),
        ]);
    }

    public function userActivityLogsDatatable($id)
    {
        $activities = Activity::where('causer_type', 'App\Models\User')->where('causer_id', $id)->latest()->get();

        return DataTables::of($activities)
            ->editColumn('created_at', function ($data) {
                return $data->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a');
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function userCartDatatable(Request $request, $id)
    {
        $data = Cart::with(['product'])->where('user_id', $id)->get();

        return DataTables::of($data)
            ->addColumn('product_name', function ($data) {
                return $data->product->name;
            })
            ->editColumn('quantity', function ($data) {
                return $data->quantity ?? 1;
            })
            ->editColumn('unit_price', function ($data) {
                if ($data->price) {
                    $price = $data->price;
                } else {
                    $price = $data->product->price;
                    if ($data->product->discount !== 0) {
                        if ($data->product->discount_type == 'percent') {
                            $price -= ($data->product->price * $data->product->discount) / 100;
                        } elseif ($data->product->discount_type == 'flat') {
                            $price -= $data->product->discount;
                        }
                    }
                }

                return $price;
            })
            ->editColumn('total_price', function ($data) {
                if ($data->price) {
                    $total_price = $data->price * $data->quantity;
                } else {
                    $total_price = $data->product->price;
                    if ($data->product->discount !== 0) {
                        if ($data->product->discount_type == 'percent') {
                            $total_price -= ($data->product->price * $data->product->discount) / 100;
                        } elseif ($data->product->discount_type == 'flat') {
                            $total_price -= $data->product->discount;
                        }
                    }
                }

                return $total_price;
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->isoFormat('MMMM Do YYYY, h:mm:ss a');
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function customerShippingAddressStore(ShippingRequest $request)
    {
        $collection = collect($request->validated());
        $user_id = $request->user_id;
        $merge = $collection->merge(compact('user_id'));

        return CustomerShippingAddress::create($merge->all())
            ? $this->responseRedirectBack('Shipping Address has been created successfully.', 'success', false, false)
            : $this->responseRedirectBack('There was problem with server. Please try again later.', 'error', true, true);
    }


    protected function editUserShippingAddress($id)
    {
        $data['shipping_address'] = CustomerShippingAddress::findOrFail($id);
        $data['shippings'] = Shipping::all();
        $returnHTML = view('cms.admin.customers.edit_address_modal', $data)->render();
        return response()->json(array('data' => $data, 'html'=>$returnHTML));
    }


    public function updateUserShippingAddress(ShippingRequest $request, $id)
    {
        $collection = collect($request->validated());
        $user_id = $request->user_id;
        $merge = $collection->merge(compact('user_id'));
        $shipping_address = CustomerShippingAddress::findOrFail($id);

        return $shipping_address->update($merge->all())
            ? $this->responseRedirectBack('Shipping Address has been updated successfully.', 'success', false, false)
            : $this->responseRedirectBack('There was problem with server. Please try again later.', 'error', true, true);
    }

    public function setDefaultShippingAddress($id)
    {
        $shippingAddress = CustomerShippingAddress::findOrFail($id);
        $user = User::findOrFail($shippingAddress->user_id);
        foreach ($user->shipping_address as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        $shippingAddress->set_default = true;
        return $shippingAddress->save()
            ? $this->responseRedirectBack('Default Shipping Address has been updated successfully.', 'success', false, false)
            : $this->responseRedirectBack('There was problem with server. Please try again later.', 'error', true, true);
    }


    public function userOrderDatatable($id)
    {
        $orders = Order::where('user_id', $id)->latest()->get();

        return DataTables::of($orders)
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
            ->editColumn('created_at', function ($data) {
                return $data->created_at->isoFormat('MMMM Do  YYYY, h:mm:ss a');
            })
            ->addColumn('action', function ($data) {
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
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function impersonate($id)
    {
        $user = User::findOrFail($id);
        activity()
            ->causedBy($user)
            ->useLog('Customer impersonation session. Started')
            ->log('Impersonated by ' . Auth::user()->name . ' (Email: ' . Auth::user()->email . ')');
        Auth::user()->impersonate($user);

        return redirect(route('site.page'))->withSuccess('You have successfully logged in as ' . $user->name);
    }

    public function impersonateLeave()
    {
        $impersonate_user = Auth::user();
        Auth::user()->leaveImpersonation();

        activity()
            ->causedBy($impersonate_user)
            ->useLog('Customer impersonation session. Finished')
            ->log('Impersonation by ' . Auth::user()->name . ' was finished (Email: ' . Auth::user()->email . ')');

        return redirect(route('admin.users.info', $impersonate_user->id));
    }

    public function importExcel(Request $request)
    {
        $file=$request->file('import_file');
        $import=new UsersImport;
        $import->import($file);
        return $this->responseRedirect('admin.users.index', 'Users Imported Successfully', 'success');
    }
}
