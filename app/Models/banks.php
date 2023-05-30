<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banks extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',

    ];

    //definir la relación con la tabla secundaria
    public function accounts()
    {
        return $this->hasOne(accounts::class, 'banks_id');
    }
}
