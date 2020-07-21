<link href="<?=base_url()?>static/vendor/fullcalendar/fullcalendar.css" rel="stylesheet">

<script src='<?=base_url()?>static/vendor/fullcalendar/lib/moment.min.js'></script>
<script src='<?=base_url()?>static/vendor/fullcalendar/fullcalendar.js'></script>
<script src='<?=base_url()?>static/vendor/fullcalendar/locale/ko.js'></script>

<!-- 1번째 -->
<?php
    $list = array();
    foreach($event as $key =>$value){
        $list[]=$value;
    }
?>
<script>
      $(function(){

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listMonth'
          },
          selectable: true,
          events:<?php echo json_encode($list); ?>,
            eventRender: function(event, element) {
              $(element).tooltip({title: event.description}); 
            }
        });
      });
    </script>
    <section id="month" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">이달의 행사
        <?php if(isset($_SESSION['id'])){?>
          <div>
            <a class="insert btn btn-lg" href="<?=base_url()?>index/info/insertEvent">등록하기</a>
            <a class="update btn btn-lg" href="../info/updateEvent.php">수정하기</a>
          </div>
        <?php } ?>
        </div>
        <div class="bar"></div>
        <div id='calendar'></div>


      </div>
    </section>
