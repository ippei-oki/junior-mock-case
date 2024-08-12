<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AttendanceController;
use App\Models\User;

class WorkStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:work_start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call AttendanceController@work_start at 00:00 daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = Cache::get('current_user_id');
        $user = User::find($userId);
        Auth::login($user);
        $controller = new AttendanceController();
        $controller->work_start();
        
        $this->info('AttendanceController@work_start has been called.');
    }
}
