<?php

namespace TourSorter;

use TourSorter\Cards\BoardCard;

class BoardSorter
{
    /**
     * @param array $boardCards
     * @return BoardCard[]
     * @throws SortingFailure
     * @return BoardCard[]
     */
    public function sort(array $boardCards): array
    {
        if (count($boardCards) <= 1) {
            return $boardCards;
        }

        $dataStructure = $this->extractDataStructure($boardCards);

        $origins = array_keys($dataStructure);
        $destinations = array_column($dataStructure, 'destination');

        $startingPoint = $this->getStartingPoint($origins, $destinations);
        $finalDestination = $this->getFinalDestination($destinations, $origins);

        return $this->sortList($startingPoint, $finalDestination, $dataStructure);
    }

    /**
     * @param BoardCard[] $boardCards
     * @return array
     */
    private function extractDataStructure(array $boardCards): array
    {
        $dataStructure = [];
        foreach ($boardCards as $boardCard) {
            $origin = $boardCard->getOrigin();
            $destination = $boardCard->getDestination();
            $dataStructure[$origin] =
                [
                    'destination' => $destination,
                    'board' => $boardCard
                ];
        }
        return $dataStructure;
    }

    /**
     * @param $origins
     * @param $destinations
     * @return string
     * @throws SortingFailure
     */
    private function getStartingPoint($origins, $destinations): string
    {
        $startingPointDiff = array_diff($origins, $destinations);
        if (1 !== count($startingPointDiff)) {
            throw new SortingFailure('Error calculating tour');
        }
        $startingPoint = array_shift($startingPointDiff);
        return $startingPoint;
    }

    /**
     * @param $destinations
     * @param $origins
     * @return string
     * @throws SortingFailure
     */
    private function getFinalDestination($destinations, $origins): string
    {
        $finalDestinationDiff = array_diff($destinations, $origins);
        $finalDestination = array_shift($finalDestinationDiff);
        return $finalDestination;
    }

    /**
     * @param $startingPoint
     * @param $finalDestination
     * @param $dataStructure
     * @return BoardCard[]
     */
    private function sortList($startingPoint, $finalDestination, $dataStructure): array
    {
        $currentDestination = $startingPoint;
        $sortedCards = [];
        while ($currentDestination != $finalDestination) {
            $currentDestination = $dataStructure[$startingPoint]['destination'];
            $sortedCards[] = $dataStructure[$startingPoint]['board'];
            $startingPoint = $currentDestination;
        }
        return $sortedCards;
    }
}
