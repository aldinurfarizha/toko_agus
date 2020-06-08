<?php 
	$pem       = new lsp();
	$transkode = $pem->autokode("table_transaksi","kd_transaksi","TR");
	$sql       = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
	$exec      = mysqli_query($con,$sql);
	$assoc     = mysqli_fetch_assoc($exec);
	$sql1      = "SELECT SUM(jumlah) as jum FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
	$exec1     = mysqli_query($con,$sql1);
	$assoc1    = mysqli_fetch_assoc($exec1);
	$auth      = $pem->selectWhere("table_user","username",$_SESSION['username']);
	$sql2      = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
	$exec2     = mysqli_query($con,$sql2);
	$assoc2    = mysqli_fetch_assoc($exec2);
	$sql3      = "SELECT * from table_pelanggan";
	$exec3     = mysqli_query($con,$sql3);
	$assoc3    = mysqli_fetch_assoc($exec3);
	if ($assoc2['count'] <= 0) {
		header("location:PageKasir.php?page=kasirTransaksi");
	}

if(isset($_POST['tambah_piutang']))
{   $id=$_POST['id_pelanggan'];
	$total  = $_POST['tot'];
$sql4="INSERT INTO piutang_dagang (id_pelanggan,total_piutang) VALUES ('$id','$total') 
ON DUPLICATE KEY UPDATE total_piutang=total_piutang+'$total'";
mysqli_query($con,$sql4);
$total  = $_POST['tot'];
$bayar  = $_POST['bayar'];
$kem    = $_POST['kem'];

		$date  = date("Y-m-d");
		$value = "'$transkode','$auth[kd_user]','$assoc1[jum]','$assoc[sub]','$date'";
		$response = $pem->insert("table_transaksi",$value,"?page=struk&id=$transkode");
		if ($response['response'] == "positive") {
			unset($_SESSION['transaksi']);
		}
	


}

	if (isset($_POST['selesaiGet'])) {
		$total  = $_POST['tot'];
		$bayar  = $_POST['bayar'];
		$kem    = $_POST['kem'];
		if ($bayar == "" || $kem == "") {
			$response = ['response'=>'negative','alert'=>'Bayar dahulu'];
		}else{
			if ($bayar < $total) {
				$response = ['response'=>'negative','alert'=>'Uang Kurang'];
			}else{
				$date  = date("Y-m-d");
				$value = "'$transkode','$auth[kd_user]','$assoc1[jum]','$assoc[sub]','$date'";
				$response = $pem->insert("table_transaksi",$value,"?page=struk&id=$transkode");
				if ($response['response'] == "positive") {
					unset($_SESSION['transaksi']);
				}
			}
		}
	}
 ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-6 col-sm-12 offset-2">
            		<div class="card">
            			<div class="card-header">
            				<h3>Pembayaran</h3>
            			</div>
            			<div class="card-body">
            				<form method="post">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Kode Transaksi</label>
										<input type="text" class="form-control" name="autokode" id="autokode" value="<?php echo $transkode ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Total harga</label>
										<input type="text" class="form-control" name="tot" id="tot" value="<?php echo $assoc['sub'] ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Bayar</label>
										<input type="text" class="form-control" name="bayar" id="bayar">
									</div>
									<div class="form-group">
										<label for="">Kembalian</label>
										<input type="text" class="form-control" name="kem" id="kem" readonly="">
									</div>
									<button class="btn btn-primary" name="selesaiGet"><i class="fa fa-cart-plus"></i> Selesaikan Transaksi </button>
									<a class="btn btn-warning" href="#piutang" data-toggle="modal">Selesaikan Dengan Piutang</a>
									<a href="?page=kasirTransaksi" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
								</div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>
		</div>
    </div>
</div>
<div class="modal fade" id="piutang" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Masukan Informasi Pelanggan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="tambah_piutang"  method="post">
                <label>Nama Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" class="form-control">
			<?php foreach ($exec3 as $dd): ?>
				<option value="<?= $dd['id_pelanggan'] ?>"><?php echo $dd['nama_pelanggan']."-".$dd['no_telp'] ?></option>
				<?php endforeach ?>
			</select>
			<label>Total Piutang</label>
            <input type="text" class="form-control" name="tot" id="tot" value="<?php echo $assoc['sub'] ?>" readonly>
            <br>
			<div class="form-group">
									<div class="form-group">
										<input type="text" class="form-control" name="bayar" id="bayar" value="<?php echo $assoc['sub'] ?>">
									</div>
									<div class="form-group">
									<input type="hidden" class="form-control" name="autokode" id="autokode" value="<?php echo $transkode ?>" readonly>
										<input type="hidden" class="form-control" name="kem" id="kem" readonly="">
            <input class="btn btn-warning" name="tambah_piutang" value="Tambah Piutang" type="submit"></input>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#jumjum').keyup(function(){
        	var jumlah  = $(this).val();
        	var harba   = $('#harba').val();
        	var kali    = harba * jumlah;
        	$("#totals").val(kali);
        });

        $('#bayar').keyup(function(){
        	var bayar = $(this).val();
        	var total = $('#tot').val();
        	var kembalian = bayar - total;
        	$('#kem').val(kembalian);
        });
	})
</script>