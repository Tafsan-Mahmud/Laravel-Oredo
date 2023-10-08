@extends('layouts.dashboard');

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">edit profile</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row m-auto">
            <div class="col-lg-8 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    @if (session('updateinfoSuccss'))
                        <div class="alert alert-success">Update Successfuly</div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.profile') }}" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Full Name</label>
                                <input value="{{ Auth::user()->name }}" type="text" name="name" class="form-control"
                                    id="exampleInputUsername1" autocomplete="off" placeholder="full name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input value="{{ Auth::user()->email }}" type="email" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Old Password</label>
                                <input type="password" name="oldPassword" class="form-control" id="exampleInputPassword1"
                                    autocomplete="off" placeholder="old Password">
                            </div>
                            @if (session('OlsPassErr'))
                                <strong class="text-danger">{{ session('OlsPassErr') }}</strong>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    autocomplete="off" placeholder="Password">
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile image</h4>
                    </div>
                    @if (session('updateimageSuccss'))
                        <div class="alert alert-success">Update Successfuly</div>
                    @endif
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('update.profile.image') }}"
                            class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="photo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
