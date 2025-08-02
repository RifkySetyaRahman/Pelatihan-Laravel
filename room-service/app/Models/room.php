<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $table = 'room';

    protected $fillable = [
        'name',
        'capacity',
        'facilities',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }
}
