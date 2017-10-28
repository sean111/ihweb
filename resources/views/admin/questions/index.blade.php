@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Questions
        </div>
        <div class="card-body">
            <div class="pull-right" style="padding-bottom: 1em;">
                <a href="{{ route('admin.question.new') }}" class="btn btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
            <table class="table table-hover table-stripped">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answers</th>
                        <th>Correct Answer</th>
                        <th>Correct Feedback</th>
                        <th>Incorrect Feedback</th>
                        <th>Difficulty</th>
                        <th>Resource</th>
                        <th>Category</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <?php $answers = \unserialize($question->answers); ?>
                        <tr>
                            <td>{{ $question->question }}</td>
                            <td>
                                @foreach($answers as $answer)
                                    {{ $answer }} <br/>
                                @endforeach
                            </td>
                            <td>{{ $answers[$question->correct_answer] }}</td>
                            <td>{{ $question->correct_feedback }}</td>
                            <td>{{ $question->incorrect_feedback }}</td>
                            <td>{{ $question->difficulty }}</td>
                            <td>{{ $question->resource }}</td>
                            <td>{{ $question->category->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('admin.question.edit', ['id' => $question->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection