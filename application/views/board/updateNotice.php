<?php foreach ($res as $key => $value){?>
<section id="updateNotice" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">알림방</div>

		<form action="" id="updatetNotice-form" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3 control-label">제목</label>
				<div class="col-sm-9">
					<input type="text" class="form-control title" name="title" value="<?=$value['title']?>">
					<input type="hidden" name="idx" value="<?=$idx?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">내용</label>
				<div class="col-sm-9">
					<textarea style="resize: none;" class="form-control contents" name="contents" rows="3"><?=$value['contents']?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">첨부파일</label>
				<div class="col-sm-9">
					<input type="hidden" class="old-file" value="<?=$value['file']?>">
					<input type="file" class="file" name="file">
					<div id="old-file-name">기존 파일 : <?=$value['file']?></div>
				</div>
			</div>
		</form>
		<div class="text-center" style="margin-top: 20px;">
			<div class="btn btn-lg insert" onclick="updateNotice(<?=$idx?>);">수정하기</div>
			<div class="btn btn-lg cancel" onclick="history.back();">취소하기</div>
		</div>
	</div>
</section>
<?php } ?>
