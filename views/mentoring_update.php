<?php
//검토
if($_POST[check]){
    $sql = 
    "UPDATE bm_mentoring 
    SET 
    okay = '작성중'
    WHERE 
    id='{$_POST[plan_id]}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }else{
        echo "<script>location.href='index.php?id=mentoring_plan&plan_id={$_POST[plan_id]}'</script>";
        exit;
    }
}

//승인
if($_POST[sign]){
    $sql = 
    "UPDATE bm_mentoring 
    SET 
    okay = '승인'
    WHERE 
    id='{$_POST[plan_id]}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }else{
        echo "<script>location.href='index.php?id=mentoring_plan&plan_id={$_POST[plan_id]}'</script>";
        exit;
    }
}

//삭제
if($_GET[delete]){
$sql = "DELETE FROM bm_mentoring WHERE id='{$_GET[plan_id]}'";
    if ($conn->query($sql) === FALSE) {
        echo "Error delete record: " . $conn->error;
    }else{
        echo "<script>location.href='index.php?id=mentoring_plan&plan_id={$_POST[plan_id]}'</script>";
    }
}
//수정
if($_POST[submit]){
    //멘토링 계획 수정
    $sql = "UPDATE bm_mentoring
    SET 
        season = '{$present_data[season]}',
        mentor = '{$_POST[mentor_email]}',
        cd_mentor = '{$_POST[mentor_cd_email]}',
        cd_mentee = '{$_POST[mentee_cd_email]}',
        mentee = '{$_POST[mentee_email]}',
        title = '{$_POST[title]}',
        contents = '{$_POST[contents]}',
        classroom = '{$_POST[classroom]}',
        okay = '{$_POST[okay]}'
    WHERE
        id = '{$_POST[plan_id]}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }else{
        echo "<script>location.href='index.php?id=mentoring_plan&plan_id={$_POST[plan_id]}'</script>";
        exit;
    }
}

//계획 출력
if($_POST[plan_id]){
    $sql = "SELECT * FROM bm_mentoring WHERE id = '{$_POST[plan_id]}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $mentoring_data = $result->fetch_assoc();
    }else{
        echo "<script>alert('멘토링 정보가 없습니다.');location.href='./index.php'</script>";
        exit;
    }
}

//학생 리스트
$sql = "SELECT * FROM bm_user WHERE grade = '멘티'";
$result_user = $conn->query($sql);
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
            <form method="post" action="index.php?id=mentoring_update">
            <input type="hidden" name="okay" value="<?php echo $_POST[okay];?>">
            <input type="hidden" name="plan_id" value="<?php echo $_POST[plan_id];?>">
                <div class="row m-3">
                    <div class="col-md-12 mb-3">
                        <label for="company">멘토</label>
                        <p><?php echo $_POST[mentor_name];?></p>
                        <input type="hidden" name="mentor_email" value="<?php echo $mentoring_data[mentor];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘토)</label>
                        <p><?php echo $_POST[mentor_cd_name];?></p>
                        <input type="hidden" name="mentor_cd_email" value="<?php echo $mentoring_data[cd_mentor];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘티)</label>
                        <p><?php echo $_POST[mentee_cd_name];?></p>
                        <input type="hidden" name="mentee_cd_email" value="<?php echo $mentoring_data[cd_mentee];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="video">멘티</label>
                        <input type="text" class="shadow form-control" id="mentee_email" placeholder="" name="mentee_email" value="<?php echo $_POST[mentee_name];?>">
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <h5 class="mb-3">멘토링 계획</h5>
                <div class="card shadow bg-white mb-3">
                    <div class="row m-3">
                    <div class="col-md-12 mb-3">
                        <label for="address">시즌</label>
                        <p class="text-dark"><?php echo $mentoring_data[season];?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">주제</label>
                        <input
                            type="text"
                            class="shadow form-control"
                            id="title"
                            name="title"
                            placeholder=""
                            value="<?php echo $mentoring_data[title];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">활동계획</label>
                        <textarea
                            type="text"
                            class="shadow form-control"
                            id="editor"
                            name="contents"
                            placeholder=""><?php echo $mentoring_data[contents];?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="classrooom">클래스룸 주소</label>
                        <input
                            type="text"
                            class="shadow form-control"
                            id="classroom"
                            name="classroom"
                            placeholder=""
                            value="<?php echo $mentoring_data[classroom];?>">
                    </div>
                    </div>
                </div>
                <input class="shadow btn btn-primary btn-lg btn-block mt-3" type="submit" name="submit" value="제출">
            </form>
        </div>
    </div>
</div>
<!--amsifySuggestags -->
<script type="text/javascript">
	$('input[name="mentee_email"]').amsifySuggestags({
        type :'bootstrap',
		suggestions: [
        <?php
            while($user_data = $result_user->fetch_assoc()){
                echo "{"."tag : '{$user_data[job]} {$user_data[name]}', value: '{$user_data[email]}'"."},";
            }    
        ?>
                    ],
		whiteList: true
	});
</script>