<?php
    namespace Sfp;

    class Fibonacci {    
        
        private $arr, $flag, $resultArray, $checkincludesAll;

        // ctor
        public function __construct() {
            $this->arr = [];
            $this->flag = false;
            $this->resultArray = [];
            $this->checkincludesAll = false;
        }

        /*
         * open and get data in the file
         * sort the data in ascending order
         * check all the data in the file is fibonacci or not
         * set the array that starts with lowest fibonacci in the dataset
         * return array of 10 int of fibonacci. 
         * if the dataset is invalid range, print error msg
         */
        function execute() { 
            $handle = fopen("../assets/fibonacci.csv", "r"); 
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { 
                $num = count($data); 
                
                for ($i = 0; $i < $num; $i++) {         
                    $tmp = (int) $data[$i];
                    array_push($this->arr, $tmp);
                } 
            } 

            fclose($handle);
            
            // sort in ascending order
            sort($this->arr);

            // check all numbers are fibonacci or not
            $this->checkFibo($this->arr);

            $this->setFibo($this->arr[0]);

            if($this->checkincludesAll) {
                return $this->resultArray;
            }
            else {
                echo 'Invalid Range Error';
            }
        }

        // check all the elements in the array are fibonacci or not
        // if any of the number in the array is not fibonacci print error msg 
        function checkFibo($arr) {
            $arrSize = count($this->arr);

            for ($i = 0; $i < $arrSize; $i++) {  
                $this->isFibo($this->arr[$i]);
            }
           
            if(!$this->flag) {
                echo 'Invalid Input Error';
            }
        }

        // check the number is either fibonacci or not
        function isFibo($param) { 
            if($this->checkSquare(5 * $param * $param + 4)) {
                $this->flag = true;
                return true;
            }
            else if($this->checkSquare(5 * $param * $param - 4)) {
                $this->flag = true;
                return true;
            }
            else {
                $this->flag = false;
                return false;
            }
        } 

        // check with the formula of fibonacci numbers
        function checkSquare($x) { 
            $s = (int) (sqrt($x)); 

            if($s * $s == $x) {
                $this->flag = true;
                return true;
            }
            else {
                $this->flag = false;
                return false;
            }
        } 

        // set the array that starts with lowest fibonacci in the dataset
        function setFibo($num) { 
            $first = 0; 
            $second = 1;
            $prev = 0;
            $beginIndex = 0;
            
            while(1) {
                if($num === $second) {
                    break;
                }
                $tmp = $second + $first; 
                $first = $second; 
                $second = $tmp; 
                $beginIndex = $beginIndex + 1;
            }
          
            $third = $first + $second;
            array_push($this->resultArray, $second, $third);

            for($j = 2; $j < 10; $j++) {
                $num1 = $this->resultArray[$j - 2];
                $num2 = $this->resultArray[$j - 1];

                $tmp = $num1 + $num2;
               
                array_push($this->resultArray, $tmp);
            }
            
            // Double check that all datas in the range of 10 int array
            $this->checkincludesAll = !array_diff($this->arr , $this->resultArray);
        } 

    }

    // Test Function
    // $fibonacci = new Fibonacci();
    // var_dump($fibonacci->execute());
   
?>