<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bienes extends Model
{
    protected $table='bienes';

    protected $fillable=[
        'Dirección',
        'Ciudad',
        'Telefono',
        'Codigo_Postal',
        'Tipo',
        'Precio',
        'Origin'
    ];
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'SedeSlug';
	}
}
