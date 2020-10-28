<?php

namespace TourSorter\Application;

use TourSorter\BoardSorter;

/**
 * Application facade for easy usage outside the project
 *
 * @package TourSorter\Application
 */
class App
{
    /** @var Application */
    private static $app = null;

    private static function getApp(): Application
    {
        if (is_null(static::$app)) {
            static::$app = new Application(
                new BoardSorter(),
                new BoardFactory()
            );
        }

        return static::$app;
    }

    /**
     * @param Mean[] $boards
     * @return string
     * @throws InvalidBoardType
     * @throws \TourSorter\SortingFailure
     */
    public static function showItinerary(array $boards)
    {
        return self::getApp()->showItinerary($boards);
    }
}
