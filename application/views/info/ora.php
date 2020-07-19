<section id="organization" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">기구표, 임원현황</div>
        <img src="<?=base_url()?>static/img/organization.png" alt="" class="web">
        <img src="<?=base_url()?>static/img/organization_m.png" alt="" class="mobile">

      </div>
    </section>

    <section id="executive" class="page-section">
      <div class="inner" id="page-inner">
        <!-- <div class="title" id="page-title">임원현황</div> -->
        <?php if(isset($_SESSION['id'])){?>
          <span class="btn" onclick="location.href='../info/insertExecutive.php'">등록하기</span>
        <?php } ?>
        <table class="table text-center">
          <thead>
            <tr>
              <td>직무</td>
              <td>성명</td>
              <td>연락처</td>
            <?php if(isset($_SESSION['id'])){?>
              <td></td>
            <?php } ?>
            </tr>
          </thead>
          <tbody class="exeTbody">
         <!-- 메모장 org.28확인 -->
         <?php foreach($res as $key =>$value){ ?>
            <tr>
             <td><?=$value->job?></td>
             <td><?=$value->name?></td>
             <td><?=$value->phone?></td>
             <?php if(isset($_SESSION['id'])){?>
              <td>
                <img src="../img/top_icon.png" alt="" onclick="moveExecutive('up',<?= $value->seq ?>,<?= $min ?>,<?=$value->idx?>);">
                <img src="../img/bottom_icon.png" alt="" onclick="moveExecutive('down',<?= $value->seq ?>,<?=$max ?>,<?=$value->idx?>);">
                <img src="../img/update.png" alt="" onclick="location.href='../info/updateExecutive.php?idx='+<?= $value->idx ?>">
              <img src="../img/delete.png" alt="" onclick="deleteExecutive(<?= $value->idx ?>);">
              </td>
            <?php } ?>
           </tr>
	    <?php } ?>
         </tbody>
        </table>

      </div>
    </section>