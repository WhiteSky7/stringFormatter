<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class StringFormatterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    private function checkData(String $s, Array $map) {
        $stringMap = $map;
        $data = $s;
        foreach($stringMap as $value => $key) {
            if($data == $value) {
                return $value;
            }
        }
    }

    private function createStringMap(String $s): Array {
        $data = $s;
        $output = [];
        $length = strlen($data);
        for($i = 0; $i < $length ; $i++) {
          if ( $data[$i] !== $this->checkData($data[$i], $output)) {
            $output[$data[$i]] = 0;
          }
        }
        return $output;
    }
    
    public function getPopularSymbol(Request $request) {
        
        $formatString = $request['data'];
        $dataArray = ["aaagggaabbbbccccccc"];
        $compareArray = [];
        
        $this->createStringMap($formatString);
        $length = strlen($formatString);

        for($i = 0; $i < $length; $i++) {
            if($formatString[$i] == $formatString[$i + 1]) {
                $compareArray[0] + 1; 
            }
            if($formatString[$i] != $formatString[$i + 1]) {

            }
        }
        
        return $compareArray;
    }

    public function checkPalindrome() {
        return 'Palindrome';
    }
}
