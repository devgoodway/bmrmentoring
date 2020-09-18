<?php
//멘토링 정보 출력하기
    $sql = "SELECT * FROM bm_mentoring 
    WHERE (mentor LIKE '{$row_user[email]}'
    OR cd_mentor LIKE '{$row_user[email]}'
    OR cd_mentee LIKE '{$row_user[email]}'
    OR mentee LIKE '{$row_user[email]}')";
    if($row_user[grade] == '멘토'){
        $sql .= " AND okay != '검토중'";
    }
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
        <h6 class="m-0 font-weight-bold text-primary">나의 멘토링</h6>
    </div>
    <div class="card-body">
        <div class="">
        <table class="display responsive nowrap" id="dataTable" width="100%">
            <thead>
            <tr>
                <th>시즌</th>
                <th>주제</th>
                <th>상태</th>
                <th>멘토</th>
                <th>멘티</th>
                <th>작성일시</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($mentoring_data = $result->fetch_assoc()){
                    //멘토 정보 출력
                    $sql = "SELECT * FROM bm_user WHERE email='{$mentoring_data[mentor]}'";
                    $result_mentor = $conn->query($sql);
                    if ($result_mentor->num_rows > 0) {
                        $mentor_data = $result_mentor->fetch_assoc();
                    }
                    //멘티 정보 출력
                    $sql = "SELECT * FROM bm_user";
                    $result_mentee = $conn->query($sql);
                    if ($result_mentee->num_rows > 0) {
                        $mentee_list = '';
                        while($mentee_data = $result_mentee->fetch_assoc()){
                            if(strpos($mentoring_data[mentee], $mentee_data[email]) !== false)
                                $mentee_list .= $mentee_data[name]." ";
                        }
                    }

                    if($mentoring_data[okay]=='검토중')
                        $state = '검토중';
                    elseif($mentoring_data[okay]=='작성중')
                        $state = '작성중';
                    elseif($mentoring_data[okay]=='승인')
                        $state = '승인';

                    echo "
                    <tr>
                        <td>{$mentoring_data[season]}</td>
                        <td><a href='index.php?id=mentoring_plan&plan_id={$mentoring_data[id]}'>{$mentoring_data[title]}</a></td>
                        <td>{$state}</td>
                        <td>{$mentor_data[name]}</td>
                        <td>{$mentee_list}</td>
                        <td>{$mentoring_data[created]}</td>
                    </tr>
                    ";
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
