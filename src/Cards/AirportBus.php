<?php

namespace TourSorter\Cards;

use TourSorter\Cards\BoardCard;

class AirportBus extends BoardCard
{
    /** @var string */
    private $seat;

    /**
     * AirportBus constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $origin
     * @param string $destination
     * @param string $seat
     * @return AirportBus
     */
    public static function createFrom(string $origin, string $destination, string $seat = ''): self
    {
        //@todo add validation
        $bus = new self();
        $bus->origin = $origin;
        $bus->destination = $destination;
        $bus->seat = $seat;

        return $bus;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ('' !== $this->seat) {
            $seatMessage = "Sit in seat {$this->seat}";
        } else {
            $seatMessage = "No seat assignment";
        }
        return sprintf(
            'Take the airport bus from %s to %s. %s.',
            $this->origin,
            $this->destination,
            $seatMessage
        );
    }
}
