<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PNO"]) && isset($mydata["PNO"])&& ($mydata["PNO"]!="") && ($mydata["Photo"]!="")){
                $p_PNO = $mydata["PNO"]; 
                $p_Photo = $mydata["Photo"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
               // $sql = "INSERT INTO age(Name) VALUES ('$p_Name')";

               $sql = "INSERT INTO productPhoto(PNO, Photo) VALUES (?,?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("ss", $p_PNO, $p_Photo);
               
                
                //if(mysqli_query($conn, $sql)){
                if($stmt->execute()){
                    echo '{"state":true, "message":"新增產品詳細圖片成功"}';
                }else{
                    echo '{"state":false, "message":"新增產品詳細圖片失敗"}';
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
