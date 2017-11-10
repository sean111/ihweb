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
                            Category:
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <div class="p-2"><a href="#" class="btn btn-primary">Assign</a></div>
                            <div class="p-2"><a href="#" class="btn btn-warning">Rename</a></div>
                            <div class="p-2"><a href="#" class="btn btn-danger">Delete</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection