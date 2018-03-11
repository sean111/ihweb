@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($id)
                Edit {{ $category->name }}
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.save') }}" method="post">
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-label">Description</label>
                    <textarea name="description" id="description" rows="10" class="form-control">{{ $category->description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="parent" class="form-control-label">Parent</label>
                    <select name="parent" id="parent" class="form-control">
                        <option value="0">None</option>
                        @foreach($categories as $cats)
                            <option value="{{ $cats->id }}" {{ $cats->id == $category->parent_id ? 'selected' : null }}>{{ $cats->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="id" value="{{ $id }}">
                    {{ csrf_field() }}
                    <a href="{{ route('admin.categories') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection