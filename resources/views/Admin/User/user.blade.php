@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">user list</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card">
                    <form action="{{ route('delete.checkbox') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>User List <span class="float-right"> Total: {{ $total }} </span></h4>
                            <button type="submit" class="btn btn-danger mt-2">Delete all Checked User</button>
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
                                {{-- @can('show_user_list') --}}
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
                                                <a href="{{ route('user.delete', $data->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                {{-- @else
                                    <div class="text-center text-danger">
                                        <h2>This page is Restricted!!. only the Super Admin Can Access this page!</h2>
                                    </div> --}}
                                {{-- @endcan --}}
                            </table>
                        </div>
                    </form>
                </div>
                @can('show_user_list')
                    <div class="m-auto pt-3">
                        {{ $userData->Links() }}
                    </div>
                @endcan
            </div>
        </div>

    </div>
@endsection

@section('footer_JS')
    @if (session('dltUser'))
        <script>
            Swal.fire(
                'delete user {trash}'
            )
        </script>
    @endif
    <script>
        $('#checkall').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        })
    </script>
@endsection
