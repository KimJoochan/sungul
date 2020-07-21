<section id="insertGallery" class="page-section">
      <div class="inner" id="page-inner">
        <div class="title" id="page-title">성불사 갤러리</div>

        <form action="" id="insertGallery-form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">제목</label>
            <div class="col-sm-9">
              <input type="text" name="title" class="form-control title" placeholder="제목을 입력해주세요.">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">내용</label>
            <div class="col-sm-9">
              <textarea style="resize: none;" name="contents" class="form-control contents" rows="3" placeholder="게시물의 내용을 입력해주세요."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">이미지첨부</label>
            <div class="col-sm-9">
              <input type="file" class="file" name="file">
            </div>
          </div>
        </form>
        <div class="text-center" style="margin-top: 20px;">
          <div class="btn btn-lg insert" onclick="insertGallery();">등록하기</div>
          <div class="btn btn-lg cancel" onclick="location.href='<?=base_url()?>index/board/gallery'">취소하기</div>
        </div>
      </div>
    </section>