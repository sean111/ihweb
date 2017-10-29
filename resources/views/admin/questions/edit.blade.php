@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($id)
                Edit
            @else
                New
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('admin.question.save') }}" method="post">
                <div class="form-group">
                    <label for="question" class="form-control-label">Question</label>
                    <textarea name="question" id="question" rows="5" class="form-control">{{ $question->question ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="answers" class="answers">Answers</label>
                    <?php
                        $answers = [];
                        if (!empty($question->answers)) {
                            $answers = unserialize($question->answers);
                        }
                    ?>
                    @foreach( $answers as $answer)
                        <div id="answer-inputs">
                            <div class="input-group">
                                <input type="text" name="answer[]" class="form-control answer" value="{{ $answer }}">
                                <span class="input-group-btn">
                                <button type="button" class="btn btn-danger del-answer"><i class="fa fa-remove"></i></button>
                            </span>
                            </div>
                        </div>
                    @endforeach
                    <div id="answer-inputs">
                        <div class="input-group">
                            <input type="text" name="answer[]" class="form-control answer">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger del-answer"><i class="fa fa-remove"></i></button>
                            </span>
                        </div>
                    </div>
                    <span class="add-answer"><i class="fa fa-plus"></i> Add</span>
                </div>
                <div class="form-group">
                    <label for="correct_answer" class="form-control-label">Correct Answer</label>
                    <select name="correct_answer" id="correct_answer" class="form-control">
                        @foreach($answers as $answer)
                            <option value="{{ $answer }}">{{ $answer }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="correct_feedback" class="form-control-label">Correct Feedback</label>
                    <input type="text" class="form-control" name="correct_feedback">
                </div>
                <div class="form-group">
                    <label for="incorrect_feedback" class="form-control-label">Incorrect Feedback</label>
                    <input type="text" class="form-control" name="incorrect_feedback">
                </div>
                <div class="form-group">
                    <label for="difficulty" class="form-control-label">Difficulty</label>
                    <select name="difficulty" id="difficulty" class="form-control">
                        @foreach($difficulties as $difficulty)
                            <option value="{{ $difficulty }}">{{ ucfirst($difficulty) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="resource" class="form-control-label">Resource</label>
                    <input type="text" class="form-control" name="resource">
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-success">Save</button>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection