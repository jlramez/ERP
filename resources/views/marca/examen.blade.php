// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A, $K)
 {
     print_r("Valor original de A:");
     print_r($A);
     $counter=count($A);
     $c=0;
    while($c<=$K)
    {
        print_r("el contador vale ".$c);
        print_r("nuevo valor de A :");
        print_r($A);
        if($new_array)
       {
        pint_r('existe new_array: ');
        print_r($new_array);
       }
        for($i=0;$i<=$counter;$i++)
        {
            if($i==$counter)
            $last=$A[$i-1];
        }
        $new_array=array($last);
        printf($new_array[0]." ya esta en la primera posicion");
        for($j=0;$j<$counter-1;$j++)
        {
            array_push($new_array, $A[$j]);
        }
        for($l=0;$l<=$counter-1;$l++)
        {
            unset($A[$l]);
            array_push($A, $new_array[$l]);
        }      
     
     print_r("nuevo_array:");
     print_r($new_array);
     $c++;
    }
}
