@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($id)
                Edit {{ $user->email }}
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.save') }}" method="post">
                <div class="form-group">
                    <label for="first_name" class="form-control-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $user->first_name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="last_name" class="form-control-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="firebase_uid" class="form-control-label">Firebase UID</label>
                    <input type="text" class="form-control" name="firebase_uid" value="{{ $user->firebase_uid }}" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection