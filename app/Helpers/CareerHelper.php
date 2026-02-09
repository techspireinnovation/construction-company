<?php

namespace App\Helpers;

class CareerHelper
{
    /*
    |--------------------------------------------------------------------------
    | Employment Type
    |--------------------------------------------------------------------------
    | 1 = Full Time
    | 2 = Part Time
    | 3 = Contract
    | 4 = Internship
    | 5 = Freelance
    */

    public static function employmentType($type)
    {
        $types = [
            0 => 'Full Time',
            1 => 'Part Time',
        ];

        return $types[$type] ?? 'Not Specified';
    }


    /*
   |--------------------------------------------------------------------------
   | Education Level
   |--------------------------------------------------------------------------
   | 0 = No formal education
   | 1 = Basic (Up to Grade 8)
   | 2 = SEE / SLC
   | 3 = +2 / Intermediate
   | 4 = Diploma
   | 5 = Graduate (Bachelor)
   | 6 = Postgraduate (Master)
   | 7 = PhD
   */

    public static function educationLevel($level)
    {
        $levels = [
            0 => 'No Formal Education',
            1 => 'Basic (Up to Grade 8)',
            2 => 'SEE / SLC',
            3 => '+2 / Intermediate',
            4 => 'Diploma',
            5 => 'Graduate (Bachelor)',
            6 => 'Postgraduate (Master)',
            7 => 'PhD',
        ];

        return $levels[$level] ?? 'Not Specified';
    }
}
