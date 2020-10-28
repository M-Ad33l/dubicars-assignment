<?php

namespace TourSorter\Cards;

use TourSorter\Cards\BoardCard;

class Train extends BoardCard
{
    /** @var string */
    private $trainNumber;
    /** @var */
    private $seat;

    /**
     * Train constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $origin
     * @param string $destination
     * @param string $trainNumber
     * @param string $seat
     * @return Train
     */
    public static function createFrom(string $origin, string $destination, string $trainNumber, string $seat)
    {
        $train = new self();
        //@todo add validation here
        $train->destination = $destination;
        $train->origin = $origin;
        $train->trainNumber = $trainNumber;
        $train->seat = $seat;

        return $train;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        /**
         * @todo can be refactored to extract seat into a class with
         * it's own responsibility for formatting and should also be used in the Bus class
         */
        if ('' !== $this->seat) {
            $seatMessage = "Sit in seat {$this->seat}";
        } else {
            $seatMessage = "No seat assignment";
        }
        return sprintf(
            'Take train %s from %s to %s. %s.',
            $this->trainNumber,
            $this->origin,
            $this->destination,
            $seatMessage
        );
    }
}
