<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Console\Command;
use App\Events\HappyBirhdateEvent;
use Illuminate\Support\Facades\Log;

class DeleteRelation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:relation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete to relation of users and groups';

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
        // $usersGroups = UserGroup::get();
        // foreach($usersGroups as $item)
        // {
        //     $item->delete();
        //     Log::info('deleted');
        // }

        $users = User::get();
        $date = new \DateTime();
        foreach($users as $user):
            if($user->created_at->format('Y-m-d') == $date->format('Y-m-d')):
                event(new HappyBirhdateEvent($user));
            endif;
        endforeach;

    }
}
