<?php
//key의 초기값 설정
$admin_key = 0;
$main_key = "%F84%BB%DC_n%5CHl%EC1z%90D%5DY";
$email_chk = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_COOKIE[Email]);
//현재 시즌을 출력한다
$sql = "SELECT * FROM bm_season WHERE present='Y'";
$result_present = $conn->query($sql);
$present_data = $result_present->fetch_assoc();

//사용자 식별을 위한 변수를 생성한다.
if($email_chk == true){
	$email = $_COOKIE[Email];
	setcookie('Email', openssl_encrypt($email, 'aes-256-cbc', $main_key, false, str_replace(chr(0), 16)), time() + 36000);
}else{
	$email = openssl_decrypt($_COOKIE[Email], 'aes-256-cbc', $main_key, false, str_replace(chr(0), 16));
}
//쿠키에 저장된 키를 이용하여 사용자를 확인한다.
	$result_user = mysqli_query($conn, "SELECT * FROM bm_user WHERE email ='{$email}'");
    $row_user = mysqli_fetch_assoc($result_user);
//사용자 아이디 저장
    $user_id = $row_user[id];
//권한 설정
	if($email==$row_user[email]){
    	$admin_key = 1;
	}
    if($row_user[grade]=="멘티"){
    	$admin_key = 2;
	}
    if($row_user[grade]=="멘토"){
    	$admin_key = 3;
	}
    if($row_user[grade]=="코디네이터"){
    	$admin_key = 4;
	}
    if($row_user[grade]=="관리자"){
    	$admin_key = 5;
    }
    if($row_user[okay]!='승인'){
        $admin_key = 1;
    }
	//메모리 초기화
	mysqli_free_result($result_user);
?>