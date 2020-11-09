<?php

namespace App\Http\Controllers;
use App\Models\uploadfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UploadReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploade=uploadfile::all();
        return view('homeDoctor', ['uploadfiles' => $uploade]);
    }
    public function homeupload($id)
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // // \Log::info($request->input('filereport'));
        // if (Request::hasFile('filereport')) {
        //     $path = Request::file('filereport')->store('public/files');
        //     return Request::file('filereport')->getClientOriginalName();
        // }else{
        //     return 'fail' ;
        // }
        // // }
        //  return Input::file('filereport');
        $upload = new uploadfile;
        $upload->an=Request::input('an');
        $upload->filename=Request::file('filereport')->getClientOriginalName();
        $upload->path = Request::file('filereport')->store('public/files');
        $upload->save();
        return "success";
                
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
