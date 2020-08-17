<?php

namespace App\Services\Reports\Contracts;

/**
 * Interface ReportContract
 * @package App\Services\Reports\Contracts
 */
interface ReportContract
{
    /**
     * @param callable $callback
     *
     * @return mixed
     */
    public function process(callable $callback);
}