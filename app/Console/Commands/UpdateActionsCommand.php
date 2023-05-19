<?php

namespace App\Console\Commands;

use App\BO\ActionBO;
use Illuminate\Console\Command;

class UpdateActionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-actions {numberDays=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza as ações do dia.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $numberOfDays = $this->argument('numberDays');

        (new ActionBO)->updateActions($numberOfDays);

        return Command::SUCCESS;
    }
}
