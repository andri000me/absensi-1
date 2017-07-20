<div class="container">
	<?php
	$result = $this->Absen_M->rawQuery("
	SELECT 
	DISTINCT data_ra.id_k AS me,
	data_k.nama_k AS my,
	(
		SELECT count(data_ra.id_k)
		FROM data_ra
		INNER JOIN data_k ON data_ra.id_k = data_k.id_k
		WHERE data_ra.detail = 'tepat waktu' AND data_k.jabatan_k != 12	AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) = '2017' AND data_ra.id_k = me
		GROUP BY data_ra.id_k
	) AS ontime,
	(
		SELECT count(data_ra.id_k) FROM	data_ra	INNER JOIN data_k ON data_ra.id_k = data_k.id_k
		WHERE	data_ra.detail = 'telat' AND data_k.jabatan_k != 12	AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) = '2017' AND data_ra.id_k = me
		GROUP BY data_ra.id_k
	) AS late
	
	FROM data_ra 
	INNER JOIN data_k ON data_ra.id_k = data_k.id_k
	WHERE data_k.jabatan_k != 12
	AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) = '2017'

	")->result();
	
	echo "<pre>";
	foreach ($result as $key => $value) {
		$karyawan[] = array('karyawan'=> $value->me ,'nama_k' =>$value->my,'late'=> $value->late , 'ontime' => $value->ontime);
	}
	foreach ($karyawan as $key => $row) {
	    $late[$key]  = $row['late'];
	    $ontime[$key] = $row['ontime'];
	}
	array_multisort($ontime, SORT_DESC,$late, SORT_ASC, $karyawan);
	$last_id_karyawan = end($karyawan); // ambil ranking terakhir
	var_dump($last_id_karyawan['nama_k']);
	echo "</pre>";
?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>ranking</th>
			<th>id_k</th>
			<th>nama_k</th>
			<th>late</th>
			<th>ontime</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$a = 1;
		foreach ($karyawan as $key ) {?>
		<tr>
			<td><?=$a?></td>
			<td><?=$key['karyawan']?></td>
			<td><?=$key['nama_k']?></td>
			<td><?=$key['ontime']?></td>
			<td><?=$key['late']?></td>
		</tr>
		<?php
		$a++;
		} ?>
	</tbody>
</table>
</div>
