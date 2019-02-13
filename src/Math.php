<?php
    namespace Sfp;

    class Math {    

        private $result;

        public function __construct() {
            $this->result = 0;
        }

        // returns the average of true values
        function execute() { 
            $handle = fopen("../assets/tabular.csv", "r"); 
            
            $row = 1;
            $counter = 0;
            $sum = 0;
            $avg = 0;
           
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { 
                $num = count($data); 
               
                for ($c = 0; $c < $num; $c++) { 
                    // check first line
                    if($row == 1) {
                        // check second col and third col is right
                        if($data[1] === "value" && $data[2] === "accept") {
                            continue;
                        }
                        else {
                            echo "Error";
                            break;
                        }
                    }
                    else {
                        if($data[2] === "TRUE") {
                            $counter++;
                            $sum += $data[1];

                            break;
                        }
                    }
                }
                
                $row++; 
            }
            
            fclose($handle); 

            $avg = $sum / $counter; # get the average 
            $avg = doubleval($avg); # make it double
            $result = (double) number_format($avg, 10, '.', ''); # 10 decimals
           
            return $result;
        }
    }

    // Test function
    // $obj = new Math();
    // var_dump($obj->execute());
    // echo "<br \>";
    // print($obj->execute());
   
?>