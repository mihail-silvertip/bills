<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\RestrictUser;

class Balance extends Model
{
    use HasFactory;
    use RestrictUser;

    protected $fillable = ['user_id', 'date', 'amount'];

    // protected $casts = [
    //     'date' => 'date:d-m-Y',
    // ];

    // protected $dates = ['date'];

    // set user_id default to current user
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
