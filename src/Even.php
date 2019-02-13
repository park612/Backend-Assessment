<?php
    namespace Sfp;

    class Even {

        function execute() { 
            $handle = fopen("../assets/numbers.csv", "r"); 
            $counter = 0; #counts number of evens
            
            //get data from file
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { 
                $numData = count($data); #num data in line

                for ($i = 0; $i < $numData; $i++) { 
                    //check the number is even or not
                    if($data[$i] % 2 == 0) { 
                        //increase if number is even
                        $counter++; 
                    } 
                } 
            } 

            fclose($handle); 

            return $counter;
        }
    }

    // Test function
    // $obj = new Even();
    // var_dump($obj->execute());
    // echo "<br \>";
    // print($obj->execute());

?>