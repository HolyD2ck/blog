<?php

namespace App\Exports;

use App\Models\Applicants;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicantsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Applicants::select(\DB::raw('id, Фамилия, Имя, Отчество, Образование, Специальность, Дата_Рождения, Телефон, Email'))->get();
        
    }
}

