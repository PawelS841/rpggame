<?php
if(isset($_POST["Email"]) && isset($_POST["Login"]) && isset($_POST["Password"]) && isset($_POST["Password_r"]))
{
        session_start();
        $_SESSION["error1"]=0;
        $_SESSION["error2"]=0;
        $_SESSION["error3"]=0;
        $_SESSION["error4"]=0;

        $E=$_POST["Email"];
        $L=$_POST["Login"];
        $P=$_POST["Password"];
        $P_r=$_POST["Password_r"];
        $_SESSION["E"]=$E;
        $_SESSION["L"]=$L;

        if(empty($_POST["Email"]))
            $_SESSION["error1"]=1;
        if(empty($_POST["Login"]))
            $_SESSION["error2"]=1;        
        if(empty($_POST["Password"]))
            $_SESSION["error3"]=1;
        if(empty($_POST["Password_r"]))
            $_SESSION["error4"]=1;

        if(($_SESSION["error1"]+$_SESSION["error2"]+$_SESSION["error3"]+$_SESSION["error4"])==0)
            {


                //sprawdzeniea emaila
                $email_pattern="/.+@+.+/";

                if(!preg_match($email_pattern,$E))
                    $_SESSION["error1"]=2;
                

                //sprawdzenie loginu
                $login_pattern="/.{8}/";

                if(!preg_match($login_pattern,$L))
                    $_SESSION["error2"]=2;
                

                //sprawdzenia hasła
                $pass_patern1="/.*[A-Z]+.*/";
                $pass_patern2="/.*[a-z]+.*/";
                $pass_patern3="/.*[0-9]+.*/";
                $pass_patern4="/.*[!@#$%^&*()]+.*/";

                if(!preg_match($pass_patern1,$P))
                    $_SESSION["error3"]=2;
                if(!preg_match($pass_patern2,$P))
                    $_SESSION["error3"]=2;
                if(!preg_match($pass_patern3,$P))
                    $_SESSION["error3"]=2;
                if(!preg_match($pass_patern4,$P))
                    $_SESSION["error3"]=2;
                if(strlen($P)<11)
                    $_SESSION["error3"]=2;


                //sprawdzenie zgodnosci haseł
                if($P!=$P_r)
                {
                    $_SESSION["error4"]=2;
                }


                if(($_SESSION["error1"]+$_SESSION["error2"]+$_SESSION["error3"]+$_SESSION["error4"])==0)
                {
                    $connect=mysqli_connect("localhost","root","","rpg");

                    $sql="SELECT * FROM users WHERE Login='$L';";
                    $resoult=mysqli_query($connect,$sql);
                    $L_r=mysqli_num_rows($resoult);
                    $sql="SELECT * FROM users WHERE Email='$E';";
                    $resoult=mysqli_query($connect,$sql);
                    $E_r=mysqli_num_rows($resoult);

                    if(($L_r+$E_r)==0)
                       {
                            $P=hash("sha256",$P);
                            $sql="INSERT INTO users VALUES (null,'$L','$E','$P','','','','','');";
                            mysqli_query($connect,$sql);

                            $sql="INSERT INTO statistic (ID) VALUES ('');";
                            mysqli_query($connect,$sql);

                            $sql="INSERT INTO skill (ID) VALUES ('');";
                            mysqli_query($connect,$sql);

                            $sql="INSERT INTO skill_xp (ID) VALUES ('');";
                            mysqli_query($connect,$sql);

                            $sql="INSERT INTO equipment (ID) VALUES ('');";
                            mysqli_query($connect,$sql);

                            $sql="SELECT ID FROM users WHERE Login='{$L}';"; 
                            $resoult=mysqli_query($connect,$sql);

                            while($row=mysqli_fetch_assoc($resoult))
                                $_SESSION["LOG-IN"]=$row["ID"];

                            $sql="INSERT INTO inventory (SID, user_ID) VALUES ('','{$_SESSION["LOG-IN"]}');";
                            for ($i=0; $i < 5; $i++) { 
                                mysqli_query($connect,$sql);
                            }
                            mysqli_close($connect);
                            header("Location:index.php");
                       }
                    else
                        {
                            mysqli_close($connect);
                            if($E_r!=0)
                                $_SESSION["error1"]=3;
                            if($L_r!=0)
                                $_SESSION["error2"]=3;
                            header("Location:register.php");
                        }
                        

                }
                else 
                    header("Location:register.php");

            }





        else
            header("Location:register.php");

}
?>