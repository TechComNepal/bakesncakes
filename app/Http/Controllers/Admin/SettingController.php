<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Qrcode;
use App\Models\Socialmedia;
use App\Repositories\Settings\SettingRepository;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    private $settingRepository;
    private $imageUploadService;

    public function __construct(SettingRepository $settingRepository, ImageUploadService $imageUploadService)
    {
        $this->settingRepository = $settingRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $this->setPageTitle('Company Setting', '');

        return view('cms.admin.settings.site_info');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $setting = $this->settingRepository->updateSetting($request->all());

        if ($setting) {
            if ($request->has('logo')) {
                $this->imageUploadService->uploadImageFromRequest($request, $setting, 'logo', 'logo');
            }
            if ($request->has('favicon')) {
                $this->imageUploadService->uploadImageFromRequest($request, $setting, 'favicon', 'favicon');
            }
        }

        return $setting
            ? $this->responseRedirect('admin.setting.index', 'Setting has been updated successfully.', 'success')
            : $this->responseRedirectBacK('There was some with the server. Please try again later.');
    }

    public function socialMediaIndex()
    {
        $this->setPageTitle('Social Media', 'Add Social Media');
        return view('cms.admin.settings.social_media', [
            'socialmedia' => Socialmedia::first(),
        ]);
    }

    public function socialMediaUpdate(Request $request)
    {
        $socialMedia = $this->settingRepository->updateSocialMedia($request->all());

        return $socialMedia
            ? $this->responseRedirect('admin.setting.social.media.index', 'Social Media has been updated successfully.', 'success')
            : $this->responseRedirectBacK('There was some with the server. Please try again later.');
    }

    public function rolesPermissionIndex()
    {
        $this->setPageTitle('Roles & Permission', 'Add or Remove Permission to User Roles.');

        return view('cms.admin.settings.roles_permission', [
            'roles' => Role::with('permissions')->where('id', '>', 2)->get(),
            'totalPermission' => Permission::count(),
            'modulesData' => Module::with('permissions')->get(),
        ]);
    }

    public function rolesPermissionStore(Request $request)
    {
        $roleId = $request->roleId;
        $permissionId = $request->permissionId;

        $role = Role::findById($roleId);
        if ($request->assignPermission == 'yes') {
            $role->givePermissionTo($permissionId);
            return response()->json(['status' => 'success', 'msg' => 'Permission has been assigned successfully.']);
        } else {
            $role->revokePermissionTo($permissionId);
            return response()->json(['status' => 'revoke', 'msg' => 'Permission has been removed successfully.']);
        }
    }

    public function rolesPermissionAssignAllPermission(Request $request)
    {
        $roleId = $request->roleId;
        $permissions = Permission::all();

        $role = Role::findOrFail($roleId);
        $role->syncPermissions([]);
        $role->givePermissionTo($permissions);
        return response()->json(['status' => 'success', 'msg' => 'All permission has been assigned to ' . ucfirst($role->name)]);
    }

    public function manageRolesPermissionIndex()
    {
        $this->setPageTitle('Manage Roles', '');
        return request()->ajax()
            ? $this->rolesDatatable()
            : view('cms.admin.settings.roles_permission_create');
    }

    public function createRoles(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        return Role::create(['name'=>$request->name])
            ? $this->responseRedirectBack('Roles has been created successfully.', 'success', false, true)
            : $this->responseRedirectBack('There was some problem with server. Please try again later.', 'error', true, true);
    }

    public function rolesDatatable()
    {
        $roles = Role::all();

        return DataTables::of($roles)
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
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make(true);
    }
    
    public function qrCodeIndex()
    {
        $this->setPageTitle('QR Code', '');
        return view('cms.admin.settings.qrcode', [
            'qrcode'=>Qrcode::first(),
        ]);
    }

    public function qrcodeUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
           'qr_image'=>'sometimes',
         'status'=>'sometimes'
       ]);
        $qrcode=Qrcode::updateOrCreate(['id'=>1], [
            'status'=>$request->status,
        ]);
        
        if ($qrcode) {
            if ($request->has('qr_image')) {
                $this->imageUploadService->uploadImageFromRequest($request, $qrcode, 'qr_image', 'qrimage');
            }
        }

        return $qrcode
            ? $this->responseRedirect('admin.setting.qrcode.index', 'QR CodeSetting has been updated successfully.', 'success')
            : $this->responseRedirectBacK('There was some with the server. Please try again later.');
    }
}
