<?php

namespace TourSorter\Application\Assets;

use TourSorter\Application\Application;
use TourSorter\Application\Mean;

class Flight implements Mean
{
    /** @var string */
    public $origin;
    /** @var string */
    public $destination;
    /** @var string */
    public $number;
    /** @var string */
    public $seat;
    /** @var string */
    public $gate;
    /** @var string */
    public $baggagePolicy = Application::TRANSPORT_FLIGHT_BAGGAGE_POLICY_TRANSFERRED;
    /** @var string */
    public $ticketNumber = '';
}
