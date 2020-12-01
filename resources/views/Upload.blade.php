@extends('layouts.app')

@section('title','Uploads')

@section('sidebar')
    @parent

@endsection

@section('content')  
<div class="mt-4">
<form action="{{url('/uploads')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="input-group mb-3">
    <span class="input-group-text btn-secondary" id="basic-addon1">AN</span>
    <input type="text" class="form-control" id='an' name="an" value='' required>
    </div>

    <div class="form-file form-file-sm ">
    <input class="form-control" type="file" id="formFile" name="filereport">
    <input type="hidden" id="status" name="status" value="Upload">
    </div>
    <div class="mt-4 col-md-12 text-center">
    <button type="submit" type="button" class="btn btn-primary">Upload File</button>
    </div>
    <input type="hidden" id="id" name="users_id" value="{{Auth::user()->id}}">
    </form>
</div>
@endsection