<?php

$getAllProducts = fn($db_conn) => mysqli_query($db_conn, "SELECT * FROM tbl_product");

$addProduct = fn($db_conn, $ptitle, $pprice, $pfile, $pfile_temp) => mysqli_query(
    $db_conn,
    "INSERT INTO tbl_product (ptitle, pprice, pfile, pstatus) 
                VALUES ('$ptitle', '$pprice', '$pfile', '1')"
);

$addProduct = fn($db_conn, $ptitle, $pprice, $pfile, $pfile_temp) => mysqli_query(
    $db_conn,
    "INSERT INTO tbl_product (ptitle, pprice, pfile, pstatus) 
                VALUES ('$ptitle', '$pprice', '$pfile', '1')"
);

?>