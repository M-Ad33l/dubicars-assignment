<?php

namespace TourSorter\Tests\Unit;

use PHPUnit\Framework\TestCase;

class AirportBusTest extends TestCase
{

    /**
     * given an airport bus from Delta to Beta Airport with seat 91D format to specific message
     */
    public function testGivenAnAirportBusFromDeltaToBetaAirportWithSeat91DFormatToSpecificMessage()
    {
        $bus = \TourSorter\Cards\AirportBus::createFrom(
            'Delta',
            'Beta Airport',
            '91D'
        );

        static::assertEquals(
            'Take the airport bus from Delta to Beta Airport. Sit in seat 91D.',
            (string)$bus
        );
    }


}
