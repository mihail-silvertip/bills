<?php
namespace App\Http\Traits;

trait RestrictUser {
    public static function scopeMine ($query) {
        return $query->where('user_id', auth()->id());
    }
}