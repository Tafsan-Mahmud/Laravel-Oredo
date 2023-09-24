@extends('layouts.dashboard')


@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Role Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">role</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Power of Role</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($roles as $sl => $role)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->getAllPermissions() as $permi)
                                            <span class="badge badge-info">{{ $permi->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{-- <a href="" class="btn btn-danger">Delete</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>User Role list</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $sl => $user)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @forelse ($user->getRoleNames() as $role)
                                            <span class="badge badge-success">{{ $role }}</span>
                                        @empty
                                            <span class="badge badge-secondary">not assign</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        @foreach ($user->getAllPermissions() as $permi)
                                            <span class="badge badge-info">{{ $permi->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.user.permission', $user->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ route('remove.role.user', $user->id) }}"
                                            class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>



            <div class="col-lg-3">
                    <div class="card">

                        <div class="card-header">
                            <h4>Add Permission</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('permission.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="permission" placeholder="add permission" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Add Permission</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-header">
                            <h4>Add Role</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="role" placeholder="add role" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <h5>add permission</h5>
                                    @foreach ($permission as $check)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="permission[]" value="{{ $check->id }}"
                                                    class="form-check-input">
                                                {{ $check->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Add Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h4>Asign Role</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('asign.role') }}" method="POST">
                                @csrf
                                <h5 class="mb-2">Select User</h5>
                                <select name="user_id" id="" class="form-control user_select">
                                    <option value="">--Select User--</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <h5 class="mb-2 mt-3">Select Role</h5>
                                <select name="role_id" id="" class="form-control">
                                    <option value="">--Select Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Asign Role" class="btn btn-primary mt-3">
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
            $('.user_select').select2();
        });
    </script>
@endsection
