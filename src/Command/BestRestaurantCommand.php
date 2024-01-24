<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command;

use App\Repository\RestauranteRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * A console command that returns the best restaurant.
 *
 * To use this command, open a terminal window, enter into your project directory
 * and execute the following:
 *
 *     $ php bin/console app:count-restaurants
 *
 * Check out the code of the src/Command/AddUserCommand.php file for
 * the full explanation about Symfony commands.
 *
 * See https://symfony.com/doc/current/console.html
 */
#[AsCommand(
    name: 'app:best-restaurant',
    description: 'Returns the best restaurant',
    aliases: ['app:restaurants']
)]
final class BestRestaurantCommand extends Command
{
    public function __construct(
        private readonly RestauranteRepository $restaurants
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp(<<<'HELP'
                The <info>%command.name%</info> command returns the best ranked restaurant

                  <info>php %command.full_name%</info>

                HELP
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $allRestaurants = $this->restaurants->findBestRanked();

        $name = $allRestaurants[0]->getNombre();

        // Una vez finalizado el commando, se envia el nombre del restaurante mejor valorado.
        $output->writeln([
            'Restaurants',
            '============',
            'El restaurante mejor valorado. ',
            $name,
        ]);

        return Command::SUCCESS;
    }
}