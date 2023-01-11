<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\Teacher\Teacher;
use App\Models\Classroom\Classroom;
use App\Models\Teacher\HomeroomClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExportClassAsPDF extends Controller
{
    public function Export($class_id = null)
    {
        if($class_id == null)
        {
            return back()->with('export-failed', 'Silahkan pilih salah satu kelas untuk di-export!');
        }
        
        $data = [
            'class' => Classroom::query()->find($class_id)->name,
            'schoolYear' => Auth::user()->role == 1 ? HomeroomClass::query()->where('NIP', Auth::user()->NIP)->where('homeroom_class_id', $class_id)->join('school_years', 'school_years.id', '=', 'teacher_homeroom_classes.school_year_id')->value('year') : HomeroomClass::query()->where('homeroom_class_id', $class_id)->join('school_years', 'school_years.id', '=', 'teacher_homeroom_classes.school_year_id')->value('year'),
            'homeroomTeacher' => Teacher::query()->where('NIP', HomeroomClass::query()->where('homeroom_class_id', $class_id)->value('NIP'))->value('name') 
        ];

        // DOWNLOAD USING CTRL + P
        // return view('export.class-detail-tabulation', $data);

        // OPEN PDF VIEWER
        return PDF::loadView('export.class-detail-tabulation', $data)->setPaper('A4', 'portrait')->stream();
    }
}
