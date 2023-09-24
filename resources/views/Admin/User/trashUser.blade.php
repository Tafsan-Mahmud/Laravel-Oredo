@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trash User</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9 m-auto">
                <div class="card">
                    <form action="{{ route('hard.delete.checkbox') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>User List <span class="float-right"> Total: {{ $total }} </span></h4>
                            <button type="submit" name="click" value="1" class="btn btn-danger mt-2">Delete permanently all Checked User</button>
                            <button type="submit" name="click" value="2" class="btn btn-success mt-2">Restore permanently all Checked User</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" id="checkall"> Check All</th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($userData as $sl => $data)
                                    <tr>
                                        <td><input type="checkbox" name="check[]" value="{{ $data->id }}"></td>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            @if ($data->photo == null)
                                                <img src="{{ Avatar::create($data->name)->toBase64() }}" />
                                            @else
                                                <img src="{{ asset('/uploads/users') }}/{{ $data->photo }}" alt="profile">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.restore', $data->id) }}"
                                                class="btn btn-success">Restore</a>
                                            <a href="{{ route('user.hard.delete', $data->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_JS')
    <script>
        $('#checkall').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        })
    </script>
@endsection
