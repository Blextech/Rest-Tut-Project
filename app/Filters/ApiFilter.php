<?php

namespace App\Filters;

use Illuminate\Http\Request ;


class ApiFilter {
//first rule of user input is not to trust user input
protected $allowedParms =[
   
];
protected $columnMap =[];

//transforming our operator from string
protected $operatorMap = [
   
];

public function transform(Request $request){
$eloQuery = [];
foreach($this->allowedParms as $parm => $operators ){
    $query = $request->query($parm);

    if(!isset($query)){
        continue ;
    }

    $column = $this->columnMap[$parm] ?? $parm ;// incase there is no value we provided the deafult
    foreach ($operators as $operator ){
        if(isset($query[$operator])){
            $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
        }
    }

}


return $eloQuery ;
}

}