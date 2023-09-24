@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Role Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">edit permission</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Permission</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('update.user.permission')}}" method="POST">
                            @csrf
                            <h5>User Name</h5>
                            <div class="mb-3 mt-2">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <h6 class="text-secondary border p-2">{{$user->name}} -> <span class="float-right badge badge-success">
                                    @foreach ($user->getRoleNames() as $role)
                                        {{$role}}
                                    @endforeach
                                </span></h6>
                            </div>
                            <div class="mb-3 mt-4">
                                @foreach ($permission as $check)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox"
                                                {{ $user->hasPermissionTo($check->name) ? 'checked' : '' }}
                                                name="permission[]" value="{{ $check->id }}" class="form-check-input">
                                            {{ $check->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="submit" value="Sunmit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
