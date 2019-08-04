<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 07:22 PM
 */

namespace App\UseCases\Interfaces;

/**
 * Interface RegisterUserUseCaseInterface
 * @package App\UseCases\Interfaces
 */
interface RegisterUserUseCaseInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function handle(array $data): array;
}