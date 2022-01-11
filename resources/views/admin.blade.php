@extends('master')

@section('content')
@extends('layout.header')
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Number of pictures</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($data as $key => $item)
    <tr>
      <th scope="row">{{$key + 1}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->email}}</td>
      <td>{{$item->image_count}}</td>

      <td>@if ($item->is_admin != 1)
        <a href="{{route('destroy',['id'=>$item->id])}}"> Delete </a>

      @endif
    </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
