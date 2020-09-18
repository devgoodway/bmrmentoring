<?php
//등록
if($_POST[write]){
    //정보 출력
    $sql = "SELECT * FROM bm_notice WHERE id = '{$_POST[id]}'";
    $result = $conn->query($sql);

    if($result->num_rows === 0){
        //공지사항 등록
        $sql = "INSERT 
        INTO bm_notice(user_id, title, contents)
        VALUES ('{$email}', '{$_POST[title]}', '{$_POST[contents]}')";
    }else{
        //공지사항 업데이트
        $sql = 
        "UPDATE bm_notice 
        SET 
        user_id = '{$email}',
        title = '{$_POST[title]}',
        contents = '{$_POST[contents]}'
        WHERE 
        id='{$_POST[id]}' AND user_id = '{$email}'";
    }
    //에러 확인 및 출력 페이지 이동   
    if ($conn->query($sql) === FALSE) {
      echo "Error updating record: " . $conn->error;
    }else{
      echo "<script>location.href='./index.php?id=notice_view&notice_id={$_POST[id]}'</script>";
    }
}

if($_GET[notice_id]){
    //정보 출력
    $sql = "SELECT * FROM bm_notice WHERE id = '{$_GET[notice_id]}'";
    $result = $conn->query($sql);
    $notice_data = $result->fetch_assoc();
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">공지사항</h6>
        </div>
        <form method="post" action="index.php?id=notice_write">
            <input type="hidden" name="id" value="<?php echo $notice_data[id];?>">
            <div class="card-body">
                <label for='title'>제목</label>
                <h5><input
                    type="text"
                    class="form-control"
                    name="title"
                    placeholder=""
                    value="<?php echo $notice_data[title];?>"></h5>
                <hr>
                <label for='contents'>내용</label>
                <p>
                    <textarea
                        type="text"
                        class="form-control"
                        id="editor"
                        name="contents"
                        placeholder=""><?php echo $notice_data[contents];?></textarea>
                </p>
            </div>
            <div class="text-right mr-3">
                <input
                    class='shadow btn btn-success btn-sm mb-3'
                    type='submit'
                    name='write'
                    value='작성'
                    onclick="insert();">
                <a class='shadow btn btn-info btn-sm mb-3' href="index.php?id=notice_list">목록</a>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    function insert() {
        alert("등록되었습니다!");
    }
</script>