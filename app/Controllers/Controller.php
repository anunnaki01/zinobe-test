<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 1/08/19
 * Time: 11:18 PM
 */

namespace App\Controllers;


use Jenssegers\Blade\Blade;
use Rakit\Validation\Validator;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{
    /**
     * @var
     */
    public $view;
    public $validator;

    public function __construct()
    {
        $this->view = new Blade('resources/views/', 'resources/cache');
        $this->validator = new Validator;
    }
}