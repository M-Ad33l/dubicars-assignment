<?php

namespace TourSorter\Application;

use TourSorter\Cards\AirportBus;
use TourSorter\Cards\BoardCard;
use TourSorter\Cards\Flight;
use TourSorter\Cards\Train;
use TourSorter\Application\Assets\Flight as FlightAsset;
use TourSorter\Application\Assets\Train as TrainAsset;
use TourSorter\Application\Assets\Bus as BusAsset;

class BoardFactory
{
    /**
     * @param Mean $mean
     * @return BoardCard
     * @throws InvalidBoardType
     */
    public function createFrom(Mean $mean): BoardCard
    {
        switch (get_class($mean)) {
            case FlightAsset::class:
                /** @var FlightAsset $mean */
                return Flight::createFrom(
                    $mean->origin,
                    $mean->destination,
                    $mean->number,
                    $mean->gate,
                    $mean->seat,
                    $mean->baggagePolicy,
                    $mean->ticketNumber
                );
                break;
            case BusAsset::class:
                /** @var BusAsset $mean */
                return AirportBus::createFrom(
                    $mean->origin,
                    $mean->destination,
                    $mean->seat
                );
                break;
            case TrainAsset::class:
                /** @var TrainAsset $mean */
                return Train::createFrom(
                    $mean->origin,
                    $mean->destination,
                    $mean->number,
                    $mean->seat
                );
                break;
            default:
                throw new InvalidBoardType();
        }
    }
}
