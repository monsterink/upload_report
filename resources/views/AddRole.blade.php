@extends('layouts.app')

@section('title','Role')

@section('sidebar')
    @parent

@endsection

@section('content')  

<div class="mt-4">
<form action="{{url('addRole')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <span class="input-group-text btn-secondary">กรุณากรอกสิทธิใหม่</span>
        <input type="text" class="form-control" name="addRole" required>
    </div>
    <div class="col-md-12 text-center">  
        <button type="submit" type="button" class="btn btn-success">บันทึก</button>
    </div>
</form>
</div>
@endsection