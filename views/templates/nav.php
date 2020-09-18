<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="https://image.flaticon.com/icons/svg/1604/1604752.svg" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">별무리 멘토링</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        BMR MENTORING
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tutorial" aria-expanded="true" aria-controls="tutorial">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>배우기</span>
        </a>
        <div id="tutorial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tutorial:</h6>
            <a class="collapse-item" href="index.php?id=tutorial_start">시작하기</a>
            <a class="collapse-item" href="index.php?id=tutorial_mentor">별무리 멘토란?</a>
            <a class="collapse-item" href="index.php?id=tutorial_mentee">별무리 멘티란?</a>
            <!-- <a class="collapse-item" href="index.php?id=tutorial_finish">마무리하기</a> -->
          </div>
        </div>
      </li>
<?php if($admin_key>1){?>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notice" aria-expanded="true" aria-controls="notice">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>알리기</span>
        </a>
        <div id="notice" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Notice:</h6>
            <a class="collapse-item" href="index.php?id=notice_list">공지사항</a>
            <a class="collapse-item" href="index.php?id=calendar">학사일정</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#search" aria-expanded="true" aria-controls="search">
          <i class="fas fa-fw fa-search"></i>
          <span>탐색하기</span>
        </a>
        <div id="search" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Search:</h6>
            <a class="collapse-item" href="index.php?id=search_mentor">멘토 찾기</a>
            <a class="collapse-item" href="index.php?id=search_mentee">멘티 찾기</a>
            <a class="collapse-item" href="index.php?id=search_mentoring">멘토링 찾기</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#activity" aria-expanded="true" aria-controls="coordinator">
          <i class="fas fa-fw fa-running"></i>
          <span>활동하기</span></a>
        <div id="activity" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Activity:</h6>
            <a class="collapse-item" href="index.php?id=mentoring_list">나의 멘토링</a>
          </div>
        </div>
      </li>
      <?php }if($row_user[email]=='mrgoodway@bmrschool.org'){?>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coordinator" aria-expanded="true" aria-controls="coordinator">
          <i class="fas fa-fw fa-cog"></i>
          <span>관리하기</span>
        </a>
        <div id="coordinator" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Search:</h6>
            <a class="collapse-item" href="index.php?id=admin_user">회원관리</a>
            <a class="collapse-item" href="index.php?id=admin_season">시즌관리</a>
          </div>
        </div>
      </li>
      <?php }?>
      <!-- Divider -->
      <hr class="sidebar-divider d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
          <p class="mt-4 mb-4 d-none d-md-inline">현재 매칭이 진행되고 있는 시즌은 [<mark><?php echo $present_data[season];?></mark>]입니다.</p>
          <p class="mt-4 mb-4 d-inline d-md-none"><?php echo $present_data[season];?></p>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php 
                        if(isset($row_user[name])){
                          echo $row_user[name].' '.$row_user[grade].'님 안녕하세요!';
                        }elseif(isset($_COOKIE[Email])){
                            echo $_COOKIE[Name].'님 안녕하세요!';
                        }else{
                            echo '환영합니다!';
                        } 
                    ?>
                </span>
                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php
								if(isset($_COOKIE[Email])){
									echo '
                                    <a class="dropdown-item" href="index.php?id=profile">
                                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                      나의 정보
                                    </a>
                                    <a class="dropdown-item" href="index.php?id=profile_update">
                                      <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                      업데이트
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    로그아웃
                                  </a>';
								}
								else{
									echo '
									<a class="dropdown-item" href="./index.php?id=login"><i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>로그인</a>
									<a class="dropdown-item" href="./index.php?id=register"><i class="fas fa-registered fa-sm fa-fw mr-2 text-gray-400"></i>회원가입</a>';
								}?>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
