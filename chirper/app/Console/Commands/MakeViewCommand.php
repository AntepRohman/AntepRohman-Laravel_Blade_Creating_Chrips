<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewCommand extends Command
{
    protected $signature = 'make:view {name : The name of the view}';
    protected $description = 'Create a new Blade view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = resource_path('views/' . str_replace('.', '/', $name) . '.blade.php');

        if (File::exists($path)) {
            $this->error("View {$name} already exists!");
            return;
        }

        File::makeDirectory(dirname($path), 0755, true, true);
        File::put($path, "<!-- View: {$name} -->");

        $this->info("View {$name} created successfully.");
    }
}
