<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class properties_neighborhoods extends Model
{
    use HasFactory;
    protected $table = 'properties_neighborhoods';
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'neighborhood_id',
        'number_rooms',
        'parking',

    ];

    //definir la relación con la tabla principal
    public function properties()
    {
        return $this->belongsTo(properties::class, 'property_id');
    }

    //definir la relación con la tabla principal
    public function neighborhoods()
    {
        return $this->belongsTo(neighborhoods::class, 'neighborhood_id');
    }
}
