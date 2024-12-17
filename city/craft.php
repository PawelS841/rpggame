<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:../index.php");
}
if(isset($_POST['recipe']))
{
    $id=$_POST["recipe"];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM recipes WHERE RID='{$id}'";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $type=$row['type'];
    $sql="SELECT * FROM skill WHERE ID={$_SESSION["LOG-IN"]}";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $lvl=$row[$type];

    $sql="SELECT * FROM recipes WHERE RID='{$id}'";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $lvl_needen=$row['lvl'];

    if($lvl_needen<=$lvl)
    {
        $pass1=1;
        $pass2=1;
        $pass3=1;
        $item=$row['Item_ID'];
        $sql1="";
        $sql2="";
        $sql3="";
        if($row['ingredient_1']!=0)
        {
            $quantity_need1=$row['ingredient_1a'];
            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_1']}  AND user_ID={$_SESSION['LOG-IN']};";
            $resoults=mysqli_query($connect,$sqls);
            if(mysqli_num_rows($resoults)==1)
            {
                $rows=mysqli_fetch_assoc($resoults);
                $quantity1=$rows['quantity'];
                $SID=$rows['SID'];
                $quantity1-=$quantity_need1;

                if($quantity1>0)
                    $sql1="UPDATE inventory SET quantity=$quantity1 WHERE SID='{$SID}';";
                else if($quantity1==0)
                    $sql1="UPDATE inventory SET quantity=$quantity1, Item_ID=0 WHERE SID='{$SID}';";
                
                else
                    $pass1=0;
                
            }
            else
                $pass1=0;
        }        


        $item=$row['Item_ID'];
        if($row['ingredient_2']!=0)
        {
            $quantity_need2=$row['ingredient_2a'];
            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_2']} AND user_ID={$_SESSION['LOG-IN']};";
            $resoults=mysqli_query($connect,$sqls);
            if(mysqli_num_rows($resoults)==1)
            {
                $rows=mysqli_fetch_assoc($resoults);
                $quantity2=$rows['quantity'];
                $SID=$rows['SID'];
                $quantity2-=$quantity_need2;
                if($quantity2>0)
                    $sql2="UPDATE inventory SET quantity=$quantity2 WHERE SID='{$SID}';";
                else if($quantity2==0)
                    $sql2="UPDATE inventory SET quantity=$quantity2, Item_ID=0 WHERE SID='{$SID}';";
                
                else
                    $pass2=0;
            }
            else
                $pass2=0;
        }
        $item=$row['Item_ID'];
        if($row['ingredient_3']!=0)
        {
            $quantity_need3=$row['ingredient_3a'];
            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_3']} AND user_ID={$_SESSION['LOG-IN']};";
            $resoults=mysqli_query($connect,$sqls);
            if(mysqli_num_rows($resoults)==1)
            {
                $rows=mysqli_fetch_assoc($resoults);
                $quantity3=$rows['quantity'];
                $SID=$rows['SID'];
                $quantity3-=$quantity_need3;
                if($quantity3>0)
                    $sql3="UPDATE inventory SET quantity=$quantity3 WHERE SID='{$SID}';";
                else if($quantity3==0)
                    $sql3="UPDATE inventory SET quantity=$quantity3, Item_ID=0 WHERE SID='{$SID}';";
                
                else
                    $pass3=0;
            }
            else
                $pass3=0;
        }
        if(($pass1+$pass2+$pass3)==3)
        {
            $sql="SELECT * FROM items WHERE ID='{$item}'";
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $price=$row['price'];
            $sql="SELECT * FROM inventory WHERE Item_ID='{$item}' AND user_ID='{$_SESSION['LOG-IN']}';";
            $resoult=mysqli_query($connect,$sql);
            $space=mysqli_num_rows($resoult);
            if($space==1)
            {
                xp($type,$price);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    $SID=$row['SID'];
                    $QUANTITY=$row['quantity'];
                }
                $QUANTITY++;
                $sql="UPDATE inventory SET quantity=$QUANTITY WHERE SID='{$SID}';";
                mysqli_query($connect,$sql);
                if($sql1!="")
                    mysqli_query($connect,$sql1);
                if($sql2!="")
                    mysqli_query($connect,$sql2);
                if($sql3!="")
                    mysqli_query($connect,$sql3);
                echo "created";
            }
            else
            {
                $sql="SELECT * FROM inventory WHERE Item_ID='0' AND user_ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                $space=mysqli_num_rows($resoult);
                if($space>0)
                {
                    xp($type,$price);
                    while($row=mysqli_fetch_assoc($resoult))
                    {
                        $WSID[]=$row['SID'];
                    }
                    $QUANTITY=1;
                    $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$item WHERE SID='{$WSID[0]}';";
                    mysqli_query($connect,$sql);
                    if($sql1!="")
                    mysqli_query($connect,$sql1);
                    if($sql2!="")
                        mysqli_query($connect,$sql2);
                    if($sql3!="")
                        mysqli_query($connect,$sql3);
                    echo "created";

                }
            }
        }
    }
    
}
function xp($skill,$price)
{
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM skill_XP WHERE ID='{$_SESSION["LOG-IN"]}';";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $skill_xp=$row[$skill."_XP"];
    

    $sql="SELECT * FROM skill WHERE ID='{$_SESSION["LOG-IN"]}';";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $skill_lvl=$row[$skill];
    $skill_xp+=$price;
    $skill_xp_need=round(100*pow(1.5,($skill_lvl-1)));
    if($skill_xp>=$skill_xp_need)
    {
        $skill_xp-=$skill_xp_need;
        $skill_lvl++;
        $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
        mysqli_query($connect,$sql);
        $sql="UPDATE skill SET {$skill}={$skill_lvl} WHERE ID='{$_SESSION["LOG-IN"]}';";
        mysqli_query($connect,$sql);
        echo"reload";
    }
    else
    {
        $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
        mysqli_query($connect,$sql);
    }

}
?>