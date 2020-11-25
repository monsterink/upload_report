<?php

namespace App\Http\Controllers;
use App\Models\uploadfile;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class UploadReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user=User::all();
        $id=Auth::user()->id;
        $upload=uploadfile::where('users_id',$id)->get();
        return view('HomeDoctor', ['uploadfiles' => $upload,'users' => $user]);
    }
    public function role()
    {
        //$id=Auth::user()->id;
        $user=User::all();
        $role=Role::all();
        //return $user;
        return view('role', ['users' => $user,'roles' => $role]);
    }
    // public function homeDoctor()
    // {
    //     $upload=uploadfile::all();
    //     return view('homeDoctor', ['uploadfiles' => $upload]);
    // }
    // public function homeStaff()
    // {
    //     $upload=uploadfile::all();
    //     return view('homeDoctor', ['uploadfiles' => $upload]);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $upload=uploadfile::all();
        return view('Upload', ['uploadfiles' => $upload]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $upload = new uploadfile;
        $upload->an=Request::input('an');
        $upload->filename=Request::file('filereport')->getClientOriginalName();
        $upload->path = Request::file('filereport')->store('files');
        $upload->status = Request::input('status');
        $upload->users_id = Request::input('users_id');
        $upload->save();
        return redirect()->route('uploads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //\Log::info($request);
        $role = new User;
        $role->role=Request::input('id');
        
        $user = User::where('id',$id)
          ->update(['role' => $role]);
          return "update success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($id)
    {
        //$fn=uploadfile::find($id);
        $fn = uploadfile::select('path')->where('id',$id)->get();
        $name= $fn[0]->path;
        //$path = Storage::path('public/files');
     
        $fn = uploadfile::where('id',$id)
          ->update(['status' => 'Printing']);

        $filename = '/app/'.$name;
//return $filename;

        $path = storage_path($filename);
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
    public function delete(Request $request, $id)
    {
        // $fn = uploadfile::where('id',$id)
        //   ->delete();
        //   return "Complete";   
    }
    // public function preview($id)
    // {
    //     $fn = uploadfile::select('path')->where('id',$id)->get();
    //     $name= $fn[0]->path;

    //     $filename = '/app/'.$name;

    //     $path = storage_path($filename);
    //     return Response::make(file_get_contents($path), 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="'.$filename.'"'
    //     ]);
    // }
}
