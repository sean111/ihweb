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
            <form action="" method="post">

            </form>
        </div>
    </div>
@endsection