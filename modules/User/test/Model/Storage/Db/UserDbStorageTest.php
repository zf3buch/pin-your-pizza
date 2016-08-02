<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserTest\Model\Storage\Db;

use PHPUnit_Extensions_Database_DataSet_IDataSet;
use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;
use PHPUnit_Extensions_Database_DB_IDatabaseConnection;
use PHPUnit_Extensions_Database_TestCase;
use User\Model\Storage\Db\UserDbStorage;
use User\Model\Storage\UserStorageInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class UserDbStorageTest
 *
 * @package UserTest\Model\Storage\Db
 */
class UserDbStorageTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var UserStorageInterface
     */
    private $userStorage;

    /**
     * @var Adapter
     */
    private $adapter = null;

    /**
     * @var PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private $connection = null;

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        if (!$this->userStorage) {
            $dbConfig = include __DIR__
                . '/../../../../../../config/autoload/database.test.php';

            $this->adapter = new Adapter($dbConfig['db']);

            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

            $tableGateway = new TableGateway(
                'user', $this->adapter, null, $resultSet
            );

            $this->userStorage = new UserDbStorage($tableGateway);
        }

        parent::setUp();
    }

    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->createDefaultDBConnection(
                $this->adapter->getDriver()->getConnection()->getResource(
                ),
                'pin-your-pizza-test'
            );
        }

        return $this->connection;
    }

    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return $this->createXmlDataSet(
            __DIR__ . '/assets/user-test-data.xml'
        );
    }

    /**
     * Test fetch user by id
     *
     * @param $id
     *
     * @dataProvider provideUserByIdData
     */
    public function testFetchUserById($id)
    {
        $userById = $this->userStorage->fetchUserById($id);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchUserById',
            'SELECT * FROM user WHERE id = "' . $id . '";'
        );

        $this->assertEquals($queryStorage->getRow(0), $userById);
    }

    /**
     * Data provider for pizzas sorted tests
     *
     * @return array
     */
    public function provideUserByIdData()
    {
        return [
            [1],
            [2],
        ];
    }

    /**
     * Test save user
     *
     * @param $data
     *
     * @dataProvider provideInsertUserData
     */
    public function testInsertUser($data)
    {
        $result = $this->userStorage->insertUser($data);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchUserById',
            'SELECT * FROM user WHERE id = "' . $data['id'] . '";'
        );

        $expectedData = $queryStorage->getRow(0);

        $this->assertEquals(1, $result);
        $this->assertEquals($expectedData, $data);
    }

    /**
     * Data provider for save user
     *
     * @return array
     */
    public function provideInsertUserData()
    {
        return [
            [
                [
                    'id'         => '3',
                    'date'       => '2016-04-13 16:00:43',
                    'email'      => 'theo@tester.de',
                    'password'   => password_hash(
                        'Test1234', PASSWORD_BCRYPT
                    ),
                    'role'       => 'member',
                    'first_name' => 'Theo',
                    'last_name'  => 'Tester',
                ],
            ],
            [
                [
                    'id'         => '4',
                    'date'       => '2016-04-13 16:01:14',
                    'email'      => 'thea@tester.de',
                    'password'   => password_hash(
                        'Test1234', PASSWORD_BCRYPT
                    ),
                    'role'       => 'admin',
                    'first_name' => 'Thea',
                    'last_name'  => 'Tester',
                ],
            ],
        ];
    }
}
