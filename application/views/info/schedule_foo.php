    <section id="schedule" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">정기법회일정</div>
        <div class="contents">
          <div class="title">월 정기법회<div class="bar"></div></div>
                  <?php if(isset($_SESSION['id'])){?>
          <span class="btn" onclick="location.href='<?=base_url()?>index/info/insertSchedule?type=month'">등록하기</span>
        <?php } ?>
          <table class="table">
            <!-- 2번째 -->
            <?php foreach($month_sch as $key => $value){?>
                <tr>
                <td><?= $value->title?></td>
                <td><?=$value->contents?></td>
                <?php if(isset($_SESSION['id'])){?>
                <td>
                    <img src="<?=base_url()?>static/img/update.png" alt="" onclick="location.href='<?=base_url()?>index/info/updateSchedule?idx=<?=$value->idx ?>&type=month'">
                <img src="<?=base_url()?>static/img/delete.png" alt="" onclick="deleteSchedule('month',<?= $value->idx ?>);">
                </td>
                <?php } ?>
                </tr>
            <?php } ?>
          </table>
        </div>
        <div class="contents">
          <div class="title">년간 정기법회 및 명절 차례불공<div class="bar"></div></div>
                  <?php if(isset($_SESSION['id'])){?>
          <span class="btn" onclick="location.href='<?=base_url()?>index/info/insertSchedule?type=year'">등록하기</span>
        <?php } ?>
          <table class="table">
            <!-- 3번재 -->
            <?php foreach($year_sch as $key => $value){ ?>
                <tr>
                    <td><?=$value->title?></td>
                    <td><?=$value->contents?></td>
                    <?php if(isset($_SESSION['id'])){?>
                    <td>
                        <img src="<?=base_url()?>static/img/update.png" alt="" onclick="location.href=`<?=base_url()?>index/info/updateSchedule?idx=${<?= $value->idx ?>}&type=year`">
                    <img src="<?=base_url()?>static/img/delete.png" alt="" onclick="deleteSchedule('year',<?= $value->idx ?>);">
                    </td>
                   <?php } ?>
                </tr>
            <?php } ?>
          </table>
        </div>

      </div>
    </section>
