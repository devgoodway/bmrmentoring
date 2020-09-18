<?php
if($_POST[insert]){
    //멘토링 계획 등록
    $sql = "INSERT INTO 
    bm_mentoring(
        season,
        mentor,
        cd_mentor,
        cd_mentee,
        mentee,
        title,
        contents,
        classroom,
        okay) 
    VALUES 
    ('{$present_data[season]}', 
    '{$_POST[mentor_email]}', 
    '{$_POST[mentor_cd_email]}', 
    '{$_POST[mentee_cd_email]}', 
    '{$_POST[mentee_email]}', 
    '{$_POST[title]}', 
    '{$_POST[contents]}', 
    '{$_POST[classroom]}', 
    '{$_POST[okay]}')";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }else{
        echo "<script>location.href='index.php?id=mentoring_list'</script>";
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
            <form method="post" action="index.php?id=mentoring_apply">
            <input type="hidden" name="okay" value="<?php echo $_POST[okay];?>">
                <div class="row m-3">
                    <div class="col-md-12 mb-3">
                        <label for="company">멘토</label>
                        <p><?php echo $_POST[mentor_name];?></p>
                        <input type="hidden" name="mentor_email" value="<?php echo $_POST[mentor_email];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘토)</label>
                        <p><?php echo $_POST[mentor_cd_name];?></p>
                        <input type="hidden" name="mentor_cd_email" value="<?php echo $_POST[mentor_cd_email];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company">코디네이터(멘티)</label>
                        <p><?php echo $_POST[mentee_cd_name];?></p>
                        <input type="hidden" name="mentee_cd_email" value="<?php echo $_POST[mentee_cd_email];?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="video">멘티</label>
                        <?php if($_POST[apply_grade]=='멘티'){?>
                            <p><?php echo $_POST[mentee_name];?></p>
                            <input type="hidden" name="mentee_email" value="<?php echo $_POST[mentee_email];?>">
                        <?php }else{ ?>
                            <input type="text" class="shadow form-control" id="mentee_email" placeholder="" name="mentee_email" value="">
                        <?php } ?>
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
                        <p class="text-dark"><?php echo $present_data[season];?></p>
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
                            placeholder=""><?php echo $mentoring_data[plan];?></textarea>
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
                <input class="shadow btn btn-primary btn-lg btn-block mt-3" type="submit" name="insert" value="제출">
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