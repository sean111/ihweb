@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($id)
                Edit {{ $group->name }}
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.group.save') }}" method="post">
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $group->name ?? '' }}" required>
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