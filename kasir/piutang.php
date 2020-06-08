<?php 
	$pelanggan       = new lsp();
    $sql2      = "SELECT piutang_dagang.id_pelanggan, nama_pelanggan,alamat, no_telp, total_piutang
	FROM piutang_dagang
	INNER JOIN table_pelanggan
	ON piutang_dagang.id_pelanggan = table_pelanggan.id_pelanggan";
    $exec2     = mysqli_query($con,$sql2);
    $assoc2    = mysqli_fetch_assoc($exec2);
    if(isset($_POST['bayar']))
{   $id=$_POST['id_pelanggan'];
	$total_bayar=$_POST['total_bayar'];
	$total_piutang=$_POST['total_piutang'];
	$total_final=$total_piutang-$total_bayar;
	if($total_final>=0){
		$value = "id_pelanggan='$id',total_piutang='$total_final'";
    $response=$pelanggan->update('piutang_dagang', $value,"id_pelanggan",$id, "?page=piutang");
	}
	else{
		$response = ['response'=>'negative','alert'=>'Jumlah Pembayaran Tidak Boleh melebihi total Utang dagang'];
	}
}



 ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Daftar Piutang Pelanggan</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                            <table class="table table-striped table-bordered" width="80%">
                              <tr>
                                    <td>Nama Pelanggan</td>
                                    <td>Alamat</td>
                                    <td>No. HP</td>
                                    <td>Total Utang</td>
                                    <td>Aksi</td>
                              </tr>
                              <?php foreach ($exec2 as $dd): ?>
                              <tr>
                                    <td><?= $dd['nama_pelanggan'] ?></td>
                                    <td><?= $dd['alamat'] ?></td>
                                    <td><?= $dd['no_telp'] ?></td>
                                    <td><?php 
                                    $status=$dd['total_piutang'];
                                    if($status==0){
                                        echo '<div class="badge badge-primary text-wrap" style="width: 6rem;">
                                        Lunas
                                      </div>';
                                    }
                                    else{
                                        echo '<div class="badge badge-danger text-wrap" style="width: 6rem;">
                                        '.$status.'
                                      </div>';
                                    }?>
                                    <td><?php 
                                    $status=$dd['total_piutang'];
                                       
                                        if(!$status==0){
                                            echo '<a class="btn btn-success btn-block" href="#bayar'.$dd['id_pelanggan'].'" data-toggle="modal">Bayar</a></td>';
                                        }
                                        else{
                                            echo '';
                                        }?>
                                    
                              </tr>
                             
                              <?php endforeach ?>
                
                        </table>
                        </form>
                    </div>
                </div>
                </div>
               
            </div>
        </div>

    </div>
</div>
<?php foreach ($exec2 as $dd):?>
<div class="modal fade" id="bayar<?= $dd['id_pelanggan'] ?>" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bayar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form name="bayar"  method="post">
            <input name="id_pelanggan" class="form-control" id="id_pelanggan" type="hidden" value="<?= $dd['id_pelanggan'] ?>">
			<input name="total_piutang" class="form-control" id="total_piutang" type="hidden" value="<?= $dd['total_piutang'] ?>">
            <label>Total Piutang</label>
			<h2><?= $dd['total_piutang'] ?></h2>
			<label>Nama Pelanggan</label>
            <input name="nama_pelanggan" class="form-control" id="nama_pelanggan" type="text" value="<?= $dd['nama_pelanggan'] ?>" readonly>
            <br>
			<label>Total Bayar</label>
			<input name="total_bayar" class="form-control" id="total_bayar" type="text" >
			<br>
            <input class="btn btn-success" name="bayar" value="Bayar" type="submit"></input>
            </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<script src="vendor/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){


        $('#barang_nama').change(function(){
            var barang = $(this).val();
            $.ajax({
                type:"POST",
                url :'ajaxTransaksi.php',
                data:{'selectData' : barang},
                success: function(data){
                    $("#harba").val(data);
                    $("#jumjum").val();
                    var jum   = $("#jumjum").val();
                    var kali  = data * jum;
                    $("#totals").val(kali);
                }
            })
        });


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
        })
    })
</script>