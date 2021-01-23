<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class deleteNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteNotification:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes notification older than 90 days';

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
     * @return mixed
     */
    public function handle()
    {
        $notice_notifications = DB::table('notifications')
            ->where('read_at', '!=', null)
            ->where('created_at', '<', Carbon::now()->subDays(90))
            ->delete();
    }
}
