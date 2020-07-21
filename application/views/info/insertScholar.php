<section id="scholarship" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">장학금 수혜자</div>
		<div class="bar"></div>
		<div class="scholar">장학금 수혜자 등록하기</div>
		<form action="" class="form-horizontal insert-scholar" id="insert-scholar">
			<div class="form-group">
				<label class="col-sm-3 control-label">장학년도</label>
				<div class="col-sm-9">
					<input type="number" class="form-control year" value="<?=$year?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학생성명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control name" placeholder="학생성명을 입력해주세요.">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">분류</label>
				<div class="col-sm-9">
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="1"> 초등학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="2"> 중학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="3"> 고등학교
					</label>
					<label class="radio-inline degree_radio">
						<input type="radio" name="degree" class="degree" value="4"> 대학교
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학교명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control school" placeholder="학교명을 입력해주세요.">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">학년</label>
				<div class="col-sm-9">
					<input type="number" class="form-control grade" placeholder="학년을 입력해주세요.">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">지역</label>
				<div class="col-sm-9">
					<input type="text" class="form-control local" placeholder="지역을 입력해주세요.(예 : 부산광역시 금정구, 경상남도 창원시)">
				</div>
			</div>
		</form>
		<div class="btns">
			<div class="btn btn-lg fir" onclick="insertScholar();">등록하기</div>
			<div class="btn btn-lg sec" onclick="$('#insert-scholar')[0].reset();">취소하기</div>
		</div>

	</div>
</section>
