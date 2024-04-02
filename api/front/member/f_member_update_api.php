<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if( isset($mydata["ID"]) &&
            isset($mydata["FullName"]) &&
            isset($mydata["Mobile"]) &&
            isset($mydata["Email"]) &&
            isset($mydata["Age_ID"]) &&
            ($mydata["ID"]!="") &&
            ($mydata["FullName"]!="") &&
            ($mydata["Mobile"]!="") &&
            ($mydata["Email"]!="") &&
            ($mydata["Age_ID"]!="")){

                $p_ID = $mydata["ID"];
                $p_fullName = $mydata["FullName"];
                $p_mobile = $mydata["Mobile"];
                $p_email = $mydata["Email"];
                $p_ageID = $mydata["Age_ID"];
                $p_Pwd = $mydata["Pwd"];
                $p_Photo = $mydata["Photo"];
                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';

                // 密碼不是空白的
                if($p_Pwd!=""){
                    $p_Pwd = password_hash($mydata["Pwd"], PASSWORD_DEFAULT);
                    $sql = "UPDATE member SET Pwd='$p_Pwd' WHERE ID='$p_ID'";
                    mysqli_query($conn, $sql);
                }

                // 照片不是空白的
                if($p_Photo !=""){
                    $sql = "SELECT Photo FROM member WHERE ID='$p_ID'";
                    $result = mysqli_query($conn, $sql);  
      
                    while($row = $result->fetch_assoc()){
                        if($row["Photo"]!="")
                        {
                            $p_uploadFolder = dirname(dirname(dirname(dirname(__FILE__))));
                            // echo $p_uploadFolder;
                            $p_folderPath = $p_uploadFolder."/upload/images/member";
                            // echo $p_folderPath;
                            $filename = $p_folderPath."/".$row["Photo"];
                            if (file_exists($filename)) 
                                unlink($filename);
                        }
                    }  
                    
                    $sql = "UPDATE member SET Photo='$p_Photo' WHERE ID='$p_ID'";
                    mysqli_query($conn, $sql);
                }
            
                // 更新資料庫
                $sql = "UPDATE member SET FullName='$p_fullName', Mobile='$p_mobile', Email='$p_email', Age_ID='$p_ageID' WHERE ID='$p_ID'";
                
                if(mysqli_query($conn, $sql)){

                    // 查詢資料庫
                    $sql = "SELECT ID, WebName, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP FROM member WHERE ID='$p_ID'";
                    $result = mysqli_query($conn, $sql);
                    $mydata = array();
                    $row= mysqli_fetch_assoc($result);                
                    $mydata[] = $row;

                    echo '{"state":true, "data":'.json_encode($mydata).', "message":"更新會員資料成功"}';
                }else{
                    echo '{"state":false, "message":"更新會員資料失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>