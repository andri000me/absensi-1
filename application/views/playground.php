<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php echo form_open_multipart('Playground_C/upload');?>

<input type="file" name="foto" size="20" />
<input type="file" name="kk" size="20" />
<input type="file" name="ktp" size="20" />

<br /><br />

<input type="submit" value="upload" />
</form>

</body>
</html>
<!-- <form method="POST" action="<?=base_url('Playground_C/upload')?>" enctype="multipart/form-data">
	<label for="foto">FOTO</label>
	<input type="file" name="foto" id="foto">
	<label for="kk">KK</label>
	<input type="file" name="kk" id="kk">
	<label for="ktp">KTP</label>
	<input type="file" name="ktp" id="ktp">
	<button type="submit" value="submit" name="submit">Send</button>
</form> -->