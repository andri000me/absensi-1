	<div class="container">
	<div class="row">
	    <div class="col-sm-6 col-xs-12">
	    	<br/><h2>Stasistik Bulanan</h2>
	    	<h4><?= isset($bulan_dicari) ? $bulan_dicari.'-'.$tahun_dicari:"-"?></h4>	
	    </div>
	<div style="margin-top: 50px">
	<form action="<?php echo base_url('overview_c/lihat/bulan')?>" method="POST" class="form-horizontal" role="form" >
	    <div class="col-sm-2" style="padding-bottom: 20px">
			<input type="month" name="l_param" class="form-control" required="required">
	    </div>
	    <div class="col-sm-2 col-xs-6" style="padding-bottom: 20px">
	    	<button type="submit" class="btn btn-primary col-sm-12 col-xs-12">TAMPILKAN</button>
	    <!-- <hr class="vertical-line hidden-xs"> -->
	    </div>
	</form>
	    <div class="col-sm-2 col-xs-6" style="padding-bottom: 20px">
	    	<button class="btn btn-primary col-sm-12 col-xs-12" id="print_btn" > <span class="glyphicon glyphicon-print" aria-hidden="true"></span> CETAK</button>
	    </div>
	</div>
	</div>
	 <hr class="horizontal-line col-sm-12 col-xs-12 pull right">
	</div>
	   
 
    


<!-- -->