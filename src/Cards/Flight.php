<?php

namespace TourSorter\Cards;

use TourSorter\Cards\BoardCard;

class Flight extends BoardCard
{

    const BAGGAGE_TRANSFERRED = 'TRANSFERRED';
    const BAGGAGE_DROP = 'dropped';

    /** @var string */
    private $flightNumber;
    /** @var string */
    private $gate;
    /** @var string */
    private $seat;
    /** @var string */
    private $baggagePolicy;
    /** @var string */
    private $ticketNumber;

    private function __construct()
    {
    }

    /**
     * @param string $origin
     * @param string $destination
     * @param string $flightNumber
     * @param string $gate
     * @param string $seat
     * @param string $baggagePolicy
     * @param string $ticketNumber
     * @return Flight
     */
    public static function createFrom(
        string $origin,
        string $destination,
        string $flightNumber,
        string $gate,
        string $seat,
        string $baggagePolicy,
        string $ticketNumber = ''
    ): self {
        //@todo add validation
        $flight = new self();
        $flight->origin = $origin;
        $flight->destination = $destination;
        $flight->flightNumber = $flightNumber;
        $flight->gate = $gate;
        $flight->seat = $seat;
        $flight->baggagePolicy = $baggagePolicy;
        $flight->ticketNumber = $ticketNumber;

        return $flight;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        //switch can be encapsulated in a proper baggage policy classes with specific message formatting, no time for that right now
        switch ($this->baggagePolicy) {
            case static::BAGGAGE_TRANSFERRED:
                $baggageMessage = 'Baggage will be automatically transferred from your last leg.';
                break;
            case static::BAGGAGE_DROP:
                $baggageMessage = sprintf('Baggage drop at ticket counter %s.', $this->ticketNumber);
                break;
            default:
                //@todo remove after validation ,should be catched by validation and never happen
                $baggageMessage = '';
        }

        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s.' . PHP_EOL . '%s',
            $this->origin,
            $this->flightNumber,
            $this->destination,
            $this->gate,
            $this->seat,
            $baggageMessage
        );
    }
}
