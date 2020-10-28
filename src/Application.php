<?php

namespace TourSorter\Application;

use TourSorter\Cards\BoardCard;
use TourSorter\Application\BoardFactory;
use TourSorter\BoardSorter;
use TourSorter\Cards\Flight;
use TourSorter\Application\InvalidBoardType;
use TourSorter\SortingFailure;

class Application
{
    const TRANSPORT_TYPE_FLIGHT = 'flight';
    const TRANSPORT_FLIGHT_BAGGAGE_POLICY_TRANSFERRED = Flight::BAGGAGE_TRANSFERRED;
    const TRANSPORT_TYPE_BUS = 'airport_bus';
    const TRANSPORT_TYPE_TRAIN = 'train';
    const TRANSPORT_FLIGHT_BAGGAGE_POLICY_DROP = Flight::BAGGAGE_DROP;
    /**
     * @var BoardSorter
     */
    private $boardSorter;
    /**
     * @var BoardFactory
     */
    private $boardFactory;

    /**
     * Application constructor.
     * @param BoardSorter $boardSorter
     * @param BoardFactory $boardFactory
     */
    public function __construct(BoardSorter $boardSorter, BoardFactory $boardFactory)
    {
        $this->boardSorter = $boardSorter;
        $this->boardFactory = $boardFactory;
    }

    /**
     * @param Mean[] $boards
     * @return string
     * @throws InvalidBoardType
     * @throws SortingFailure
     */
    public function showItinerary(array $boards): string
    {
        $boards = $this->buildBoardsFrom($boards);
        $sortedBoards = $this->boardSorter->sort($boards);

        $result = $this->prepareForPrint($sortedBoards);

        return implode(PHP_EOL, $result);
    }

    /**
     * @param array $boards
     * @return BoardCard[]
     * @throws InvalidBoardType
     */
    private function buildBoardsFrom(array $boards): array
    {
        $list = [];
        foreach ($boards as $board) {
            $list[] = $this->boardFactory->createFrom($board);
        }

        return $list;
    }

    /**
     * @param $sortedBoards
     * @return array
     */
    public function prepareForPrint($sortedBoards): array
    {
        $boardNumber = 1;
        $result = [];
        foreach ($sortedBoards as $board) {
            $result[] = "$boardNumber.\t" . (string)$board;
            $boardNumber++;
        }

        $result[] = "$boardNumber.\tYou have arrived at your final destination.";
        return $result;
    }
}
