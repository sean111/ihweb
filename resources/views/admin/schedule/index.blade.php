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
                            <td>{{ date('m/d/Y', strtotime($event->start)) }}</td>
                            <td>{{ date('m/d/Y', strtotime($event->end)) }}</td>
                            <td>{{ $event->frequency }}</td >
                            <td>
                                @foreach($event->days as $index => $day)
                                    {{ getDayFromInt($index) }}
                                @endforeach
                            </td>
                            <td>{{ date('h:ia', strtotime($event->time)) }}</td>
                            <td>
                                <a href="{{ route('admin.schedule.edit', ['id' => $event->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('admin.schedule.delete', ['id' => $event->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection