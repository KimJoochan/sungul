<section id="galleryView" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">성불사 갤러리</div>
		<div class="view-wrap">
			<div class="top">
				<div class="title"><?= $now[0]['title']; ?></div>
				<div class="date">작성일 : <?php echo substr($now[0]['regdate'], 0, 10) ?></div>
			</div>
			<div class="contents"><?php echo htmlspecialchars(nl2br($now[0]['contents'])); ?></div>
			<div class="img">
				<img src="<?= base_url() ?>board/gallery/<?= $now[0]['file'] ?>" alt="">
			</div>
			<input type="hidden" id="file_name" value="<?= $now[0]['file'] ?>">
			<div class="clearfix">
				<a href="<?= base_url() ?>sche/index/gallery?page=<?= $page ?>&search=<?= $search ?>"
				   class="btn pull-right list-btn">목록</a>
				<?php if (isset($_SESSION['id'])) { ?>
					<a onclick="deleteGallery(<?= $now[0]['idx'] ?>);" class="btn pull-right list-btn delete">삭제하기</a>
					<a href="<?= base_url() ?>sche/index/updateGallery?page=<?= $page ?>&search=<?= $search ?>&idx=<?= $idx ?>"
					   class="btn pull-right list-btn update">수정하기</a>
				<?php } ?>
			</div>
			<?php if (isset($pre[0])) { ?>
				<div class="prev">
					<div class="left">이전글</div>
					<div class="title">
						<a href="<?= base_url() ?>sche/index/galleryView?page=<?= $page ?>&search<?= $search ?>&idx=<?= $pre[0]['idx'] ?>"><?= htmlspecialchars($pre[0]['title']) ?></a>
					</div>
					<div class="regdate"><?php echo substr($pre[0]['regdate'], 0, 10) ?></div>
				</div>
			<?php } ?>
			<?php if (isset($next[0])) { ?>
				<div class="next">
					<div class="left">다음글</div>
					<div class="title">
						<a href="<?= base_url() ?>sche/index/galleryView?page=<?= $page ?>&search<?= $search ?>&idx=<?= $next[0]['idx']?>"><?= htmlspecialchars($next[0]['title']) ?></a>
					</div>
					<div class="regdate"><?= substr($next[0]['regdate'], 0, 10) ?></div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
