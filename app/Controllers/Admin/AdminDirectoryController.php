<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 2/08/19
 * Time: 12:05 AM
 */

namespace App\Controllers\Admin;


use App\Controllers\Controller;
use App\Models\User;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\UseCases\Admin\AdminDirectoryUseCase;
use App\UseCases\Interfaces\AdminDirectoryUseCaseInterface;


/**
 * Class UserController
 * @package App\Controllers\User
 */
class AdminDirectoryController extends Controller
{
    /**
     * @var AdminDirectoryUseCaseInterface
     */
    protected $adminDirectoryUseCase;

    /**
     * AdminDirectoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->adminDirectoryUseCase = new AdminDirectoryUseCase(new EloquentUserRepository());
    }


    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            exit($this->view->make('admin.directory.list',
                ['users' => $this->adminDirectoryUseCase->getAll()])->render());
        }

        exit($this->view->make('admin.directory.list',
            ['users' => $this->adminDirectoryUseCase->search($_POST['search'])])->render());
    }
}