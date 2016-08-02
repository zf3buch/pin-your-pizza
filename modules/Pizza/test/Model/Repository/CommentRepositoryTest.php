<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Pizza\Model\Repository;

/**
 * Overwrite date
 *
 * @param string $format
 *
 * @return string
 */
function date($format)
{
    return \date($format, mktime(15, 39, 33, 4, 13, 2016));
}

namespace PizzaTest\Model\Repository;

use PHPUnit_Framework_TestCase;
use Pizza\Model\Repository\CommentRepository;
use Pizza\Model\Repository\CommentRepositoryInterface;
use Pizza\Model\Storage\CommentStorageInterface;

/**
 * Class CommentRepositoryTest
 *
 * @package PizzaTest\Model\Repository
 */
class CommentRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * @var CommentStorageInterface
     */
    private $commentTable;

    /**
     * Sets up the test
     */
    protected function setUp()
    {
        $this->commentTable = $this->prophesize(
            CommentStorageInterface::class
        );

        $this->commentRepository = new CommentRepository(
            $this->commentTable->reveal()
        );
    }

    /**
     * Test save comment with data
     */
    public function testSaveCommentWithData()
    {
        $id   = '1';
        $data = [
            'name' => 'Test name',
            'text' => 'Test comment',
        ];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => $data['name'],
            'text'  => $data['text'],
        ];

        $this->commentTable->saveComment($insertData)->willReturn(true)
            ->shouldBeCalled();

        $this->assertTrue(
            $this->commentRepository->saveComment($id, $data)
        );
    }

    /**
     * Test save comment with empty data
     */
    public function testSaveCommentWithEmptyData()
    {
        $id   = '1';
        $data = [];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => 'unbekannt',
            'text'  => 'kein Kommentar',
        ];

        $this->commentTable->saveComment($insertData)->willReturn(true)
            ->shouldBeCalled();

        $this->assertTrue(
            $this->commentRepository->saveComment($id, $data)
        );
    }

    /**
     * Test save comment failed
     */
    public function testSaveCommentFailed()
    {
        $id   = '1';
        $data = [];

        $insertData = [
            'pizza' => $id,
            'date'  => date(
                'Y-m-d H:i:s', mktime(15, 39, 33, 4, 13, 2016)
            ),
            'name'  => 'unbekannt',
            'text'  => 'kein Kommentar',
        ];

        $this->commentTable->saveComment($insertData)->willReturn(false)
            ->shouldBeCalled();

        $this->assertFalse(
            $this->commentRepository->saveComment($id, $data)
        );
    }

    /**
     * Test delete comment success
     */
    public function testDeleteCommentSuccess()
    {
        $id = '1';

        $this->commentTable->deleteComment($id)->willReturn(true)
            ->shouldBeCalled();

        $this->assertTrue(
            $this->commentRepository->deleteComment($id)
        );
    }

    /**
     * Test delete comment failed
     */
    public function testDeleteCommentFailed()
    {
        $id = '1';

        $this->commentTable->deleteComment($id)->willReturn(false)
            ->shouldBeCalled();

        $this->assertFalse(
            $this->commentRepository->deleteComment($id)
        );
    }
}
