<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * @param int $catId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(int $catId)
    {
        $questions = Question::whereHas('categories', function($q) use ($catId) {
            $q->where('category_id', $catId);
        })->get();
        foreach ($questions as &$question) {
            $question->answers = \unserialize($question->answers);
        }
        return $questions;
    }

    /**
     * @param int $catId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getRandom(int $catId)
    {
        $question = Question::whereHas('categories', function($q) use ($catId) {
            $q->where('category_id', $catId);
        })->inRandomOrder()->first();
        $question->answers = \unserialize($question->answers);
        return $question;
    }

    /**
     * @param int $catId
     * @param int $count
     * @param int $start
     * @return Question[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getRange(int $catId, int $count = 10, int $start = 0)
    {
        $questions = Question::whereHas('categories', function($q) use ($catId) {
            $q->where('category_id', $catId);
        });
        if ($start) {
            $questions = $questions->offset($start);
        }
        foreach ($questions as &$question) {
            $question->answers = \unserialize($question->answers);
        }
        return $questions->limit($count)->get();
    }

    public function getDifficulty(int $catId, string $diff)
    {
        $questions = Question::whereHas('categories', function($q) use ($catId) {
            $q->where('category_id', $catId);
        })->where('difficulty', '=', $diff)->get();
        foreach ($questions as &$question) {
            $question->answers = \unserialize($question->answers);
        }
        return $questions;
    }
}