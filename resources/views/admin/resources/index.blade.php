@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Resources
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.resource.upload') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="row">
            @foreach($files as $file)
                <div class="card" style="width: 20rem">
                    <img src="{{ resourceLink($file) }}" alt="" class="card-img-top img-fluid">
                    <div class="card-body">
                        <p class="card-text">
                            Name: {{ $file->name }}<br>
                            Category: {{ $file->category_id ? $file->category->name : 'None' }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <div class="p-2"><a href="#" class="btn btn-primary resource-assign" data-id="{{ $file->id }}">Assign</a></div>
                            <div class="p-2"><a href="#" class="btn btn-warning resource-rename" data-id="{{ $file->id }}">Rename</a></div>
                            <div class="p-2"><a href="#" class="btn btn-danger resource-delete" data-id="{{ $file->id }}">Delete</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="resource-rename-modal">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.resource.rename') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rename File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <input type="hidden" name="file_id" id="file_id">
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Rename</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="resource-assign-modal">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.resource.assign') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Category</label>
                            <select name="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="file_id" id="assign_file_id">
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Assign</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection