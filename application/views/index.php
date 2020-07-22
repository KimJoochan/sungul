<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <section id="main-slider">
            <div class="swiper-container slider1">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="<?=base_url()?>static/img/slide1.jpg" alt="" class="web"><img src="<?=base_url()?>static/img/slide1_m.jpg" alt="" class="mobile"></div>
                  <div class="swiper-slide"><img src="<?=base_url()?>static/img/slide2.jpg" alt="" class="web"><img src="<?=base_url()?>static/img/slide2_m.jpg" alt="" class="mobile"></div>
                  <div class="swiper-slide"><img src="<?=base_url()?>static/img/slide3.jpg" alt="" class="web"><img src="<?=base_url()?>static/img/slide3_m.jpg" alt="" class="mobile"></div>
                  <div class="swiper-slide"><img src="<?=base_url()?>static/img/slide4.jpg" alt="" class="web"><img src="<?=base_url()?>static/img/slide4_m.jpg" alt="" class="mobile"></div>
                </div>
                <div class="intro">
                  <div class="title">성불사는</div>
                  <div class="contents">부산의 명산인 금정산 고당봉을 바라보며<br>
                  우뚝 솟은 계명봉 줄기의 끝자락에 위치하고 있습니다.</div>
                  <img src="<?=base_url()?>static/img/more.png" alt="" style="cursor: pointer" onclick="location.href='<?=base_url()?>index/info/info'" class="more">
                </div>
            </div>
            <script>
                var swiper = new Swiper('.slider1', {
                  autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                  },
                  loop: true
                });
            </script>
  </section>
  <!-- 메인이미지슬라이더 -->

  <section id="main-btns">
    <div class="inner">
      <div class="btns clearfix">
        <div class="Btn" onclick="location.href='<?=base_url()?>index/info/info'">
          <img src="<?=base_url()?>static/img/btn1.png" alt="">
          <div>도량소개</div>
        </div>
        <div class="bar"></div>
        <div class="Btn" onclick="location.href='<?=base_url()?>index/info/greeting'">
          <img src="<?=base_url()?>static/img/btn2.png" alt="">
          <div>인사말</div>
        </div>
        <div class="bar"></div>
        <div class="Btn" onclick="location.href='<?=base_url()?>index/info/schedule'">
          <img src="<?=base_url()?>static/img/btn3.png" alt="">
          <div>법회일정</div>
        </div>
        <div class="bar"></div>
        <div class="Btn" onclick="location.href='<?=base_url()?>index/info/directions'">
          <img src="<?=base_url()?>static/img/btn4.png" alt="">
          <div>오시는길</div>
        </div>
      </div>
    </div>
  </section>
  <!-- 메인버튼 -->
  <div style="height:110px;" class="main-gap"></div>

  <div id="main-mid">
    <div class="inner clearfix">
      <section id="main-notice">
        <div class="notice-top clearfix">
          <div class="title">알림방</div>
          <div class="plus" onclick="location.href='<?=base_url()?>sche/index/notice'"><img src="<?=base_url()?>static/img/plus.png" alt=""></div>
        </div>
        <div class="notice-bot">
          <ul>
			<!-- 메모장 index.68확인 -->
			<?php foreach($notice as $key =>$value){ ?>
			<li class="list clearfix">
              <span class="title"><a href="<?=base_url()?>sche/index/noticeView?idx=<?= $value->idx?>" class="listTitle"><?= $value->title ?></a></span>
              <span class="date"><?= substr($value->regdate,0,10) ?></span>
            </li>
			<?php } ?>
          </ul>
        </div>
      </section>
      <!-- 알림방 -->

      <section id="main-DD">
        <div class="dal" onclick="location.href='<?=base_url()?>index/info/dalma'"><img src="<?=base_url()?>static/img/dal.png" alt=""></div>
        <div class="dong" onclick="location.href='<?=base_url()?>index/info/establish'"><img src="<?=base_url()?>static/img/dong.png" alt=""></div>
        <div class="dal_m" onclick="location.href='<?=base_url()?>index/info/dalma'"><img src="<?=base_url()?>static/img/dal_m.png" alt=""></div>
        <div class="dong_m" onclick="location.href='<?=base_url()?>index/info/establish'"><img src="<?=base_url()?>static/img/dong_m.png" alt=""></div>
        
      </section>
      <!-- 달마,동지 -->
    </div>
  </div>
  
  <section id="main-gal">
    <div class="inner clearfix">
      <div class="plus" onclick="location.href='<?=base_url()?>sche/index/gallery'" style="cursor: pointer;"><img src="<?=base_url()?>static/img/plus.png" alt=""></div>
      <div class="gal-title">갤러리</div>
      <div class="clearfix">
	<!-- 메모장 index.89 확인 -->
	<?php foreach($gallery as $key =>$value){ ?>
		<div class="main-gallery">
        <div class="img" style="background-image: url('<?=base_url()?>board/gallery/<?=$value->file?>')" onclick="location.href='<?=base_url()?>index/board/galleryView?idx=<?=$value->idx?>'"></div>
        <div class="text text-center">
          <div class="title" onclick="location.href='<?=base_url()?>sche/index/galleryView?idx=<?=$value->idx?>'"><?=$value->title?></div>
          <div class="contents" onclick="location.href='<?=base_url()?>sche/index/galleryView?idx=<?=$value->idx?>'"><?=$value->contents?></div>
          <div class="arrow"></div>
        </div>
      </div>
	<?php } ?>
    </div>

    </div>
  </section>

  <script>
    var date= new Date();
    var dd = date.getDate();
    var mm = date.getMonth()+1;
    var yyyy = date.getFullYear();
    if(mm < 10){
    mm = "0"+mm;
    }
    var today = yyyy+"-"+mm+"-"+dd;
    if(today <= "2018-09-25" && today >= "2018-09-20"){
    popimage('<?=base_url()?>static/img/popup.png',450,579);
    }
    function popimage(imagesrc,winwidth,winheight){
      popuppage = window.open("","", "width=450  , height = 579 ,left=300 , top =150");
      popuppage.document.open();
      popuppage.document.write("<img src = './static/img/popup.png' style='width:100%;'>");
    }
 </script>
