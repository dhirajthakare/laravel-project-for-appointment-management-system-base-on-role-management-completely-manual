<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookingDate',
        'noPerson',
        'advisorId',
        'clientId',

    ];

    public function Advisor()
    {
        return $this->belongsTo(User::class, 'advisorId','id');
    }
    public function Client()
    {
        return $this->belongsTo(User::class, 'clientId','id');
    }
}
