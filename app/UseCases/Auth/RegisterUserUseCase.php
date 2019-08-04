<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 07:20 PM
 */

namespace App\UseCases\Auth;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Interfaces\RegisterUserUseCaseInterface;
use App\UseCases\UseCase;

/**
 * Class RegisterUserUseCase
 * @package App\UseCases
 */
class RegisterUserUseCase extends UseCase implements RegisterUserUseCaseInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var
     */
    protected $externalCountryRepository;

    /**
     * RegisterUserUseCase constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return array
     * @throws \ErrorException
     */
    public function handle(array $data): array
    {
        $findUser = $this->userRepository->findByEmail($data['email']);

        if (!empty($findUser)) {
            return $this->response(false, 'El usuario ya existe.');
        }

        try {
            $this->userRepository->store([
                'name' => $data['name'],
                'email' => $data['email'],
                'country' => $data['country'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }

        return $this->response(true, 'Registro satisfactorio.');
    }
}