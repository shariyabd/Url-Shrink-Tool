<?php

namespace App\Http\Controllers;

use App\Trait\ResponseTrait;
use DataTables;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    // use ResponseTrait;
    public function index()
    {
        if (Auth::check()) {
            return view('backend.dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function urlList(Request $request)
    {

        if ($request->ajax()) {
            $data = Url::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm urlDelete-btn"><i class="fa-solid fa-trash"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Copy" data-text="' . $row->short_url . '" class="btn btn-success btn-sm urlCopybtn"><i class="fa-solid fa-copy"></i></a>';
                    $btn .= '<a href="' . route('url-view', $row->id) . '" data-toggle="tooltip"  target="_blank"  data-original-title="View" class="btn btn-secondary btn-sm viewBtn"><i class="fa-solid fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.manage');

    }

    public function edit($id)
    {
        $urls = Url::findOrFail($id);
        return response()->json($urls);
    }
    public function view($id)
    {
        $urlView = Url::findOrFail($id);

        if ($urlView) {
            $urlView->total_view++;
            $urlView->save();
            return Redirect::to($urlView->org_url);
        } else {
            return response()->json(['error' => 'URL not found'], 404);
        }
    }

    public function delete(Request $reqeust)
    {
        $urls = Url::findOrFail($reqeust->id);
        $urlId = $urls->delete();

        Session::flash('cls', 'success');

        if ($urlId) {
            return response()->json(['success' => 'Url Deleted successfully']);
        } else {
            return response()->json(['error' => 'Url Delete Faild']);
        }

    }
    public function logout()
    {
        Session::flush();
        auth()->logout();
        return redirect()->route('login');
    }
}
