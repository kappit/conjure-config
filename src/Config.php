<?php

declare(strict_types=1);

namespace Conjure\Config;

final class Config
{

    private static self|null $instance;

    private function __construct()
    {
        // To do
        echo 'Config singleton has been constructed';
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}