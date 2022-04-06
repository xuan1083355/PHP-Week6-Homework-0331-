<?php
   // ob_start();
    session_start();
    $link = @mysqli_connect(
        'localhost',   //MySQL主機名稱
        'root',         //使用者名稱
        '765nuk4321',             //密碼
        'php');   //要連接的資料庫
    
?>

<html>
    <head>
        <title>登入</title>
        <style>
            input{padding:10px 20px; border:2px black solid; cursor:pointer;border-radius:5px;}
            input[type="submit"]{padding:5px 15px; background:#ccc; border:0 none; cursor:pointer;border-radius:5px;}
            html{
                background-color:#FFDDAA;
                text-align:center;      
            }
            p{
                color:#FF7744;
                font-size:20px;
            }
            
         </style>
    </head>
    <body>
        <h2 style="color:blue; text-align:center; text-style:bold">-會員/管理者登入-</h2>
        <fieldset>
            <legend style="font-size:20px;font-style:italic";>
            <?php
            if(isset($_COOKIE["UID"])){
                $cookieID=$_COOKIE["UID"];
                echo "感謝"."<b>'$cookieID'</b>"."回到本系統";
            }else{
                echo "歡迎初次來到本系統";
            }   
            ?>
            </legend>

            <form action="" method="POST">  
                <p><b>請輸入帳號: </b><input type="text" name="id" required></p>
                <p><b>請輸入密碼: </b><input type="password" name="psw" required></p>
                <input type="submit" value="登入">
            </form>
        </field>

        <?php 
        
        if(isset($_POST["id"])){
            $uid=$_POST["id"];
            $upsw=$_POST["psw"];

            $SQL="SELECT * FROM user WHERE uName='$uid' AND uPWD='$upsw'";

            $result=mysqli_query($link,$SQL);   //只會顯示對或錯 
            
            if(mysqli_num_rows($result)==1){   //結果出來一行    
                setcookie("UID",$uid,time()+17280);
                $row=mysqli_fetch_assoc($result);
                if($row["uRole"]=="user"){
                    $_SESSION["user_login"]="YES"; 
                    header('Location: register.php');
                }else if($row["uRole"]=="admin"){
                    $_SESSION["admin_login"]="YES"; 
                    header('Location: admin.php');
                }
            }else{
               echo "帳號或密碼輸入錯誤";
            }
                
        }else{
            echo "請輸入帳號密碼";
        }
          
        ?>
    </body>
</html>