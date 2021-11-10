<?php

namespace App\api\Repository;

use App\api\Entity\User;
use App\api\Repository\ManagerRepository;

class UserRepository extends ManagerRepository
{

    public function buildObject($row)
    {
        $user = new User();
        $user
            ->setUser_id($row->user_id)
            ->setEmail($row->email)
            ->setUsername($row->username)
            ->setPassword($row->password)
            ->setRole($row->role)
            ->setCreated_at($row->created_at)
            ->setUpdated_at($row->updated_at);
        return $user;
    }

    public function addUser($user)
    {
        extract($user);
        $sql = 'INSERT INTO user (email, username, password, role, created_at, updated_at) VALUES (?, ?, ?, "registered", NOW(),NOW())';
        $this->createQuery($sql, [$email, $username, $password]);
    }
}