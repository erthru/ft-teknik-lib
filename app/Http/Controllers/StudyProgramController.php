<?php

namespace App\Http\Controllers;
use App\StudyProgram;

use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function majorIdJSON(Request $request)
    {
        return StudyProgram::where("major_id", $request->query("id"))->get();
    }
}
