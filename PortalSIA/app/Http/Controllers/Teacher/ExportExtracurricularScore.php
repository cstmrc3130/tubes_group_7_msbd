<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\ExtracurricularScoreExport;
use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use Maatwebsite\Excel\Facades\Excel;

class ExportExtracurricularScore extends Controller
{
    public function Export()
    {
        return Excel::download(new ExtracurricularScoreExport, 'DataNilai' . \App\Models\Teacher\TeachingExtracurricular::query()->where('NIP', auth()->user()->NIP)->where('school_year_id', session('currentSchoolYear'))->first()->extracurricular->name . '.xlsx');
    }
}

