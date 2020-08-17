<?php

namespace App\Services\Reports;

use App\Services\Reports\Contracts\ReportContract;
use Illuminate\Support\Collection;

/**
 * Class ReportsService
 * @package App\Services\Reports
 */
final class ReportsService
{
    /**
     * Data to parse
     *
     * @var Collection $dataCollection
     */
    protected Collection $dataCollection;

    /**
     * @var ReportContract $report
     */
    protected $report;

    /**
     * Id of the report generated
     *
     * @var int $report_id
     */
    private int $report_id;

    /**
     * Number of records in the report
     *
     * @var int $records_count
     */
    private int $records_count;

    /**
     * ReportsService constructor.
     * @param $ReportType
     */
    protected function __construct($ReportType)
    {
        $this->report = $ReportType;
    }

    /**
     * @param $ReportType
     *
     * @return self
     */
    public static function make($ReportType): self
    {
        return new static($ReportType);
    }

    /**
     * Get Current User's Reports
     *
     * @return Collection
     */
    public function getCurrentUserReports(): Collection
    {
        // init report and access the repo
        return (new $this->report(Collection::make()))
            ->getReportsForUser(auth()->user()->id);
    }

    /**
     * Set Data Collection
     *
     * @param Collection $collection
     * @return $this
     */
    public function setDataCollection(Collection $collection): self
    {
        $this->dataCollection = $collection;
        return $this;
    }

    /**
     * Get Report ID
     *
     * @return int
     */
    public function getReportId(): int
    {
        return $this->report_id;
    }

    /**
     * Get Records Count
     *
     * @return int
     */
    public function getRecordsCount(): int
    {
        return $this->records_count;
    }

    /**
     * Process Given Report
     */
    public function process(): void
    {
        // process given report and get the data
        (new $this->report($this->dataCollection))->process(function($report_id, $records_count)
        {
            // set data
            $this->setReportId($report_id)
                ->setRecordsCount($records_count);
        });
    }

    /**
     * Set records Count
     *
     * @param $count
     *
     * @return ReportsService
     */
    private function setRecordsCount(int $count): self
    {
        $this->records_count = $count;
        return $this;
    }

    /**
     * @param $id
     * @return ReportsService
     */
    private function setReportId(int $id): self
    {
        $this->report_id = $id;
        return $this;
    }
}