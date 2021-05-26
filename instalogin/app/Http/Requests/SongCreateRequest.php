<?php

namespace App\Http\Requests;

use App\Rules\SongThrottle;
use App\Rules\SongUrl;
use Illuminate\Foundation\Http\FormRequest;

class SongCreateRequest extends FormRequest
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
            'song_url' => ['required', new SongUrl()],
            'title' => ['required', 'max:60', 'min:3', new SongThrottle()],
        ];
    }
}
