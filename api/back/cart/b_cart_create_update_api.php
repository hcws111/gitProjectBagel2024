<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && isset($mydata["Content"]) && ($mydata["WebName"]!="") && ($mydata["Content"]!="")){
                $p_WebName = $mydata["WebName"];
                $p_Content = $mydata["Content"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';


                // 查詢                
                $sql = "SELECT WebName, Content From cart WHERE WebName='$p_WebName'";
                $result = mysqli_query($conn, $sql);    
                if(mysqli_num_rows($result)>0){
                    $sql = "UPDATE cart SET Content='$p_Content' WHERE WebName='$p_WebName'";
                    if(mysqli_query($conn, $sql)){
                        echo '{"state":true, "message":"有此會員資料, 更新購物車成功"}';
                    }else{
                        echo '{"state":false, "message":"有此會員資料, 更新購物車失敗"}';
                    }
                }else{
                    // 新增
                    $sql = "INSERT INTO cart(WebName, Content) VALUES (?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $p_WebName, $p_Content);                    
                    if($stmt->execute()){
                        echo '{"state":true, "message":"無此會員資料, 新增購物車成功"}';
                    }else{
                        echo '{"state":false, "message":"無此會員資料,新增購物車失敗"}';
                    }
                    $stmt->close();
                    mysqli_close($conn);
                }
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }

   

    
?>
