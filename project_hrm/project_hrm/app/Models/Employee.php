<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $primaryKey = "id";
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'employee_id', 'employee_id');
    }
}
