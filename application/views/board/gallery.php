<section id="gallery" class="page-section">
    <div class="inner" id="page-inner">
        <div class="title" id="page-title">성불사 갤러리</div>
        <div class="top">
            <div class="search-wrap">
                <input type="text" placeholder="검색어 입력">
                <button onclick="gallery_search()">검색</button>
            </div>
        </div>
        <div class="board clearfix text-center">
            <div class="clearfix">
            <?php foreach($row as $key => $value){?>
                <div class="w-3 clearfix" onclick="location.href='<?=base_url()?>index/board/galleryView/<?=$page?>/<?=$search?>/<?=$value->idx?>'">
                    <div class="img" style="background-image:url('<?=base_url()?>board/gallery/<?= urldecode($value->file)?>')"></div>
                    <div class="bot">
                        <div class="title"><?=$value->title?></div>
                        <div class="date"><?= substr($value->regdate,0,10) ?></div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="paging pos1">
                <div class="innerPaging">
                    <ul class="clearfix">
                    <?php if($page>$block){ ?>
                        <li><a href="<?=base_url()?>index/board/gallery/<?=$s_page-1?>/<?=$search?>" class="move prev"><span class="hide">이전페이지</span></a></li>
                        <?php }else{ ?>
                        <li><a class="move prev" style="cursor:not-allowed;"><span class="hide">이전페이지</span></a></li>
                    <?php } ?>
                    <?php for($p=$s_page; $p<=$e_page; $p++){ 
                        if($page==$p){?>
                            <li><a href="<?=base_url()?>index/board/gallery/<?=$p?>/<?=$search?>" style="background-color: #DBDBDB;"><?= $p ?></a></li>
                        <?php }else{ ?>
                            <li><a href="<?=base_url()?>index/board/gallery/<?=$p?>/<?=$search?>"><?= $p ?></a></li>
                    <?php }} ?>
                    <?php if($e_page<$page_num){ ?>
                        <li><a href="<?=base_url()?>index/board/gallery/<?=$e_page+1?>/<?=$search?>" class="move next"><span class="hide">다음페이지</span></a></li>
                        <?php }else{ ?>
                        <li><a class="move next" style="cursor:not-allowed;"><span class="hide">다음페이지</span></a></li>
                    <?php } ?>

                    </ul>
                    <tr>

                </div>
            </div>
            <!-- 5반 -->
            <?php if(isset($_SESSION['id'])){?>
                <a href="<?=base_url()?>index/board/insertGallery" class="btn btn-lg pull-right insert-btn">등록하기</a>
            <?php } ?>
        </div>
    </div>
</section>