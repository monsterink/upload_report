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
      <th scope="col">ชื่อ</th>
      <th scope="col">E-mail</th>
      <th scope="col">สถานะ</th>
      <th scope="col"></th>
    </tr>
  </thead>
  @foreach ($users as $key=>$user) 
  <tbody>
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <form action="{{url('/uploads/role/'.$user->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      <td><select class="form-select form-select-sm" id="role" name="role">
            @foreach ($roles as $role) 
            <option value="{{$role->id}}"{{ old('id') == $user->role ? "selected" :""}}>{{$role->role}}</option>
            @endforeach
      </select></td>
      <td><button type="submit" type="button" class="btn btn-primary">แก้ไข</button></td>
      </form>
    </tr>
  </tbody>
  @endforeach
</table>
</div>
@endsection