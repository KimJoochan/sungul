<?php foreach ($res as $key => $value){?>
<section id="executive" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">임원 수정하기</div>
		<form action="" class="form-horizontal insert-executive" id="insert-executive">
			<div class="form-group">
				<label class="col-sm-3 control-label">직무</label>
				<div class="col-sm-9">
					<input type="text" class="form-control job" value="<?=$value['job']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">성명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control name" value="<?=$value['name']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">연락처</label>
				<div class="col-sm-9">
					<input type="text" class="form-control phone" value="<?=$value['phone']?>">
				</div>
			</div>

		</form>
		<div class="btns">
			<div class="btn btn-lg fir" onclick="updateExecutive(<?= $idx ?>);">수정하기</div>
			<div class="btn btn-lg sec" onclick="$('#insert-executive')[0].reset();">취소하기</div>
		</div>
	</div>
</section>
<?php }?>
