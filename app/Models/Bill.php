<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'due_date', 'category', 'description', 'amount', 'observation', 'payment_method', 'periodic_bill_id', 'confirmed_date', 'paid_date'];

    protected $casts = [
        'confirmed_date' => 'date:d-m-Y',
        'paid_date' => 'date:d-m-Y',
        'due_date' => 'date:d-m-Y',
    ];

    protected $dates = ['confirmed_date', 'paid_date', 'due_date'];

    // set user_id default to current user
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setConfirmedDateAttribute($date)
    {
        $this->attributes['confirmed_date'] = empty($date) ? null : Carbon::parse($date);
    }

    public function setPaidDateAttribute($date)
    {
        $this->attributes['paid_date'] = empty($date) ? null : Carbon::parse($date);
    }

    public function setDueDateAttribute($date)
    {
        $this->attributes['due_date'] = empty($date) ? null : Carbon::parse($date);
    }

}
