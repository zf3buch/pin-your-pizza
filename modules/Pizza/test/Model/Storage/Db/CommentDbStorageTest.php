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
use Pizza\Model\Storage\Db\CommentDbStorage;
use Pizza\Model\Storage\CommentStorageInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class CommentStorageTest
 *
 * @package PizzaTest\Model\Storage\Db
 */
class CommentStorageTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var CommentStorageInterface
     */
    private $commentStorage;

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
        if (!$this->commentStorage) {
            $dbConfig = include __DIR__
                . '/../../../../../../config/autoload/database.test.php';

            $this->adapter = new Adapter($dbConfig['db']);

            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);

            $tableGateway = new TableGateway(
                'comment', $this->adapter, null, $resultSet
            );

            $this->commentStorage = new CommentDbStorage($tableGateway);
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
            __DIR__ . '/assets/comment-test-data.xml'
        );
    }

    /**
     * Test fetch comments by pizza
     *
     * @param $pizzaId
     *
     * @dataProvider provideCommentsByPizzaData
     */
    public function testFetchCommentsByPizza($pizzaId)
    {
        $comments = $this->commentStorage->fetchCommentsByPizza(
            $pizzaId
        );

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchAllComments',
            'SELECT * FROM comment WHERE pizza = "' . $pizzaId
            . '" ORDER BY date ASC;'
        );

        $allComments = [];

        for ($key = 0; $key < $queryStorage->getRowCount(); $key++) {
            $comment = $queryStorage->getRow($key);

            $allComments[] = $comment;
        }

        foreach ($comments as $key => $comment) {
            $this->assertEquals($comment, $allComments[$key]);
        }
    }

    /**
     * Data provider for Comments sorted tests
     *
     * @return array
     */
    public function provideCommentsByPizzaData()
    {
        return [
            [1],
            [6],
            [9],
            [3],
            [2],
        ];
    }

    /**
     * Test save comment
     *
     * @param $data
     *
     * @dataProvider provideSaveCommentData
     */
    public function testSaveComment($data)
    {
        $result = $this->commentStorage->saveComment($data);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM comment WHERE id = "' . $data['id'] . '";'
        );

        $expectedData = $queryStorage->getRow(0);

        $this->assertEquals(1, $result);
        $this->assertEquals($expectedData, $data);
    }

    /**
     * Data provider for save comment
     *
     * @return array
     */
    public function provideSaveCommentData()
    {
        return [
            [
                [
                    'id'    => '12',
                    'pizza' => '5',
                    'date'  => '2016-04-09 16:46:43',
                    'name'  => 'Test Comment',
                    'text'  => 'Test text',
                ],
            ],
            [
                [
                    'id'    => '13',
                    'pizza' => '6',
                    'date'  => '2016-04-09 16:47:25',
                    'name'  => 'Another Test Comment',
                    'text'  => 'Another Test text',
                ],
            ],
        ];
    }

    /**
     * Test delete comment
     *
     * @param $id
     *
     * @dataProvider provideDeleteCommentData
     */
    public function testDeleteComment($id)
    {
        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM comment WHERE id = "' . $id . '";'
        );

        $this->assertEquals(1, $queryStorage->getRowCount());

        $result = $this->commentStorage->deleteComment($id);

        $this->assertEquals(1, $result);

        $queryStorage = $this->getConnection()->createQueryTable(
            'fetchPizzaById',
            'SELECT * FROM comment WHERE id = "' . $id . '";'
        );

        $this->assertEquals(0, $queryStorage->getRowCount());
    }

    /**
     * Data provider for delete comment tests
     *
     * @return array
     */
    public function provideDeleteCommentData()
    {
        return [
            [1],
            [5],
            [9],
            [6],
            [2],
        ];
    }
}
