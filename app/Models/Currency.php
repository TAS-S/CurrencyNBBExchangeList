<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $fillable=['name','code'];

    public function users()
    {
        return $this->belongsToMany(User::class,'currencies_users', 'currency_id')->withTimestamps();
    }
}
