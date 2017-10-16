<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    public function getAll(int $catId)
    {
        $questions = Question::where('category_id', '=', $catId)->get();
        return $questions;
    }

    public function getRandom(int $catId)
    {
        $question = Question::where('category_id', '=', $catId)->get()->inRandomOrder()->first();
        return $question;
    }

    public function getRange(int $catId, int $start = 0, int $count = 10)
    {
        $questions = Question::where('category_id', '=', $catId);
        if ($start) {
            $questions->offset($start);
        }
        $questions->limit($count)->get();
        dd($questions);
    }
}