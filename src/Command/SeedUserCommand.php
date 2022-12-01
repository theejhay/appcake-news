<?php

namespace App\Command;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'user:seed',
    description: 'This command seed users',
)]
class SeedUserCommand extends Command
{

    public function __construct(
        protected usersRepository $usersRepository,
        protected userPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
        $this->usersRepository = $usersRepository;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->seedAdmin();

        $this->seedModerator();

        $io->success('admin and moderator user data seeded successfully!');

        return Command::SUCCESS;
    }

    private function seedAdmin()
    {
        $user = new Users;

        $user->setEmail('admin@appake.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'test123'));

        $this->usersRepository->save($user, true);
    }

    private function seedModerator()
    {
        $user = new Users;

        $user->setEmail('moderator@appcake.com');
        $user->setRoles(['ROLE_MODERATOR']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'test123'));

var_dump($user);
        $this->usersRepository->save($user, true);
    }
}
