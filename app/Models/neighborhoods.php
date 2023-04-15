<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class neighborhoods extends Model
{
    use HasFactory;
    protected $table = 'neighborhoods';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city_id',

    ];

    //definir la relación con la tabla secundaria
    public function properties_neighborhoods()
    {
        return $this->hasMany(properties_neighborhoods::class, 'neighborhood_id');
    }
}
