<?php
    if ((($_FILES["file"]["type"] == "image/png")
         || ($_FILES["file"]["type"] == "image/jpg")
         || ($_FILES["file"]["type"] == "image/jpeg"))
        && ($_FILES["file"]["size"] < 200000))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            

								$imagePath = dirname(__FILE__) . "/upload/" . $_FILES["file"]["name"];
								
                move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath);
                
                echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
        }
    }
    else
    {
        echo "Invalid file";
    }
    
    $con = mysql_connect("localhost","root","");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    
    mysql_select_db("test", $con);
    
    mysql_query("INSERT INTO TestTable (Name)
                VALUES ('{$imagePath}')");
                            
    mysql_close($con);
?>