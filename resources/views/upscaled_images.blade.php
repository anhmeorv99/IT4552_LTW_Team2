@extends('master')

@section('content')
@extends('layout.header')
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Image</th>
      <th scope="col">File Name</th>
      <th scope="col">Scale</th>
    </tr>
  </thead>
  <tbody>
      @foreach($images as $key => $item)
      @if ($item->scale_x2 != null && $item->scale_x4 != null)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td><img src="/results/X2_{{$item->hashed_filename}}" width="250", height="250"></td>
            <td>{{$item->file_name}}</td>
            <td>2</td>
        </tr>

        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td><img src="/results/X4_{{$item->hashed_filename}}" width="250", height="250"></td>
            <td>{{$item->file_name}}</td>
            <td>4</td>
        </tr>
        @else
        <tr>
            <th scope="row">{{$key + 1}}</th>
            @if ($item->scale_x2 != null)
                <td><img src="/results/X2_{{$item->hashed_filename}}" width="250", height="250"></td>
                <td>{{$item->file_name}}</td>
                <td>2</td>
            @else
                <td><img src="/results/X4_{{$item->hashed_filename}}" width="250", height="250"></td>
                <td>{{$item->file_name}}</td>
                <td>4</td>
            @endif
        </tr>
        @endif
    @endforeach
  </tbody>
</table>
@endsection
