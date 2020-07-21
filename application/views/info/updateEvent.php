
<table class="table text-center" >
	<thead>
	<tr>
		<td>타이틀</td>
		<td>행사시작일</td>
		<td>행사마감일</td>
		<td>상세내용</td>
		<td></td>
	</tr>
	</thead>
	<?php foreach ($res as $key => $value){?>
		<tr>
			<td><?= $value['title']?></td>
			<td><?=$value['start'] ?></td>
			<td><?=$value['end']?></td>
			<td><div class="des"><?=$value['description']?></div></td>
			<td>
				<img style="cursor: pointer;" src="<?=base_url()?>static/img/update.png" alt="" onclick="location.href='<?=base_url()?>index/info/updateEventEach?id='+<?=$value['id']?>">
				<img src="<?=base_url()?>static/img/delete.png" alt="" onclick="deleteEvent(<?= $value['id']?>);">
			</td>
		</tr>
	<?php } ?>
</table>

</div>
</section>
