<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\Teacher\Teacher;
use App\Models\Classroom\Classroom;
use App\Models\Teacher\HomeroomClass;

class ExportClassAsPDF extends Controller
{
    public function Export($class_id = null)
    {
        if($class_id == null)
        {
            return back()->with('export-failed', 'Silahkan pilih salah satu kelas untuk di-export!');
        }
        
        $data = [
            'semester' => session('currentSemester'),
            'class' => Classroom::query()->find($class_id)->name,
            'schoolYear' => SchoolYear::query()->find(session('currentSchoolYear'))->year,
            'homeroomTeacher' => Teacher::query()->where('NIP', HomeroomClass::query()->where('homeroom_class_id', $class_id)->value('NIP'))->value('name') 
        ];

        // DOWNLOAD USING CTRL + P
        // return view('export.class-detail-tabulation', $data);

        // OPEN PDF VIEWER
        return PDF::loadView('export.class-detail-tabulation', $data)->setPaper('A4', 'portrait')->stream();
    }
}
