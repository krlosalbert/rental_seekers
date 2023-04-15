<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'number_rooms',
        'parking',
        'canon',
        'referencia',
        'comprobante',
        'terminos',
        'customer_id',
        'city_id',
        'neighborhood_id',
        'property_id',
        'advisor_id',
        'account_id',
        'service_id',


    ];
}
