<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 3/08/19
 * Time: 11:49 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

session_start();

require_once 'vendor/autoload.php';
require_once 'config/database.php';

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        DB::rollBack();
    }
}
