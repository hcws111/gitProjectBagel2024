<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && ($mydata["WebName"]!="")){
                $dT = new DateTime();
                $p_PoNo = "T".$dT->format('YmdHisu');
                $p_OrderTime = $dT->format("Y-m-d H:i:s");
                $p_WebName = $mydata["WebName"];
                $p_PayID = $mydata["Pay_ID"];
                $p_DeliveryID = $mydata["Delivery_ID"];
                $p_Receiver = $mydata["Receiver"];
                $p_Mobile = $mydata["Mobile"];
                $p_County = $mydata["County"];
                $p_Township = $mydata["Township"];
                $p_Addr = $mydata["Addr"];
                $p_Money = $mydata["Money"];
                $p_OrderState = "P";


                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
               // $sql = "INSERT INTO age(Name) VALUES ('$p_Name')";

               $sql = "INSERT INTO orderP(PoNo, OrderTime, WebName, Pay_ID, Delivery_ID, Receiver, Mobile, County, Township, Addr, Money, OrderState) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("sssiisssssis", $p_PoNo, $p_OrderTime, $p_WebName, $p_PayID, $p_DeliveryID, $p_Receiver, $p_Mobile, $p_County, $p_Township, $p_Addr, $p_Money, $p_OrderState);
               
                
                //if(mysqli_query($conn, $sql)){
                if($stmt->execute()){
                    $mydata = array(
                        "PoNo" => $p_PoNo,
                    );
                    
                    echo '{"state":true, "data":'.json_encode($mydata).', "message":"新增訂單資料成功"}';
                }else{
                    echo '{"state":false, "message":"新增訂單資料失敗"}';
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
