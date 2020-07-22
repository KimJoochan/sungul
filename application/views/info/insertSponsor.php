<section id="sponsor" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">후원자 등록하기</div>
		<form action="" class="form-horizontal insert-sponsor" id="insert-sponsor">
			<div class="form-group">
				<label class="col-sm-3 control-label">성명</label>
				<div class="col-sm-9">
					<input type="text" class="form-control name" placeholder="성명을 입력해주세요.">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">후원금액</label>
				<div class="col-sm-9">
					<input type="text" class="form-control money" placeholder="후원금액을 입력해주세요.">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">주소</label>
				<div class="col-sm-9">
					<input type="text" class="form-control location" placeholder="주소를 입력해주세요.">
				</div>
			</div>

		</form>

		<div class="btns">
			<div class="btn btn-lg fir" onclick="insertSponsor();">등록하기</div>
			<div class="btn btn-lg sec" onclick="$('#insert-sponsor')[0].reset();">취소하기</div>
		</div>
	</div>
</section>
