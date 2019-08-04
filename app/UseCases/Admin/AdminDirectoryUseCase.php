<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 09:31 PM
 */

namespace App\UseCases\Admin;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Interfaces\AdminDirectoryUseCaseInterface;
use App\UseCases\UseCase;

/**
 * Class AdminDirectoryUseCase
 * @package App\UseCases\Admin
 */
class AdminDirectoryUseCase extends UseCase implements AdminDirectoryUseCaseInterface
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AdminDirectoryUseCase constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $string
     * @return array
     */
    public function search(string $string): array
    {
        return $this->userRepository->findByNameOrEmail($string);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->userRepository->all();
    }
}