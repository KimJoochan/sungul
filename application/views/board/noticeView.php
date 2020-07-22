

<section id="noticeView" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">알림방</div>
		<div class="view-wrap">
			<div class="top">
				<div class="title"><?=$view[0]['title']?></div>
				<div class="date">작성일 : <?= substr($view[0]['regdate'],0,10) ?></div>
			</div>
			<div class="contents"><?= nl2br($view[0]['contents'])?></div>
			<?php if(strlen($view[0]['file'])>0){ ?>
				<div class="file">
					<div class="left">첨부파일</div>
					<input type="hidden" id="file-name" value="<?=$view[0]['file']?>">
					<div class="fileName"><a href="<?=base_url()?>action/index/downFile?fileName=<?=$view[0]['file']?>"><?=$view[0]['file']?></a></div>
				</div>
			<?php } ?>
			<div class="clearfix">
				<a href="<?=base_url()?>sche/index/notice?page=<?=$page?>&search=<?=$search?>" class="btn pull-right list-btn">목록</a>
				<?php if(isset($_SESSION['id'])){?>
					<a onclick="deleteNotice(<?=$view[0]['idx']?>);" class="btn pull-right list-btn delete">삭제하기</a>
					<a href="<?=base_url()?>sche/index/updateNotice?page=<?=$page?>&search=<?=$search?>&idx=<?=$idx?>" class="btn pull-right list-btn update">수정하기</a>
				<?php } ?>
			</div>

	<?php if(isset($nextrow[0]['idx'])){?>
			<div class="prev">
				<div class="left">다음글</div>
				<div class="title">
					<a href="<?=base_url()?>sche/index/noticeView?page=<?=$page?>&idx=<?=$nextrow[0]['idx']?>&search=<?=$search?>"><?=$nextrow[0]['title']?><?php if(strlen($nextrow[0]['file'])>0){echo "<img src=\"img/ico_bfile.gif\">";}?></a>
				</div>
				<div class="regdate"><?= substr($nextrow[0]['regdate'],0,10) ?></div>
			</div>
	<?php }?>
	<?php if(isset($prevrow[0]['idx'])){?>
			<div class="next">
				<div class="left">이전글</div>
				<div class="title">
					<a href="<?=base_url()?>sche/index/noticeView?page=<?=$page?>&idx=<?=$prevrow[0]['idx']?>&search=<?=$search?>"><?=$prevrow[0]['title']?><?php if(strlen($prevrow[0]['file'])>0){echo "<img src=\"../img/ico_bfile.gif\">";} ?></a>
				</div>
				<div class="regdate"><?= substr($prevrow[0]['regdate'],0,10)?></div>
			</div>
	<?php }?>
		</div>
	</div>
</section>
