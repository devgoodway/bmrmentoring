<?php
if($_GET[email]){
  $email_data = $_GET[email];
}elseif($_POST[id]){
  $email_data = $_POST[email];
}else{
  $email_data = $email;
}

//정보 출력
$sql = "SELECT * FROM bm_user WHERE email='{$email_data}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}else{
    echo "<script>alert('회원정보가 없습니다.');location.href='./index.php'</script>";
    exit;
}

//코디네이터 관계 출력
$sql = "SELECT A.name,A.email,A.grade
FROM bm_user AS A 
LEFT JOIN bm_user AS B
ON A.coordinator = B.email
WHERE B.email = '{$email_data}'
ORDER BY A.grade,A.name";
$result_member = $conn->query($sql);

//멘토 코디네이터 출력
$sql = "SELECT * FROM bm_user WHERE email='{$user_data[coordinator]}'";
$result_mentor_cd = $conn->query($sql);
  if ($result_mentor_cd->num_rows > 0) {
      $mentor_cd_data = $result_mentor_cd->fetch_assoc();
  }

//멘티 코디네이터 출력
$sql = "SELECT * FROM bm_user WHERE email='{$row_user[coordinator]}'";
$result_mentee_cd = $conn->query($sql);
  if ($result_mentee_cd->num_rows > 0) {
      $mentee_cd_data = $result_mentee_cd->fetch_assoc();
  }

//항목별 타이틀 이름 지정
if($user_data[grade]=='멘티'){
    $profile_label = array(
        "title"=>"<h5 class='text-dark'>M E N T E E</h5>",
        "company"=>"학교",
        "job"=>"학년",
        "user_keyword"=>"멘티 키워드",
        "mentoring_keyword"=>"멘토링 키워드",
        "introduce"=>"자기소개",
        "name"=>"이름",
        "area"=>"지역",
        "zipcode"=>"우편번호",
        "address1"=>"주소",
        "address2"=>"상세주소",
        "email"=>"이메일",
        "phone"=>"연락처",
        "introduce"=>"자기소개");
}elseif($user_data[grade]=='코디네이터'){
    $profile_label = array(
        "title"=>"<h5 class='text-danger'>C O O R D I N A T O R</h5>",
        "company"=>"소속",
        "job"=>"직업",
        "user_keyword"=>"멘토 키워드",
        "mentoring_keyword"=>"멘토링 키워드",
        "introduce"=>"자기소개",
        "name"=>"이름",
        "area"=>"지역",
        "zipcode"=>"우편번호",
        "address1"=>"주소",
        "address2"=>"상세주소",
        "email"=>"이메일",
        "phone"=>"연락처",
        "introduce"=>"자기소개");
}else{
    $profile_label = array(
        "title"=>"<h5 class='text-primary'>M E N T O R</h5>",
        "company"=>"소속",
        "job"=>"직업",
        "user_keyword"=>"멘토 키워드",
        "mentoring_keyword"=>"멘토링 키워드",
        "name"=>"이름",
        "area"=>"지역",
        "zipcode"=>"우편번호",
        "address1"=>"주소",
        "address2"=>"상세주소",
        "email"=>"이메일",
        "phone"=>"연락처",
        "introduce"=>"자기소개");
}

$conn->close();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">회원 정보</h1> -->
  <div class="row">
    <div class="col-md-4 mb-4">
    	<div class="mb-3 card shadow pt-3">
        	<div class="text-center mb-3">
                <?php echo $profile_label[title];?>
                <i class="fas fa-user-circle fa-9x" aria-hidden="true"></i>
                <!-- <img class="shadow img-profile rounded-circle" src="https://lh3.googleusercontent.com/a-/AOh14Gg8z7rokgzk-Abwpjat_JtAMlNL8uBG10Cm0z_2Fw=s96-c" style="width:150px;height:150px;"> -->
            </div>
            <div class="text-center mb-3">
                <h5 class="text-dark"><?php echo $user_data[name];?></h5>
                <h6 class="text-dark"><?php echo $user_data[company]." / ".$user_data[job];?></h6>
            </div>
        </div>
      <h5 class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <span class="text-muted">맴버</span>
      </h5>
      <ul class="card shadow list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $mentor_cd_data[name];?></h6>
            <small class="text-danger">코디네이터</small>
          </div>
                <a href="index.php?id=profile&email=<?php echo $mentor_cd_data[email];?>"><i class="fas fa-user-circle" aria-hidden="true" style="font-size:40px"></i></a>
            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" style="width:40px;height:40px;"> -->
        </li>
        <?php 
          while($member_data = $result_member->fetch_assoc()){
            echo "<li class='list-group-item d-flex justify-content-between lh-condensed'>
                <div>
                  <h6 class='my-0'>{$member_data[name]}</h6>
                  <small class='text-primary'>{$member_data[grade]}</small>
                </div>
                <a href='index.php?id=profile&email={$member_data[email]}'><i class='fas fa-user-circle' aria-hidden='true' style='font-size:40px'></i></a>
              </li>";
          }
        ?>
      </ul>
    </div>
    <div class="col-md-8">
      <h5 class="mb-3">프로필</h5>
        <div class="card shadow mb-3">
        <div class="row m-3">
          <div class="col-md-3 mb-3">
            <label class="text-info font-weight-bold" for="name">멘토링 활동</label>
            <div>
                <input class="form-control" name="activity" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="danger"  data-width="100%" disabled
            <?php 
              echo $user_data[activity] == 'on' ? "checked" : "";
            ?>>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label class="text-info font-weight-bold" for="area"><?php echo $profile_label[area];?></label>
            <p class="text-dark"><?php echo $user_data[area];?></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-info font-weight-bold" for="email"><?php echo $profile_label[email];?></label>
            <a href="mailto:<?php echo $user_data[email];?>" target="_blank" class="badge badge-primary ml-1"><i class="fas fa-envelope"></i> Send</a>
              <p class="text-dark"><?php echo $user_data[email];?></p>
          </div>
          <?php if($admin_key > 3 ){?>
          <div class="col-md-8 mb-3">
            <label class="text-primary font-weight-bold" for="address"><?php echo $profile_label[address1];?></label>
            <p class="text-dark"><?php echo "({$user_data[zipcode]}) {$user_data[address1]} {$user_data[address2]}";?></p>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-primary font-weight-bold" for="phone"><?php echo $profile_label[phone];?></label>
            <a href="tel:<?php echo $user_data[phone];?>" target="_blank" class="badge badge-primary ml-1"><i class="fas fa-phone"></i> Call</a>
              <p class="text-dark"><?php echo $user_data[phone];?></p>
          </div>
          <?php }?>
          <div class="col-md-12 mb-3">
            <label class="text-info font-weight-bold" for="interest"><?php echo $profile_label[user_keyword];?></label>
            <p class="text-dark"><?php echo $user_data[user_keyword];?></p>
          </div>

          <div class="col-md-12 mb-3">
            <label class="text-info font-weight-bold" for="major"><?php echo $profile_label[mentoring_keyword];?></label>
            <p class="text-dark"><?php echo $user_data[mentoring_keyword];?></p>
          </div>

          <div class="col-md-12 mb-3">
            <label class="text-info font-weight-bold" for="company">자기소개</label>
            <span class="text-dark"><?php echo $user_data[introduce];?></span>
          </div>
        </div>
    </div>
    <?php if(
    $user_data[email] != $row_user[email]
    && $user_data[grade] != '멘티' 
    && ($row_user[grade] == '멘티' 
    || $row_user[grade] == '코디네이터')){ ?>
      <form method="post" action="index.php?id=mentoring_apply">
        <input type="hidden" name="apply_grade" value="<?php echo $row_user[grade];?>">
        <input type="hidden" name="mentor_name" value="<?php echo $user_data[name];?>">
        <input type="hidden" name="mentor_email" value="<?php echo $user_data[email];?>">
        <input type="hidden" name="mentor_cd_name" value="<?php echo $mentor_cd_data[name];?>">
        <input type="hidden" name="mentor_cd_email" value="<?php echo $mentor_cd_data[email];?>">
        <?php if($row_user[grade] == '멘티'){ ?>
          <input type="hidden" name="mentee_name" value="<?php echo $row_user[name];?>">
          <input type="hidden" name="mentee_email" value="<?php echo $row_user[email];?>">
          <input type="hidden" name="mentee_cd_name" value="<?php echo $mentee_cd_data[name];?>">
          <input type="hidden" name="mentee_cd_email" value="<?php echo $mentee_cd_data[email];?>">
          <input type="hidden" name="okay" value="검토중">
        <?php }else{ ?>
          <input type="hidden" name="mentee_cd_name" value="<?php echo $row_user[name];?>">
          <input type="hidden" name="mentee_cd_email" value="<?php echo $row_user[email];?>">
          <input type="hidden" name="okay" value="작성중">
          
        <?php } ?>
        <input class="shadow btn btn-primary btn-lg btn-block mt-3 mb-3" type="submit" name="submit" value="멘토링 신청하기">
      </form>
    <?php } ?>
  </div>
</div>
</div>