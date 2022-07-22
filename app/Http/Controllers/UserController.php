<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        User::create($data);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function search(Request $request)
    {
        //    $search=['email' => $request->search_data];
        //    $user=User::orderBy('id','desc');

        //    if($request->search_data != null){
        //         $user->where('email',$request->search_data);
        //    }
        //    $user = $user->paginate(15);
        $from_date = Carbon::today()->toDateString();
        $to_date = Carbon::today()->toDateString();

        if ($request->input('from_date') != null) {
            $from_date = $request->input('from_date');
        }
        if ($request->input('to_date') != null) {
            $to_date = $request->input('to_date');
        }

        if ($from_date > $to_date) {
            return Redirect::back()->withErrors([
                'msg' => 'To Date should be later than From Date!',
            ]);
        }

        $from_date = $from_date . ' 00:00:00';
        $to_date = $to_date . ' 23:59:59';

        $search = ['from_date' => $from_date, 'to_date' => $to_date];

        $user = User::select('id', 'name', 'email', 'phone', 'address','created_at','updated_at')
            // ->where('requestdatetime', '>=', $from_date)
            // ->where('requestdatetime', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->paginate(15);

        if ($request->action == 'user.search') {
            return $this->ExportUser($search);
        }

        return view('user.index', compact('user'));
    }

    public function ExportUser($search)
    {
        return Excel::download(
            new UserExport($search['from_date'],$search['to_date']),
            'UserReport-' . Carbon::today()->toDateString() . '.xlsx',
            \Maatwebsite\Excel\Excel::XLSX
        );
    }
}
