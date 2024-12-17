<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    header("Location:../index.php");
if(isset($_POST['email']))
{
    $new_email=$_POST['email'];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM users WHERE ID='{$_SESSION["LOG-IN"]}';"; 
    $resoult=mysqli_query($connect,$sql);
    $how_many=mysqli_num_rows($resoult);
    $email_pattern="/.+@+.+/";
    if($how_many==1)
    {
        $row=mysqli_fetch_assoc($resoult);
        $old_email=$row['Email'];
        if($new_email!=$old_email)
        {
            if(preg_match($email_pattern, $new_email))
            {
                $sql="SELECT * FROM users WHERE Email='$new_email';";
                $resoult=mysqli_query($connect,$sql);
                $how_many=mysqli_num_rows($resoult);
                if($how_many==0)
                {
                    $sql="UPDATE users SET Email='{$new_email}' WHERE ID='{$_SESSION["LOG-IN"]}';";
                    mysqli_query($connect,$sql);
                    header("Location:index.php");
                }
                else
                {
                    $_SESSION["email_change_error"]=2;
                    header("Location:email.php"); 
                }
            }
            else
            {
                $_SESSION["email_change_error"]=1;
                header("Location:email.php"); 
            }

        }
        else
            header("Location:index.php");
    }
    else
        header("Location:index.php");

}
?>