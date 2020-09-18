<?php
// 사용자 정보를 담은 쿠키를 모두 초기화하고 메인화면을 출력한다.2020/02/06
setcookie(Name,'');
setcookie(Email,'');
setcookie(Avatar,'');
setcookie(Picture,'');
header("Location: ./index.php");
exit;
?>