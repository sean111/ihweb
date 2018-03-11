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
                            <option value="{{ $category->id }}" {{ $category->id == $event->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="frequency" class="form-control-label">Frequency</label>
                    <select name="frequency" id="frequency" class="form-control">
                        @foreach($frequencies as $frequency)
                            <option value="{{ $frequency }}" {{ $frequency == $event->frequency ? "selected" : ""}}>{{ ucwords($frequency, '-') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group schedule-date" style="{{ $event->frequency !== 'once' ? 'display: none;' : ''}}">
                    <label for="date" class="form-control-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group schedule-start" style="{{ $event->frequency === 'once' ? 'display: none;' : ''}}">
                    <label for="start" class="form-control-label">Start Date</label>
                    <input type="date" name="start" id="start" class="form-control" value="{{ $event->start ? date('Y-m-d', strtotime($event->start)) : date('Y-m-d') }}">
                </div>
                <div class="form-group schedule-end" style="{{ $event->frequency === 'once' ? 'display: none;' : ''}}">
                    <label for="end" class="form-control-label">End Date</label>
                    <input type="date" name="end" id="end" class="form-control" value="{{ $event->end ? date('Y-m-d', strtotime($event->end)) : '' }}">
                </div>
                <div class="form-group schedule-days" style="display: none;">
                    <label for="days" class="form-control-label">Days:</label>
                    <input type="checkbox" name="day[0]" value="1" {{ !empty($event->days[0]) ? 'checked' : '' }}> Monday
                    <input type="checkbox" name="day[1]" value="1" {{ !empty($event->days[1]) ? 'checked' : '' }}> Tuesday
                    <input type="checkbox" name="day[2]" value="1" {{ !empty($event->days[2]) ? 'checked' : '' }}> Wednesday
                    <input type="checkbox" name="day[3]" value="1" {{ !empty($event->days[3]) ? 'checked' : '' }}> Thursday
                    <input type="checkbox" name="day[4]" value="1" {{ !empty($event->days[4]) ? 'checked' : '' }}> Friday
                    <input type="checkbox" name="day[5]" value="1" {{ !empty($event->days[5]) ? 'checked' : '' }}> Saturday
                    <input type="checkbox" name="day[6]" value="1" {{ !empty($event->days[6]) ? 'checked' : '' }}> Sunday
                </div>
                <div class="form-group">
                    <label for="time" class="form-control-label">Time</label>
                    <input type="time" name="time" id="time" class="form-control" value="{{ $event->time ?? '' }}">
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