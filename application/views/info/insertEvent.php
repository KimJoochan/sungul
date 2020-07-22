<section id="insertEvent" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title"> 이달의 행사</div>
		<div class="top"> 이달의 행사 등록하기 <div class="bar"></div></div>
	</div>
	<form action="" id="insertEvent-form" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-3 control-label" style="margin-top: 6px;"> 행사일</label>
			<div class="col-sm-9">
				<div class="dateSet">
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control start" name="start"/>
						<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					</div>
				</div>
				<span class="gap"> ~</span>
				<div class="dateSet">
					<div class='input-group date' id='datetimepicker2'>
						<input type='text' class="form-control end" name="end"/>
						<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"> 행사명</label>
			<div class="col-sm-9">
				<input type="text" class="form-control title" placeholder="행사명을 입력해주세요.">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"> 상세내용</label>
			<div class="col-sm-9">
				<textarea style="resize: none;" class="form-control description" rows="3"
						  placeholder="일정시간, 장소를 입력해주세요."></textarea>
			</div>
		</div>
	</form>
	<div class="text-center" style="margin-top: 20px;">
		<div class="btn btn-lg insert" onclick="insertEvent();"> 등록하기</div>
		<div class="btn btn-lg cancel" onclick="location.href='<?=base_url()?>sche/index/month'"> 취소하기</div>
	</div>
</section>
<script>
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'yyyy-mm-dd'
		});
		$('#datetimepicker2').datetimepicker({
			format: 'yyyy-mm-dd',
			useCurrent: false //Important! See issue #1075
		});
		$("#datetimepicker1").on("dp.change", function (e) {
			$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
		});
		$("#datetimepicker2").on("dp.change", function (e) {
			$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
		});
		/* 날짜 표기 */
	});
</script>
