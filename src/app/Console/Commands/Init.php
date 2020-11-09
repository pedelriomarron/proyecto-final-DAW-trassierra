<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializacion de datos';

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
        echo shell_exec('composer dump-autoload');
        echo shell_exec('php artisan migrate:fresh --seed');
        echo shell_exec('php artisan migrate:fresh');
        echo shell_exec('php artisan db:seed --class=PermissionTableSeeder');
        echo shell_exec('php artisan db:seed --class=CreateAdminUserSeeder');
        echo shell_exec('php artisan db:seed --class=DrivesSeeder');
        echo shell_exec('php artisan db:seed --class=BodystylesSeeder');
        echo shell_exec('php artisan translator:update');
        echo "Fin";
    }
}
