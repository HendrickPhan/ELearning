<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Entities\User;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

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
        //
        $userInfo = array();

        $userInfo['name'] = $this->ask('What is your name?');
        $userInfo['email'] = $this->ask('What is your email?');
        $userInfo['password'] = Hash::make($this->secret('What is the password?'));
        $userInfo['role'] = UserRolesStatic::ADMIN;
        $userInfo['status'] = UserStatusStatic::ACTIVE;

        $user = User::create($userInfo);

        $this->info('Create user success');
    }
}
