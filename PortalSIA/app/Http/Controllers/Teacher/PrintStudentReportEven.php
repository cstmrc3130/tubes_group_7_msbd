<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Teacher\Teacher;
use Illuminate\Support\Facades\Date;
use App\Models\Student\HomeroomClass;
use App\Models\Subject\SubjectScore;
use App\Http\Controllers\Controller;
use App\Models\AbsentRecapitulation;
use App\Models\Extracurricular\ExtracurricularScore;
use App\Models\Student\TakingExtracurricular;
use Illuminate\Support\Facades\DB;

class PrintStudentReportEven extends Controller
{
    public function CalculateFinalScore($NISN, $subject)
    {
        $homeworkAverage = 0;
        $examAverage = 0;
        $midAndFinalAverage = 0;
        $finalScore = 0;
        $scoreCategory;

        foreach(SubjectScore::query()->where('NISN', $NISN)->where('school_year_id', session('tempSchoolYear'))->whereHas('subject', fn($query) => $query->where('name', $subject))->get() as $data)
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

        $finalScore = intval(((2 * $homeworkAverage) + (3 * $examAverage) + (5 * $midAndFinalAverage)) / 10);

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

            if($finalScore == 0)
            {
                session()->put('zero-score', true);
            }
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
        $extracurricular = TakingExtracurricular::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->first()->extracurricullar->name ?? "";
        $extracurricularScore = ExtracurricularScore::query()->where('NISN', $NISN)->where('extracurricular_id', TakingExtracurricular::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->first()->extracurricular_id ?? "")->first()->score ?? "";

        if ($extracurricularScore >= 80 && $extracurricularScore <= 100)
        {
            session()->put($extracurricular, "A");
        }
        else if($extracurricularScore >= 70 && $extracurricularScore <= 79)
        {
            session()->put($extracurricular, "B");
        }
        else if($extracurricularScore >= 60 && $extracurricularScore <= 69)
        {
            session()->put($extracurricular, "C");
        }
        else
        {
            session()->put($extracurricular, "D");
        }

        $data = [
            'studentName' => Student::query()->find($NISN)->name,
            'semester' => "Genap",
            'NISN' => $NISN,
            'class' => HomeroomClass::query()->where('NISN', $NISN)->where('school_year_id', session('currentSchoolYear'))->first(),
            
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
            'fiqihFinalScore' => $this->CalculateFinalScore($NISN, "FIQIH"),
            'SKIFinalScore' => $this->CalculateFinalScore($NISN, "SEJARAH KEBUDAYAAN ISLAM"),
            'PKNFinalScore' => $this->CalculateFinalScore($NISN, "PKN"),
            'bahasaIndonesiaFinalScore' => $this->CalculateFinalScore($NISN, "BAHASA INDONESIA"),
            'bahasaArabFinalScore' => $this->CalculateFinalScore($NISN, "BAHASA ARAB"),
            'bahasaInggrisFinalScore' => $this->CalculateFinalScore($NISN, "BAHASA INGGRIS"),
            'matematikaFinalScore' => $this->CalculateFinalScore($NISN, "MATEMATIKA"),
            'IPAFinalScore' => $this->CalculateFinalScore($NISN, "IPA"),
            'IPSFinalScore' => $this->CalculateFinalScore($NISN, "IPS"),
            'kesenianFinalScore' => $this->CalculateFinalScore($NISN, "KESENIAN"),
            'seniBudayaFinalScore' => $this->CalculateFinalScore($NISN, "SENI BUDAYA"),
            'PENJASFinalScore' => $this->CalculateFinalScore($NISN, "PENJAS"),
            'BPFinalScore' => $this->CalculateFinalScore($NISN, "BP"),

            'extracurricular' => $extracurricular,
            'extracurricularScore' => $extracurricularScore,

            'totalSickDays' => AbsentRecapitulation::query()->where('NISN', auth()->user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'S')->count(),
            'totalPermittedDays' => AbsentRecapitulation::query()->where('NISN', auth()->user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'I')->count(),
            'totalAlphaDays' => AbsentRecapitulation::query()->where('NISN', auth()->user()->NISN)->where('school_year_id', session('tempSchoolYear'))->where('type', 'A')->count(),

            'classRank' => DB::table('subject_scores')->select("nisn", "subject_id")->addSelect(DB::raw("sum(score) / 6 as `total_score`, rank() over ( order by total_score desc) `rank`"))->groupBy("nisn")->get(),
        ];

        // DOWNLOAD USING CTRL + P
        return view('export.student-report-even', $data);
    }
}
