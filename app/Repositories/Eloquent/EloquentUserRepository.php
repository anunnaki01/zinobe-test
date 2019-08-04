<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 07:17 PM
 */

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\Eloquent
 */
class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    protected $user;

    /**
     * EloquentUserRepository constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Obtener todos los usuarios
     *
     * @return array
     */
    public function all(): array
    {
        return $this->user->all()->toArray();
    }

    /**
     * Crear un usuario
     *
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->user->create($data);
    }

    /**
     * Buscar por correo
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): array
    {
        $user = $this->user->where('email', $email)->get()->first();

        if (empty($user)) {
            return [];
        }

        return $user->toArray();
    }

    /**
     * Buscar por nombre o correo
     *
     * @param string $search
     * @return array
     */
    public function findByNameOrEmail(string $search): array
    {
        return $this->user->where(
            'name', 'like', '%' . $search . '%'
        )->orWhere(
            'email', 'like', '%' . $search . '%'
        )->get()->toArray();
    }
}