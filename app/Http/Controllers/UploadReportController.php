<?php

namespace App\Http\Controllers;
use App\Models\uploadfile;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
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
        
        // $users = uploadfile::join('users', 'users.id', '=', 'uploadfiles.users_id')
        //     ->select('users.name')
        //     ->get();
        $userId=Auth::user()->id;
        if(Auth::user()->role==1){
            $upload=uploadfile::where('users_id',$userId)->get();
        }else{
            $upload=uploadfile::all();
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
        $id=Auth::user()->id;
        $upload->an=Request::input('an');
        $upload->filename=Request::file('filereport')->getClientOriginalName();
        $upload->path = Request::file('filereport')->store('files');
        $upload->status = Request::input('status');
        $upload->users_id =$id;
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
        if(Request::hasFile('filereport')){
        $upload=uploadfile::find($upload_id)
        ->update(['an' => Request::input('an'),
        'filename' => Request::file('filereport')->getClientOriginalName(),
        'path' => Request::file('filereport')->store('files')]);
        }else{
            $upload=uploadfile::find($upload_id)
            ->update(['an' => Request::input('an')]);
        }
        return redirect()->route('uploads');
    }
    public function findAn(Request $request){
        $data=Request::all();
        $search=$data['search'];
  
        if($search == ''){
           $patients = Patient::orderby('an','asc')->limit(5)->get();
        }else{
           $patients = Patient::orderby('an','asc')->where('an', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($patients as $patient){
           $response[] = array("value"=>('HN: '.$patient->hn.' || ชื่อ: '.$patient->name.' || อายุ: '.$patient->age),"label"=>$patient->an);
        }
  
        return response()->json($response);

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
    public function preview($id)
    {
        //$fn=uploadfile::find($id);
        $fn = uploadfile::select('path')->where('id',$id)->get();
        $name= $fn[0]->path;
        //$path = Storage::path('public/files')

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
