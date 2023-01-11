<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\SubjectScoreExport;
use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use Maatwebsite\Excel\Facades\Excel;

class ExportSubjectScore extends Controller
{
    public function Export($class_id = null)
    {
        if($class_id == null)
        {
            return back()->with('export-failed', 'Silahkan pilih salah satu kelas untuk di-export!');
        }

        return Excel::download(new SubjectScoreExport($class_id), 'DataNilai' . Classroom::query()->find($class_id)->name . '.xlsx');
    }
}
