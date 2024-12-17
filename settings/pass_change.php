<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    header("Location:../index.php");
if(isset($_POST['old_pass'])&&isset($_POST['new_pass'])&&isset($_POST['repeat_pass']))
{
    $old_pass=$_POST['old_pass'];
    $new_pass=$_POST['new_pass'];
    $repeat_pass=$_POST['repeat_pass'];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM users WHERE ID='{$_SESSION["LOG-IN"]}';"; 
    $resoult=mysqli_query($connect,$sql);
    $how_many=mysqli_num_rows($resoult);

    $pass_patern1="/.*[A-Z]+.*/";
    $pass_patern2="/.*[a-z]+.*/";
    $pass_patern3="/.*[0-9]+.*/";
    $pass_patern4="/.*[!@#$%^&*()]+.*/";

    if($how_many==1&&$old_pass!=null)
    {
        $old_pass=hash("sha256",$old_pass);
        $row=mysqli_fetch_assoc($resoult);
        $check_old_pass=$row['Password'];
        if($old_pass==$check_old_pass)
        {
            if($new_pass==$repeat_pass)
            {
                if(preg_match($pass_patern1,$new_password)&&preg_match($pass_patern2,$new_password)&&preg_match($pass_patern3,$new_password)&&preg_match($pass_patern4,$new_password)&&(strlen($new_password)>11))
                {
                    $sql="UPDATE users SET Email='{$new_email}' WHERE ID='{$_SESSION["LOG-IN"]}';";
                    mysqli_query($connect,$sql);
                    header("Location:index.php");
                }
                else
                {
                    $_SESSION["pass_change_error"]=3;
                    header("Location:pass.php"); 
                }
            }
            else
            {
                $_SESSION["pass_change_error"]=2;
                header("Location:pass.php"); 
            }

        }
        else
        {
            $_SESSION["pass_change_error"]=1;
            header("Location:pass.php"); 
        }
    }
    else
        header("Location:index.php");

}
?>