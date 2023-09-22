<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter ;

use Illuminate\Http\Request ;


class InvoiceFilter extends ApiFilter {
//first rule of user input is not to trust user input

protected $allowedParms =[
    'customerId' => ['eq'],
    'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    'status' => ['eq', 'ne'],
    'billedDate' =>  ['eq', 'lt', 'gt', 'lte', 'gte'],
    'paidDate' =>  ['eq', 'lt', 'gt', 'lte', 'gte'] //eq is equal = , gt is greater than > , lt is lesser than <

];
protected $columnMap =['customerId' => 'customer_id', 'billedDate' => 'billed_date',
'paidDate' => 'paid_date'];

//transforming our operator from string
protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>=' ,
    'ne' => '!='// there is still many operator supported you can use as many as you like 
];



}