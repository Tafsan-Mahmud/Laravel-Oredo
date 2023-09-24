@extends('layouts.dashboard');


@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Tag</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tag list</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>all tags</h4>
                    </div>
                    @if (session('tagdel'))
                        <div class="alert alert-success">{{ session('tagdel') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Tag Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($tag_data as $sl => $data)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $data->tag_name }}</td>
                                    <td>
                                        <a class="btn btn-danger dlt_url"
                                            href="{{ route('delete.tag', $data->id) }}">Delete</a>
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
                        <h4>add new Tag</h4>
                    </div>
                    @if (session('tagSuccess'))
                        <div class="alert alert-success">{{ session('tagSuccess') }}</div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.new.tag') }}" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tag Name</label>
                                <input value="{{ old('tag_name') }}" type="text" name="tag_name" class="form-control"
                                    id="exampleInputUsername1" autocomplete="off" placeholder="tag name">
                                @error('tag_name')
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
