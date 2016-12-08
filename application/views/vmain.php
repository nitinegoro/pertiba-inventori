<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div id="chart_div"></div>
		</div>
		<div class="col-md-6">
			<div id="condition"></div>
		</div>
		<div class="col-md-12"><hr></div>
		<div class="col-md-10 col-md-offset-1">
			<div id="barchart_material"></div>
		</div>
		<div class="col-md-12"><hr></div>
		<div class="col-md-10 col-md-offset-1">
			<div id="pengeluaran_anggaran"></div>
		</div>
	</div>
</div>

<script>
      google.charts.load('43',{'packages':['corechart','line','bar'], 'language' : 'id'});
      google.charts.setOnLoadCallback(jenisChart);
      google.charts.setOnLoadCallback(conditionChart);
      google.charts.setOnLoadCallback(pengajuanChart);
      google.charts.setOnLoadCallback(anggaranChart);

      function jenisChart() 
      {
	        var data = new google.visualization.DataTable();
	        data.addColumn('string', 'Topping');
	        data.addColumn('number', 'Slices');
	        data.addRows([
	<?php  
	// get all Category
	foreach($this->app->category() as $cat) :
	?>
	          ['<?php echo $cat->category_name; ?>', <?php echo $this->app->count_category($cat->item_category_id) ?>],
	<?php  
	endforeach;
	?>
	        ]);
	        var options = {
	        	'title':'Presentase Jenis Barang',
	            'width':'500%',
	            'height':350,
	            is3D:true
	        };
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
      }

      function conditionChart() 
      {
	        var data = new google.visualization.DataTable();
	        data.addColumn('string', 'Topping');
	        data.addColumn('number', 'Slices');
	        data.addRows([
	<?php  
	// get all Condition
	foreach($this->app->condition() as $co) :
	?>
	          ['<?php echo $co->c_name; ?>', <?php echo $this->app->count_condition($co->condition_id) ?>],
	<?php  
	endforeach;
	?>
	        ]);
	        var options = {
	        	'title':'Presentase Kondisi Barang',
	            'width':'500%',
	            'height':350,
	            is3D:true
	             };
	        var chart = new google.visualization.PieChart(document.getElementById('condition'));
	        chart.draw(data, options);
      }

      function pengajuanChart() 
      {
        var data = google.visualization.arrayToDataTable([
          ['Bulan', 'Disetujui / Diterima', 'Tidak disetujui / Tertunda'],
  <?php  
  // loops bulan
  for($bln = 1; $bln<=12; $bln++) :
  ?>
          ['<?php echo bulan($bln); ?>', <?php echo $this->app->pengajuan($bln, date('Y'), 'approve') ?>,  <?php echo $this->app->pengajuan($bln, date('Y'), 'pending') ?>],
  <?php  
  endfor;
  ?>
        ]);
        var options = {
          chart: {

            title: 'Data Pengajuan (Lembar)',
            subtitle: 'Status diterima & tertunda tahun : 2016',
          },
          bars: 'vertical',
          width:'500%',
          height:350,
          colors: ['#82AF6F','#F89406'],
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, options);
      }

    function anggaranChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Bulan');
      data.addColumn('number', 'Anggran Keluar');

      data.addRows([
  <?php  
  // loops bulan
  for($bln = 1; $bln<=12; $bln++) :
  ?>
          ['<?php echo bulan($bln); ?>', <?php echo $this->app->anggaran($bln, date('Y')) ?>],
  <?php  
  endfor;
  ?>
      ]);

      var options = {
        chart: {
          title: 'Anggaran Pengeluaran Inventaris (Rp.)',
          subtitle: 'Tahun : 2016'
        },
        width: '100%',
        height: 350
      };

      var chart = new google.charts.Line(document.getElementById('pengeluaran_anggaran'));

      chart.draw(data, options);
    }
</script>