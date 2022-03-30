<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Events\UserSubscribedEvent;
use App\Http\Controllers\Controller;
use Validator;

class NewsLetterController extends Controller
{
    public function show()
    {
        $this->setPageTitle('Newsletter', '');

        return view('cms.admin.newsletters.show');
    }

    public function subscribe(Request $request)
    {/*
        $validator = $request->validate([
            'email' => 'required|email|unique:news_letters,email',
        ]); */
        $validator= Validator::make($request->all(), [
          'email' => 'required|email|unique:news_letters,email'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $email= $request['email'];
            event(new UserSubscribedEvent($email));
            return response()->json(['status' => 1,'message' => 'Thank you for subscribing.']);
        }
    }

    public function markAsRead()
    {
        return auth()->user()->unreadNotifications->markAsRead()
            ? response()->json(['success' => ' Notification Successfully marked.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }

    public function markSingleAsRead($id)
    {
        auth()->user()->unreadNotifications()->where('id', $id)->get()->markAsRead();
        return response()->json(['success' => ' Notification Successfully marked as read.','count'=>auth()->user()->unreadNotifications->count()]);
    }


    public function index()
    {
        $this->setPageTitle('NewsLetter', '');
        return (request()->ajax())
            ? $this->datatable()
            : view('cms.admin.newsletters.index');
    }

    protected function datatable()
    {
        $newsletters = NewsLetter::orderBy('created_at', 'desc')->get();
        return DataTables::of($newsletters)
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
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

    public function destroy(NewsLetter $newsletter)
    {
        return $newsletter->delete()
            ? response()->json(['success' => 'NewsLetter Successfully Deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }

    public function deleteAllRead()
    {
        return auth()->user()->readNotifications()->delete()
            ? response()->json(['success' => ' Notification Successfully deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }
}
