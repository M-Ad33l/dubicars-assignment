<?php

namespace TourSorter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TourSorter\BoardSorter;

class SortingTest extends TestCase
{
    /** @var BoardSorter */
    private $sorting;

    protected function setUp()
    {
        $this->sorting = new BoardSorter();
    }

    /**
     * given one boarding card return it
     */
    public function testGivenOneBoardingCardReturnIt()
    {
        $boardCard = [
            'origin' => 'alpha',
            'destination' => 'delta',
        ];

        $sortedBoardCards = $this->sorting->sort([$boardCard]);
        static::assertEquals([$boardCard], $sortedBoardCards);
    }

    /**
     * given a empty list of board cards should return an empty list
     */
    public function testGivenAEmptyListOfBoardCardsShouldReturnAnEmptyList()
    {
        $sortedBoardCards = $this->sorting->sort([]);
        static::assertEquals([], $sortedBoardCards);
    }

    /**
     * given a list with two sorted board cards should return the list
     */
    public function testGivenAListWithTwoSortedBoardCardsShouldReturnTheList()
    {
        $firstBoardCard = [
            'origin' => 'alpha',
            'destination' => 'beta',
        ];

        $secondBoardCard = [
            'origin' => 'delta',
            'destination' => 'gamma',
        ];

        $sortedBoardCards = $this->sorting->sort([$firstBoardCard, $secondBoardCard]);
        static::assertEquals([$firstBoardCard, $secondBoardCard], $sortedBoardCards);
    }

    /**
     * given a list with three sorted board cards should return the list
     */
    public function testGivenAListWithThreeSortedBoardCardsShouldReturnTheList()
    {
        $firstBoardCard = [
            'origin' => 'orio',
            'destination' => 'delta',
        ];

        $secondBoardCard = [
            'origin' => 'delta',
            'destination' => 'gamma',
        ];

        $thirdBoardCard = [
            'origin' => 'gamma',
            'destination' => 'Rome',
        ];

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard];
        $sortedBoardCards = $this->sorting->sort($boardCards);
        static::assertEquals($boardCards, $sortedBoardCards);
    }

    /**
     * given a list with three board cards in inverse order should return the list sorted
     */
    public function testGivenAListWithThreeBoardCardsInInverseOrderShouldReturnTheListSorted()
    {
        $firstBoardCard = [
            'origin' => 'orio',
            'destination' => 'delta',
        ];

        $secondBoardCard = [
            'origin' => 'delta',
            'destination' => 'gamma',
        ];

        $thirdBoardCard = [
            'origin' => 'gamma',
            'destination' => 'Rome',
        ];

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard];
        $sortedBoardCards = $this->sorting->sort(array_reverse($boardCards));
        static::assertEquals($boardCards, $sortedBoardCards);
    }


}
