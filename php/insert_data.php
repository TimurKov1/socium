<?php
    include('connect.php');
    $table = $_POST['table'];
    $data = json_decode($_POST['data']);
    $query = "INSERT INTO `".$table."`";
    $fields = "(";
    $values = "(";
    foreach ($data as $key => $val) {
        $fields .= "`".$key."`, ";
        if($key == 'password') {
            $values .= "'".md5(mysqli_real_escape_string($conn, htmlspecialchars($val)))."', ";
        }elseif (gettype($val) == 'string'){
            $values .= "'".mysqli_real_escape_string($conn, htmlspecialchars($val))."', ";
        }else{
            $values .= $val.", ";
        }
        if($key == 'email'){
            $path = time().$_FILES['photo']['name'];
            $d = (array)$data;
            mkdir("../user_materials/".$d['email']);
            move_uploaded_file($_FILES['photo']['tmp_name'],'../user_materials/'.$d['email'].'/'.$path);
            $fields .= "`photo`, ";
            $values .= "'".$path."', ";
        }
    }
    $fields = substr($fields, 0, -2).")";
    $values = substr($values, 0, -2).")";
    $query .= $fields." VALUES".$values;
    if(mysqli_query($conn,$query)){
        $result=[
            'status'=>true
        ];
    }else{
        $result=[
            'status'=>false
        ];
    }
    echo json_encode($result);
?>