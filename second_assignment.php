<?php
    if(!empty($_GET['save']))
    {
    	$getid=$_GET['i'];
    	$getname=$_GET['n'];
    	$getclass=$_GET['cl'];
    	$getmarks=$_GET['m1'];	
    	$fn="json/second_assignment.json";

         //     JSON FILE

        if (file_exists($fn)) 
        {
        $cd=file_get_contents($fn);
        $ad=json_decode($cd, true);
    	$na=array(
    		'Id' => $getid,
    		'Name' => $getname,
    		'Class' => $getclass,
    		'Marks' => $getmarks, 
    	);
    	$ad[]=$na;

    	$jdata=json_encode($ad, JSON_PRETTY_PRINT);
      
        if(file_put_contents($fn, $jdata))
        {
    	    echo "Created";
        }
        else
        {
    	    echo "Not Created";
        }

        }

        }
        else
        {
        	echo "Not Exit";
        }

        //   Display Data
        
        $fn="json/second_assignment.json";
        $cd = file_get_contents($fn); 
        $ad = json_decode($cd); 
        // print_r($ad);


        //         Delete Data

        $fn="json/second_assignment.json";
        if(!empty($_GET['did']))
        {
        $id=$_GET['did'];
        $cd = file_get_contents($fn);
        $ad_arr = json_decode($cd, true);

        $arr_index = array();
        foreach ($ad_arr as $key => $value)
        {
          if ($value['Id'] == $id) 
          {
              $arr_index[] = $key;
          }
        }

        foreach ($arr_index as $i) 
        {
           unset($ad_arr[$i]);
        }
        $ad_arr = array_values($ad_arr);
        file_put_contents($fn, json_encode($ad_arr,JSON_PRETTY_PRINT));
        header("Location: http://localhost/php/second_assignment.php");
        die();
        }

        //  EDIT

        
        if(isset($_GET['index'])){
   
        $index = $_GET['index'];
        //print_r($index);
        $data = file_get_contents('json/second_assignment.json');
        $data_array = json_decode($data,true);
        $ro = $data_array[$index];
        //print_r( $ro);
        }
    
    

        //     UPDATE


        if(isset($_GET['update']))
        {
            $index = $_GET['index'];
            $data = file_get_contents('json/second_assignment.json');
            $data_array = json_decode($data,true);
            $na=array(
                'Id' => $getid,
                'Name' => $getname,
                'Class' => $getclass,
                'Marks' => $getmarks, 
            );
            $data_array[$index]=$na;
            $data=json_encode($data_array,JSON_PRETTY_PRINT);
            file_put_contents('second_assignment.json', $data);
         
        }
 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Second Assignment</title>
</head>
<body>
	<form method="get" action="">
		<input type="hidden" name="editid" value="<?php if(!empty($ro['name'])) echo $ro['Id'] ?>"><br/><br/>
		Enter Id : <input type="id" value="<?php if(!empty($ro['Id'])) echo $ro['Id'] ?>" name="i" required/><br/><br/>
		Enter Name : <input type="text" value="<?php if(!empty($ro['Name'])) echo $ro['Name'] ?>" name="n" required/><br/><br/>
		Enter Class : <input type="text" value="<?php if(!empty($ro['Class'])) echo $ro['Class'] ?>" name="cl" required/><br/><br/>
		Enter Marks : <input type="text" value="<?php if(!empty($ro['Marks'])) echo $ro['Marks'] ?>" name="m1" required/><br/><br/>
		<input type="submit" name="save" value="Save the Form"/>
		<input type="submit" name="update" value="Update"/>
		<input type="submit" name="cancel" value="Cancel"/><br/><br/>
	</form>
	<table border="1" width="80%">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Class</th>
			<th>Marks</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
		 
        <?php
    //$fn="json/second_assignment.json";
        $cd = file_get_contents('json/second_assignment.json'); 
        $ad = json_decode($cd); 
        $index=0;    
        foreach ($ad as $ad) { ?>
       <tr>
           <td> <?= $ad->Id;?> </td>    
           <td> <?= $ad->Name; ?> </td>
           <td> <?= $ad->Class; ?> </td>
           <td> <?= $ad->Marks; ?> </td>
           <td><a href="second_assignment.php?did=<?= $ad->Id; ?>">Delete</a></td>
           <td><a href='second_two_assignment.php?index=<?= $index ?>'>Edit</a></td>

      </tr>

        <?php 
        $index++;

    }
                ?>
		
	</table>
	<br/>

	

</body>
</html>