@extends('master')
@section('content')
@extends('layout.header')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>My profile</h4>
                        <hr>
                            <div class="col">
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" readonly class="form-control" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text"  name="name" readonly class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text"  name="address" readonly class="form-control" value="{{ Auth::user()->address }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text"  name="phone" readonly class="form-control" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-4 offset-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Update profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('updateProfile')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="col">
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" readonly class="form-control" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text"  name="name" class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text"  name="address" class="form-control" value="{{ Auth::user()->address }}">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text"  name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
