<?php foreach ($res as $key => $value) { ?>
<section id="scholarship" class="page-section">
	<div class="inner"id="page-inner">
		<div class="title"id="page-title">장학금 수혜자</div>
		<div class="bar"></div>
		<div class="scholar">장학금 수혜자 수정하기</div>
		<form action="" class="form-horizontal insert-scholar" id="insert-scholar">
			<div class="form-group">
				<label class="col-sm-3 control-label">장학년도</label>
				<div class="col-sm-9">
					<input type="number" class="form-control year" value="<?=$value['year']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학생성명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control name" value="<?=$value['name']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">분류</label>
				<div class="col-sm-9">
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="1" <?php if($value['degree']==1){echo "checked=\"checked\"";}?>> 초등학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="2" <?php if($value['degree']==2){echo "checked=\"checked\"";}?>> 중학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="3" <?php if($value['degree']==3){echo "checked=\"checked\"";}?>> 고등학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="4" <?php if($value['degree']==4){echo "checked=\"checked\"";}?>> 대학교
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학교명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control school" value="<?=$value['school']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학년</label>
				<div class="col-sm-9">
					<input type="number" class="form-control grade" value="<?=$value['grade']?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">지역</label>
				<div class="col-sm-9">
					<input type="text" class="form-control local" value="<?=$value['local']?>">
				</div>
			</div>
		</form>
		<div class="btns">
			<div class="btn btn-lg fir" onclick="updateScholar(<?php echo $idx ?>);">수정하기</div>
			<div class="btn btn-lg sec" onclick="$('#insert-scholar')[0].reset();">취소하기</div>
		</div>
	</div>
</section>
<?php } ?>
