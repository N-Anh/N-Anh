<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    use HasFactory;
    protected $table = "employment_type";
    protected $primaryKey = "employment_id";
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'employment_type_id', 'employment_type_id');
    }
}
