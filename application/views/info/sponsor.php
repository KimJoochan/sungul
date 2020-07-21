    <section id="sponsor" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">장학금 후원자 현황</div>
        <?php if(isset($_SESSION['id'])){?>
          <span class="btn" onclick="location.href='<?=base_url()?>index/info/insertSponsor'">등록하기</span>
        <?php } ?>
        <table class="table text-center">
          <thead>
            <tr>
              <td>후원자 성명</td>
              <td>후원금액</td>
              <td>주&nbsp;&nbsp;소</td>
            <?php if(isset($_SESSION['id'])){?>
              <td></td>
            <?php } ?>
            </tr>
          </thead>
          <tbody class="exeTbody">
          <?php foreach($res as $key =>$value){?>
                <tr>
                <td><?=$value->name?></td>
                <td><?php if(isset($_SESSION['id'])){?>
                 <?=$value->money?>
                 <?php }else{ ?>
                 ***
                 <?php } ?>  
                 </td>
                <td><?=$value->location?></td>
                <?php if(isset($_SESSION['id'])){?>
                 <td>
                   <img src="<?=base_url()?>static/img/update.png" alt="" onclick="location.href='../info/updateSponsor.php?idx='+<?= $value->idx ?>">
                 <img src="<?=base_url()?>static/img/delete.png" alt="" onclick="deleteSponsor(<?= $value->idx ?>);">
                 </td>
               <?php } ?>
              </tr>
            <?php }?>
         </tbody>
        </table>

      </div>
    </section>
