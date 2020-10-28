<?php

namespace TourSorter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TourSorter\BoardSorter;
use TourSorter\SortingFailure;

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
        $boardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

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
        $firstBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

        $secondBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Beta',
            'Gamma',
            '43C'
        );

        $sortedBoardCards = $this->sorting->sort([$firstBoardCard, $secondBoardCard]);
        static::assertEquals([$firstBoardCard, $secondBoardCard], $sortedBoardCards);
    }

    /**
     * given a list with three sorted board cards should return the list
     */
    public function testGivenAListWithThreeSortedBoardCardsShouldReturnTheList()
    {
        $firstBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

        $secondBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Beta',
            'Gamma',
            '43C'
        );
        $thirdBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Gamma',
            'Alpha',
            '43C'
        );

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard];
        $sortedBoardCards = $this->sorting->sort($boardCards);
        static::assertEquals($boardCards, $sortedBoardCards);
    }

    /**
     * given a list with three board cards in inverse order should return the list sorted
     */
    public function testGivenAListWithThreeBoardCardsInInverseOrderShouldReturnTheListSorted()
    {
        $firstBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

        $secondBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Beta',
            'Gamma',
            '43C'
        );
        $thirdBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Gamma',
            'Alpha',
            '43C'
        );

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard];
        $sortedBoardCards = $this->sorting->sort(array_reverse($boardCards));
        static::assertEquals($boardCards, $sortedBoardCards);
    }

    /**
     * given a list with three board cards in random order should return the list sorted
     */
    public function testGivenAListWithThreeBoardCardsInRandomOrderShouldReturnTheListSorted()
    {
        $firstBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

        $secondBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Beta',
            'Gamma',
            '43C'
        );
        $thirdBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Gamma',
            'Alpha',
            '43C'
        );

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard];
        $clonedList = $boardCards;
        shuffle($clonedList);
        $sortedBoardCards = $this->sorting->sort($clonedList);
        static::assertEquals($boardCards, $sortedBoardCards);
    }

    /**
     * given a invalid trip list throw an exception
     *
     */
    public function testGivenAInvalidTripListThrowAnException()
    {
        $firstBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Orio',
            'Beta',
            '43C'
        );

        $secondBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Beta',
            'Gamma',
            '43C'
        );
        $thirdBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Gamma',
            'Alpha',
            '43C'
        );
        $fourthBoardCard = \TourSorter\Cards\AirportBus::createFrom(
            'Alpha',
            'Orio',
            '43C'
        );

        $boardCards = [$firstBoardCard, $secondBoardCard, $thirdBoardCard, $fourthBoardCard];
        $clonedList = $boardCards;
        shuffle($clonedList);

        $this->expectException(SortingFailure::class);
        $this->expectExceptionMessage('Error calculating tour');
        $this->sorting->sort($clonedList);
    }
}
