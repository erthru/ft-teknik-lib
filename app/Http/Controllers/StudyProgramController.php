<?php

namespace App\Http\Controllers;
use App\StudyProgram;
use App\Major;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function studyProgram(Request $request)
    {
        return view("admin.study_program");
    }

    public function studyProgramAdd(Request $request)
    {
        $majors = Major::orderBy("name", "ASC")->get();
        $data = [
            "majors" => $majors
        ];

        return view("admin.study_program_add", $data);
    }

    public function studyProgramAddAction(Request $request)
    {
        Validator::make($request->all(), [
            'major_id' => 'required',
            'name' => 'required',
        ])->validate();

        $body = [
            "name" => $request->input("name"),
            "major_id" => $request->input("major_id")
        ];

        StudyProgram::create($body);

        return redirect("/admin/study_program")->with("success", "Prodi ditambahkan.");
    }

    public function studyProgramDetail(Request $request)
    {
        $majors = Major::orderBy("name", "ASC")->get();
        $studyProgram = StudyProgram::find($request->query("id"));

        $data = [
            "majors" => $majors,
            "study_program" => $studyProgram
        ]; 

        return view("admin.study_program_detail", $data);
    }

    public function studyProgramUpdateAction(Request $request)
    {
        Validator::make($request->all(), [
            'major_id' => 'required',
            'name' => 'required',
        ])->validate();

        $studyProgram = StudyProgram::findOrFail($request->query("id"));

        $body = [
            "name" => $request->input("name"),
            "major_id" => $request->input("major_id")
        ];

        $studyProgram->update($body);

        return redirect("/admin/study_program")->with("success", "Prodi diperbarui.");
    }

    public function studyProgramDeleteAction(Request $request)
    {
        $studyProgram = StudyProgram::findOrFail($request->query("id"));
        $studyProgram->delete();

        return redirect("/admin/study_program")->with("success", "Prodi dihapus.");
    }

    public function dataStudyProgramByMajorIdJSON(Request $request)
    {
        return StudyProgram::where("major_id", $request->query("id"))->get();
    }

    public function dataTableStudyProgramJSON(Request $request)
    {
        return DataTables::of(StudyProgram::with("major")->get())->make();
    }
}
