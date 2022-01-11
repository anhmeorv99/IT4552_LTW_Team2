@extends('master')

@section('content')
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User name</th>
      <th scope="col">Email</th>
      <th scope="col">Number of pictures</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($userList as $item)
    <tr>
      <th scope="row">{{++$order}}</th>
      <td>{{$item->user_id}}</td>
      <td>{{$item->email}}</td>
      <td>{{$item->image_count}}</td>
      <td><button class="btn btn-danger">Delete <a href="{{route('destroy',['id'=>$item->user_id])}}"></a></button></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection