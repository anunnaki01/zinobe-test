<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 09:32 PM
 */

namespace App\UseCases\Interfaces;

/**
 * Interface AdminDirectoryUseCaseInterface
 * @package App\UseCases\Interfaces
 */
interface AdminDirectoryUseCaseInterface
{
    /**
     * @param string $string
     * @return array
     */
    public function search(string $string): array;

    /**
     * @return array
     */
    public function getAll(): array;
}