# dubicars-assignment
Trip Sorter assignment for dubicars

## How to test

```terminal
composer install
```

After that run the tests using following command:
```terminal
./vendor/bin/phpunit --testsuite=all
```

## External use

We can use the package via **\TourSorter\Application\App** facade and providing the transportable assets from the
**\TourSorter\Application\Assets** namespace.
Like the example code given below.
```php
<?php

    $flight = new \TourSorter\Application\Assets\Flight();
    $flight->origin = 'Alpha';
    $flight->destination = 'Beta';
    $flight->number = '22SV';
    $flight->seat = '34A';
    $flight->gate = '13';
    $flight->baggagePolicy = \TourSorter\Application\Application::TRANSPORT_FLIGHT_BAGGAGE_POLICY_DROP;
    $flight->ticketNumber = '115';

    $bus = new \TourSorter\Application\Assets\Bus();
    $bus->origin = 'Beta';
    $bus->destination = 'Gamma';
    $bus->seat = '14C';

    $train = new \TourSorter\Application\Assets\Train();
    $train->origin = 'Gamma';
    $train->destination = 'Delta';
    $train->number = '19E';
    $inputData = [$flight, $bus, $train];
    
    echo \TourSorter\Application\App::showItinerary([$train, $bus, $flight]);
```
