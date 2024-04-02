<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["Name"]) && ($mydata["Name"]!="")){
                $p_Name = $mydata["Name"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
               // $sql = "INSERT INTO age(Name) VALUES ('$p_Name')";

               $sql = "INSERT INTO pay(Name) VALUES (?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s", $p_Name);
               
                
                //if(mysqli_query($conn, $sql)){
                if($stmt->execute()){
                    echo '{"state":true, "message":"新增付款方式成功"}';
                }else{
                    echo '{"state":false, "message":"新增付款方式失敗"}';
                }
                $stmt->close();
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }

   

    
?>
