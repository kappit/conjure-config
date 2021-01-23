<?php

declare(strict_types=1);

namespace Conjure\Config;

use Composer\Autoload\ClassLoader;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\FormatException;
use Symfony\Component\Dotenv\Exception\PathException;

/**
 * Class Config
 * @package Conjure\Config
 */
final class Config
{

    /**
     * @var self|null
     */
    private static self|null $_instance = null;

    /**
     * @var Dotenv
     */
    private Dotenv $_dotenv;

    /**
     * @var string
     */
    private string $_root;

    /**
     * Config constructor.
     */
    private function __construct()
    {
        try {
            $rc = new ReflectionClass(objectOrClass: ClassLoader::class);
            $this->_root = dirname(path: $rc->getFileName(), levels: 2);
            $this->_dotenv = new Dotenv();
            $this->_dotenv->loadEnv(path: $this->_root . '/.env');
        } catch (ReflectionException | FormatException | PathException $ex) {
            $className = get_class(object: $ex);

            $error = match ($className) {
                ReflectionException::class => 'Composer is not installed',
                FormatException::class => 'The .env file has a syntax error',
                PathException::class => 'The file .env does not exist in '
                    . $this->_root
            };

            die($error);
        }
    }

    /**
     * @return string
     */
    public function getRoot(): string
    {
        return $this->_root;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

}