<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CustomerLead extends Model
{
    protected $table = 'customer_leads';

    protected $fillable = [
        'full_name',
        'birth_date',
        'gender',
        'phone',
        'email',
        'province',
        'education_level',
        'major',
        'graduation_year',
        'learned_german',
        'german_level',
        'ready_to_learn_german',
        'program_interest',
        'desired_job',
        'planned_departure_time',
        'financial_capacity',
        'work_experience',
        'current_job',
        'registrant_type',
        'parent_phone',
        'marketing_source',
        'consultation_content',
    ];
}
