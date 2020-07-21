    <!-- 메모장1 번째 참고 -->
    <section id="scholarship" class="page-section">
      <div class="inner"id="page-inner">
        <div class="title"id="page-title">장학금 수혜자</div>
        
        <!-- 메모장 2번째 참고 1번째 완성후 가능할듯 -->
        <div class="scholar clearfix" style="border-bottom: 0;">
          <?php if(isset($_SESSION['id'])){?>
          <span class="btn" onclick="location.href='<?=base_url()?>index/info/insertScholar?year=<?=$year?>'">등록하기</span><span class="btn" onclick="updateScholarCnt();">인원수 수정하기</span>
		  <?php } ?></div>

        <div class="control clearfix">
          <div class="pull-left" onclick="location.href='<?=base_url()?>index/info/scholarship/<?php echo (int)$year-1; ?>'"><?php echo (int)$year-1; ?></div>
          <div class="pull-right" onclick="location.href='<?=base_url()?>index/info/scholarship/<?php echo (int)$year+1; ?>'"><?php echo (int)$year+1; ?></div>
          <div class="bold"><?=$year?></div>
        </div>

        <!-- 년도 컨트롤 -->
        <input type="hidden" id="year" value="<?=$year?>">
        <table class="table text-center">
          <thead>
            <tr>
              <td>년도</td>
              <td>초등학생</td>
              <td>중학생</td>
              <td>고등학생</td>
              <td>대학생</td>
              <td>계</td>
            </tr>
            <tr>
              <!-- 메모장 3번째  -->
              <td><?=$year?></td>
              <td><span <?php if(isset($_SESSION['id'])){?>class="hide"<?php } ?>><?=$row1[0]['grade1']?></span><?php if(isset($_SESSION['id'])){?><input type="num" class="form-control" id="grade1" value="<?=$row1[0]['grade1']?>"><?php } ?></td>
              <td><span <?php if(isset($_SESSION['id'])){?>class="hide"<?php } ?>><?=$row1[0]['grade2']?></span><?php if(isset($_SESSION['id'])){?><input type="num" class="form-control" id="grade2" value="<?=$row1[0]['grade2']?>"><?php } ?></td>
              <td><span <?php if(isset($_SESSION['id'])){?>class="hide"<?php } ?>><?=$row1[0]['grade3']?></span><?php if(isset($_SESSION['id'])){?><input type="num" class="form-control" id="grade3" value="<?=$row1[0]['grade3']?>"><?php } ?></td>
              <td><span <?php if(isset($_SESSION['id'])){?>class="hide"<?php } ?>><?=$row1[0]['grade4']?></span><?php if(isset($_SESSION['id'])){?><input type="num" class="form-control" id="grade4" value="<?=$row1[0]['grade4']?>"><?php } ?></td>
              <td><?=$row1[0]['sum']?></td> 
            </tr>
          </thead>
        </table>

        <table class="table text-center">
          <thead>
          <tr class="bold" style="height:57px;">
            <td>학생성명</td>
            <td>학교명</td>
            <td>학년</td>
            <td>지역</td>
            <?php if(isset($_SESSION['id'])){?><td></td><?php } ?>
          </tr>
          </thead>
          <!-- 메모장 56번째 -->
          <?php foreach($row as $key => $value){ ?>
          <tr style="height:57px;">
            <td><?= $value->name ?></td>
            <td><?= $value->school ?></td>
            <td><?= $value->grade ?></td>
            <td><?= $value->local ?></td>
            <?php if(isset($_SESSION['id'])){?>
            <td>
              <img src="<?=base_url()?>static/img/update.png" alt="" onclick="location.href='<?=base_url()?>index/info/updateScholar?idx=<?= $value->idx ?>'">
              <img src="<?=base_url()?>static/img/delete.png" alt="" onclick="deleteScholar(<?= $value->idx ?>);">
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        

      </div>
    </section>
