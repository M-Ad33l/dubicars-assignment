<?php

namespace TourSorter\Application\Assets;

use TourSorter\Application\Mean;

class Train implements Mean
{
    /** @var string */
    public $origin;
    /** @var string */
    public $destination;
    /** @var string */
    public $number;
    /** @var string */
    public $seat = '';
}
