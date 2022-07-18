<?php

namespace App\Http\Requests\Subject;

use App\Helpers\Qs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubjectCreate extends FormRequest
{

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
            'name' => 'required|string|min:3',
            'my_class_id' => 'required',
            'teacher_id' => 'required',
            'slug' => 'nullable|string|min:3',
            'time_from' => 'required',
            'time_to' => 'required',
            'marks' => 'required',
            'days' => 'required',
        ];
    }

    public function attributes()
    {
        return  [
            'my_class_id' => 'Class',
            'teacher_id' => 'Teacher',
            'slug' => 'Short Name',
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();
        $input['school_id'] = Auth::user()->school_id;
        $input['days'] = json_encode($input['days']);
        // dd($input);
        // $input['teacher_id'] = Qs::hash($input['teacher_id']);
        // $input['teacher_id'] = $input['teacher_id'] ? Qs::decodeHash($input['teacher_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
