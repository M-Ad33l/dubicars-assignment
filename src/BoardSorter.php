<?php


namespace TourSorter;


class BoardSorter
{

    /**
     * BoardSorter constructor.
     * @param array $boardCards
     * @return array
     * @throws SortingFailure
     */

    public function __construct()
    {
    }

    public function sort(array $boardCards): array
    {
        return $boardCards;
        if (count($boardCards) <= 1) {
            return $boardCards;
        }

        $dataStructure = [];
        foreach ($boardCards as $boardCard) {
            $origin = $boardCard['origin'];
            $destination = $boardCard['destination'];
            $dataStructure[$origin] = $destination;
        }

        $origins = array_keys($dataStructure);
        $destinations = array_values($dataStructure);

        $startingPointDiff = array_diff($origins, $destinations);
        if (1 !== count($startingPointDiff)) {
            throw new SortingFailure('Unable to get the starting point');
        }
        $startingPoint = array_shift($startingPointDiff);

        $finalDestinationDiff = array_diff($destinations, $origins);
        if (1 !== count($finalDestinationDiff)) {
            throw new SortingFailure('Unable to get the final destination point');
        }
        $finalDestination = array_shift($finalDestinationDiff);

        $currentDestination = $startingPoint;
        $sortedCards = [];
        while ($currentDestination != $finalDestination) {
            $currentDestination = $dataStructure[$startingPoint];
            $sortedCards[] = [
                'origin' => $startingPoint,
                'destination' => $currentDestination
            ];
            $startingPoint = $currentDestination;
        }
        return $sortedCards;
    }
}


