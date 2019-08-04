<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 3/08/19
 * Time: 12:53 PM
 */

namespace Tests\Features\UseCases\Admin;


use App\Models\User;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCases\Admin\AdminDirectoryUseCase;
use Tests\TestCase;

/**
 * Class AdminDirectoryUseCaseTest
 * @package Tests\Features\UseCases\Admin
 */
class AdminDirectoryUseCaseTest extends TestCase
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepositoryMock;

    /**
     * @var User
     */
    protected $usersFaker;


    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);


        User::query()->delete(); //Eliminar todos los registro, aunque el setUp del padre hace rollback

        $this->usersFaker = User::insert([
            [
                'name' => 'Primer registro',
                'email' => 'primer@registro.com',
                'password' => password_hash('primerregistro123', PASSWORD_DEFAULT),
                'country' => 'CO',
            ],
            [
                'name' => 'Segundo registro',
                'email' => 'segundo@registro.com',
                'password' => password_hash('segundo registro', PASSWORD_DEFAULT),
                'country' => 'CO',
            ]
        ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function provider()
    {
        return [
            [
                'primer',
                'primer@registro.com'
            ],
            [
                'segundo',
                'segundo@registro.com'
            ]
        ];
    }

    /**
     * Prueba que el buscador encuentre registros
     *
     * @param string $search
     * @param string $expected
     *
     * @dataProvider provider
     */
    public function testSearch(string $search, string $expected)
    {
        $adminDirectoryUseCase = new AdminDirectoryUseCase(new EloquentUserRepository());
        $response = $adminDirectoryUseCase->search($search);

        $this->assertCount(1, $response);
        $this->assertEquals($expected, $response[0]['email']);
    }

    /**
     * Prueba que cuando no encuentre ninguna coincidencia retorne un arreglo vacío
     */
    public function testSearchEmpty()
    {
        $adminDirectoryUseCase = new AdminDirectoryUseCase(new EloquentUserRepository());
        $response = $adminDirectoryUseCase->search('Foo');
        $this->assertIsArray($response);
        $this->assertEmpty($response);

    }

    /**
     * Prueba que obtenga todos los registros
     */
    public function testGetAll()
    {
        $adminDirectoryUseCase = new AdminDirectoryUseCase(new EloquentUserRepository());
        $response = $adminDirectoryUseCase->getAll();

        $this->assertCount(2, $response);
    }

}