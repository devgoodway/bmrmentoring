<?php
//멘토링 정보 출력하기
    $sql = "SELECT * 
    FROM bm_user
    WHERE activity = 'on'
    AND grade NOT LIKE '멘티'
    AND okay LIKE '승인'
    ";
    $result = $conn->query($sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> <p class="mb-4">DataTables is
    a third party plugin that is used to generate the demo table below. For more
    information about DataTables, please visit the <a target="_blank"
    href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">멘토 찾기</h6>
        </div>
        <div class="card-body">
            <div class="">
                <table class="display responsive nowrap" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>이름</th>
                            <th>직업</th>
                            <th>지역</th>
                            <th>멘토링 키워드</th>
                            <th>멘토 키워드</th>
                            <th>자기소개</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
            while($user_data = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td><a href='index.php?id=profile&email={$user_data[email]}'>{$user_data[name]}</a></td>
                        <td>{$user_data[job]}</td>
                        <td>{$user_data[area]}</td>
                        <td>{$user_data[mentoring_keyword]}</td>
                        <td>{$user_data[user_keyword]}</td>
                        <td>{$user_data[introduce]}</td>
                    </tr>
                    ";
            }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->