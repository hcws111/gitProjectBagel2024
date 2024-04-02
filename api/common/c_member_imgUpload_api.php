<?php
       if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
        
        $p_full = dirname(__FILE__);
        $p_uploadFolder = dirname(dirname($p_full));
        // echo($p_uploadFolder);

        // // 建立資料夾
         $p_folderPath = $p_uploadFolder."/upload/images/member";
        //  echo($p_folderPath);
        // if (!is_dir($p_folderPath)){
        //     //  echo ("資料夾不存在");

        //     if (!mkdir($p_folderPath, 0777, true)) {
        //       die("無法創建資料夾：$p_folderPath");
        //     }
        // }else{
        //     //  echo ("資料夾已存在");
        // }


        if($_FILES['file']['type']== "image/jpeg" || $_FILES['file']['type']=="image/png"){
            // 重新命名檔案, 傳遞至伺服器
            // $myfile = date("YmdHis").'_'.$_FILES['file']['name'];
            // $filename = 'upload/'.$myfile;
            $nameArray = explode(".", $_FILES['file']['name']);
            $myfile = date("YmdHis").'.'.$nameArray[1]; 
            $filename = $p_folderPath."/".$myfile;
            // echo($filename);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $filename)){
                $datainfo = array();
                $datainfo["name"] = $_FILES['file']['name'];
                $datainfo["type"] = $_FILES['file']['type'];
                $datainfo["size"] = $_FILES['file']['size'];
                $datainfo["tmp_name"] = $_FILES['file']['tmp_name'];
                $datainfo["error"] = $_FILES['file']['error'];
                $datainfo["folderPath"]=$p_folderPath;
                $datainfo["serverfilename"] = $myfile;
                echo '{"state":"true", "data":'.json_encode($datainfo).', "message":"檔案上傳成功!"}';
            }else{
                $errorinfo = array();
                $errorinfo["info"] = $_FILES['file']['error'];
                echo '{"state":"false", "data":'.json_encode($errorinfo).', "message":"檔案上傳錯誤!"}';
            }
        }else{
            echo '{"state":"false", "message":"檔案格式錯誤, 必須為jpeg或png"}';
        }
    }else{
        echo '{"state":"false", "message":"檔案不存在!!"}';
    }
?>