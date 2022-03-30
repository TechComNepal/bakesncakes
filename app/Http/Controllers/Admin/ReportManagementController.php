<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Repositories\Products\ProductRepository;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class ReportManagementController extends Controller
{
    private $productRepository;
    private $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService)
    {
        $this->productRepository = $productRepository;
        $this->setPageTitle('Stock product ', '');
        $this->imageUploadService = $imageUploadService;
    }

    public function viewStock()
    {
        return (\request()->ajax())
        ? $this->datatable()
        : view('cms.admin.reportManagements.stockView');
    }


    public function customOrderReport()
    {
        $this->setPageTitle('Custom Order', '');
        return request()->ajax()
        ? $this->customOrderDatatable()
        : view('cms.admin.reportManagements.CustomOrders.customOrderReport');
    }


    


    public function viewStockPdf()
    {
        return (\request()->ajax())
        ? $this->datatable()
        : view('cms.admin.reportManagements.stockView');

        // $pdf=PDF::loadView('cms.admin.reportManagements.stockProduct.stockReportPdf',$data);
        // $pdf->SetProctection(['copy', 'print'], '','pass');
        // return $pdf->stream('document.pdf');
    }



    // dataTable for Stock view

    public function datatable()
    {
        $products = $this->productRepository->listProducts('created_at', 'desc');
        return DataTables::of($products)
         
        ->editColumn('name', function ($data) {
             return '<div class="col-auto" style="display: inline-block">
                    <img src="'.$data->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb').'" alt="Product Image" height="50" width="50"/>
                </div>
                <div class="col-auto" style="display: inline-block">
                    <span class="text-muted text-truncate">'.$data->name.' </span>
                </div>';
        })

        
        ->addColumn('selling_price', function ($data) {
            return '<div class="col-auto" style="display: inline-block">
            <span class="text-muted text-truncate">'. $data->selling_price.'</span>' .'<br />'.'<br />
            </div>';
             })
      
        ->editColumn('discount', function ($data) {
            $type = ($data->discount_type==='flat') ? 'Rs.' : '%';
           
            return '<div class="col-auto" style="display: inline-block">
           
            </div>
            <div class="col-auto" style="display: inline-block">
                <span class="text-muted text-truncate">'. $data->discount .' ' .'<strong>'. $type.'</strong>' .' </span>
            </div>';
        })
        

        ->editColumn('is_taxable', function ($data) {
                $checked = $data->is_taxable == 1 ? 'checked' : '';

                return '
                    <label for="is-taxable-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-taxable-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_taxable"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsTaxable(' . $data->id . ')"
                    />
                ';
            })
          
            ->addIndexColumn()
            ->rawColumns(['name', 'selling_price', 'discount'])
            ->make(true);
    }




    
    
    protected function customOrderDatatable()
    {
        $data = CustomOrder::latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
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


          

            ->editColumn('description', function ($data) {
                return '
                <div class="d-flex flex-column">    
                <p
                        class="text-body font-size-16 "
                                title="' . $data->description . '"
                                data-bs-original-title="' . $data->description . '"
                            >' .$data->description . '
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

        
            ->editColumn('image', function ($data) {
                return ' <img src="'. $data->getFirstOrDefaultMediaUrl("image", 'thumb') .'" style="wiidth: 60px; height: 60px;">';
            })

           
                 ->editColumn('address', function ($data) {
                return '
                <div class="d-flex flex-column">

                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                >'. Str::limit($data->address, 112) .'
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
                            >' . Carbon::parse($data->date)->diffForHumans() . '
                     </p>

                    ';
            })

        
            ->addIndexColumn()
            ->rawColumns(['actions', 'name', 'email', 'image', 'description','address', 'quantity', 'date'])
            ->make(true);
    }


        //  toggle status
        public function toggleIsStatus(Request $request): JsonResponse
        {
            $customOrder = CustomOrder::findOrFail($request['id']);
            $customOrder->status = !$customOrder->status;
                    return $customOrder->update()
                ? response()->json(['message' => 'Custom Order Updated Successfully.',  'status' => 'success'])
                : response()->json(['message' => 'Error occurred while updating category status.', 'status' => 'error']);
        }
    
    
}
