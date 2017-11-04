@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.user.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Firebase UID</th>
                        <th>Group</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->firebase_uid }}</td>
                            <td>{{ $user->group->name }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection