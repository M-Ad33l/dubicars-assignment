<?php

namespace TourSorter\Application\Assets;

use TourSorter\Application\Mean;

class Bus implements Mean
{
    /** @var string */
    public $origin;
    /** @var string */
    public $destination;
    /** @var string */
    public $seat;
}
