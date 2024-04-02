<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["Name"]) && isset($mydata["Tag"]) && ($mydata["Name"]!="") && ($mydata["Tag"]!="")){
                $p_Name = $mydata["Name"];
                $p_Tag = $mydata["Tag"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
               $sql = "INSERT INTO memberType(Name, Tag) VALUES (?, ?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("ss", $p_Name, $p_Tag);
               
                if($stmt->execute()){
                    echo '{"state":true, "message":"新增會員分類成功"}';
                }else{
                    echo '{"state":false, "message":"新增會員分類失敗"}';
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