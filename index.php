<?php

    $doc1 = "file1.txt";
    $doc2 = "file2.txt";

    $file_size1 = filesize($doc1);
    $file_size2 = filesize($doc2);

    if($file_size1){
        $file1 = file_get_contents($doc1);
        $file1 = explode("\n", $file1);
        $file1 = array_map("trim", $file1);
    }
    
    if($file_size2){
        $file2 = file_get_contents($doc2);
        $file2 = explode("\n", $file2);
        $file2 = $alias_file2 = array_map("trim", $file2);
    }
    

    $i = 1;

    if($file_size1 < 1 && $file_size2 < 1){
        echo "Both Files are Empty";
    }

    else if($file_size1 < 1 && $file_size2 > 1){
        print_file_data($file2, $i, "+");
    }
    
    else if($file_size1 > 1 && $file_size2 < 1){
        print_file_data($file1, $i, "-");
    }

    else{

        foreach($file1 as $key => $f1){
    
            if(!in_array($f1, $alias_file2)){
                
                if(array_key_exists($key, $alias_file2)){

                    if(!in_array($alias_file2[$key], $file1)){
                        echo "$i * $f1 | $alias_file2[$key]";
        
                        if (($index = array_search($f1, $alias_file2)) !== false) {
                            unset($file2[$index]);
                        }
                    }
                    else if(in_array($alias_file2[$key], $file1)){
                        echo "$i -$f1";
                    }
                }
                else{
                    echo "$i -$f1";
                }
            }

            else if(in_array($f1, $alias_file2)){

                echo "$i $f1";
                if (($index = array_search($f1, $alias_file2)) !== false) {
                    unset($file2[$index]);
                }
            }
            echo "<br>";
            $i++;
        }
    
        if($file2){
            print_file_data($file2, $i, "+");
        }
    }


    function print_file_data($data, $index, $sign = ''){
        foreach($data as $d){
            echo "$index $sign $d <br>"; 
            $index++;
        }
    }
?>
