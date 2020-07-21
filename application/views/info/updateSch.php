<?php foreach ($res as $key => $value) { ?>
	<section id="schedule" class="page-section">
		<div class="inner" id="page-inner">
			<div class="title" id="page-title">
				<?php if ($type == 'month') {
					echo '월 정기법회 등록';
				} else {
					echo '년간 정기법회 및 명절 차례불공 등록';
				} ?>
			</div>

			<form action="" class="form-horizontal insert-schedule" id="insert-schedule">
				<div class="form-group">
					<label class="col-sm-3 control-label">제목</label>
					<div class="col-sm-9">
						<input type="text" class="form-control title" value="<?= $value['title']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">내용</label>
					<div class="col-sm-9">
						<input type="text" class="form-control contents" value="<?=$value['contents']; ?>">
					</div>
				</div>

			</form>

			<div class="btns">
				<div class="btn btn-lg fir"
					 onclick="updateSchedule('<?=$type; ?>',<?= $idx; ?>);">수정하기
				</div>
				<div class="btn btn-lg sec" onclick="$('#insert-schedule')[0].reset();">취소하기</div>
			</div>
		</div>
	</section>
<?php } ?>
