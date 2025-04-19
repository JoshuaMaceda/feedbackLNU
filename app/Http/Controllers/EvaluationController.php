<?php

// app/Http/Controllers/EvaluationController.php
namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function create(User $teacher, Request $req)
    {
        abort_unless($teacher->role==='teacher',404);
        return view('evaluate', [
            'teacher'=>$teacher,
            'questions'=>['clarity','engagement','knowledge','management']
        ]);
    }

    public function store(User $teacher, Request $req)
    {
        $data = $req->validate([
            'scores'=>'required|array',
            'scores.*'=>'required|integer|min:1|max:5',
            'comments'=>'nullable|string|max:1000'
        ]);

        Evaluation::create([
            'teacher_id'   => $teacher->id,
            'evaluator_id' => Auth::id(),
            'source_type'  => 'student', 
            'scores'       => $data['scores'],
            'comments'     => $data['comments'] ?? null,
        ]);

        return redirect()->route('evaluation.create',$teacher)
                         ->with('message','Evaluation submitted.');
    }
}
