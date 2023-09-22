<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;


class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' =>['required', 'integer'],
            '*.amount' =>['required', 'numeric'], //Anthing other than i and b will be rejected 
            '*.status' =>['required', Rule::in(['P', 'B', 'V','p', 'v', 'b'])],
            '*.billedDate' =>['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' =>['date_format:Y-m-d H:i:s', 'nullable'],
            
        ];
    }

    //since we are recieving camel case postalCode from client we need to turn it to postal_code for our database
    protected function prepareForValidation(){
       //since this is an array , this will be diffrent 
       $data =[];

       foreach($this->toArray() as $obj){

       $obj['customer_id'] = $obj['customerId'] ?? null ;
       $obj['billed_date'] = $obj['billedDate'] ?? null ;
       $obj['paid_date'] = $obj['paidDate'] ?? null ;

       $data[] = $obj ;
       }

       $this->merge($data);
    }
}
