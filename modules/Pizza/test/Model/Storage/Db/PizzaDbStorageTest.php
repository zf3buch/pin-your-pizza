<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Storage\Db;

use PHPUnit_Extensions_Database_DataSet_IDataSet;
use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;
use PHPUnit_Extensions_Database_DB_IDatabaseConnection;
use PHPUnit_Extensions_Database_TestCase;
use Pizza\Model\Storage\Db\PizzaDbStorage;
use Pizza\Model\Storage\PizzaStorageInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class PizzaStorageTest
 *
 * @package PizzaTest\Model\Storage\Db
 */
class PizzaStorageTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var PizzaStorageInterface
     */
    private $pizzaStorage;

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
        if (!$this->pizzaStorage) {
            $dbConfig = include __DIR__
                . '/../../../../../../config/autoload/database.test.php';

            $this->adapter = new Adapter($dbConfig['db']);

            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

            $tableGateway = new TableGateway(
                'pizza', $this->adapter, null, $resultSet
            );

            $this->pizzaStorage = new PizzaDbStorage($tableGateway);
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
            __DIR__ . '/assets/pizza-test-data.xml'
        );
    }

    /**
     * Test fetch all pizzas
     */
    public function testFetchAllPizzas()
    {
        $pizzaList = $this->pizzaStorage->fetchAllPizzas();

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchAllPizzas', 'SELECT * FROM pizza ORDER BY id;'
        );

        $allPizzas = [];

        for ($key = 0; $key < $queryStorage->getRowCount(); $key++) {
            $pizza = $queryStorage->getRow($key);

            $allPizzas[$pizza['id']] = $pizza;
        }

        foreach ($pizzaList as $pizza) {
            $this->assertTrue(
                in_array($pizza['id'], array_keys($allPizzas))
            );
        }
    }

    /**
     * Test fetch pizza by id
     *
     * @param $id
     *
     * @dataProvider providePizzaByIdData
     */
    public function testFetchPizzaById($id)
    {
        $pizzaById = $this->pizzaStorage->fetchPizzaById($id);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM pizza WHERE id = "' . $id . '";'
        );

        $this->assertEquals($queryStorage->getRow(0), $pizzaById);
    }

    /**
     * Data provider for pizzas sorted tests
     *
     * @return array
     */
    public function providePizzaByIdData()
    {
        return [
            [1],
            [5],
            [9],
            [6],
            [2],
        ];
    }

    /**
     * Test save voting
     *
     * @param $id
     * @param $star
     * @param $total
     * @param $rate
     *
     * @dataProvider provideSaveVotingData
     */
    public function testSaveVoting($id, $star, $starCnt, $total, $rate)
    {
        $result = $this->pizzaStorage->saveVoting($id, $star);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM pizza WHERE id = "' . $id . '";'
        );

        $expectedData = $queryStorage->getRow(0);

        $this->assertTrue($result);
        $this->assertEquals($starCnt, $expectedData['stars' . $star]);
        $this->assertEquals($total, $expectedData['total']);
        $this->assertEquals($rate, $expectedData['rate']);
    }

    /**
     * Data provider for save voting tests
     *
     * @return array
     */
    public function provideSaveVotingData()
    {
        return [
            [1, 2, 1, 3, 3.6667],
            [5, 3, 1, 3, 2.6667],
            [9, 3, 2, 3, 2.6667],
            [7, 5, 1, 3, 3.0000],
            [2, 5, 3, 3, 5.0000],
        ];
    }
}
