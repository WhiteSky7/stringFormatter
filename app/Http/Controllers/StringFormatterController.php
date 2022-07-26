<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    private function createCompareMap(Array $stringMap) 
    {
        $rawMap =  $stringMap;
        $compareMap = [];
        foreach($rawMap as $key => $value) {
            $compareMap[] = [$key => $value];
        }
        return $compareMap;
    }

    private function calculateHighSecondSymbol(Array $data) {
      
        $highFrequencyData = $data;
        $fisrtFrequencySymbol = null;
        $firstLetter = '';
        $secondFrequencySymbol = null;
        $secondLetter = '';

        foreach($highFrequencyData as $element) {
            foreach($element as $key => $value) {
                if($value > $fisrtFrequencySymbol && $key > $firstLetter ) {
                    $fisrtFrequencySymbol = $value;
                    $firstLetter = $key;
                } 
            }
        }
        foreach($highFrequencyData as $element) {
            foreach($element as $key => $value) {
                if($value > $secondFrequencySymbol && $value < $fisrtFrequencySymbol && $key > $secondLetter) {
                    $secondFrequencySymbol = $value;
                    $secondLetter = $key;
                }
            }    
        }

        return [$secondLetter, $secondFrequencySymbol] ;
    }
    
   
    
    public function getPopularSymbol(Request $request): String {
        
        $formatString = $request['data2'];
        $stringMap = [];
        $compareMap = [];
        $targetValue = null;
        $output = '';   

        $stringMap = $this->createStringMap($formatString);
        $length = strlen($formatString);

        for($i = 0; $i < $length; $i++) {
            if($formatString[$i] == $this->checkData($formatString[$i], $stringMap) ) {
                $stringMap[$formatString[$i]] ++;
            }
        }
       $compareMap = $this->createCompareMap($stringMap);
       $targetValue = $this->calculateHighSecondSymbol($compareMap);

        if ($targetValue[1] == null) {
            $output = 'В строке нет второго по встречаяемости символа';
        }
        if ($targetValue[1] != null) {
            $output = 'Символ '. $targetValue[0] . ' второй по популярности и встречается '. $targetValue[1] . ' раза';
        }
       // return $targetValue;
        return $output;
    }

    public function checkPalindrome(Request $request): String {
        $checkWord = $request['$data'];

        $length = 
        for($i = 0;)
    }

}
