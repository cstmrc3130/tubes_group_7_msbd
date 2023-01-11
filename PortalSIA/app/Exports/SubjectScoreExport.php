<?php

namespace App\Exports;

use App\Models\Classroom\Classroom;
use App\Models\Student\HomeroomClass;
use App\Models\Subject\SubjectScore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubjectScoreExport implements FromCollection, WithHeadings
{
    protected $class_id;

    public function __construct($class_id)
    {
        $this->class_id = $class_id;
    }

    public function collection()
    {
        $classDetails = [];
        $iteration = 1;

        foreach(HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $this->class_id)->get() as $data)
        {
            array_push($classDetails, 
            [
                'No.' => $iteration, 
                'NISN' => $data->NISN,  
                'Nama' => $data->student->name,
                'TUGAS 1' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW1')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
                'UJIAN 1' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX1')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
                'MID' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'MID')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
                'TUGAS 2' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'HW2')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
                'UJIAN 2' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'EX2')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
                'FIN' => SubjectScore::query()->join('scoring_sessions', 'scoring_sessions.id', '=', 'subject_scores.scoring_session_id')->where('scoring_sessions.type', 'FIN')->where('NISN', $data->NISN)->where('subject_scores.school_year_id', session('tempSchoolYear'))->where('subject_id', \App\Models\Teacher\TeachingSubject::query()->where('school_year_id', session('currentSchoolYear'))->where('NIP', auth()->user()->NIP)->groupBy('subject_id')->value('subject_id'))->value('score'),
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
            'TUGAS 1',
            'UJIAN 1',
            'MID',
            'TUGAS 2',
            'UJIAN 2',
            'FIN',
        ];
    }
}
