<?php

namespace TourSorter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TourSorter\Cards\Train;

class TrainTest extends TestCase
{
    /**
     * given the train 91C from Gamma to Delta with the seat 91D format to specific message
     */
    public function testGivenTheTrain91CFromGammaToDeltaWithTheSeat91DFormatToSpecificMessage()
    {
        $train = Train::createFrom(
            'Gamma',
            'Delta',
            '91C',
            '91D'
        );
        static::assertEquals(
            'Take train 91C from Gamma to Delta. Sit in seat 91D.',
            (string)$train
        );
    }

  
}
