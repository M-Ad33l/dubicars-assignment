<?php

namespace TourSorter\Cards;

class BoardCard
{
    /** @var string */
    protected $origin;
    /** @var string */
    protected $destination;

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }
}
