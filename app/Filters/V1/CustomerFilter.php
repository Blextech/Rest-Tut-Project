<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter ;

use Illuminate\Http\Request ;


class CustomerFilter extends ApiFilter {
//first rule of user input is not to trust user input
protected $allowedParms =[
    'name' => ['eq'],
    'type' => ['eq'],
    'email' => ['eq'],
    'address' => ['eq'],
    'city' => ['eq'],
    'state' => ['eq'],
    'postalCode' => ['eq', 'gt', 'lt'] //eq is equal = , gt is greater than > , lt is lesser than <

];
protected $columnMap =['postalCode' => 'postal_code'];

//transforming our operator from string
protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>=' // there is still many operator supported you can use as many as you like 
];

// public function transform(Request $request){
// $eloQuery = [];
// foreach($this->allowedParms as $parm => $operators ){
//     $query = $request->query($parm);

//     if(!isset($query)){
//         continue ;
//     }

//     $column = $this->columnMap[$parm] ?? $parm ;// incase there is no value we provided the deafult
//     foreach ($operators as $operator ){
//         if(isset($query[$operator])){
//             $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
//         }
//     }

// }


// return $eloQuery ;
// }

}