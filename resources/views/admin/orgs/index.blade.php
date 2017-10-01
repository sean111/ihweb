@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Organizations
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.org.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Email</th>
                        <th>Domain</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orgs as $org)
                    <tr>
                        <td>{{ $org->name }}</td>
                        <td>{{ $org->email }}</td>
                        <td>{{ $org->domain }}</td>
                        <td>
                            <a href="{{ route('admin.org.edit', ['id' => $org->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{ route('admin.org.delete', ['id' => $org->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Danger</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection