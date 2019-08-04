<?php

namespace App\Repositories\Interfaces;


use App\Models\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): array;

    /**
     * @param string $search
     * @return array
     */
    public function findByNameOrEmail(string $search): array;

}