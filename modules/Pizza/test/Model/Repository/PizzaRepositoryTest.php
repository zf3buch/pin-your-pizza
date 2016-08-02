<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace PizzaTest\Model\Repository;

use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\PizzaRepository;
use Pizza\Model\Repository\PizzaRepositoryInterface;
use Pizza\Model\Storage\CommentStorageInterface;
use Pizza\Model\Storage\PizzaStorageInterface;

/**
 * Class PizzaRepositoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class PizzaRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PizzaRepositoryInterface
     */
    private $pizzaRepository;

    /**
     * @var PizzaStorageInterface
     */
    private $pizzaTable;

    /**
     * @var CommentStorageInterface
     */
    private $commentTable;

    /**
     * @var array
     */
    private $pizzaData
        = [
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
     * @var array
     */
    private $commentData
        = [
            '1' => [
                [
                    'id'    => '1',
                    'pizza' => '1',
                    'date'  => '2016-04-08 15:45:11',
                    'name'  => 'Test Comment',
                    'price' => 7.95,
                ],
                [
                    'id'    => '3',
                    'pizza' => '1',
                    'date'  => '2016-04-08 15:45:29',
                    'name'  => 'Another Test Comment',
                    'price' => 8.95,
                ],
            ],
            '2' => [
                [
                    'id'    => '2',
                    'pizza' => '2',
                    'date'  => '2016-04-08 15:45:22',
                    'name'  => 'Another Test Comment',
                    'price' => 8.95,
                ],
            ],
        ];

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        $this->pizzaTable = $this->prophesize(
            PizzaStorageInterface::class
        );

        $this->commentTable = $this->prophesize(
            CommentStorageInterface::class
        );

        $this->pizzaRepository = new PizzaRepository(
            $this->pizzaTable->reveal(), $this->commentTable->reveal()
        );
    }

    /**
     * Test get pizza pinboard
     */
    public function testGetPizzaPinboard()
    {
        $pizzaData    = array_slice($this->pizzaData, 0, 2);
        $commentData1 = $this->commentData[$pizzaData[0]['id']];
        $commentData2 = $this->commentData[$pizzaData[1]['id']];

        $expectedData = [
            $pizzaData[0],
            $pizzaData[1],
        ];

        $expectedData[0]['comments'] = $commentData1;
        $expectedData[1]['comments'] = $commentData2;

        $this->pizzaTable->fetchAllPizzas()->willReturn($pizzaData)
            ->shouldBeCalled();

        $this->commentTable->fetchCommentsByPizza('1')
            ->willReturn($commentData1)->shouldBeCalled();

        $this->commentTable->fetchCommentsByPizza('2')
            ->willReturn($commentData2)->shouldBeCalled();

        $this->assertEquals(
            $expectedData, $this->pizzaRepository->getPizzaPinboard()
        );
    }

    /**
     * Test get single pizza
     */
    public function testGetSinglePizza()
    {
        $pizzaData   = $this->pizzaData[0];
        $commentData = $this->commentData[$pizzaData['id']];

        $expectedData             = $pizzaData;
        $expectedData['comments'] = $commentData;

        $this->pizzaTable->fetchPizzaById($pizzaData['id'])
            ->willReturn($pizzaData)->shouldBeCalled();

        $this->commentTable->fetchCommentsByPizza($pizzaData['id'])
            ->willReturn($commentData)->shouldBeCalled();

        $this->assertEquals(
            $expectedData,
            $this->pizzaRepository->getSinglePizza($pizzaData['id'])
        );
    }

    /**
     * Test save voting
     */
    public function testSaveVoting()
    {
        $id   = 1;
        $star = 3;

        $this->pizzaTable->saveVoting($id, $star)->willReturn(true)
            ->shouldBeCalled();

        $this->assertTrue($this->pizzaRepository->saveVoting($id, $star));
    }
}
