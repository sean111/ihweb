@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ $id ? 'Edit' : 'New' }} Schedule
        </div>
        <div class="card-body">
            <form action="{{ route('admin.schedule.save') }}" method="post">
                <div class="form-group">
                    <label for="category" class="form-control-label">Category</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="frequency" class="form-control-label">Frequency</label>
                    <select name="frequency" id="frequency" class="form-control">
                        @foreach($frequencies as $frequency)
                            <option value="{{ $frequency }}">{{ ucwords($frequency, '-') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group schedule-date">
                    <label for="date" class="form-control-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group schedule-start" style="display: none;">
                    <label for="start" class="form-control-label">Start Date</label>
                    <input type="date" name="start" id="start" class="form-control" value="{{ $event->start ?? date('Y-m-d') }}">
                </div>
                <div class="form-group schedule-end" style="display: none;">
                    <label for="end" class="form-control-label">End Date</label>
                    <input type="date" name="end" id="end" class="form-control">
                </div>
                <div class="form-group schedule-days" style="display: none;">
                    <label for="days" class="form-control-label">Days:</label>
                    <input type="checkbox" name="day[0]" value=""> Monday
                    <input type="checkbox" name="day[1]" value=""> Tuesday
                    <input type="checkbox" name="day[2]" value=""> Wednesday
                    <input type="checkbox" name="day[3]" value=""> Thursday
                    <input type="checkbox" name="day[4]" value=""> Friday
                    <input type="checkbox" name="day[5]" value=""> Saturday
                    <input type="checkbox" name="day[6]" value=""> Sunday
                </div>
                <div class="form-group">
                    <label for="time" class="form-control-label">Time</label>
                    <input type="time" name="time" id="time" class="form-control">
                </div>
                <div class="form-group pull-right">
                    <a href="{{ route('admin.schedules') }}" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-success">Save</button>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                {{ csrf_field() }}

            </form>
        </div>
    </div>
@endsection