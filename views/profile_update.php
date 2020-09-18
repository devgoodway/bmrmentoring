<?php
//최초등록
if($_POST[submit]){
    //기존에 가입된 회원이 아닌지 확인
    $sql = "SELECT * FROM bm_user WHERE email='{$email}'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $sql = 
        "INSERT 
        INTO bm_user(name, email, grade, activity)
        VALUES ('{$_POST[name]}', '{$email}', '{$_POST[grade]}', 'on')";
    }else{
        echo "<script>alert('이미 가입되어 있습니다.');location.href='./index.php'</script>";
		exit;
    }

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//정보 업데이트
if($_POST[update]){
    $sql = 
    "UPDATE bm_user 
    SET 
    name = '{$_POST[name]}',
    img = '{$_POST[img]}',
    grade = '{$_POST[grade]}',
    company = '{$_POST[company]}',
    job = '{$_POST[job]}',
    area = '{$_POST[area]}',
    zipcode = '{$_POST[zipcode]}',
    address1 = '{$_POST[address1]}',
    address2 = '{$_POST[address2]}',
    phone = '{$_POST[phone]}',
    user_keyword = '{$_POST[user_keyword]}',
    mentoring_keyword = '{$_POST[mentoring_keyword]}',
    introduce = '{$_POST[introduce]}',
    activity = '{$_POST[activity]}'
    WHERE 
    email='{$email}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }
}

//정보 출력
$sql = "SELECT * FROM bm_user WHERE email='{$email}' OR id='{$_POST[id]}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}else{
    echo "<script>alert('회원정보가 없습니다.');location.href='./index.php'</script>";
    exit;
}

//항목별 타이틀 이름 지정
if($user_data[grade]=='멘티'){
    $profile_label = array(
        "title"=>"<h5 class='text-info'>M E N T E E</h5>",
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
    <!-- <h1 class="h3 mb-4 text-gray-800">나의 정보</h1> -->
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
                <h6 class="text-dark"><?php if($user_data[company]){echo $user_data[company]." / ".$user_data[job];}?></h6>
            </div>
        </div>
            <!-- <div class="card shadow custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div> -->
    </div>
    <div class="col-md-8">
      <h5 class="mb-3">프로필</h5>
      <form method="post" action="index.php?id=profile_update">
        <input type="hidden" name="grade" value="<?php echo $user_data[grade];?>">
        <div class="row card-header shadow bg-white mx-1">
          <div class="col-md-3 mb-3">
            <label for="name">멘토링 활동</label>
            <div>
            <input class="form-control" name="activity" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="danger"  data-width="100%"
            <?php 
              echo $user_data[activity] == 'on' ? "checked" : "";
            ?>>
            </div>
          </div>          
          <div class="col-md-3 mb-3">
              <label for="address_search">주소검색</label>
              <button class="shadow btn btn-info btn-md btn-block" onclick="goPopup();">검색</button>
          </div>
          <div class="col-md-6 mb-3">
            <label for="area"><?php echo $profile_label[area];?></label>
            <input type="text" class="form-control" id ="siNm" name="area" placeholder="직장/학교/집" value="<?php echo $user_data[area];?>" readonly>
          </div>
          <div class="col-md-4 mb-3">
            <label for="zipcode"><?php echo $profile_label[zipcode];?></label>
            <input type="text" class="form-control" id ="zipNo" name="zipcode" placeholder="" value="<?php echo $user_data[zipcode];?>" readonly>
          </div>
          <div class="col-md-8 mb-3">
            <label for="address1"><?php echo $profile_label[address1];?></label>
            <input type="text" class="form-control" id ="roadAddrPart1" name="address1" placeholder="" value="<?php echo $user_data[address1];?>" readonly>
          </div>
          <div class="col-md-12 mb-3">
            <label for="address"><?php echo $profile_label[address2];?></label>
            <input type="text" class="form-control" id ="addrDetail" name="address2" placeholder="" value="<?php echo $user_data[address2];?>"  required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="name"><?php echo $profile_label[name];?></label>
            <input type="text" class="form-control" name="name" placeholder="실명을 입력해주세요." value="<?php echo $user_data[name];?>" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="email"><?php echo $profile_label[email];?></label>
            <input type="text" class="form-control" name="email" placeholder="" value="<?php echo $user_data[email];?>" readonly>
          </div>

          <div class="col-md-4 mb-3">
            <label for="phone"><?php echo $profile_label[phone];?></label>
            <input type="text" class="form-control" name="phone" placeholder="010-0000-0000" value="<?php echo $user_data[phone];?>"  required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="company"><?php echo $profile_label[company];?></label>
            <input type="text" class="form-control" name="company" placeholder="직장/학교명" value="<?php echo $user_data[company];?>"  required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="job"><?php echo $profile_label[job];?></label>
            <input type="text" class="form-control" name="job" placeholder="직업/직위/학년명" value="<?php echo $user_data[job];?>"  required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="user_keyword"><?php echo $profile_label[user_keyword];?></label>
            <input type="text" class="form-control" data-role="tagsinput" name="user_keyword" placeholder="" value="<?php echo $user_data[user_keyword];?>"  required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="mentoring_keyword"><?php echo $profile_label[mentoring_keyword];?></label>
            <input type="text" class="form-control" data-role="tagsinput" name="mentoring_keyword" placeholder="" value="<?php echo $user_data[mentoring_keyword];?>"  required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="introduce"><?php echo $profile_label[introduce];?></label>
            <textarea type="text" class="form-control" id="editor" name="introduce" placeholder="작성하신 키워드를 중심으로 소개해주세요."><?php echo str_replace( '&', '&amp;', $user_data[introduce]);?></textarea>
          </div>
        </div>
        <input class="shadow btn btn-primary btn-lg btn-block mt-3 mb-3" type="submit" name="update" value="나의 정보 업데이트">
      </form>
    </div>
  </div>
</div>
</div>

<!-- amsifySuggestags -->
<script type="text/javascript">
	$('input[name="user_keyword"]').amsifySuggestags();
	$('input[name="mentoring_keyword"]').amsifySuggestags();
</script>


<script language="javascript">
// opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
//document.domain = "abc.go.kr";

function jusoCallBack(roadFullAddr,roadAddrPart1,addrDetail,roadAddrPart2,engAddr,jibunAddr,zipNo,admCd,rnMgtSn,bdMgtSn,detBdNmList,bdNm,bdKdcd,siNm,sggNm,emdNm,liNm,rn,udrtYn,buldMnnm,buldSlno,mtYn,lnbrMnnm,lnbrSlno,emdNo){
	document.getElementById('roadFullAddr').value = roadFullAddr;
	document.getElementById('roadAddrPart1').value = roadAddrPart1;
	document.getElementById('addrDetail').value = addrDetail;
	document.getElementById('roadAddrPart2').value = roadAddrPart2;
	document.getElementById('engAddr').value = engAddr;
	document.getElementById('jibunAddr').value = jibunAddr;
	document.getElementById('zipNo').value = zipNo;
	document.getElementById('admCd').value = admCd;
	document.getElementById('rnMgtSn').value = rnMgtSn;
	document.getElementById('bdMgtSn').value = bdMgtSn;
	document.getElementById('detBdNmList').value = detBdNmList;
	//** 2017년 2월 제공항목 추가 **/
	document.getElementById('bdNm').value = bdNm;
	document.getElementById('bdKdcd').value = bdKdcd;
	document.getElementById('siNm').value = siNm;
	document.getElementById('sggNm').value = sggNm;
	document.getElementById('emdNm').value = emdNm;
	document.getElementById('liNm').value = liNm;
	document.getElementById('rn').value = rn;
	document.getElementById('udrtYn').value = udrtYn;
	document.getElementById('buldMnnm').value = buldMnnm;
	document.getElementById('buldSlno').value = buldSlno;
	document.getElementById('mtYn').value = mtYn;
	document.getElementById('lnbrMnnm').value = lnbrMnnm;
	document.getElementById('lnbrSlno').value = lnbrSlno;
	//** 2017년 3월 제공항목 추가 **/
	document.getElementById('emdNo').value = emdNo;
}

function goPopup(){
	// 주소검색을 수행할 팝업 페이지를 호출합니다.
	// 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrLinkUrl.do)를 호출하게 됩니다.
	var pop = window.open("/jusoPopup_utf8.php","pop","width=570,height=420, scrollbars=yes, resizable=yes"); 
	
	// 모바일 웹인 경우, 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrMobileLinkUrl.do)를 호출하게 됩니다.
    //var pop = window.open("/jusoPopup_utf8.php","pop","scrollbars=yes, resizable=yes"); 
}
</script>
