<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 08:56 PM
 */

namespace App\UseCases\Interfaces;

/**
 * Interface LoginUseCaseInterface
 * @package App\UseCases\Interfaces
 */
interface LoginUseCaseInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function handle(array $data): array;

    /**
     * logout
     */
    public function logout(): void;

}