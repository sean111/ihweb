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
        return $question;
    }

    /**
     * @param int $catId
     * @param int $count
     * @param int $start
     */
    public function getRange(int $catId, int $count = 10, int $start = 0)
    {
        $questions = Question::whereHas('categories', function($q) use ($catId) {
            $q->where('category_id', $catId);
        });
        if ($start) {
            $questions = $questions->offset($start);
        }
        return $questions->limit($count)->get();
    }
}