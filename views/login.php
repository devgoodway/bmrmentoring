
<div class="content" style="margin-top: 21vh;">
        <div class="container" style="margin-top: 5vh;">
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
              <div class="card mb-5">
                <div class="card-header ">
                  <div class="card-header ">
                    <h3 class="header text-center">Login</h3>
                  </div>
                </div>
                <div class="card-body text-center mt-5">
					<?php
					if(isset($_COOKIE[Email])){
						echo "<script>location.href='./index.php'</script>";
						exit;
					}else{
                       echo '
                       <div class="d-flex justify-content-center">
                        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                       </div>
					  <hr class="mt-5">
					  <div class="text-center">
					  	<label>구글 아이디로 로그인 하세요.</label>
				      </div>';
						}?>
                </div>
              </div>
          </div>
        </div>