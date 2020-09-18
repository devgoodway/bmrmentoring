<div class="content" style="margin-top: 21vh;">
	<div class="container" style="margin-top: 5vh;">
		<div class="col-lg-5 col-md-5 ml-auto mr-auto">
			<form class="form" method="post" action="./index.php?id=profile_update">
				<div class="card card-login mb-5">
					<div class="card-header">
						<div class="card-header">
							<h3 class="header text-center">Register</h3>
						</div>
					</div>
					<div class="card-body text-center">
						<?php
					if(isset($_COOKIE[Email])){
					  echo $_COOKIE[Name].'님 안녕하세요.<br>
						<a href="./logout.php">Sign out</a>
						<hr />
						<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text">
									이름
								</span>
							</div>
                            <input
                                name = "name"
								type="text"
                                class="form-control"
                                value="'.$_COOKIE[Name].'"
								placeholder=""
							/>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									유형
								</span>
							</div>
							<select class="form-control" name="grade">
								<option value="멘토">멘토</option>
								<option value="멘티">멘티</option>
							</select>
						</div>
						<br />
						<div class="form-group">
							<div class="form-check text-left">
								<label class="form-check-label">
                                    <input 
                                    id="infosecurity" 
                                    class="form-check-input" 
                                    type="checkbox"
                                    onclick="clause();" />
									<span class="form-check-sign"></span>
									나는 다음과 같은 
									<a href="index.php?id=infosecurity" target="_blank">개인정보처리방침</a>에 동의합니다.
								</label>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<input
							type="submit"
							value="Get Started"
                            class="btn btn-warning btn-round btn-block"
                            id="submit"
                            name="submit"
                            disabled="disabled"
                            onclick="insert();"
                            >'; 
                        }else{ 
                        echo '
                        <div class="mt-5 d-flex justify-content-center">
                        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                        </div>
						<hr style="margin-top: 60px;" />
						<div class="text-center">
							<label>구글 아이디로 로그인 하세요.</label>
						</div>
						'; }?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
function clause(){
if($(infosecurity).is(":checked"))
    $submit = $(submit).attr('disabled', false);
else
    $submit = $(submit).attr('disabled', true); 
}
</script>

<script>
    function insert() {
        alert("환영합니다!");
    }
</script>
