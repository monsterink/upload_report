@extends('layouts.app')

@section('title','Homepage')

@section('sidebar')
    @parent

@endsection

@section('content')  
<div class="mt-4">
<form action="{{url('/upload')}}" method="post" enctype="multipart/form-data" class="was-validated">
        @csrf
    <div class="input-group mb-3">
    <span class="input-group-text btn-secondary" id="basic-addon1">AN</span>
    <input type="text" class="form-control" name="an" required>
    </div>

    <div class="form-file form-file-sm ">
    <input type="file" class="form-file-input" id="customFileLg" name="filereport" data-preview-file-type="text" data-allowed-file-extensions='["pdf"]' accept="application/pdf"/ required>
    <label class="form-file-label" for="customFileLg">
        <span class="form-file-text">กรุณาเลือกไฟล์</span>
        <span class="form-file-button btn btn-primary ">เลือก</span>
    </label>
    <input type="hidden" id="status" name="status" value="Active">
    </div>
    <div class="mt-4 col-md-12 text-center">
    <button type="submit" type="button" class="btn btn-primary">Upload File</button>
    <a href="{{url('/homeDoctor')}}" class="btn btn-secondary" role="button">ย้อนกลับ</a>
    </div>
    </form>

    <!-- <form action="{{url('/uplode')}}" method="post" enctype="multipart/form-data" class="was-validated">
    @csrf
        <div class="col-sm-12 col-md-11 col-lg-5">
            <div class="form-group row">
                <label for="file" class="col-md-3 col-lg-4 col-form-label">ไฟล์ :</label>
                <div class="col-sm-8">
                    <input id="file" name="filereport" type="file" class="form-control file-is-invalid" data-preview-file-type="text" data-allowed-file-extensions='["pdf"]' accept="application/pdf"/>
                    @error('file')<div class="invalid-file">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">UPLOAD</button>
    </form> -->
</div>
@endsection