<?php
if($_GET[notice_id]){
    //정보 출력
    $sql = "SELECT notice.id,notice.title,notice.contents,notice.created,user.name,user.email
    FROM bm_notice AS notice 
    INNER JOIN bm_user AS user 
    ON notice.id = '{$_GET[notice_id]}' 
    AND notice.user_id = user.email";
    $result = $conn->query($sql);
    $notice_data = $result->fetch_assoc();
}

if($_GET[del]){
    //정보 출력
    $sql = "DELETE FROM bm_notice WHERE id = '{$_GET[notice_id]}'";
    //에러 확인 및 출력 페이지 이동   
    if ($conn->query($sql) === FALSE) {
      echo "Error delete: " . $conn->error;
    }else{
      echo "<script>location.href='index.php?id=notice_list'</script>";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">공지사항</h6>
        </div>
        <div class="card-body">
            <h5><?php echo $notice_data[title];?></h5>
            <hr>
            <p><?php echo str_replace( '&', '&amp;', $notice_data[contents]);?></p>
            <hr>
            <div class="text-right">
                <span><?php echo $notice_data[name];?></span>
                <span><?php echo $notice_data[created];?></span>
            </div>
        </div>
        <div class="text-right mr-3 mb-3">
        <?php if($admin_key>4 || $notice_data[email] == $email){?>
            <a class='shadow btn btn-danger btn-sm mb-3' href="index.php?id=notice_view&del=on&notice_id=<?php echo $notice_data[id];?>">삭제</a>
            <a class='shadow btn btn-warning btn-sm mb-3' href="index.php?id=notice_write&notice_id=<?php echo $notice_data[id];?>">수정</a>
        <?php }?>
            <!-- <a class='shadow btn btn-primary btn-sm mb-3' href="index.php?id=notice_send&notice_id=<?php echo $notice_data[id];?>">발행</a> -->
            <a class='shadow btn btn-info btn-sm mb-3' href="index.php?id=notice_list">목록</a>
        </div>
    </div>
      <div id="disqus_thread"></div>
</div>
<!-- /.container-fluid -->