<div class="container">
	<div class="hero-unit"  id="cadreSendUpdate" >
		<table class="table-striped" style="font-size: 14px;width: 100%;">
			<tr>
				<th> Titre new </th>
				<th> Date new </th>
				<th> Image </th>
				<th>  </th>
				<th>  </th>
			</tr>
			<?php foreach ($news as $item): ?>
			<tr>
				<td> <?= $item['titre_new'] ?></td>
				<td> <?= $item['date_new'] ?></td>
				<td> <img src="<?php echo base_url();?>uploads/<?= $item['url_img'] ?>" class="img-polaroid" style="width:100px;heigh:100px;"/></td>
				<td style="padding-left:20px;"> <a class="btn btn-small" href="<?php echo base_url("index.php/News/news_control/modif_new/");?>/<?= $item['id_new'] ?>">  <i class="icon-cog"></i> Mofidier </a> </td>
				<td style="padding-left:20px;"> <a class="btn btn-small" href="<?php echo base_url("index.php/News/news_control/delete_new/");?>/<?= $item['id_new'] ?>"> <i class="icon-trash"></i> Supprimer </a> </td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
</div>

