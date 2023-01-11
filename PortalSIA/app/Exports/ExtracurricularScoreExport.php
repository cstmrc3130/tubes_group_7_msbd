<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Student\TakingExtracurricular;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Extracurricular\ExtracurricularScore;

class ExtracurricularScoreExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $classDetails = [];
        $iteration = 1;

        foreach(TakingExtracurricular::query()->where('school_year_id', session('currentSchoolYear'))->where('extracurricular_id', \App\Models\Teacher\TeachingExtracurricular::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('extracurricular_id')->value('extracurricular_id'))->get() as $data)
        {
            array_push($classDetails, 
            [
                'No.' => $iteration, 
                'NISN' => $data->NISN,  
                'Nama' => $data->student->name,
                'Nilai' => ExtracurricularScore::query()->where('NISN', $data->NISN)->where('extracurricular_id', \App\Models\Teacher\TeachingExtracurricular::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('extracurricular_id')->value('extracurricular_id'))->value('score'),
            ]);

            $iteration++;
        }

        return collect($classDetails);
    }

    public function headings():array
    {
        return 
        [
            'No.',
            'NISN',
            'Nama',
            'Nilai',
        ];
    }
}
