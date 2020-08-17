<?php

namespace App\Services\Parsers\File;

use App\Services\Parsers\Contracts\ParserContract;

use Illuminate\Support\Collection;
use League\Csv\Reader;

use Exception;

/**
 * Class Parser used League\Csv\Reader to read the given file
 * this can be changed with other file reader, reason for using this is offers streaming on files
 * therefore can be used to read a large dataset(s).
 *
 * @package App\Services\Parsers\File
 */
abstract class Parser implements ParserContract
{
    /**
     * Array With file data/records
     *
     * @var Collection $records
     */
    protected Collection $records;

    /**
     * Array with files to parse
     *
     * @var Reader
     */
    private Reader $fileReader;

    /**
     * Return count of records
     *
     * @return int
     */
    public abstract function count(): int;

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->records()->toArray();
    }

    /**
     * Returns Array with records
     *
     * @return Collection
     */
    public abstract function records(): Collection;

    /**
     * @param string $path
     */
    protected function setFile(string $path): void
    {
        try
        {
            // create file stream
            $this->fileReader = Reader::createFromPath($path, 'r');
        }
        catch (Exception $ex)
        {
            // do something with the exception
        }
    }

    /**
     * @throws \League\Csv\Exception
     */
    protected function setStreamFilters()
    {
        // convert to utf 8
        if ($this->fileReader->getInputBOM() === Reader::BOM_UTF16_LE ||
            $this->fileReader->getInputBOM() === Reader::BOM_UTF16_BE) {
            $this->fileReader->addStreamFilter('convert.iconv.UTF-16/UTF-8');
        }
    }

    /**
     *  Get the File Reader/Parser
     */
    protected function getFileReader()
    {
        return $this->fileReader;
    }

    /**
     * Parse the records into a Collection
     */
    protected abstract function parseRecords(): void;
}