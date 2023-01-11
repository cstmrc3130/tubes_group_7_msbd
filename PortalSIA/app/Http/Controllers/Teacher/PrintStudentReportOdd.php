<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Teacher\Teacher;
use Illuminate\Support\Facades\Date;
use App\Models\Student\HomeroomClass;
use App\Models\Subject\SubjectScore;
use App\Http\Controllers\Controller;

class PrintStudentReportOdd extends Controller
{
    public function CalculateFinalScore($NISN, $subject)
    {
        $homeworkAverage = 0;
        $examAverage = 0;
        $midAndFinalAverage = 0;
        $finalScore = 0;
        $scoreCategory;

        foreach(SubjectScore::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->whereHas('subject', fn($query) => $query->where('name', $subject))->get() as $data)
        {
            if($data->scoringsession->type == "HW1" || $data->scoringsession->type == "HW2")
            {
                $homeworkAverage += ($data->score / 2);
            }
            elseif($data->scoringsession->type == "EX1" || $data->scoringsession->type == "EX2")
            {
                $examAverage += ($data->score / 2);
            }
            elseif($data->scoringsession->type == "MID" || $data->scoringsession->type == "FIN")
            {
                $midAndFinalAverage += ($data->score / 2);
            }
        }

        $finalScore = (((2 * $homeworkAverage) + (3 * $examAverage) + (5 * $midAndFinalAverage)) / 10);

        if ($finalScore >= 80 && $finalScore <= 100)
        {
            $scoreCategory = "A";
        }
        else if($finalScore >= 70 && $finalScore <= 79)
        {
            $scoreCategory = "B";
        }
        else if($finalScore >= 60 && $finalScore <= 69)
        {
            $scoreCategory = "C";
        }
        else
        {
            $scoreCategory = "D";
        }

        // SESSION FOR SCORE CATEGORY 
        session()->put($subject, $scoreCategory);

        return $finalScore;
    }

    public function View($NISN = null)
    {
        if($NISN == null)
        {
            return back()->with('report-not-found', 'Silahkan pilih salah satu siswa untuk dilihat rapornya!');
        }

        Date::setLocale('id');

        $teacher = Teacher::query()->where('NIP', \App\Models\Teacher\HomeroomClass::query()->where('homeroom_class_id', HomeroomClass::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->first()->classroom->id)->value('NIP'));

        $data = [
            'NISN' => $NISN,
            'semester' => "Ganjil",
            'studentName' => Student::query()->find($NISN)->name,
            'class' => HomeroomClass::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->first()->classroom->name,
            
            'homeroomTeacherName' => $teacher->value('name'),
            'homeroomTeacherNIP' => $teacher->value('NIP'),
            
            'currentMonth' => Date::now()->translatedFormat('F Y'),

            'quranHadistKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "QUR'AN HADITS")->value('completeness'),
            'aqidahAkhlakKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "AQIDAH AKHLAK")->value('completeness'),
            'fiqihKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "FIQIH")->value('completeness'),
            'SKIKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "SEJARAH KEBUDAYAAN ISLAM")->value('completeness'),
            'PKNKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "PKN")->value('completeness'),
            'bahasaIndonesiaKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "BAHASA INDONESIA")->value('completeness'),
            'bahasaArabKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "BAHASA ARAB")->value('completeness'),
            'bahasaInggrisKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "BAHASA INGGRIS")->value('completeness'),
            'matematikaKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "MATEMATIKA")->value('completeness'),
            'IPAKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "IPA")->value('completeness'),
            'IPSKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "IPS")->value('completeness'),
            'kesenianKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "KESENIAN")->value('completeness'),
            'seniBudayaKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "SENI BUDAYA")->value('completeness'),
            'PENJASKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "PENJAS")->value('completeness'),
            'BPKKM' => Subject::query()->where('school_year_id', session('currentSchoolYear'))->where('name', "BP")->value('completeness'),

            'quranHadistFinalScore' => $this->CalculateFinalScore($NISN, "QUR'AN HADITS"),
            'aqidahAkhlakFinalScore' => $this->CalculateFinalScore($NISN, "AQIDAH AKHLAK"),
        ];

        // DOWNLOAD USING CTRL + P
        return view('export.student-report-odd', $data);
    }
}
