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
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody>
      @foreach($images as $key => $item)
      @if ($item->scale_x2 != null && $item->scale_x4 != null)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td><img src="/results/X2_{{$item->hashed_filename}}" width="150", height="150"></td>
            <td>{{$item->file_name}}</td>
            <td>2</td>
            <td><a href="results/X2_{{$item->hashed_filename}}" download><i class="fa fa-download" style="font-size:36px;"></i> </a></td>
        </tr>

        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td><img src="/results/X4_{{$item->hashed_filename}}" width="150", height="150"></td>
            <td>{{$item->file_name}}</td>
            <td>4</td>
            <td><a href="results/X4_{{$item->hashed_filename}}" download> <i class="fa fa-download" style="font-size:36px;"></i> </a> </td>
        </tr>
        @else
        <tr>
            <th scope="row">{{$key + 1}}</th>
            @if ($item->scale_x2 != null)
                <td><img src="/results/X2_{{$item->hashed_filename}}" width="150", height="150"></td>
                <td>{{$item->file_name}}</td>
                <td>2</td>
                <td><a href="results/X2_{{$item->hashed_filename}}" download><i class="fa fa-download" style="font-size:36px;"></i> </a></td>
            @else
                <td><img src="/results/X4_{{$item->hashed_filename}}" width="150", height="150"></td>
                <td>{{$item->file_name}}</td>
                <td>4</td>
                <td><a href="results/X4_{{$item->hashed_filename}}" download> <i class="fa fa-download" style="font-size:36px;"></i> </a> </td>
            @endif
        </tr>
        @endif

    @endforeach
  </tbody>
</table>
{{-- <div class="row" style="margin-left: 30px; display='block';">{{ $images->links() }}</div> --}}
<div class="pagination" style="margin-left:45%;">
    @if ($images->hasMorePages())
    <li style="padding-right:50px"><a href="{{ $images->previousPageUrl() }}" rel="next">← Back</a></li>
    <li><a href="{{ $images->nextPageUrl() }}" rel="next">Next →</a></li>
    @else
    <li style="padding-right:50px"><a href="{{ $images->previousPageUrl() }}" rel="next">← Back</a></li>
    <li><span>Next →</span></li>
    @endif

</div>



@endsection
