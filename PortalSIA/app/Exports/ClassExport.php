<?php

namespace App\Exports;

use App\Models\Student\Student;
use App\Models\Classroom\Classroom;
use App\Models\Student\HomeroomClass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassExport implements FromCollection, WithHeadings
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

        foreach(HomeroomClass::query()->where('school_year_id', session('currentSchoolYear'))->where('homeroom_class_id', $this->class_id)->join('students', 'student_homeroom_classes.NISN', '=', 'students.NISN')->orderBy('students.name', 'ASC')->get() as $data)
        {
            array_push($classDetails, ['No.' => $iteration, 'NISN' => $data->NISN,  'name' => Student::query()->where('NISN', $data->NISN)->value('name')]);

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
        ];
    }
}
