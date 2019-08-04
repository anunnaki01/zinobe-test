<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 1/08/19
 * Time: 09:48 PM
 */


namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\UseCases\Auth\LoginUseCase;


/**
 * Class LoginController
 * @package App\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * @var string
     */
    protected $redirectTo = '/admin/directory';

    protected $loginUseCase;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!empty($_SESSION['email'])) {
            header('location: /admin/directory');
        }

        $this->loginUseCase = new LoginUseCase(new EloquentUserRepository());
    }

    /**
     * Login
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            exit($this->view->make('auth.login')->render());
        }

        $response = $this->loginUseCase->handle($_POST);

        if (!$response['status']) {
            $_SESSION['error'] = $response['message'];
            return redirect('/login');
        }

        return redirect($this->redirectTo);
    }

    /**
     * logout
     */
    public function logout()
    {
        $this->loginUseCase->logout();
        return redirect('/');
    }
}