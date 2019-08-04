<?php
/**
 * Created by PhpStorm.
 *
 * User: juan
 * Date: 2/08/19
 * Time: 10:11 PM
 */


namespace Tests\Features\UseCases\Auth;

use App\Models\User;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Auth\LoginUseCase;
use Tests\TestCase;


/**
 * Class ExampleTest
 * @package Test\Features
 */
class LoginUseCaseTest extends TestCase
{

    /**
     * @var
     */
    protected $userRepositoryMock;

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
     * Prueba le respuesta cuando el usuario no existe en el sistema
     */
    public function testLoginUserNotExist()
    {
        $this->userRepositoryMock->shouldReceive('findByEmail')->andReturn([]);
        $data = [
            'email' => 'no@existe.com',
            'password' => 'noexiste'
        ];

        $LoginUseCase = new LoginUseCase($this->userRepositoryMock);

        $this->assertEquals(['status' => false, 'message' => 'El usuario no existe'], $LoginUseCase->handle($data));
    }

    /**
     * Prueba la validacion de usuario y password incorrectos
     */
    public function testLoginUserIncorrect()
    {

        $this->userRepositoryMock->shouldReceive('findByEmail')->andReturn(['password' => 'incorrecta']);

        $data = [
            'email' => 'incorrecto@incorrecto.com',
            'password' => 'incorrecta'
        ];

        $LoginUseCase = new LoginUseCase($this->userRepositoryMock);

        $this->assertEquals(['status' => false, 'message' => 'Usuario o contraseña incorrectos.'],
            $LoginUseCase->handle($data));
    }


    /**
     * Prueba el inicio de session satisfactorio
     */
    public function testLoginUserSuccess()
    {
        $user = User::create([
            'name' => 'TestUnit',
            'email' => 'testunit@test.com',
            'password' => password_hash('unittest123456', PASSWORD_DEFAULT),
            'country' => 'CO',
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'unittest123456'
        ];

        $LoginUseCase = new LoginUseCase(new EloquentUserRepository());

        $this->assertEquals(['status' => true, 'message' => ''],
            $LoginUseCase->handle($data));

        $this->assertEquals($_SESSION, ['name' => $user->name, 'email' => $user->email]);
    }

    /**
     * Prueba el cierre de session
     *
     * @depends testLoginUserSuccess
     */
    public function testLogout()
    {
        $LoginUseCase = new LoginUseCase($this->userRepositoryMock);
        $LoginUseCase->logout();
        $this->assertEquals($_SESSION, []);
    }
}