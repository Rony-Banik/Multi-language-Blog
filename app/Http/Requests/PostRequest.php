<?php

namespace App\Http\Requests;

class PostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->blog ? ',' . $this->blog : '';
        return [
            'title_en' => 'bail|required|max:255',
            'title_bn' => 'bail|required|max:255',
            'summary_en' => 'bail|required|max:65000',
            'summary_bn' => 'bail|required|max:65000',
            'content_en' => 'bail|required|max:65000',
            'content_bn' => 'bail|required|max:65000',
            'slug' => 'bail|required|max:255|unique:posts,slug' . $id,
            'tags' => ['regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/'],
        ];
    }
}
