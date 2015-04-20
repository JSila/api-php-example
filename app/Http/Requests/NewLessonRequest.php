<?php namespace App\Http\Requests;

use App\Http\RespondsTrait;

class NewLessonRequest extends Request {

    use RespondsTrait;

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
            'body' => 'required'
		];
	}

    public function forbiddenResponse()
    {
        return $this->respondForbidden('Not authorized to store a lesson.');
    }

    public function response(array $errors)
    {
        return $this->respondUnprocessableEntity('Validation for storing a lesson failed');
    }
}
