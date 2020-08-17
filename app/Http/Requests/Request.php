<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * TODO: here we can add logic to see if the user has rights for example
     *
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
