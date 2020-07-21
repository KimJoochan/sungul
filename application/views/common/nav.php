<body id="page-top" style="overflow-x:hidden;">
<header id="header">
	<div class="inner">
		<div class="home"><a href="<?=base_url()?>">HOME</a></div>
		<div class="bar"></div>
		<div class="login">
			<?php if(isset($_SESSION['id'])){ ?>
				<a href="<?=base_url()?>index/action/login_out">로그아웃</a>
			<?php }else{ ?>
				<a href="<?=base_url()?>index/board/login">로그인</a>
			<?php } ?>
		</div>
	</div>
</header>
<!-- 홈,로그인 -->
<div id="nav">
	<div class="inner clearfix">
		<div class="img" onclick="location.href='<?=base_url()?>'">
			<img src="<?=base_url()?>static/img/logo_03.png" alt="">
		</div>
		<div class="navs">
			<div class="line"><a href="<?=base_url()?>index/info/info">우리도량소개</a></div>
			<div class="line"><a href="<?=base_url()?>index/info/dalma">달마선원</a></div>
			<div><a href="<?=base_url()?>index/info/establish">달마공동체<br>둥지장학회</a></div>
			<div><a href="<?=base_url()?>index/info/schedule">정기법회<br>행사계획</a></div>
		</div>
	</div>

	<div id="gnb">
		<div class="inner clearfix" style="height:200px;">
			<ul>
				<li><a href="<?=base_url()?>index/info/schedule">법회일정</a></li>
				<li><a href="<?=base_url()?>index/info/month">이달의 행사</a></li>
				<li><a href="<?=base_url()?>index/board/notice">알림방</a></li>
				<li><a href="<?=base_url()?>index/board/gallery">갤러리</a></li>
			</ul>
			<ul>
				<li><a href="<?=base_url()?>index/info/establish">설립취지</a></li>
				<li><a href="<?=base_url()?>index/info/organization">기구표, 임원현황</li>
				<li><a href="<?=base_url()?>index/info/scholarship">장학금 수혜자</a></li>
				<!-- <li><a href="../info/rule.php">장학회 회칙</a></li> -->
				<li><a href="<?=base_url()?>index/info/sponsor">장학금 후원자현황</a></li>
			</ul>
			<ul>
				<li><a href="<?=base_url()?>index/info/dalma">달마선원</a></li>
			</ul>
			<ul>
				<li><a href="<?=base_url()?>index/info/info">도량소개</a></li>
				<li><a href="<?=base_url()?>index/info/greeting">주지스님 인사말</a></li>
				<li><a href="<?=base_url()?>index/info/directions">오시는 길</a></li>
			</ul>
			<!-- float right때문에 역순 -->
		</div>
	</div>
</div>
		<a class="menu-toggle menu-m" href="#">
		  <!-- <i class="fa fa-bars"></i> -->
		  <div class="icon"></div>
		</a>
	<nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
      	<li class="sidebar-brand"><a href="../index/index.php">성불사</a>
        </li>
        <li class="sidebar-nav-item" data-toggle="collapse" href="#menu1_m" aria-expanded="false" aria-controls="menu1_m">우리도량소개
        </li>
        <div class="collapse" id="menu1_m">
			<a href='../info/info.php'">도량소개</a>
			<a href='../info/greeting.php'">주지스님인사말</a>
			<a href='../info/directions.php'">오시는길</a>
		</div>
		<li class="sidebar-nav-item" data-toggle="collapse" href="#menu2_m" aria-expanded="false" aria-controls="menu2_m">달마선원
        </li>
        <div class="collapse" id="menu2_m">
			<a href='../info/dalma.php'">달마선원</a>
		</div>
		<li class="sidebar-nav-item" data-toggle="collapse" href="#menu3_m" aria-expanded="false" aria-controls="menu3_m">달마공동체 둥지장학회
        </li>
        <div class="collapse" id="menu3_m">
			<a href='../info/establish.php'">설립취지</a>
			<a href='../info/organization.php'">기구표, 임원현황</a>
			<a href='../info/scholarship.php'">장학금 수혜자</a><!-- 
			<a href='../info/rule.php'">장학회 회칙</a> -->
			<a href='../info/sponsor.php'">장학금 후원자현황</a>
		</div>
		<li class="sidebar-nav-item" data-toggle="collapse" href="#menu4_m" aria-expanded="false" aria-controls="menu4_m">정기법회 행사계획
        </li>
        <div class="collapse" id="menu4_m">
			<a href='../info/schedule.php'">법회일정</a>
			<a href='../info/month.php'">이달의 행사</a>
			<a href='../board/notice.php'">알림방</a>
			<a href='../board/gallery.php'">갤러리</a>
		</div>
      </ul>
    </nav>
<!-- 네비버튼 -->