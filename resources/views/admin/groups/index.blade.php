@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Groups
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.group.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Members?</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->code }}</td>
                            <td>&nbsp;</td>
                            <td>
                                <a href="{{ route('admin.group.edit', ['id' => $group->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('admin.group.delete', ['id' => $group->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection