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
        if(is_string($s)) {
            if(is_array($map)) {
                
                $stringMap = $map;
                $data = $s;
                foreach($stringMap as $value => $key) {
                    if($data == $value) {
                        return $value;
                    }
                }
            }
        }
    }

    private function createStringMap(String $s): Array {

        if(is_string($s)) {

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
    }

    private function createCompareMap(Array $stringMap): Array {
        if(is_array($stringMap)) {

            $rawMap =  $stringMap;
            $compareMap = [];
            foreach($rawMap as $key => $value) {
                $compareMap[] = [$key => $value];
            }
            return $compareMap;
        }
    }

    private function calculateHighSecondSymbol(Array $data): Array {
      if(is_array($data)) {

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
    }
    
   
    
    public function getPopularSymbol(Request $request): String {
       
        if(is_string($request['data']))  {

           $formatString = $request['data'];
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
            
            return response()->json(['response' => $output],200);
        }
    }

    public function checkPalindrome(Request $request): String {
        if(is_string($request['data'])) {
            $checkWord = $request['data'];
            $length = mb_strlen($checkWord);
            $output = '';
            
            $output = $this->compareWord($checkWord, $length);
            
            return response()->json(['response' => $output],200);
        }
    }

    private function compareWord(String $s, Int $len) {
       
        if(is_string($s)) {
            if(is_int($len)) {

                $checkWord = $s;
                $length = $len;
                $firstHalf = '';
                $secondHalf = '';
                for($i = 0; $i < $length/2; $i++) {
                    $firstHalf .= $checkWord[$i];
                }
                for($i = $length; $i > $length / 2 ; $i--) {
                    $secondHalf .= $checkWord[$i - 1];
                }
                if($firstHalf == $secondHalf) {
                    return 'палиндром';
                }
                if($firstHalf != $secondHalf) {
                    return 'не палиндром';
                }
            }
        }

    }

}
