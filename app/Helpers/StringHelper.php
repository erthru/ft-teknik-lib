<?php

use Illuminate\Support\Facades\DB;

if (!function_exists("findFine")){
    function findFine($borrowedDate, $returnedDate){
        $diff = date_diff(date_create($borrowedDate), date_create($returnedDate))->format("%a");
        $diffFixed = $diff > 7 ? $diff - 7 : 0;

        $fine = 0;

        if($diffFixed > 0) {
            $fine = $diffFixed * 1000;
        }

        return $fine;
    }
}

if(!function_exists("findLate")){
    function findLate($borrowedDate, $returnedDate){
        $diff = date_diff(date_create($borrowedDate), date_create($returnedDate))->format("%a");
        $diffFixed = $diff > 7 ? $diff - 7 : 0;

        return $diffFixed;
    }
}