<?php
//등록
if($_POST[insert]){
    $sql = "SELECT * FROM bm_season WHERE season='{$_POST[season]}'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $sql = 
        "INSERT 
        INTO bm_season(season,present)
        VALUES ('{$_POST[season]}', 'N')";
    }else{
        echo "<script>alert('이미 등록되어 있습니다.');location.href='./index.php?id=admin_season'</script>";
		exit;
    }
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
//수정
if($_POST[update]){
    //전체 초기화
    $sql = 
    "UPDATE bm_season 
    SET 
    present = 'N'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }

    //해당 시즌 선택
    $sql = 
    "UPDATE bm_season 
    SET 
    present = 'Y'
    WHERE 
    season='{$_POST[present]}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    }
}
//삭제
if($_POST[delete]){
    $sql = "DELETE FROM bm_season WHERE season='{$_POST[season_del]}'";

    if ($conn->query($sql) === FALSE) {
        echo "Error deleting record: " . $conn->error;
    }
}

//정보 출력
$sql = "SELECT * FROM bm_season";
$result = $conn->query($sql);
$result_del = $conn->query($sql);

$conn->close();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">시즌관리</h6>
        </div>
        <div class="card-body">
          <div class="">
            <div class="card shadow mb-3">
            <form method="post" action="index.php?id=admin_season">
                <div class="row m-3">
                    <div class="col-md-6 mb-3">
                        <label for="present">현재 시즌</label>
                        <p class="text-dark"><?php echo $present_data[season];?></p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="present">멘토링 신청을 진행 할 시즌</label>
                        <select class="custom-select d-block w-100" name="present">
                        <?php
                            while($season_data = $result->fetch_assoc()){
                                echo "<option value='{$season_data[season]}'>{$season_data[season]}</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="area">수정</label>
                        <input class="btn btn-success btn-md btn-block" type="submit" name="update" value="수정">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="present">삭제 할 시즌</label>
                        <select class="custom-select d-block w-100" name="season_del">
                        <?php
                            while($season_data = $result_del->fetch_assoc()){
                                echo "<option value='{$season_data[season]}'>{$season_data[season]}</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="area">삭제</label>
                        <input class="btn btn-danger btn-md btn-block" type="submit" name="delete" value="삭제">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="season">등록 할 시즌명</label>
                        <input type="text" class="form-control" name="season" placeholder="" value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="area">등록</label>
                        <input class="btn btn-primary btn-md btn-block" type="submit" name="insert" value="등록">
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
