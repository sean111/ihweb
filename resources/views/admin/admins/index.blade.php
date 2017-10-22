@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Admins
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ ucfirst($admin->role) }}</td>
                            <td>
                                <a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('admin.admins.delete', ['id' => $admin->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection