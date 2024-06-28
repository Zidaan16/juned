<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $class = Classroom::get(['id', 'name']);

        return view('admin.assignment.index', [
            'title' => 'Assignments',
            'classroom' => $class,
            'item' => Assignment::paginate(10)
        ]);
    }

    public function create(Request $request)
    {
        if ($request->classroom_id == 'all') {
            $classroom = Classroom::all();
        } else {
            $classroom = Classroom::where('id', $request->classroom_id)->get();

            if (!isset($classroom))
                return redirect()->back()->with('error', 'Something wrong.');
        }
        $numberOfQuestion = count($request->question);

        for ($j=0; $j < count($classroom); $j++) { 
            $assignment = $classroom[$j]->assignment()->create([
                'title' => $request->title,
                'expired_at' => $request->expired_at,
                'number_of_question' => $numberOfQuestion
            ]);
            for ($i=0; $i < $numberOfQuestion; $i++) {
                $question = [
                    'description' => $request->question[$i],
                    'point' => $request->point[$i],
                ];
                if ($request->type[$i] == 'mcq') {
                    $choice= [
                        $request->options1[$i],
                        $request->options2[$i],
                        $request->options3[$i],
                        $request->correctAnswer[$i]
                    ];
                    shuffle($choice);
    
                    $question['is_essay'] = false;
                    $question['choice_1'] = $choice[0];
                    $question['choice_2'] = $choice[1];
                    $question['choice_3'] = $choice[2];
                    $question['choice_4'] = $choice[3];
                    $question['correct_answer'] = $request->correctAnswer[$i];
                } else {
                    $question['is_essay'] = true;
                }
    
                $assignment->question()->create($question);
            }
        }

        return redirect('/admin/assignment/')->with('msg', "Create new assignment successfully.");
    }

    public function form(FormAssignmentRequest $request)
    {
        if ($request->classroom_id == 'all') {
            $title = 'New assignment';
        } else {
            $classroom = Classroom::find($request->classroom_id);
            if (!isset($classroom))
                return redirect()->back()->with('error', 'Something wrong.');
            $title = "New assignment on " . $classroom->name;
        }
        $data = $request->only('classroom_id', 'title', 'expired', 'numberOfQuestion');
        return view('admin.assignment.form', ['item' => $data, 'title' => $title]);
    }
}
