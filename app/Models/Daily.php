<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    protected $table='table_daily_categories';
    protected $primaryKey='id';
    protected $fillable=['employee_id','activity','progress','created_by','created_at','updated_at'];
}

