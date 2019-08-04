<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 09:05 PM
 */

namespace App\UseCases;

/**
 * Class UseCase
 * @package App\UseCases
 */
class UseCase
{
    /**
     * formato de respuesta de los casos de usos a los controladores
     *
     * @param bool $status
     * @param string $message
     * @return array
     */
    public function response(bool $status, string $message = ''): array
    {
        return ['status' => $status, 'message' => $message];
    }
}