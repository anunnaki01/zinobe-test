<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 1/08/19
 * Time: 09:47 PM
 */

namespace App\Controllers\Auth;


use App\Controllers\Controller;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Services\CountryService;
use App\UseCases\Auth\RegisterUserUseCase;


/**
 * Class RegisterController
 * @package App\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * @var RegisterUserUseCase
     */
    protected $registerUserUseCase;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->registerUserUseCase = new RegisterUserUseCase(new EloquentUserRepository());
    }

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $countries = (new CountryService())->get();

            exit($this->view->make('auth.register', ['countries' => $countries])->render());
        }

        $validation = $this->validator->validate($_POST, $this->rules());

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->all();
            return redirect('/register');
        }

        $response = $this->registerUserUseCase->handle($_POST);

        if (!$response['status']) {
            $_SESSION['errors'] = [$response['message']];
            return redirect('/register');
        }

        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];

        return redirect('/admin/directory');
    }

    /**
     * @return array
     */
    private function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required|max:2',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }
}