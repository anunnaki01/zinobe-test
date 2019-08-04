<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 08:55 PM
 */

namespace App\UseCases\Auth;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Interfaces\LoginUseCaseInterface;
use App\UseCases\UseCase;

/**
 * Class LoginUseCase
 * @package App\UseCases\Auth
 */
class LoginUseCase extends UseCase implements LoginUseCaseInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function handle(array $data): array
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (empty($user)) {
            return $this->response(false, "El usuario no existe");
        }

        if (!password_verify($data['password'], $user['password'])) {
            return $this->response(false, "Usuario o contraseña incorrectos.");
        }

        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        return $this->response(true);
    }

    /**
     * logout
     */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}