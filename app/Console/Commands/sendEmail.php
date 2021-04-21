<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\sendEmailToUser;

class sendEmail extends Command
{

    protected $signature = 'send:email';

    protected $description = 'send emails to all users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::get()->each(function($user){
            $user->notify(new sendEmailToUser($user));
        });
    }
}
