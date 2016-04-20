<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace User\Model\Repository;

/**
 * Overwrite password_hash function
 *
 * @param string $password
 * @param string $algo
 *
 * @return string
 */
function password_hash($password, $algo)
{
    return $password;
}

/**
 * Overwrite date
 *
 * @param string $format
 *
 * @return string
 */
function date($format)
{
    return \date($format, mktime(15,39,33,4,13,2016));
}

namespace UserTest\Model\Repository;

use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\MethodProphecy;
use User\Model\Repository\UserRepository;
use User\Model\Repository\UserRepositoryInterface;
use User\Model\Table\UserTableInterface;

/**
 * Class UserRepositoryTest
 *
 * @package UserTest\Model\Repository
 */
class UserRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserTableInterface
     */
    private $userTable;

    /**
     * @var array
     */
    private $userData = [
        [
            'id'    => '1',
            'name'  => 'Pizza Test',
            'image' => '/path/to/image/1.png',
            'pos'   => 10,
            'neg'   => 10,
            'rate'  => 0.5,
        ],
        [
            'id'    => '2',
            'name'  => 'Pizza Another Test',
            'image' => '/path/to/image/2.png',
            'pos'   => 15,
            'neg'   => 5,
            'rate'  => 0.75,
        ],
        [
            'id'    => '3',
            'name'  => 'Pizza Third Test',
            'image' => '/path/to/image/3.png',
            'pos'   => 5,
            'neg'   => 15,
            'rate'  => 0.25,
        ],
    ];

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        $this->userTable = $this->prophesize(
            UserTableInterface::class
        );

        $this->userRepository = new UserRepository(
            $this->userTable->reveal()
        );
    }

    /**
     * Test get single pizza
     */
    public function testGetSinglePizza()
    {
        $userData = $this->userData[0];

        $expectedData = $userData;

        /** @var MethodProphecy $method */
        $method = $this->userTable->fetchUserById($userData['id']);
        $method->willReturn($userData);
        $method->shouldBeCalled();

        $this->assertEquals(
            $expectedData,
            $this->userRepository->getSingleUser($userData['id'])
        );
    }

    /**
     * Test register user
     */
    public function testRegisterUser()
    {
        $data = [
            'email'         => 'theo@tester.de',
            'password'      => 'Test1234',
            'first_name'    => 'Test',
            'last_name'     => 'Test',
            'register_user' => 'register_user',
        ];

        $insertData = [
            'date'       => date('Y-m-d H:i:s', mktime(15,39,33,4,13,2016)),
            'email'      => $data['email'],
            'password'   => $data['password'],
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
        ];

        /** @var MethodProphecy $method */
        $method = $this->userTable->insertUser($insertData);
        $method->willReturn(true);
        $method->shouldBeCalled();

        $this->assertTrue(
            $this->userRepository->registerUser($data)
        );
    }
}
