@extends('layouts.app')

@section('title','Homepage')

@section('sidebar')
    @parent

@endsection

@section('content')  
<style>
table th {
  text-align: center;
}
table td {
  text-align: center;
}
</style>
<div class="mt-4">
<div>
<a href="{{url('/upload')}}" role="button" class="btn btn-l btn-outline-success rounded-pill shadow-lg ">
<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud-arrow-up-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 1 0V6.707l1.146 1.147a.5.5 0 0 0 .708-.708z"/>
</svg>
        Upload Files</a>
</div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ลำดับที่</th>
      <th scope="col">AN</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">วันที่</th>
      <th scope="col">สถานะ</th>
    </tr>
  </thead>
  @if (count($uploadfiles) !=0 )
    @foreach ($uploadfiles as $key=>$uploadfile) 
  <tbody>
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td><a href="{{url('/homeDoctor/'.$uploadfile->id)}}" target="_blank" role="button">{{$uploadfile->an}}</a></td>
      <td>{{$uploadfile->filename}}</td>
      <td>{{$uploadfile->created_at}}</td>
      <td>{{$uploadfile->status}}</td>
      @if($uploadfile->status == 'Upload')
      <th><div class="form-popup" id="myForm">
        <a href="{{url('/confirm/'.$uploadfile->id)}}" class="btn btn-success rounded-pill" name="status" value="Active" role="button">ยืนยัน</a>
        <a href="{{url('/delete/'.$uploadfile->id)}}" class="btn btn-danger rounded-pill" name="status" role="button">ลบ</a>
      </div></th>
      @endif
    </tr>
  </tbody>
    @endforeach
  @endif
</table>
</div>
@endsection