<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ClassExport;
use App\Models\Classroom\Classroom;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportClassAsExcel extends Controller
{
    public function Export($class_id = null)
    {
        if($class_id == null)
        {
            return back()->with('export-failed', 'Silahkan pilih salah satu kelas untuk di-export!');
        }

        return Excel::download(new ClassExport($class_id), 'DataKelas' . Classroom::query()->find($class_id)->name . '.xlsx');
    }
}
