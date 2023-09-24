@extends('layouts.dashboard')
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Category List</h4>
                    </div>
                    @if (session('cat_delete'))
                        <div class="alert alert-success">{{ session('cat_delete') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $sl => $data)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $data->cat_name }}</td>
                                    <td><img src="{{ asset('/uploads/categories') }}/{{ $data->cat_image }}"alt="">
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('edit.category', $data->id) }}">Edit</a>
                                        <a class="btn btn-danger dlt_url"
                                            daynamic-url="{{ route('delete.category', $data->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Category</h4>
                    </div>
                    @if (session('cat_store'))
                        <div class="alert alert-success">{{ session('cat_store') }}</div>
                    @endif
                    @if (session('cat_err'))
                        <div class="alert alert-danger">{{ session('cat_err') }}</div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.new.category') }}" enctype="multipart/form-data"
                            class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input value="{{ old('cat_name') }}" type="text" name="cat_name" class="form-control"
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
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_JS')
    <script>
        $('.dlt_url').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const link = $(this).attr('daynamic-url');
                    window.location.href = link;
                }
            })
        });
    </script>
    @if (session('cat_delete'))
        <script>
            Swal.fire(
                'Category deleted successfully',
                'success'
            )
        </script>
    @endif
@endsection
