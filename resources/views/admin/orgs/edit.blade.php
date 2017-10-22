@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($id)
                Edit {{ $org->name }}
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.org.save') }}" method="post">
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $org->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Contact Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $org->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="domain" class="form-control-label">Domain</label>
                    <input type="text" class="form-control" name="domain" value="{{ $org->domain ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="primary_color" class="form-control-label">Primary Color</label>
                    <div class="input-group colorpicker-component">
                        <input type="text" class="form-control" name="primary_color" value="{{ $org->primary_color }}">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="secondary_color" class="form-control-label">Secondary Color</label>
                    <div class="input-group colorpicker-component">
                        <input type="text" class="form-control" name="secondary_color" value="{{ $org->secondary_color }}">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tertiary_color" class="form-control-label">Terirary Color</label>
                    <div class="input-group colorpicker-component">
                        <input type="text" class="form-control" name="tertiary_color" value="{{ $org->tertiary_color }}">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $id }}">
                    {{ csrf_field() }}
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection