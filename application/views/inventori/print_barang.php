<!DOCTYPE html>
<html>
 <head>
  <title>Data Inventaris</title>
  <style>
     table { font-size:12px; font-family:'Arial'; }
     .header { width:100%; height:10%; font-weight:500;  }
     .big-title {  font-family:'Arial'; font-size:xx-large; letter-spacing:normal; font-weight:bold; }
     .small-title {  font-family:'Arial'; font-size:7px; letter-spacing:normal; text-transform: uppercase; }
     .content { font-size:11px; font-family:'Arial'; margin-top:20px;}
     .upper { text-transform: uppercase;  }
     .underline { text-decoration: underline; }
     .bold { font-weight:bold; }
     .text-center { text-align: center; }
     table.gridtable { border-collapse: collapse; font-size: 7px; }
     table.gridtable th {  border-width: 0.1px; padding: 4px; border-style: solid; border-color: black; text-transform: uppercase; }
     table.gridtable td { border-width: 0.1px;  padding: 4px 3px 5px 3px; border-style: solid; border-color: black; }
     table.kop tr { line-height: 50% }
     table.kop { margin-top: -5px; }
   /*   @page { size: A4; } */
    @media print {
  
        table {page-break-inside: avoid;}
    }
  </style>
 </head>
 <body onload="window.print()"> <!--  onload="window.print()" -->
 <?php if($this->input->get('pdf')!=TRUE) : ?>
   <div class="wrapper table">
      <div class="header">
            <img style="float: left; padding-right: 10px;" src="<?php echo base_url("assets/images/logo_kop.png") ?>" alt="">
            <strong class="big-title">STIE PERTIBA PANGKALPINANAG</strong>
         <table class="kop">
           <tr style="padding-top: 0px;">
             <td class="small-title" width="115">program sarjana (S1)</td>
             <td width="10" style="text-align: center;" class="small-title">:</td>
             <td class="small-title" style="vertical-align: top; line-height: 150%">izin penyelenggara surat dirjen dikti kemendikbud r.i NO..12176/D/T/K-II/2012 tanggal 05 Juni 2012 Terakeditasi "B" SK.BAT-PT KEMNDIKBUD R.I N0. 020/BAN/BAN-PT/Ak-XV/S1/VII/2012 Tanggal 12 Juli 2012</td>
           </tr>
           <tr style="padding-top: 0px;">
             <td class="small-title">program pascasarjana (S2)</td>
             <td width="10" style="text-align: center;" class="small-title">:</td>
             <td class="small-title" style="vertical-align: top; line-height: none">Terakeditasi "C" SK. BAN-PT KEMINDIKBUD R.I No. 169/SK/BAN-PT/AKRED/M/VI/2014 Tanggal 6 Juni 2014</td>
           </tr>
           <tr style="padding-top: 0px;">
             <td class="small-title">Alamat</td>
             <td width="10" style="text-align: center;" class="small-title">:</td>
             <td class="small-title" style="vertical-align: top; line-height: none">JL. Adyaksa No. 9 Pangkalpinang - Bangka Belitung Telp. (0717) 423374 FAX.(0717) 439289</td>
           </tr>
           <tr style="padding-top: 0px;">
             <td colspan="3" style="font-size: 7px;"><span>E-Mail : <span style="color: blue">stie_pertiba@yahoo.co.id</span></span> <span style="padding-left: 20px;">Website : <span style="color: blue">http://www.stiepertiba.ac.id</span></span></td>
           </tr>
         </table>
   </div>
   <hr style="width: 100%;"> </div>
<?php endif; ?>
   <div class="content">
    <h3 class="upper text-center">Data Inventaris</h3>
    <table class="gridtable mini-font" width="100%">
      <thead>
        <tr class="mini-font">
          <th width="10">No.</th>
          <th>Nama Barang</th>
          <th>jenis Barang</th>
          <th>SKU</th>
          <th>Vendor / Merk</th>
          <th>Jumlah</th>
          <th>Harga Satuan (Rp.)</th>
          <th>Total (Rp.)</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
<?php  
$no = 1;
/* Starts Loops */
   $total = 0;
   foreach($inventori as $item) :
      $sub_total = ($item->quantity *$item->nominal);
   ?>
        <tr class="sub-table">
            <td><?php echo $no++; ?></td>
            <td><?php echo $item->inventori_name; ?></td>
            <td><?php echo $item->category_name; ?></td>
            <td><?php echo $item->serial_number; ?></td>
            <td><?php echo $item->vendor; ?></td>
            <td><?php echo $item->quantity; ?></td>
            <td><?php echo number_format($item->nominal) ?>,00</td>
            <td><?php echo number_format($sub_total); ?>,00</td>
            <td><?php echo $item->description; ?></td>
        </tr>
   <?php  
   $total += $sub_total;

 /* End Lopps */
 endforeach;
?>
      </tbody>
      <thead>
         <tr>
            <td colspan="7" style="text-align: right;">Total (Rp.) : </td>
            <td colspan="2"><?php echo (isset($total)) ? number_format($total) : '0'; ?>,00</td>
         </tr>
      </thead>
    </table>
   </div>
 </body>
</html> 

