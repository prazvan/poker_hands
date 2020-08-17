<?php

namespace App\Services\Parsers\Contracts;

use Illuminate\Support\Collection;
use JsonSerializable;

/**
 * Interface ParserContract
 *
 * @package App\Services\Parsers\File\Contracts
 */
interface ParserContract extends JsonSerializable
{
    public const DELIMITER = " ";

    /**
     * Process give file
     */
    public function process(): void;

    /**
     * Returns Array with records
     *
     * @return Collection
     */
    public function records(): Collection;

    /**
     * Return count of records
     *
     * @return int
     */
    public function count(): int;

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize();
}