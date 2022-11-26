<?php

namespace App;

class User
{
    private array $users;
    private UserRepo $usersRepo;

    public function __construct(UserRepo $usersRepo)
    {
        $this->usersRepo = $usersRepo;
    }

    public function setUsers()
    {
        $this->users = $this->usersRepo->fetchUsers();
    }

    public function getUsers()
    {
        return $this->users;
    }
}