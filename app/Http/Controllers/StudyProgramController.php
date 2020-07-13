<?php

namespace App\Http\Controllers;
use App\StudyProgram;

use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function studyProgram(Request $request)
    {

    }

    public function studyProgramAdd(Request $request)
    {

    }

    public function studyProgramAddAction(Request $request)
    {

    }

    public function studyProgramDetail(Request $request)
    {

    }

    public function studyProgramUpdateAction(Request $request)
    {

    }

    public function studyProgramDeleteAction(Request $request)
    {
        
    }

    public function dataStudyProgramByMajorIdJSON(Request $request)
    {
        return StudyProgram::where("major_id", $request->query("id"))->get();
    }
}
