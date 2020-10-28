<?php

namespace TourSorter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TourSorter\Cards\Flight;

class FlightTest extends TestCase
{

    /**
     * given flight number NO61 from Alpha to Beta at gate 51 and seat 11C with automatic baggage transfer format to specific message
     */
    public function testGivenFlightNumberNO61FromAlphaToNewYorkJFKAtGate51AndSeat11CWithAutomaticBaggageTransferFormatToSpecificMessage(
    )
    {
        $flight = Flight::createFrom(
            'Alpha',
            'Beta',
            'NO61',
            '51',
            '11C',
            Flight::BAGGAGE_TRANSFERRED
        );

        static::assertEquals(
            'From Alpha, take flight NO61 to Beta. Gate 51, seat 11C.' . PHP_EOL
            . 'Baggage will be automatically transferred from your last leg.',
            (string)$flight
        );
    }

    /**
     * given flight number Num777 from Gamma to Delta at gate 87 and seat 91A with baggage drop at 911 format to specific message
     */
    public function testGivenFlightNumberNum777FromGammaToHongKongAtGate87AndSeat91AWithBaggageDropAt911FormatToSpecificMessage()
    {
        $flight = Flight::createFrom(
            'Gamma',
            'Delta',
            'Num777',
            '87',
            '91A',
            Flight::BAGGAGE_DROP,
            '911'
        );

        static::assertEquals(
            'From Gamma, take flight Num777 to Delta. Gate 87, seat 91A.' . PHP_EOL
            . 'Baggage drop at ticket counter 911.',
            (string)$flight
        );
    }

}
