<!-- 1번째 -->
<section id="notice" class="page-section">
	<div class="inner" id="page-inner">
		<div class="title" id="page-title">알림방</div>
		<div class="top">
			<div class="search-wrap">
				<input type="text" placeholder="검색어 입력">
				<button onclick="notice_search()">검색</button>
			</div>
		</div>
		<div class="board clearfix text-center">
			<table class="table">
				<thead>
				<tr>
					<td>번호</td>
					<td>제목</td>
					<td class="date">작성일</td>
				</tr>
				</thead>
				<?php $i = 0;
				foreach ($row as $key => $value) { ?>

					<tr>
						<!-- main_model에서 $num값을 넘겨야 함, $s_point값도 넘겨야 함,$page도 넘겨야 함 -->
						<td><?php echo $num - $s_point - $i; ?></td>
						<td class="title"><a
									href="<?=base_url()?>board/index/noticeView?page=<?= $page ?>&idx=<?= $value->idx; ?>&search=<?= $search ?>"
									class="listTitle"><?= $value->title ?><?php if (strlen($value->file) > 0) {
									echo "<img src='".base_url()."static/img/ico_bfile.gif'>";
								} ?></a></td>
						<td class="date"><?= substr($value->regdate, 0, 10) ?></td>
					</tr>
					<?php $i++;
				} ?>
			</table>
			<div class="paging pos1">

				<div class="innerPaging">
					<ul class="clearfix">

						<!-- 3번째 -->
						<?php $block = 5;
						if ($page > $block) { ?>
							<li><a href="notice.php?page=<?php echo $s_page - 1 ?>&search=<?php echo $search ?>"
								   class="move prev"><span class="hide">이전페이지</span></a></li>
						<?php } else { ?>
							<li><a class="move prev" style="cursor:not-allowed;"><span class="hide">이전페이지</span></a>
							</li>
						<?php } ?>
						<!-- 4번째 -->
						<?php for ($p = $s_page; $p <= $e_page; $p++) {
							if ($page == $p) { ?>
								<li><a href="notice/<?= $p ?>/<?= $search ?>"
									   style="background-color: #DBDBDB;"><?= $p ?></a></li>
							<?php } else { ?>
								<li>
									<a href="<?= base_url()?>board/index/notice?page=<?=$p?>&search=<?=$search?>"><?= $p ?></a>
								</li>
							<?php }
						} ?>
						<!-- 5번째 -->
						<?php if ($e_page < $page_num) { ?>
							<li><a href="notice.php?page=<?= $e_page + 1 ?>&search=<?= $search ?>"
								   class="move next"><span class="hide">다음페이지</span></a></li>
						<?php } else { ?>
							<li><a class="move next" style="cursor:not-allowed;"><span class="hide">다음페이지</span></a>
							</li>
						<?php } ?>

					</ul>
					<tr>

				</div>
			</div>
			<?php if (isset($_SESSION['id'])) { ?>
				<a href="<?=base_url()?>board/index/insertNotice" class="btn btn-lg pull-right insert-btn">등록하기</a>
			<?php } ?>
</ul>
<tr>

	</div>
	</div>

	</div>
	</section>
