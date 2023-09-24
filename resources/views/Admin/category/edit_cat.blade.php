@extends('layouts.dashboard');

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
    </ol>
</nav>
<div class="container">
    <div class="row m-auto">
        <div class="col-lg-5 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Category</h4>
                </div>
                @if (session('editSuccess'))
                    <div class="alert alert-success">{{ session('editSuccess') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store.edited.category') }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        <input type="hidden" value="{{$cat_data->id}}" name="cat_id">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category Name</label>
                            <input value="{{ $cat_data->cat_name }}" type="text" name="cat_name" class="form-control"
                                id="exampleInputUsername1" autocomplete="off" placeholder="Category Name">
                            @error('cat_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>image upload</label>
                            <input type="file" name="cat_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Image">

                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-secondary" type="button">Upload</button>
                                </span>
                            </div>
                            @error('cat_image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <div class="mt-3">
                                <img src="{{asset('uploads/categories')}}/{{$cat_data->cat_image}}" alt="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
