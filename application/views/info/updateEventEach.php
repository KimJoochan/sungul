<?php  if($res){ foreach ($res as $key =>$value) {?>
	<section id="updateEventEach" class="page-section">
		<div class="inner" id="page-inner">
			<div class="title" id="page-title">이달의 행사</div>
			<div class="top">이달의 행사 수정하기<div class="bar"></div></div>
			<form action="" id="insertEvent-form" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label" style="margin-top: 6px;">행사일</label>
					<div class="col-sm-9">
						<!--               <input type="date" class="form-control start"><span class="gap">~</span><input type="date" class="form-control end"> -->
						<div class="dateSet">
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' class="form-control start" name="start" value="<?=$value['start']?>"/>
								<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
							</div></div><span class="gap">~</span><div class="dateSet"><div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control end" name="end" value="<?=$value['end']?>"/>
								<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">행사명</label>
					<div class="col-sm-9">
						<input type="text" class="form-control title" value="<?=$value['title']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">상세내용</label>
					<div class="col-sm-9">
						<textarea style="resize: none;" class="form-control description" rows="3"><?=$value['description']?></textarea>
					</div>
				</div>
			</form>
			<div class="text-center" style="margin-top: 20px;">
				<div class="btn btn-lg insert" onclick="updateEvent(<?=$value['id']?>);">수정하기</div>
				<div class="btn btn-lg cancel" onclick="location.href='<?=base_url()?>/sche/index/updateEvent'">취소하기</div>
			</div>
		</div>
	</section>
<?php }} else{ echo "<script>location.href='../info/month.php'</script>"; } ?>
