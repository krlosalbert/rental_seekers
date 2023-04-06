<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supervisors extends Model
{
    use HasFactory;
    protected $table = 'supervisors';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'porcentage_id',
    ];


}
