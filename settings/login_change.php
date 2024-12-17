<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    header("Location:../index.php");
if(isset($_POST['login']))
{
    $new_login=$_POST['login'];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM users WHERE ID='{$_SESSION["LOG-IN"]}';"; 
    $resoult=mysqli_query($connect,$sql);
    $how_many=mysqli_num_rows($resoult);
    if($how_many==1)
    {
        $row=mysqli_fetch_assoc($resoult);
        $old_login=$row['Login'];
        if($new_login!=$old_login)
        {
            if(strlen($new_login)>7)
            {
                $sql="SELECT * FROM users WHERE Login='$new_login';";
                $resoult=mysqli_query($connect,$sql);
                $how_many=mysqli_num_rows($resoult);
                if($how_many==0)
                {
                    $sql="UPDATE users SET Login='{$new_login}' WHERE ID='{$_SESSION["LOG-IN"]}';";
                    mysqli_query($connect,$sql);
                    header("Location:index.php");
                }
                else
                {
                    $_SESSION["login_change_error"]=2;
                    header("Location:login.php"); 
                }
            }
            else
            {
                $_SESSION["login_change_error"]=1;
                header("Location:login.php"); 
            }

        }
        else
            header("Location:index.php");  
    }
    else
        header("Location:index.php");
}

?>