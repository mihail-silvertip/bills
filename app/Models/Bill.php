<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'due_date', 'category', 'description', 'amount', 'observation', 'payment_method', 'periodic_bill_id', 'confirmed_date', 'paid_date'];

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

}
