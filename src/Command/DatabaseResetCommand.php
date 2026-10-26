<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'mahmathasan:database:reset',
    description: 'Supprime, recrée la base de données gesDeCaliban.',
)]
class DatabaseResetCommand extends Command
{
    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $application = $this->getApplication();

        if (!$application) {
            $io->error('Impossible de récupérer l\'application Symfony.');
            return Command::FAILURE;
        }

        try {
            $io->section('1. Suppression de la base de données existante...');
            $dropInput = new ArrayInput([
                'command' => 'doctrine:database:drop',
                '--if-exists' => true,
                '--force' => true,
            ]);
            $application->run($dropInput, $output);

            $io->section('2. Création de la nouvelle base de données...');
            $createInput = new ArrayInput([
                'command' => 'doctrine:database:create',
            ]);
            $application->run($createInput, $output);

            $io->success('La base de données a été réinitialisée et les tables ont été créées avec succès !');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Une erreur est survenue : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}