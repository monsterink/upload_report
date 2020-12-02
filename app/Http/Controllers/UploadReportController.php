<?php

namespace App\Http\Controllers;
use App\Models\uploadfile;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
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
        // $user=User::all();
        $userId=Auth::user()->id;
        if(Auth::user()->role==1){
            $upload=uploadfile::where('users_id',$userId)->get();
        }elseif(Auth::user()->role==2){
            $upload=uploadfile::all();
        }else{
            $upload=uploadfile::where('users_id',$userId)->get();
        }
        
        return view('HomeDoctor', ['uploadfiles' => $upload]);
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
        $patient=Patient::all();
        return view('Upload', ['uploadfiles' => $upload,'patients' => $patient]);
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
    public function show($upload_id)
    {
        $upload=uploadfile::find($upload_id);
        return view('edit_uploads', ['uploadfiles' => $upload]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($upload_id)
    {
        
        $upload=uploadfile::find($upload_id)
        ->update(['an' => Request::input('an'),
        'filename' => Request::file('filereport')->getClientOriginalName(),
        'path' => Request::file('filereport')->store('files')]);
        return redirect()->route('uploads');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id)
    {
        //\Log::info($request);
        // $role->role=Request::input('role');
        // return $role;
        $user=User::find($user_id)->update(['role' => Request::input('role')]);
        return redirect()->route('role');
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
        $fn = uploadfile::where('id',$id)
          ->delete();
          return redirect()->route('uploads'); 
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
