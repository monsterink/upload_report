@extends('layouts.app')

@section('title','Role')

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
  @if(session()->has('status'))
        <div class="row">
          <div class="alert alert-success">
            <button type="button" class="btn-close" data-dismiss="alert" aria-hidden="true"></button>
            <!-- <strong>Notification</strong> -->
            {{session()->get('status')}}
          </div>
        </div>
  @endif
  <table class="table">
  <div>
  <a class="btn btn-primary" href="{{url('/addRole')}}" role="button">เพิ่มสิทธิ์การเข้าถึง</a>
  </div>
    <thead>
      <tr>
        <th scope="col">ลำดับที่</th>
        <th scope="col">ชื่อ</th>
        <th scope="col">E-mail</th>
        <th scope="col">สิทธิการเข้าถึง</th>
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
                    <option
                      value="{{$role->id}}"
                      {{ $user->role == $role->id ? 'selected':'' }}
                    >{{$role->role}}</option>
                  @endforeach
              </select></td>
            <td><button type="submit" type="button" class="btn btn-success">ยืนยัน</button></td>
          </form>
        </tr>
      </tbody>
    @endforeach
  </table>
</div>
@endsection