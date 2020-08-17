<?php

namespace App\Repositories\Eloquent\Contracts;

/**
 * Interface ResponseRepository
 *
 * @package App\Repositories\Eloquent\Contracts
 */
interface ResponseRepository
{
    /**
     * Persists a response in storage.
     */
    public function storeResponse();
}
