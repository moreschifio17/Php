<?php
require('../clases/conexion.php');
require('../sesiones.php');
//insertar registros
if (!empty($_POST['agregar'])) {
    $consulta = db_query("select * from pedido where ped_estado='PENDIENTE' and usu_id=$idUsu");
    if (mysqli_num_rows($consulta) > 0) {
        $consucabe = db_query("select * from pedido where ped_estado='PENDIENTE' and usu_id=$idUsu");
        $ID = mysqli_fetch_array($consucabe);
        $ped = $ID[0];
//        $ID = mysqli_fetch_array($consucabe);
        $detalle = db_query("call sp_detpedido($ped,$_POST[txtid],$_POST[txtcantidad])");

        if ($detalle) {

//                    header("refresh:3;url=pedido_agregar.php");
            echo "<script>location.href='pedido_agregar.php'</script>";
        }
    } else {
        $fecha = date('Y-m-d');
        $sucursales = $_POST['txtidsucursal'];
        //insertar cabecera 
//        $cabecera = db_query("insert into pedido(ped_fecha,ped_estado,suc_id,usu_id) values('$fecha','PENDIENTE',$sucursales,$idUsu)");
        $cabecera = db_query(" call sp_pedido('$fecha','PENDIENTE',$sucursales,$idUsu)");
        //consultar cabecera
        $consucabe = db_query("select * from pedido where ped_estado='PENDIENTE' and usu_id=$idUsu");
//        $consucabe = db_query("SELECT IFNULL(MAX(ped_id),0) as conteo FROM pedido;");
        $ID = mysqli_fetch_array($consucabe);
        $ped = $ID[0];
        $cod = $_POST['txtid'];
        $cant = $_POST['txtcantidad'];
        //insertar detalle
        $detalle = db_query(" call sp_detpedido($ped,$cod,$cant)");
        if ($detalle) {
//            echo "<div class='alert alert-success'>SE INSERTO CORRECTAMENTE</div>";
//            echo '<div class="alert alert-success" id="mensaje" role="alert">INSERTO EXITOSAMENTE<span class="glyphicon glyphicon-exclamation-sign"></span></div>';
//                    header("refresh:3;url=pedido_agregar.php");
            echo "<script>location.href='pedido_agregar.php'</script>";
        }
    }
}

if (!empty($_GET['delete'])) {
    $eliminar = db_query("delete from det_pedido where mat_id=$_GET[id]");

    if ($eliminar) {
        echo "<script>location.href='pedido_agregar.php'</script>";
    } else {

        echo "<script>alert('No se pudieron borrar los registros del detalle')</script>";
    }
}
if (!empty($_GET['borrar'])) {
    $cancel = db_query("update pedido set ped_estado='ANULADO' where ped_id=$_GET[vcod]");
    if ($cancel) {
        echo "<script>location.href='pedidolistado.php'</script>";
    }
}
///
if (!empty($_GET['imprimir'])) {
    $f1 = $_GET['vcod'];
    $update = db_query("update pedido set ped_estado='GENERADO' where ped_id=$f1");
    if ($update) {
        echo "<script>location.href='pedido_impresion.php?vcod=$f1'</script>";
    }
    
//    echo "<script>location.href='pedido_impresion.php?vcod=$f1'</script>";
}
?>
				
