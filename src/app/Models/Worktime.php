<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'work_start', 'work_end', 'work_time', 'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }
}
