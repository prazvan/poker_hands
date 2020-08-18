<?php

namespace App\Http\Controllers;

use App\Services\Reports\ReportsService;
use App\Services\Reports\Types\Poker as PokerReport;
use Exception;

use Symfony\Component\Translation\Exception\NotFoundResourceException;
use App\Http\Requests\ProcessUploadFilesRequest;

use App\Services\Parsers\{
    File\FileService
};

use Illuminate\Http\{
    Response,
    UploadedFile
};

/**
 * Process uploads
 *
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    /**
     * @var FileService
     */
    private FileService $fileService;

    /**
     * @var ReportsService
     */
    private $ReportsService;

    /**
     * UploadController constructor.
     *
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        parent::__construct();

        // set file service
        $this->fileService = $fileService;

        // get the PokerReport service
        $this->ReportsService = ReportsService::make(PokerReport::class);
    }

    /**
     * Process upload.
     *
     * for validation @see ProcessUploadFilesRequest
     *
     * @param ProcessUploadFilesRequest $Request
     *
     * @param Response $Response
     * @return Response
     */
    public function process(ProcessUploadFilesRequest $Request, Response $Response): Response
    {
        try
        {
            // if we dont have files throw exception
            if ($Request->files->count() == 0)
            {
                throw new NotFoundResourceException;
            }

            /**
             * Parse each file
             *
             * @var UploadedFile $file
             */
            foreach ($Request->allFiles() as $key => $file)
            {
                // process file
                $this->fileService->process($file);

                // start report generating
                $this->ReportsService
                    ->setDataCollection($this->fileService->records())
                    ->process();
            }

            $result = [
                'result_code' => 200,
                'success' => true,
                'data'    => [
                    'report_id'     => $this->ReportsService->getReportId(),
                    'records_count' => $this->ReportsService->getRecordsCount(),
                ],
                'error'   => []
            ];
        }
        catch (Exception $exception)
        {
            // best practice is to create an Error Bag for the exception(s)
            // for now this will do.
            // also error handaling should be done on a lower level :)
            $result  = [
                'result_code' => 400,
                'success'   => false,
                'errors'      => [
                    'file'  => [
                        'Invalid Data!'
                    ]
                ],
                'message'     => $exception->getMessage(),
            ];
        }

        // this should be wrapped into a Response wrapper or trait
        // so we don't have to set the header and encode the payload in each method,
        // but for the saks of the test it's ok :)
        return $Response
            ->header('Content-Type',  'application/json')
            ->setStatusCode($result['result_code'])
            ->setContent(json_encode($result));
    }
}