<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    use HasFactory;

    protected $table = 'work_times';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id', 'user_name', 'work_start', 'work_end', 'total_time', 'total_break_time', 'work_time',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function breaks()
    {
        return $this->hasMany(Breaktime::class);
    }
}
