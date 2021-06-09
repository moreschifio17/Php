<?php
require('../clases/conexion.php');
require('../sesiones.php');
//$conteo = db_query("SELECT IFNULL(MAX(ped_id),0) as conteo FROM compras.pedido");
//$pedido = mysqli_fetch_array($conteo);
//$idped = $pedido[0];
$consulta = db_query("SELECT * FROM pedido where ped_estado='PENDIENTE' and usu_id=$idUsu");
if (mysqli_num_rows($consulta) > 0) {
    $tomar = mysqli_fetch_array($consulta);
    $idped = $tomar[0];
//    echo "ya tenemos el ultimo ID que es:" . $ultID;
} else {
    $idped = 0;
//    $nombre = "";
//    $sucur = "";
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Pedido</title>

        <!-- Custom fonts for this template-->
        <link href="../menu/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script src="../js/script.js"></script>
        <!-- Custom styles for this template-->
        <link href="../menu/css/sb-admin-2.min.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-2.0.0.js"></script>
        <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>  
        <!--<script src="../js/jquery-3.5.1.min.js"></script>-->
        <script src="../js/buscador_matprima.js"></script>
        <script src="../js/buscador_suc.js"></script>
        <style>

            ul{
                list-style-type: none;
                /*                margin: 0;
                                padding: 0;*/

                overflow: hidden;
                background-color: lightblue;
                cursor: pointer;
                border-radius: 0 10px 0 10px;
                padding: 0 5px 0 5px;
                width: 10%;

            }
            li {
                float: left;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 10px 10px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                /*display: block;*/
                color: white;
                text-align: center;
                padding: 10px 10px;
                text-decoration: none;

            }

            .active {
                background-color: #4CAF50;
            }


        </style>
    </head>

    <body id="page-top" class="bg-gray-100" onLoad="getTime()">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->

            <!-- Sidebar - Brand -->
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <form action="pedido_abm.php" enctype="multipart/form-data" method="POST" role="form">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-1 text-gray-800">DATOS DE PEDIDO</h1>-->
                    <!--<p class="mb-4">Bootstrap's default utility classes can be found on the official <a href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom utilities below were created to extend this theme past the default utility classes built into Bootstrap's framework.</p>-->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Grow In Utility -->
                        <div class="col-lg-4">

                            <div class="card position-relative">
                                <div class="card-header py-3 bg-success">
                                    <h6 class="m-0 font-weight-bold text-white"><span class="fa fa-archive"></span> DATOS DE PEDIDO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <code>

                                        </code>

                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <div class="col-lg-12">
                                                                                <label><span><i class=""></i>Nombre y apellido:</span></label>
                                    
                                                                                <input type="text" name="txtnombre" value="<?= $nombre ?>" class="form-control" readonly="">
                                                                            </div>  
                                                                        </div>-->


                                    <div class="form-group">
                                        <div class="col-lg-9">
                                            <label><span><i class=""></i>Sucursal:</span></label>

                                            <input type="hidden" name="txtidsucursal" value="<?= $idSuc ?>" id="ids" class="form-control">
                                            <input type="text" name="txtsucursal" id="sucu" value="<?= $sucur ?>" class="form-control" readonly="">
                                        </div>  
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-9">
                                            <label><span><i class=""></i>Fecha de Pedido:</span></label>

                                            <input type="text" id="fecharegistro" class="form-control" readonly="">
                                        </div>  
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--<div></div>-->
                        <!-- Fade In Utility -->
                        <div class="col-lg-8">

                            <div class="card position-relative ">
                                <div class="card-header py-3 bg-success">
                                    <h6 class="m-0 font-weight-bold text-white"><span class="fa fa-archive"></span> DETALLE PEDIDO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <code>
<!--                                            <div id="mensaje">
                                                <div role="alert" class="alert alert-success">INSERTO CORRECTAMENTE!!!</div>
                                            </div>-->
                                        </code>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><span><i class=""></i>Codigo:</span></label>

                                                <input type="text" name="txtid" value="" id="idpro" class="form-control" readonly="">  
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label><span><i class=""></i>Materia Prima:</span></label>

                                                <input type="text" name="txtmateriaprima" id="descripcion" class="form-control" required="">    
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label><span><i class=""></i>Cantidad:</span></label>

                                                <input type="number" name="txtcantidad" value="" onkeyup="validaciones();" id="" class="form-control" required="">    
                                            </div>
                                        </div>

<!--                                        <input type="hidden" name="valor" value="<?php //echo $_GET['vcod'];   ?>"> -->
                                        <!--</div>-->
                                    </div>
                                    <hr class="divider">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered dt-responsive nowrap" id="carrito">
                                                    <thead>
                                                        <tr>
                                                            <th><div align="center">Acción</div></th>
                                                            <th><div align="center">Codigo</div></th>
                                                            <th><div align="center">Materia Prima</div></th>
                                                            <th><div align="center">Cantidad</div></th>

                                                        </tr></thead>
                                                    <?php
                                                    $consul = db_query("select * from vs_detpedido where ped_id=$idped");
                                                    ?>
                                                    <tbody>
                                                        <?php while ($mostrardatos = mysqli_fetch_array($consul)) { ?>
                                                            <tr>
                                                                <td><div align="center"><a href="pedido_abm.php?delete=delete&id=<?php echo $mostrardatos[1] ?>"><i class="entypo-trash"></i>Borrar</a></div></td>
                                                                <td><div align="center"><?php echo $mostrardatos[1] ?></div></td>
                                                                <td><div align="center"><?php echo $mostrardatos[2] ?></div></td>
                                                                <td><div align="center"><?php echo $mostrardatos[3] ?></div></td> 
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>

                                                </table>
                                                <div id="mensaje"></div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer"> 
                                        <button class="btn btn-warning" type="text" onclick="location.href = 'pedidolistado.php'"><span class="fa fa-window-restore"></span> VOLVER</button> 
                                        <button class="btn btn-danger" type="reset"><span class="fa fa-times"></span> CANCELAR</button> 
                                        <button type="button" name="imprimir" id="btn-submit" class="btn btn-primary" onclick="location.href = 'pedido_abm.php?imprimir=imprimir&vcod=<?php echo $idped; ?>'"><span class="fa fa-save"></span> IMPRIMIR</button> 
                                        <!--<button type="submit" name="agregar" id="btn-submit" class="btn btn-success"><span class="fa fa-check"></span> REGISTRAR</button>--> 
                                        <!--<input type="submit" name="agregar" id="btn-submit" class="btn btn-success glyphicon glyphicon-check" value="REGISTRAR">-->
                                        <div align="right"><button type="submit" name="agregar" value="agregar" data_toggle="modal" data_target="#registra" id="AgregaProductoVentas" class="btn btn-primary" onclick="retornar();"><span class="fa fa-check"></span> REGISTRAR</button>
                                        </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                    </div>


                    <div class="modal fade" id="registra" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title custom_align" id="heading"> INSERCIÓN EXITOSA!!! </h4>
                                </div>
                                <div class="modal-body">
                                    <span class="fa fa-check">OK</span>
                                    <a class="btn btn-info" href="pedido_agregar.php">ACEPTAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                                <a class="scroll-to-top rounded" href="#page-top">
                                    <i class="fas fa-angle-up"></i>
                                </a>-->

                    <!-- Logout Modal-->


                    <!-- Bootstrap core JavaScript-->
                    <!--<script src="../menu/vendor/jquery/jquery.min.js"></script>-->
                    <script src="../menu/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <!--<script src="../menu/vendor/jquery-easing/jquery.easing.min.js"></script>-->

                    <!-- Custom scripts for all pages-->
                    <script src="../menu/js/sb-admin-2.min.js"></script>
                    <script>
                                            $("#mensaje").hide();
                                            function retornar{
                                                $("#mensaje").show();
                                                $("#mensaje").delay(4000).slideUp(200, function () {
                                                    ($this).alert('close');
                                                });

                                            }


                    </script>

                    </body>

                    </html>
