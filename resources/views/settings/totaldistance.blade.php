@include('templates.config')


<?php
	$conn = connect();
	//script for uploading total distance
    if(isset($_POST['tot_dist']) && ($q = 'totdistance'))
    {
         $fname = $_FILES['sel_tot_dist_file']['name'];
         echo 'upload file name: '.$fname.' ';
         $chk_ext = explode(".",$fname);
        
         if(strtolower(end($chk_ext)) == "csv")
         {      
             $filename = $_FILES['sel_tot_dist_file']['tmp_name'];
             $handle = fopen($filename, "r");
       
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {
                $sql = "INSERT into totaldistance(vehicle, starttime, stoptime, beginingmileage, endmileage, totaldistance) 
				values('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]')";
                mysqli_query($conn, $sql) or die(mysqli_error($conn));
             }
             fclose($handle);
             echo "Successfully Imported";          
         }
         else
         {
             echo "Invalid File";
         }   
    }
    
    
    ?>


