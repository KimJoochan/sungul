<section id="location-bar">
  <div class="inner clearfix">
    <div class="home" onclick="location.href='<?= base_url()?>'">
    	<div class="img"></div>
    </div>
    <div class="sub-1">
    	<div class="arrow-down"></div>
    	<button data-toggle="collapse" href="#HL" aria-expanded="false" aria-controls="HL" class="mHleft"></button>
    	<div class="collapse" id="HL">
			<div data-page="info" onclick="location.href='<?=base_url()?>index/info/info'">우리도량소개</div>
			<div data-page="dalma" onclick="location.href='<?=base_url()?>index/info/dalma'">달마선원</div>
			<div data-page="establish" onclick="location.href='<?=base_url()?>index/info/establish'">달마공동체 둥지장학회</div>
			<div data-page="schedule" onclick="location.href='<?=base_url()?>index/info/schedule'">정기법회 행사계획</div>
		</div>
    </div>
    <div class="sub-2">
    	<div class="arrow-down"></div>
		<button data-toggle="collapse" href="#mH1" aria-expanded="false" aria-controls="mH1" class="mHright" data-page="info"></button>
		<div class="collapse" id="mH1">
			<div data-page="info" onclick="location.href='<?=base_url()?>index/info/info'">도량소개</div>
			<div data-page="greeting" onclick="location.href='<?=base_url()?>index/info/greeting'">주지스님인사말</div>
			<div data-page="directions" onclick="location.href='<?=base_url()?>index/info/directions'">오시는길</div>
		</div>
		<button data-toggle="collapse" href="#mH2" aria-expanded="false" aria-controls="mH2" class="mHright" data-page="dalma"></button>
		<div class="collapse" id="mH2">
			<div data-page="dalma" onclick="location.href='../info/dalma.php'">달마선원</div>
		</div>
		<button data-toggle="collapse" href="#mH3" aria-expanded="false" aria-controls="mH3" class="mHright" data-page="establish"></button>
		<div class="collapse" id="mH3">
			<div data-page="establish" onclick="location.href='<?=base_url()?>index/info/establish'">설립취지</div>
			<div data-page="organization" onclick="location.href='<?=base_url()?>index/info/organization'">기구표, 임원현황</div>
			<div data-page="scholarship" onclick="location.href='<?=base_url()?>index/info/scholarship'">장학금 수혜자</div>
			<!-- <div data-page="rule" onclick="location.href='../info/rule.php'">장학회 회칙</div> -->
			<div data-page="sponsor" onclick="location.href='<?=base_url()?>index/info/sponsor'">장학금 후원자현황</div>
		</div>
		<button data-toggle="collapse" href="#mH4" aria-expanded="false" aria-controls="mH4" class="mHright" data-page="schedule"></button>
		<div class="collapse" id="mH4">
			<div data-page="schedule" onclick="location.href='<?=base_url()?>index/info/schedule'">법회일정</div>
			<div data-page="month" onclick="location.href='<?=base_url()?>index/info/month'">이달의 행사</div>
			<div data-page="notice" onclick="location.href='<?=base_url()?>index/board/notice'">알림방</div>
			<div data-page="gallery" onclick="location.href='../board/gallery.php'">갤러리</div>
		</div>
    </div>
  </div>
</section>
<script type="text/javascript">
	$(function(){
		var CurrentFileName = document.URL.substring(document.URL.lastIndexOf("/") + 1, document.URL.lastIndexOf("/") + 30);//경로명 제외
		var Page = CurrentFileName.split('.')[0];//페이지의 이름만 추출
		let page=parseInt(Page);
		var CurrentFileName = document.location.href;
		let uri=CurrentFileName.split('/');
		let resUrl=uri.reverse();
		if(uri.length==8){ //뒤에서 첫번째 확인
			Page=resUrl[1];
		}else if(resUrl.length==9){
			Page=resUrl[2];
		}
		var all = [ ['info','greeting','directions'],['dalma'],['establish','organization','scholarship','insertScholar','updateScholar',/*'rule',*/'executive','insertExecutive','updateExecutive','sponsor','insertSponsor','updateSponsor'],['schedule','insertSchedule','updateSchedule','month','insertEvent','updateEvent','updateEventEach','notice','insertNotice','noticeView','updateNotice','gallery','insertGallery','galleryView','updateGallery']];
		//페이지들의 그룹들, 그 그룹의 가장 첫번째 꺼가 좌측그룹의 data-page와 동일
		//만약 공지사항이나 자료실, 온천소식의 세부페이지가 생기면 notice가 있는 그룹에 페이지명을 추가로 넣어주어야함.
		var mHPage="";
		for(var i=0; i<all.length;i++){
			if(all[i].indexOf(Page)!=-1){//현제페이지의 그룹을 찾음
				mHPage=all[i][0];//그 그룹의 가장 첫번째 객체를 대표명으로 사용
				break;
			}
		};//좌측그룹명 찾음

		//하위페이지뷰어 처리, 하위페이지가 생기면 상위페이지로 처리해주어야함.
		//ex) if(Page=='noteceview'){Page='notice';}
		if(Page=='insertScholar'||Page=='updateScholar'){Page='scholarship';}
		if(Page=='insertEvent'||Page=='updateEvent'||Page=='updateEventEach'){Page='month';}
		if(Page=='insertNotice'||Page=='noticeView'||Page=='updateNotice'){Page='notice';}
		if(Page=='insertGallery'||Page=='galleryView'||Page=='updateGallery'){Page='gallery';}
		if(Page=='insertSponsor'||Page=='updateSponsor'){Page='sponsor';}
		if(Page=='insertSchedule'||Page=='updateSchedule'){Page='schedule';}
		$(`.mHright[data-page=${mHPage}]`).addClass('active');
		$('.sub-2>.collapse>div[data-page='+Page+']').addClass('active');
		var PageName = $('#location-bar .collapse>.active').text();
		var LHName = $('#HL>div[data-page='+mHPage+']').text();
		$('.mHright').text(PageName);
		$('.mHleft').text(LHName);

		$('.mHright').click(function(){
			var $left = $('.mHleft');
			if($left.attr('aria-expanded')=='true'){
				$left.trigger('click');
			}
		});
		$('.mHleft').click(function(){
			var $right = $('.mHright.active');
			if($right.attr('aria-expanded')=='true'){
				$right.trigger('click');
			}
		});
	});
</script>
