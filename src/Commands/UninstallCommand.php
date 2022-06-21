<?php

namespace Novay\Nue\Commands;

use Illuminate\Console\Command;

class UninstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'nue:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the Nue package.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure to uninstall Nue?')) {
            return;
        }

        $this->removeFilesAndDirectories();

        $this->comment('Remove Nue directory "app/Nue/*" ...');
        $this->comment('Remove Nue views "resources/views/vendor/nue/*" ...');
        $this->comment('Remove Nue config file "config/nue.php" ...');

        $this->line('<info>Uninstalling Nue done!</info>');
    }

    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(config('nue.directory'));
        $this->laravel['files']->deleteDirectory(public_path('vendor/nue/'));
        $this->laravel['files']->delete(config_path('nue.php'));
    }
}