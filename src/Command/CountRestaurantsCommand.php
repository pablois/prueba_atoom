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
 * A console command that count all Restaurants.
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
    name: 'app:count-restaurants',
    description: 'Lists all the existing restaurants',
    aliases: ['app:restaurants']
)]
final class CountRestaurantsCommand extends Command
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
                The <info>%command.name%</info> command lists all the restaurnats registered in the application:

                  <info>php %command.full_name%</info>

                HELP
            )
        ;
    }

    /**
     * This method is executed after initialize(). It usually contains the logic
     * to execute to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        // Use ->findBy() instead of ->findAll() to allow result sorting and limiting
        $allRestaurants = $this->restaurants->findAll();

        $total = count($allRestaurants);

        // Una vez finalizado el commando, se envia un correo electronico con el numero de restaurantes.

        $output->writeln([
            'Restaurants',
            '============',
            'El numero de restaurantes es: . ',
            $total,
        ]);

        return Command::SUCCESS;
    }
}