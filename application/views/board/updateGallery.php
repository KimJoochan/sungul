
    <section id="updateGallery" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">성불사 갤러리</div>
        <form action="" id="updateGallery-form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">제목</label>
            <div class="col-sm-9">
            <input type="hidden" name="idx" value="<?=$res[0]['idx']?>">
              <input type="text" class="form-control title" name="title" value="<?=htmlspecialchars($res[0]['title'])?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">내용</label>
            <div class="col-sm-9">
              <textarea style="resize: none;" class="form-control contents" name="contents"  rows="3"><?=htmlspecialchars($res[0]['contents'])?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">첨부파일</label>
            <div class="col-sm-9">
              <input type="hidden" class="old-file" value="<?=$res[0]['file']?>">
              <input type="file" class="file" name="file"><br>
				기존 파일 :<input id="old-file-name" name="oldname" readonly="readonly" value="<?=$res[0]['file']?>">
            </div>
          </div>
        </form>
        <div class="text-center" style="margin-top: 20px;">
          <div class="btn btn-lg insert" onclick="updateGallery(<?=$idx?>);">수정하기</div>
          <div class="btn btn-lg cancel" onclick="history.back();">취소하기</div>
        </div>
      </div>
    </section>
