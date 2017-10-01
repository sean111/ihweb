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
                    <input type="hidden" name="id" value="{{ $id }}">
                    {{ csrf_field() }}
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection