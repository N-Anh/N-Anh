<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;

    protected $table = 'contract_type';
    protected $primaryKey = 'contract_type_id';

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'contract_type_id', 'contract_type_id');
    }
}


