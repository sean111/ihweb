@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.category.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Parent</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->parent_id ? $category->parent->name : '&nbsp;' }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection