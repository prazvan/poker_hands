<?php

namespace App\Services\Parsers\File;

use Exception;
use Illuminate\Support\Collection;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class FileService
 * @package App\Services\Parsers\File
 */
final class FileService extends Parser
{
    /**
     * Process file
     *
     * @param string|null $file
     */
    public function process(string $file = null): void
    {
        // no file given throw exception
        if (!$file) throw new NotFoundResourceException;

        $this->setFile($file);

        $this->parseRecords();
    }

    /**
     * Returns Collection with records
     *
     * @return Collection
     */
    public function records(): Collection
    {
        return $this->records;
    }

    /**
     * Get Records count
     *
     * @return int
     */
    public function count():int
    {
        return $this->records->count();
    }

    /**
     * Parse the records into a Collection,
     * Here there can be some more validation or data parsing.
     *
     * @return void
     */
    protected function parseRecords(): void
    {
        try
        {
            // make records collection
            $this->records = Collection::make();

            //$this->setStreamFilters();

            foreach ($this->getFileReader() as $record)
            {
                $this->records->add($record[0]);
            }
        }
        catch (Exception $ex)
        {
            // do something with the ex
        }
    }
}