<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 3/08/19
 * Time: 12:04 PM
 */

namespace Tests\Features\UseCases\Auth;


use App\Models\User;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Auth\RegisterUserUseCase;
use http\Exception;
use Tests\TestCase;

/**
 * Class RegisterUserUseCaseTest
 * @package Tests\Features\UseCases\Auth
 */
class RegisterUserUseCaseTest extends TestCase
{
    /**
     * @var
     */
    protected $userRepositoryMock;

    protected $userFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Prueba quu si el usuario ya existe no lo deje registrar
     */
    public function testUserExist()
    {
        $userFaker = User::create([
            'name' => 'TestUnit',
            'email' => 'testunit@test.com',
            'password' => password_hash('unittest123456', PASSWORD_DEFAULT),
            'country' => 'CO',
        ]);

        $registerUserUseCase = new RegisterUserUseCase(new EloquentUserRepository());
        $response = $registerUserUseCase->handle(['email' => $userFaker->email]);

        $this->assertEquals(['status' => false, 'message' => 'El usuario ya existe.'], $response);
    }

    /**
     * Prueba que el registro del usuario sea satisfactorio
     */
    public function testUserRegisterSuccess()
    {
        $registerUserUseCase = new RegisterUserUseCase(new EloquentUserRepository());

        $response = $registerUserUseCase->handle([
            'name' => 'TestUnit',
            'email' => 'testunit@test.com',
            'password' => 'unittest123456',
            'country' => 'CO',
        ]);

        $this->assertEquals(['status' => true, 'message' => 'Registro satisfactorio.'], $response);
    }

    /**
     * Prueba que se capture la excepcion y se muestre el error capturado
     *
     * @throws \ErrorException
     */
    public function testUserRegisterException()
    {

        $registerUserUseCase = new RegisterUserUseCase(new EloquentUserRepository());

        $this->expectException(\ErrorException::class);
        $registerUserUseCase->handle([
            'name' => 'TestUnit',
            'email' => 'testunit@test.com',
            'password' => 'unittest123456',
            'country' => 'COLO',
        ]);
    }


}