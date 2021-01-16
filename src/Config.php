<?php

declare(strict_types=1);

namespace Conjure\Config;

/**
 * Class Config
 * @package Conjure\Config
 */
final class Config
{

    /**
     * @var self|null
     */
    private static self|null $instance = null;

    /**
     * Config constructor.
     */
    private function __construct()
    {
        // To do
        echo 'Config singleton has been constructed';
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}