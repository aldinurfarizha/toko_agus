<?php
$id=$_POST['kd_pretransaksi'];
$pem= new lsp();
$pem->ganti_bos($id); 
//$query = "UPDATE table_pretransaksi set status=1 where kd_pretransaksi='$id'";
 //mysqli_query($con,$query);
?>