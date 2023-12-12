<?php

namespace App\Command;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[AsCommand(
    name: 'app:admin',
    description: 'Add a short description for your command',
)]
class AdminCommand extends Command
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private AdminRepository $adminRepository
    ){
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'adresse email de l\'administrateur')
            ->addOption('create', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');


        /**
         * @var QuestionHelper $helper
         */
        $helper = $this->getHelper('question');

        $question = new Question('Entrer le mot de passe de l\'administrateur?: ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);


        $plainPassword = $helper->ask($input, $output, $question);

        $admin = new Admin();
        $admin->setNom('admin');
        $admin->setPrenom('admin');
        $admin->setTelephone('0000000000');
        $admin->setEmail($email);

        $hashedPassword = $this->passwordHasher->hashPassword($admin,
            $plainPassword
        );
        $admin->setPassword($hashedPassword);

        $this->adminRepository->save($admin,true);
        

        // if ($email) {
        //     $io->note(sprintf('You passed an argument: %s', $email));
        // }

        // if ($input->getOption('create')) {
        //     // ...
        // }
        

        $io->success('l\'admnistrateur a bien été créé');

        return Command::SUCCESS;
    }
}
