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
  @foreach ($uploadfiles as $key=>$uploadfile) 
  <tbody>
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$uploadfile->an}}</td>
      <td>{{$uploadfile->filename}}</td>
      <td>{{$uploadfile->created_at}}</td>
    </tr>
  </tbody>
  @endforeach
</table>
</div>
@endsection