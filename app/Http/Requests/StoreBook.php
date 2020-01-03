<?php

namespace App\Http\Requests;

use App\Enums\BookStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreBook extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'blurb' => 'nullable',
            'status' => 'required|enum_key:' . BookStatus::class
        ];
    }
    
    /**
     * Prepare/format the request params before inserting into the database.
     *
     * @return mixed
     */
    public function prepared()
    {
        return $this->input();
    }
}
