<?php 
	$pelanggan       = new lsp();
    $sql2      = "SELECT * from table_pelanggan";
    $exec2     = mysqli_query($con,$sql2);
    $assoc2    = mysqli_fetch_assoc($exec2);
    if (isset($_POST['tambah'])) {
        $nama_pelanggan=$_POST['nama_pelanggan'];
        $alamat=$_POST['alamat'];
        $no_telp=$_POST['no_telpon'];
        $value = "'','$nama_pelanggan','$alamat','$no_telp','0'";
        $response=$pelanggan->insert('table_pelanggan', $value, '?page=pelanggan');
    }
    if(isset($_POST['edit']))
{   $id=$_POST['id_pelanggan'];
    $nama_pelanggan=$_POST['nama_pelanggan'];
    $alamat=$_POST['alamat'];
    $no_telp=$_POST['no_telpon'];
    $value = "id_pelanggan='$id',nama_pelanggan='$nama_pelanggan',alamat='$alamat',no_telp='$no_telp',status='0'";
    $response=$pelanggan->update('table_pelanggan', $value,"id_pelanggan",$id, "?page=pelanggan");
}
if(isset($_POST['non_aktif']))
{   $id=$_POST['id_pelanggan'];
    $nama_pelanggan=$_POST['nama_pelanggan'];
    $alamat=$_POST['alamat'];
    $no_telp=$_POST['no_telpon'];
    $value = "id_pelanggan='$id',nama_pelanggan='$nama_pelanggan',alamat='$alamat',no_telp='$no_telp',status='1'";
    $response=$pelanggan->update('table_pelanggan', $value,"id_pelanggan",$id, "?page=pelanggan");
}



 ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Daftar Pelanggan</h3>
                        <div class="text-right"><a class="btn btn-primary btn-lg" href="#tambah" data-toggle="modal">Tambah</a></div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                            <table class="table table-striped table-bordered" width="80%">
                              <tr>
                                    <td>ID Pelanggan</td>
                                    <td>Nama Pelanggan</td>
                                    <td>Alamat</td>
                                    <td>No. HP</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                              </tr>
                              <?php foreach ($exec2 as $dd): ?>
                              <tr>
                                    <td><?= $dd['id_pelanggan'] ?></td>
                                    <td><?= $dd['nama_pelanggan'] ?></td>
                                    <td><?= $dd['alamat'] ?></td>
                                    <td><?= $dd['no_telp'] ?></td>
                                    <td><?php 
                                    $status=$dd['status'];
                                    if($status==0){
                                        echo '<div class="badge badge-primary text-wrap" style="width: 6rem;">
                                        Aktif
                                      </div>';
                                    }
                                    else{
                                        echo '<div class="badge badge-danger text-wrap" style="width: 6rem;">
                                        Non-Aktif
                                      </div>';
                                    }?>
                                    <td><?php 
                                    $status=$dd['status'];
                                       
                                        if($status==0){
                                            echo '<a class="btn btn-warning btn-block" href="#edit'.$dd['id_pelanggan'].'" data-toggle="modal">Edit</a><a class="btn btn-danger btn-block" href="#hapus'.$dd['id_pelanggan'].'" data-toggle="modal">Non Aktifkan</a></td>';
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
<div class="modal fade" id="tambah" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Masukan Informasi Pelanggan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="tambah"  method="post">
                <label>Nama Pelanggan</label>
            <input name="nama_pelanggan" class="form-control" id="nama_pelanggan" type="text">
            <label>Alamat Pelanggan</label>
            <input name="alamat" id="alamat" class="form-control" type="text">
            <label>No.Hp</label>
            <input name="no_telpon" id="no_telpon" class="form-control" type="text">
            <br>
            <input class="btn btn-primary" name="tambah" value="Tambah Pelanggan" type="submit"></input>
            </form>
            </div>
        </div>
    </div>
</div>
<?php foreach ($exec2 as $dd):?>
<div class="modal fade" id="edit<?= $dd['id_pelanggan'] ?>" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Data Pelanggan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form name="edit"  method="post">
            <input name="id_pelanggan" class="form-control" id="id_pelanggan" type="hidden" value="<?= $dd['id_pelanggan'] ?>">
            <label>Nama Pelanggan</label>
            <input name="nama_pelanggan" class="form-control" id="nama_pelanggan" type="text" value="<?= $dd['nama_pelanggan'] ?>">
            <label>Alamat Pelanggan</label>
            <input name="alamat" id="alamat" class="form-control" type="text" value="<?= $dd['alamat'] ?>">
            <label>No.Hp</label>
            <input name="no_telpon" id="no_telpon" class="form-control" type="text" value="<?= $dd['no_telp'] ?>">
            <br>
            <input class="btn btn-primary" name="edit" value="Edit" type="submit"></input>
            </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($exec2 as $dd):?>
<div class="modal fade" id="hapus<?= $dd['id_pelanggan'] ?>" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Anda Yakin Menonaktifkan Pelanggan ini secara permanen?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form name="non_aktif"  method="post">
            <input name="id_pelanggan" class="form-control" id="id_pelanggan" type="hidden" value="<?= $dd['id_pelanggan'] ?>">
            <label>Nama Pelanggan</label>
            <input name="nama_pelanggan" class="form-control" id="nama_pelanggan" type="text" value="<?= $dd['nama_pelanggan'] ?>"readonly>
            <label>Alamat Pelanggan</label>
            <input name="alamat" id="alamat" class="form-control" type="text" value="<?= $dd['alamat'] ?>"readonly>
            <label>No.Hp</label>
            <input name="no_telpon" id="no_telpon" class="form-control" type="text" value="<?= $dd['no_telp'] ?>"readonly>
            <br>
            <input class="btn btn-danger" name="non_aktif" value="YA, SAYA YAKIN" type="submit"></input>
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