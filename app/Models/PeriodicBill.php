<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodicBill extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $dates = ['end_date'];

    protected $casts = [
        'end_date' => 'date:Y-m-d',
    ];


    // set user_id default to current user
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = empty($date) ? null : Carbon::parse($date);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
