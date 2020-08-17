<?php

namespace App\Http\Requests;

/**
 * Class ProcessUploadFilesRequest
 *
 * @package App\Http\Requests
 */
class ProcessUploadFilesRequest extends Request
{
    /**
     * Validation rules for upload,
     * only supports txt files and max size is 10mb
     *
     * For more Documentation see: https://laravel.com/docs/7.x/validation#available-validation-rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => 'mimes:txt|max:10000' // only txt and < 10mb
        ];
    }
}
