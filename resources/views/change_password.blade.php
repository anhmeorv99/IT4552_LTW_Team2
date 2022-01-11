@extends('master')
@section('content')
@extends('layout.header')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('error-confirm'))
                            <div class="alert alert-danger">
                                {{ session('error-confirm') }}
                            </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors)
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-danger">
                                        @if ($errors->has('new-password'))
                                            {{$errors->first('new-password')}}
                                        @elseif ($errors->has('current-password'))
                                            {{ $errors->first('current-password') }}
                                        @endif

                                    </div>

                                @endforeach
                            @endif

                        <h4>Change Password</h4>
                        <hr>

                            <div class="col">
                                <form action="{{route('updateChangePassword')}}" method="POST">
                                    @csrf
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 offset-5">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                        </form>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
