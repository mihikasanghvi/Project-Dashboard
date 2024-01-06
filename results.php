<?php
if($_post['request'])
{
        $conn = new mysqli('localhost','root','25102002','semp');
        if($conn->connect_error){
            die('Connection Failed :'.$conn->connect_error);
        }
        $request=$_POST['request'];
        $query = "select * from projects  where department='$request';"
        $query_run = mysqli_query($conn,$query);
		$check = mysqli_num_rows($query_run) > 0;
        if($check){
            while($row = mysqli_fetch_array($query_run))
                {
                    ?>
                        <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        </tr>
                    <?php   
                }
        }
        else{
            echo "No record found";
        }
    }
    ?>