<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $data = Classroom::paginate(10);
        if ($data->count() < 1) $data = null;

        // return response()->json($data);
        return view('admin.classroom.index', ['data' => $data]);
    }

    public function create(ClassroomRequest $request)
    {
        Classroom::create($request->only('name'));

        return redirect('/admin/classroom')->with('msg', "Data $request->name was successfully added. You can edit or delete this data at any time.");
    }

    public function read(String $id)
    {
        $classroom = Classroom::find($id);
        if (!isset($classroom)) return redirect('/admin/classroom/')->with('error', 'Something wrong.');
        
        $assignment = $classroom->assignment()->where('is_expired', false)->get();
        if (count($assignment) < 1) $assignment = false;

        return view('admin.classroom.read', ['data' => $classroom, 'item' => $classroom->user()->paginate(10), 'assignment' => $assignment]);
    }

    public function update(ClassroomRequest $classroomRequest, String $id)
    {
        $classroom = Classroom::find($id);
        $classroom->name = $classroomRequest->name;
        $classroom->save();
    }

    public function delete(String $id)
    {
        $bool = false;
        $class = Classroom::find($id);
        if (isset($class)) {
            $name = $class->name;
            $bool = $class->deleteOrFail();
        }

        if ($bool) {
            return redirect('/admin/classroom')->with('msg', "Delete $name successfully.");
        } else {
            return redirect('/admin/classroom')->with('error', 'Something wrong.');
        }
    }
}
