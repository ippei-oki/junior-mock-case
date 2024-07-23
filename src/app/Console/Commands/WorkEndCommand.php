<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;

class WorkEndCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:work_end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call AttendanceController@work_end at 23:59 daily';

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
        $controller = new AttendanceController();
        $request = new Request();
        $controller->work_end($request);
        
        $this->info('AttendanceController@work_end has been called.');
    }
}
