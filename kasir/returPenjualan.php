<?php 
	$retur       = new lsp();
    $sql2      = "SELECT kd_pretransaksi, nama_barang,tanggal_beli,status from table_pretransaksi
    JOIN table_barang on table_pretransaksi.kd_barang=table_barang.kd_barang
    JOIN table_transaksi ON table_pretransaksi.kd_transaksi=table_transaksi.kd_transaksi ";
    $exec2     = mysqli_query($con,$sql2);
    $assoc2    = mysqli_fetch_assoc($exec2);
    if (isset($_POST['retur'])) {
        $id=$_POST['kd_pretransaksi'];
	$value = "kd_pretransaksi='$id',status='1'";
    $response=$retur->update('table_pretransaksi', $value,"kd_pretransaksi",$id, "?page=returPenjualan");
	}
    
    if(isset($_POST['balikeun']))
{   
    $id=$_POST['kd_pretransaksi'];
    $query = "UPDATE table_pretransaksi set status=1 where kd_pretransaksi='$id'";
    mysqli_query($con,$query);
    header("location:PageKasir.php?page=returPenjualan");
}



 ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Pilih Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                            <table class="table table-striped table-bordered" width="80%">
                              <tr>
                                    <td>Kode Transaksi</td>
                                    <td>Nama Barang</td>
                                    <td>Tanggal Beli</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                              </tr>
                              <?php foreach ($exec2 as $dd): ?>
                              <tr>
                                    <td><?= $dd['kd_pretransaksi'] ?></td>
                                    <td><?= $dd['nama_barang'] ?></td>
                                    <td><?= $dd['tanggal_beli'] ?></td>
                                    <td><?php 
                                    $status=$dd['status'];
                                    if($status==0){
                                        echo 'SUKSES';
                                    }
                                    else{
                                        echo "DI RETUR";
                                    }?>
                                    <td><?php 
                                    $status=$dd['status'];
                                    if($status==0){
                                        echo '<a class="btn btn-warning btn-block" href="#'.$dd['kd_pretransaksi'].'" data-toggle="modal">Retur</a></td>';
                                    }
                                    else{
                                        echo "Berhasil di Retur";
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
<div class="modal fade" id="<?= $dd['kd_pretransaksi'] ?>" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Keterangan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <td>Kode Transaksi</td>
                            <td>Nama Barang</td>
                            <td>Tanggal Beli</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td><?= $dd['kd_pretransaksi'] ?></td>
                        <td><?= $dd['nama_barang'] ?></td>
                        <td><?= $dd['tanggal_beli'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <form name="update"  method="post">
            <input name="kd_pretransaksi" id="kd_pretransaksi" type="hidden" value="<?= $dd['kd_pretransaksi'] ?>">
            <input class="btn btn-primary" name="retur" type="submit" value="Retur"></input>
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