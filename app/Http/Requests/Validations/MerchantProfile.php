<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class MerchantProfile extends Request
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
    	$user_id = Request::user()->id; //Get current user's shop_id
        Request::merge(['user_id' => $user_id]); //Set shop_id
        return [
           'name' => 'required',
           'exprience' => 'nullable',
           'description' => 'required',
           'location' => 'required',
           'lastdelivery' => 'required',
           'profile' => 'mimes:jpeg,jpg,png,gif',
           'cover' => 'mimes:jpeg,jpg,png,gif'
        ];
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address_type.composite_unique' => trans('validation.composite_unique'),
        ];
    }
}
