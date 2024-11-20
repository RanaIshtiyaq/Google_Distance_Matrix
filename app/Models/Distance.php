<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    protected $fillable = ['company_id', 'user_id', 'distance', 'travel_time'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
