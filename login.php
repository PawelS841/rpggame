<?php
if(isset($_POST["Login"]) && isset($_POST["Password"]))
{   
    session_start();
    $L=$_POST["Login"];
    $P=$_POST["Password"];

    $_SESSION["Login_error"]=0;
    if(empty($_POST["Login"]))
        $_SESSION["Login_error"]=1;
    if(empty($_POST["Password"]))
        $_SESSION["Login_error"]=1;

    if($_SESSION["Login_error"]==0)
    {
        $P=hash("sha256",$P);
        $connect=mysqli_connect("localhost","root","","rpg");
        $sql="SELECT ID FROM users WHERE Login='{$L}'AND Password='{$P}';"; 
        $resoult=mysqli_query($connect,$sql);
        $data_check=mysqli_num_rows($resoult);
        if($data_check==1)
        {
            while($row=mysqli_fetch_assoc($resoult))
                $_SESSION["LOG-IN"]=$row["ID"];
            mysqli_close($connect);
            header("Location:character");
        }
        else{
            mysqli_close($connect);
            $_SESSION["Login_error"]=2;
            header("Location:index.php");
        }
        
    }    
    else
        header("Location:index.php");
}
?>