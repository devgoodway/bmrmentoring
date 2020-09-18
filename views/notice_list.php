<?php
  //정보 출력
  $sql = "SELECT notice.id,notice.title,notice.created,user.name 
  FROM bm_notice AS notice
  INNER JOIN bm_user AS user
  ON notice.user_id = user.email
  ORDER BY notice.created DESC";
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
            <h6 class="m-0 font-weight-bold text-primary">공지사항</h6>
        </div>
        <div class="card-body">
            <div class="">
                <table class="display responsive nowrap" id="no" width="100%">
                    <thead>
                        <tr>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일시</th>
                            <!-- <th>번호</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    $num = 0;
                      while($notice_data = $result->fetch_assoc()){
                        $num = $result->num_rows - $i;
                      echo "
                        <tr>
                            <td>
                                <a href='index.php?id=notice_view&notice_id={$notice_data[id]}'>{$notice_data[title]}</a>
                            </td>
                            <td>{$notice_data[name]}</td>
                            <td>{$notice_data[created]}</td>
                            <!-- <td>{$num}</td>-->
                        </tr>
                      ";
                      $i++;
                      }
                    ?>
                    </tbody>
                </table>
                <div class="text-right mb-3 mt-3">
                <?php if($admin_key>3){?>
                    <a class='shadow btn btn-primary btn-sm' href="index.php?id=notice_write" name='write'>글쓰기</a>
                <?php }?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->