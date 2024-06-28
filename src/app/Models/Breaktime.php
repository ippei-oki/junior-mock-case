<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaktime extends Model
{
    use HasFactory;

    protected $fillable = [
        'break_start', 'break_end', 'work_time_id',
    ];

    public function worktime()
    {
        return $this->belongsTo(Worktime::class);
    }
}
