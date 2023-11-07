<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'bname',
        'bemail',
        'bphone',
        'website_url',
        'description',
        'baddress',
        'radius_address',
        'radius',
        'closer_name',
    ];
}
