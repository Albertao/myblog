<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class commentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'articleId' => 'required|integer',
            'parentId'  => 'required|integer',
            'author'    => 'required|max:255',
            'comment'   => 'required|max:255'
        ];
    }
}
