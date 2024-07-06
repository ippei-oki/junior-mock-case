<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaktime extends Model
{
    use HasFactory;

    protected $table = 'break_times';

    protected $fillable = [
        'work_time_id', 'break_start', 'break_end', 'break_time',
    ];

    public function worktime()
    {
        $this->belongsTo(Worktime::class);
    }
}
