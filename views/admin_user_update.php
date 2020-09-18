<?php
if($_POST[update]){
//멘토링 정보 업데이트
    $sql = 
    "UPDATE bm_user 
    SET 
    grade = '{$_POST[grade]}',
    coordinator = '{$_POST[coordinator]}',
    okay = '{$_POST[okay]}'
    WHERE 
    email='{$_GET[user_email]}'";

    if ($conn->query($sql) === FALSE) {
      echo "Error updating record: " . $conn->error;
    }
}

if($_GET[user_email]){
//회원 정보 출력하기
    $sql = "SELECT * FROM bm_user WHERE email='{$_GET[user_email]}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $user_data = $result->fetch_assoc();
    }

//회원의 코디네이터 정보 출력하기
    $sql = "SELECT * FROM bm_user WHERE email='{$user_data[coordinator]}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $cd_data = $result->fetch_assoc();
    }

//전체 코디네이터 정보 출력하기
    $sql = "SELECT * FROM bm_user WHERE grade='코디네이터'";
    $cd_result = $conn->query($sql);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">회원 정보</h1> -->
    <form method="post" action="index.php?id=admin_user_update&user_email=<?php echo $user_data[email];?>">
  <div class="row">
    <div class="col-md-4 mb-4">
    	<div class="mb-3 card shadow pt-3">
        	<div class="text-center mb-3">
                <i class="fas fa-user-circle fa-9x" aria-hidden="true"></i>
                <!-- <img class="shadow img-profile rounded-circle" src="https://lh3.googleusercontent.com/a-/AOh14Gg8z7rokgzk-Abwpjat_JtAMlNL8uBG10Cm0z_2Fw=s96-c" style="width:150px;height:150px;"> -->
            </div>
            <div class="text-center mb-3">
                <h5 class="text-dark"><?php echo $user_data[name];?></h5>
                <h6 class="text-dark"><?php echo $user_data[company];?> <?php echo $user_data[job];?></h6>
            </div>
        </div>
          <div class="mb-3 mt-3">
            <label for="area">직위</label>
            <select class="shadow custom-select d-block w-100" name="grade" id="grade">
              <option value="<?php echo $user_data[grade];?>"><?php echo $user_data[grade];?></option>
              <option value="멘티">멘티 </option>
			  <option value="멘토">멘토 </option>
			  <option value="코디네이터">코디네이터 </option>
			  <option value="관리자">관리자 </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="area">코디네이터</label>
            <select class="shadow custom-select d-block w-100" name="coordinator" id="coordinator">
              <option value="<?php echo $cd_data[email];?>"><?php echo $cd_data[name];?></option>
            <?php 
            while($user_cd = $cd_result->fetch_assoc()){
                echo "<option value='{$user_cd[email]}'>{$user_cd[name]}</option>";
            }
            ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="area">상태</label>
            <select class="shadow custom-select d-block w-100" name="okay" id="okay">
              <option value="<?php echo $user_data[okay];?>"><?php echo $user_data[okay];?></option>
              <option value="승인">승인 </option>
			  <option value="대기">대기 </option>
            </select>
          </div>
        <input class="shadow btn btn-primary btn-lg btn-block mt-3" type="submit" name="update" value="회원 정보 업데이트">
        </form>
    </div>
    <div class="col-md-8">
      <h5 class="mb-3">프로필</h5>
        <div class="row card-header shadow bg-white mx-1">
          <div class="col-md-6 mb-3">
            <label for="company">이름</label>
            <p class="text-info"><?php echo $user_data[name];?></p>
          </div>

          <div class="col-md-6 mb-3">
            <label for="area">지역</label>
            <p class="text-info"><?php echo $user_data[area];?></p>
          </div>
          
          <div class="col-md-12 mb-3">
            <label for="address">주소</label>
            <p class="text-info"><?php echo "({$user_data[zipcode]}) {$user_data[address1]} {$user_data[address2]}";?></p>
          </div>

          <div class="col-md-6 mb-3">
            <label for="phone">이메일</label>
            <a href="mailto:<?php echo $user_data[email];?>" target="_blank" class="badge badge-primary ml-1"><i class="fas fa-envelope"></i> Send</a>
              <p class="text-info"><?php echo $user_data[email];?></p>
          </div>

          <div class="col-md-6 mb-3">
            <label for="phone">연락처</label>
            <a href="tel:<?php echo $user_data[phone];?>" target="_blank" class="badge badge-primary ml-1"><i class="fas fa-phone"></i> Call</a>
              <p class="text-info"><?php echo $user_data[phone];?></p>
          </div>

          <div class="col-md-6 mb-3">
            <label for="company">소속</label>
            <p class="text-info"><?php echo $user_data[company];?></p>
          </div>

          <div class="col-md-6 mb-3">
            <label for="job">직업</label>
            <p class="text-info"><?php echo $user_data[job];?></p>
          </div>

          <div class="col-md-12 mb-3">
            <label for="interest">사용자 키워드</label>
            <p class="text-info"><?php echo $user_data[user_keyword];?></p>
          </div>

          <div class="col-md-12 mb-3">
            <label for="major">멘토링 키워드</label>
            <p class="text-info"><?php echo $user_data[mentoring_keyword];?></p>
          </div>

          <div class="col-md-12 mb-3">
            <label for="company">자기소개</label>
            <p class="text-info"><?php echo $user_data[introduce];?></div>
        </div>
  </div>
</div>
</div>