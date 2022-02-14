<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'citizenship_country_id', 'first_name', 'last_name', 'phone_number'
    ];

    public function user()
    {
        $this->belongsTo(User::class,'user_id');
    }

}
