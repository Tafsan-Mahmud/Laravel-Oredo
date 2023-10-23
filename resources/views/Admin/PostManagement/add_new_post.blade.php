@extends('layouts.dashboard');


@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category section</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="">-- select category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tittle">Post Tittle</label>
                                <input type="text" id="tittle" name="tittle" value="{{ old('tittle') }}" placeholder="post tittle"
                                    class="form-control">
                                @error('tittle')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea id="summernote" name="desp" value="{{ old('desp') }}" placeholder="post tittle" class="form-control" cols="30" rows="10">
                                </textarea>
                                @error('desp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h5>Select tags</h5>
                                <div class="form-group d-flex">
                                    @foreach ($tags as $tag)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input value="{{ $tag->id }}" type="checkbox" class="form-check-input"
                                                    name="tags_id[]"> <i class="input-frame"></i>{{ $tag->tag_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('tags_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>File upload</label>
                                <input type="file" name="post_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-success" type="button">Upload</button>
                                    </span>
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        placeholder="Upload Image">
                                </div>
                            </div>
                            @error('post_image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">Submit Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_JS')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
