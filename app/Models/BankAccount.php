<?php

namespace App\Models;

use App\Http\Traits\RestrictUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Account;

class BankAccount extends Model
{
    use HasFactory;
    use RestrictUser;

    protected $guarded = [];

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

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function account()
    {
        return $this->hasMany(Account::class);
    }
}
