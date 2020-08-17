<?php

namespace App\Services\Helpers;

/**
 * Trait Singleton
 *
 * @package App\Services\Helpers
 */
trait Singleton
{
    /**
     * @var static $instance
     */
    private static $instance;

    /**
     * Singleton constructor.
     */
    protected abstract function __construct();

    /**
     * @return Singleton
     */
    public static function make(): self
    {
        if (!self::$instance)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }
}