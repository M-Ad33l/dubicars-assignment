<?php

namespace TourSorter\Tests\Integration;

use PHPUnit\Framework\TestCase;
use TourSorter\Application\Application;
use TourSorter\Application\Assets\Bus;
use TourSorter\Application\Assets\Flight;
use TourSorter\Application\Assets\Train;
use TourSorter\Application\BoardFactory;
use TourSorter\BoardSorter;

class ApplicationTest extends TestCase
{
    /** @var Application */
    private $application;

    protected function setUp()
    {
        $this->application = new Application(
            new BoardSorter(),
            new BoardFactory()
        );
    }

    /**
     * given a list of one board print them sorted
     */
    public function testGivenAListOfOneBoardPrintThemSorted()
    {
        $flight = new Flight();
        $flight->origin = 'Delta';
        $flight->destination = 'Beta';
        $flight->number = 'RI45';
        $flight->seat = '94A';
        $flight->gate = '34';
        $flight->baggagePolicy = Application::TRANSPORT_FLIGHT_BAGGAGE_POLICY_TRANSFERRED;
        $inputData = [$flight];

        $expectedMessage = "1.\tFrom Delta, take flight RI45 to Beta. Gate 34, seat 94A." . PHP_EOL .
            "Baggage will be automatically transferred from your last leg." . PHP_EOL
            . "2.\tYou have arrived at your final destination.";
        $this->assertEquals($expectedMessage, $this->application->showItinerary($inputData));
    }

    /**
     * given a list of three sorted boards print them sorted
     */
    public function testGivenAListOfThreeSortedBoardsPrintThemSorted()
    {
        $flight = new Flight();
        $flight->origin = 'Delta';
        $flight->destination = 'Beta';
        $flight->number = 'RI45';
        $flight->seat = '94A';
        $flight->gate = '34';
        $flight->baggagePolicy = Application::TRANSPORT_FLIGHT_BAGGAGE_POLICY_TRANSFERRED;

        $bus = new Bus();
        $bus->origin = 'Beta';
        $bus->destination = 'Gamma';
        $bus->seat = '94A';

        $train = new Train();
        $train->origin = 'Gamma';
        $train->destination = 'Alpha';
        $train->number = '34G';
        $train->seat = '94A';
        $inputData = [$flight, $bus, $train];


        $expectedMessage =
            "1.\tFrom Delta, take flight RI45 to Beta. Gate 34, seat 94A." . PHP_EOL .
            'Baggage will be automatically transferred from your last leg.' . PHP_EOL
            . "2.\tTake the airport bus from Beta to Gamma. Sit in seat 94A." . PHP_EOL
            . "3.\tTake train 34G from Gamma to Alpha. Sit in seat 94A." . PHP_EOL
            . "4.\tYou have arrived at your final destination.";
        $this->assertEquals($expectedMessage, $this->application->showItinerary($inputData));
    }

    /**
     * given a list of three inverse sorted boards print them sorted
     */
    public function testGivenAListOfThreeInverseSortedBoardsPrintThemSorted()
    {
        $flight = new Flight();
        $flight->origin = 'Delta';
        $flight->destination = 'Beta';
        $flight->number = 'RI45';
        $flight->seat = '94A';
        $flight->gate = '34';
        $flight->baggagePolicy = Application::TRANSPORT_FLIGHT_BAGGAGE_POLICY_DROP;
        $flight->ticketNumber = '116';

        $bus = new Bus();
        $bus->origin = 'Beta';
        $bus->destination = 'Gamma';
        $bus->seat = '94A';

        $train = new Train();
        $train->origin = 'Gamma';
        $train->destination = 'Alpha';
        $train->number = '34G';
        $inputData = [$flight, $bus, $train];

        $expectedMessage =
            "1.\tFrom Delta, take flight RI45 to Beta. Gate 34, seat 94A." . PHP_EOL .
            'Baggage drop at ticket counter 116.' . PHP_EOL
            . "2.\tTake the airport bus from Beta to Gamma. Sit in seat 94A." . PHP_EOL
            . "3.\tTake train 34G from Gamma to Alpha. No seat assignment." . PHP_EOL
            . "4.\tYou have arrived at your final destination.";
        $this->assertEquals($expectedMessage, $this->application->showItinerary(array_reverse($inputData)));
    }
}
