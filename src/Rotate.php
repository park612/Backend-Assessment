<?php
    namespace Sfp;

    class Rotate { 
        
        public $shift, $arr, $arrSize;
        
        // ctor
        public function __construct($param) {
            // read json file
            $arr = json_decode(file_get_contents('../assets/rotate.json'), true);
            
            $this->arr = $arr; # json to array
            $this->arrSize = count($arr); # size of array
            $this->shift = $param; # number of shift
        }

        // calling function
        function execute() {
            // call left rotate
            $this->leftRotate($this->arr, $this->shift, $this->arrSize);
            
            // return result
            return $this->arr;
        }

        // function that loops number of shifts
        function leftRotate(&$arr, $shift, $n) { 
            
            for ($i = 0; $i < $shift; $i++) {
                $this->leftOneRotate($arr, $n); 
            }
           
            return $arr;
        } 

        // function that left rotate one time
        function leftOneRotate(&$arr, $n) { 
           
            $temp = $arr[0]; # store first value;

            //store value in original index -1
            for ($i = 0; $i < $n - 1; $i++) {
                $arr[$i] = $arr[$i + 1]; 
            }
            
            $arr[$i] = $temp; #last index get first value in original array
            
            return $arr;
        } 
    }

    // Extend Class that extends Rotate class
    class Extend extends Rotate {
        
        // Ctor to pass parent ctor 
        function __construct($param) {
            parent::__construct($param);
        }

        // returns the last element in the array
        function extend() {
            $lastString = $this->arr[$this->arrSize - 1];           
            return $lastString;
        }
    }
    
    // Test function
    // echo '@@@@@@@@@@@@<br \>';
    // $obj1 = new Rotate(3);
    // var_dump($obj1->execute());
   
    // $obj = new Extend(3);
    // var_dump($obj->extend());
?>