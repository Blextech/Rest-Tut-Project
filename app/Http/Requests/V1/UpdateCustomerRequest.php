<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;


class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == 'PUT'){
        return [
            'name' =>['required'],
            'type' =>['required', Rule::in(['I', 'B', 'i', 'b'])], //Anthing other than i and b will be rejected 
            'email' =>['required', 'email'],
            'address' =>['required'],
            'city' =>['required'],
            'state' =>['required'],
            'postalCode' =>['required'],
        ];
    }else{//i.e if the method is not PUT its definetly going to be patch .
        return [
            'name' =>['sometimes','required'],
            'type' =>['sometimes','required', Rule::in(['I', 'B', 'i', 'b'])], //Anthing other than i and b will be rejected 
            'email' =>['sometimes','required', 'email'],
            'address' =>['sometimes','required'],
            'city' =>['sometimes','required'],
            'state' =>['sometimes','required'],
            'postalCode' =>['sometimes','required'],
        ];
    }
    }

    //since we are recieving camel case postalCode from client we need to turn it to postal_code for our database
    protected function prepareForValidation(){
        if($this->postalCode){
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
    }
}

