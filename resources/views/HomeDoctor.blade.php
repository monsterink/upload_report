@extends('layouts.app')

@section('title','Uploads')


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
  @if (count($uploadfiles) !=0 )
    @foreach ($uploadfiles as $key=>$uploadfile) 
  <tbody>
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td><!--<a href="{{url('/upload_list/'.$uploadfile->id)}}" target="_blank" role="button">-->{{$uploadfile->an}}</td>
      <td>{{$uploadfile->filename}}</td>
      <td>{{$uploadfile->created_at}}</td>
      <td>{{$uploadfile->status}}</td>
      <td><a href="{{url('/print/'.$uploadfile->id)}}" target="_blank" class="btnprn btn btn-primary" role="button"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
        <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
        <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
      </svg></a></td>
    </tr>
  </tbody>
    @endforeach
  @endif
</table>
</div>
@endsection