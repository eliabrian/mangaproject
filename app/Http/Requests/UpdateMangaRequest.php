<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateMangaRequest extends FormRequest
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
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:mangas,slug,' . $this->manga->id,
            'status' => 'required|in:ongoing,completed',
            'summary' => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        if(empty($this->slug)){
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }else{
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        }
    }
}
