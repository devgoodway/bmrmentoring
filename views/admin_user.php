<?php
//회원 정보 출력하기
    $sql = "SELECT A.email,A.name,A.grade,A.okay,A.created,B.name AS cd_name 
    FROM bm_user AS A
    LEFT JOIN bm_user AS B
    ON A.coordinator = B.email";
    $result = $conn->query($sql);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">회원관리</h6>
    </div>
    <div class="card-body">
        <div class="">
        <table class="display responsive nowrap" id="dataTable" width="100%">
            <thead>
            <tr>
                <th>이름</th>
                <th>이메일</th>
                <th>직위</th>
                <th>코디네이터</th>
                <th>가입상태</th>
                <th>작성일시</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while($user_data = $result->fetch_assoc()){
                    //코디네이터 정보 출력하기
                        // $sql = "SELECT * FROM bm_user WHERE id = {$user_data[coordinator]}";
                        // $result_cd = $conn->query($sql);
                        // $cd_data = $result_cd->fetch_assoc();
                    echo "
                    <tr>
                        <td><a href='index.php?id=admin_user_update&user_email={$user_data[email]}'>{$user_data[name]}</a></td>
                        <td>{$user_data[email]}</td>
                        <td>{$user_data[grade]}</td>
                        <td>{$user_data[cd_name]}</td>
                        <td>{$user_data[okay]}</td>
                        <td>{$user_data[created]}</td>
                    </tr>";
                }
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>

</div>
<!-- /.container-fluid -->
