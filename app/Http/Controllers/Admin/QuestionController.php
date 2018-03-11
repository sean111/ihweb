<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $questions = Question::where('organization_id', '=', getDefaultOrg()->id)->get();
        return $this->view('admin.questions.index', ['questions' => $questions]);
    }

    public function edit(int $id = 0)
    {
        try {
            if ($id) {
                $question = Question::findOrFail($id);
            } else {
                $question = new Question;
            }
            $difficulties = \App\Enums\Difficulty::toArray();
            $questionCats = $question->categories->pluck('id')->toArray();
            //Get possible categories
            $categories = Category::where('organization_id', '=', getDefaultOrg()->id)->get();
            return $this->view('admin.questions.edit', compact('question', 'id', 'categories', 'difficulties', 'questionCats'));
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error when trying to edit or create the question');
            return redirect(route('admin.questions'));
        }

    }

    public function save(Request $request)
    {
        try {
            $answer = array_filter($request->get('answer'));
            $question = Question::findOrNew($request->get('id'));
            $question->question = $request->get('question');
            $question->answers = \serialize($answer);
            $question->correct_answer = \array_search($request->get('correct_answer'), $answer);
            $question->correct_feedback = $request->get('correct_feedback');
            $question->incorrect_feedback = $request->get('incorrect_feedback');
            $question->difficulty = $request->get('difficulty');
            $question->resource = $request->get('resource');
            $question->organization_id = getDefaultOrg()->id;
            $question->save();
            $question->categories()->sync($request->get('categories'));
            setAlert('success', 'Question saved');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error saving the question');
        }
        return redirect(route('admin.questions'));
    }

    public function delete(int $id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();
            setAlert('success', 'The question was deleted successfully');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error while deleting the question');
        }
        return redirect(route('admin.questions'));
    }
}
