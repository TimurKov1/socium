<?php
include('connect.php');
$table = $_POST['table'];
$fields = json_decode($_POST['fields']);
$terms = json_decode($_POST['terms']);
$query = "SELECT ";
if (count($fields) > 0){
    foreach ($fields as $value) {
        $query .= "`".$value."`, ";
    }
    $query = substr($query, 0, -2);
}else{
    $query .= "*";
}
$query .= " FROM `".$table."`";
if (count($terms) > 0){
    $query .= " WHERE ";
    foreach ($terms as $key => $value) {
        $query .= "`".$key."` = ";
        if ($key == 'password'){
            $query .= "'".md5(mysqli_real_escape_string($conn, htmlspecialchars($value)))."' AND ";
        }elseif(gettype($value) == 'string'){
            $query .= "'".mysqli_real_escape_string($conn, $value)."' AND ";
        }else{
            $query .= $value." AND ";
        }
    }
    $query = substr($query, 0, -5);
}
$res = mysqli_query($conn,$query);
while($row =mysqli_fetch_assoc($res)){
    if (count($fields) == 1){
        $data[]=$row[$fields[0]];
    }else{
        $data[]=$row;
    }
}
$result=[
    'data'=>$data
];
echo json_encode($result);
?>