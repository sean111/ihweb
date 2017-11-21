@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Scheduled Questions
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.schedule.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Frequency</th>
                        <th>Days</th>
                        <th>Time</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->category->name }}</td>
                            <td>{{ $event->start }}</td>
                            <td>{{ $event->end }}</td>
                            <td>{{ $event->frequency }}</td>
                            <td>{{ $event->days }}</td>
                            <td>{{ $event->time }}</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection