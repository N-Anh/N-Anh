<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'employee_id',
        'contract_type_id',
        'signing_date',
        'date_start',
        'date_end',
        'contract_duration',
        'employment_type_id',
        'status',
        'gross_salary',
        'insurance_salary',
        'file_path',
        'note',
    ];

    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id', 'contract_type_id');
    }
    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id', 'employment_type_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
