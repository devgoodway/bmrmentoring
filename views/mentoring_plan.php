<?php
if($_GET[plan_id]){
    //기존에 사용자에게 등록된 값이 있는지 확인
    $sql = "SELECT * FROM bm_mentoring WHERE id = '{$_GET[plan_id]}'";
    $result_user = $conn->query($sql);
    if ($result_user->num_rows > 0) {
        $mentoring_data = $result_user->fetch_assoc();
    }else{
        echo "<script>alert('멘토링 정보가 없습니다.');location.href='./index.php'</script>";
        exit;
    }
}

//회원 정보
$sql = "SELECT * FROM bm_user WHERE email='{$email}'";
$result_user = $conn->query($sql);
if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
}else{
    echo "<script>alert('회원정보가 없습니다.');location.href='./index.php'</script>";
    exit;
}
//멘토 정보
$sql = "SELECT * FROM bm_user WHERE email='{$mentoring_data[mentor]}'";
$result_mentor = $conn->query($sql);
if ($result_mentor->num_rows > 0) {
    $mentor_user_data = $result_mentor->fetch_assoc();
}else{
    echo "<script>alert('회원정보가 없습니다.');location.href='./index.php'</script>";
    exit;
}

//멘티 정보
$sql = "SELECT * FROM bm_user";
$result_mentee = $conn->query($sql);
if ($result_mentee->num_rows > 0) {
    $mentee_list = '';
    $mentee_name_list = '';
    while($mentee_data = $result_mentee->fetch_assoc()){
        if(strpos($mentoring_data[mentee], $mentee_data[email]) !== false){
            $mentee_list .= "<a href='index.php?id=profile&email={$mentee_data[email]}'>{$mentee_data[name]}</a> ";
            $mentee_name_list .= $mentee_data[email].",";}
    }
}else{
    echo "<script>alert('회원정보가 없습니다.');location.href='./index.php'</script>";
    exit;
}

//멘토 코디네이터 정보
$sql = "SELECT * FROM bm_user WHERE email='{$mentoring_data[cd_mentor]}'";
$result_mentor_cd = $conn->query($sql);
if ($result_mentor_cd->num_rows > 0) {
    $mentor_cd_data = $result_mentor_cd->fetch_assoc();
}

//멘티 코디네이터 정보
$sql = "SELECT * FROM bm_user WHERE email='{$mentoring_data[cd_mentee]}'";
$result_mentee_cd = $conn->query($sql);
if ($result_mentee_cd->num_rows > 0) {
    $mentee_cd_data = $result_mentee_cd->fetch_assoc();
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">멘토 정보</h1> -->
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h5 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">맴버</span>
            </h5>
            <div class="card shadow mb-3">
                <div class="row m-3">
                    <div class="col-md-12 mb-3">
                        <label for="company">멘토</label>
                        <p class="text-dark">
                            <a href="index.php?id=profile&email=<?php echo $mentor_user_data[email];?>" target="_blank">
                                <?php echo $mentor_user_data[name];?>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘토)</label>
                        <p class="text-dark">
                            <a href="index.php?id=profile&email=<?php echo $mentor_cd_data[email];?>" target="_blank">
                                <?php echo $mentor_cd_data[name];?>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘티)</label>
                        <p class="text-dark">
                            <a href="index.php?id=profile&email=<?php echo $mentee_cd_data[email];?>" target="_blank">
                                <?php echo $mentee_cd_data[name];?>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="video">멘티</label>
                            <p class="text-dark"><?php echo $mentee_list;?></p>
                    </div>
                </div>
            </div>
            <?php
                $chk_name = $mentor_user_data[email].$mentor_cd_data[email].$mentee_cd_data[email];
                $chk_cd = $mentor_cd_data[email].$mentee_cd_data[email];
                if(strpos($chk_name, $row_user[email]) !== false){?>
                    <form method="post" action="index.php?id=mentoring_update">
                        <input type="hidden" name="plan_id" value="<?php echo $mentoring_data[id];?>">
                        <input type="hidden" name="mentor_name" value="<?php echo $mentor_user_data[name];?>">
                        <input type="hidden" name="mentor_cd_name" value="<?php echo $mentor_cd_data[name];?>">
                        <input type="hidden" name="mentee_cd_name" value="<?php echo $mentee_cd_data[name];?>">
                        <input type="hidden" name="mentee_name" value="<?php echo $mentee_name_list;?>">
                        <input type="hidden" name="okay" value="<?php echo $mentoring_data[okay];?>">
                        <?php if(strpos($chk_cd, $row_user[email]) !== false){?>
                            <?php if($mentoring_data[okay]=='검토중'){?>
                                <input class="shadow btn btn-warning btn-lg btn-block mt-3" type="submit" name="check" value="확인">
                            <?php }elseif($mentoring_data[okay]=='작성중'){?>
                                <input class="shadow btn btn-primary btn-lg btn-block mt-3" type="submit" name="sign" value="승인">
                            <?php }?>
                            <input class="shadow btn btn-success btn-lg btn-block mt-3" type="submit" name="update" value="수정">
                            <input class="shadow btn btn-danger btn-lg btn-block mt-3" type="submit" name="delete" value="삭제">
                        <?php }elseif($mentoring_data[okay]=='작성중'){?>
                            <input class="shadow btn btn-success btn-lg btn-block mt-3" type="submit" name="update" value="수정">
                        <?php }?>
                    </form>
            <?php }?>
        </div>
            <div class="col-md-8 order-md-1">
                <h5 class="mb-3">멘토링 계획</h5>
                <div class="card shadow bg-white mb-3">
                    <div class="row m-3">
                    <div class="col-md-6 mb-3">
                        <label for="address">시즌</label>
                        <p class="text-dark"><?php echo $mentoring_data[season];?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="state">상태</label>
                            <p><?php echo $mentoring_data[okay];?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">주제</label>
                        <p class="text-dark"><?php echo $mentoring_data[title];?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">활동계획</label>
                        <p class="text-dark"><?php echo $mentoring_data[contents];?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="classrooom">클래스룸</label>
                        <a href="<?php echo $mentoring_data[classroom];?>" target="_blank" class="badge badge-primary ml-1"><i class="fas fa-chalkboard-teacher"></i> Classroom</a>
                        <p class="text-dark"><?php echo $mentoring_data[classroom];?></p>
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>