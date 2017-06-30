<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?=$this->session->flashdata("notifikasi_libur")?>	
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>id</th>
							<th>perihal</th>
							<th>tanggal</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($liburan as $key) { ?>
						<tr>
							<td><?=$key->id_libur?></td>
							<td><?=$key->tanggal?></td>
							<td><?=$key->detail?></td>
							<td>
							<?php
								echo "<a href='".base_url()."Holiday_C/delete_liburan/".$key->id_libur."'><span class='glyphicon glyphicon-trash'></span></a>
                        		<a href='".base_url()."Holiday_C/update_liburan/".$key->id_libur."'><span class='glyphicon glyphicon-edit'></span></a>";
                        	?>
                        </td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>