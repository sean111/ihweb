@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Upload Resource
        </div>
        <div class="card-body">
            <form action="{{ route('admin.resource.upload') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="form-control-input">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="resource">Resource</label>
                    <input type="file" name="resource" class="form-control" required>
                </div>
                <div class="pull-right">
                    <button class="btn-success">Save</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection