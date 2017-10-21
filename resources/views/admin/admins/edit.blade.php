@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($admin->id > 0)
                Edit {{ $admin->name }}
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="firstName" class="form-control-label">First Name:</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $admin->first_name ?? ''}} ">
                </div>
                <div class="form-group">
                    <label for="lastName" class="form-control-label">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" value="{{ $admin->last_name ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{  $admin->email ?? '' }}">
                </div>
                @if(count($orgs) == 1)
                    <input type="hidden" name="org" value="{{ $orgs[0]->id }}">
                @else
                    <div class="form-group">
                        <label for="Organization" class="form-control-label">Organization</label>
                        <select name="org" id="org" class="form-control">
                            @foreach($orgs as $org)
                                <option value="{{$org->id}}">{{$org->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="role" class="form-control-label">Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="client_admin">Client Admin</option>
                        <option value="dev">Dev</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $admin->id }}">
                    {{ csrf_field() }}
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection