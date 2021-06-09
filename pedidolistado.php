<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Tables</title>

        <!-- Custom fonts for this template -->
        <link href="../menu/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../menu/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="../menu/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top bg-gray-100">
        <?php
        require ('../clases/conexion.php');
        include '../sesiones.php';
        $datos = db_query("select * from vs_pedido where ped_estado='GENERADO' OR ped_estado='PENDIENTE' AND suc_id=$idSuc");
        ?>
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid bg-gray-100">

                <!-- Page Heading -->
                <h1 align="center" class="h3 mb-2 text-gray-800">Listado Pedido</h1>
                <p align="center"><a href="../movimientos/pedido_agregar.php" class="btn btn-success">Nuevo Registro</a></p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-success">
                        <h6 class="m-0 font-weight-bold text-white">Listado Pedido</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead align="center">
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>FECHA</th>
                                        <th>ESTADO</th>
                                        <th>USUARIO</th>
                                        <th>ACCIONES</th>

                                    </tr>
                                </thead>
              <!--                  <tfoot>
                                  <tr>
                                    <th>CODIGO</th>
                                    <th>FECHA</th>
                                    <th>ESTADO</th>
                                    <th>USUARIO</th>
                                    <th>ACCIONES</th>
                                    
                                  </tr>
                                </tfoot>-->
                                <?php
                                while ($fila = mysqli_fetch_array($datos)) {
                                    $date = new DateTime($fila[1]);
                                    ?>
                                    <tbody align="center">
                                        <tr>
                                            <td><?php echo $fila[0]; ?></td>
                                            <td><?php echo date_format($date, 'd-m-Y'); ?></td>
                                            <?php if ($fila[2] == 'GENERADO') { ?>
                                                <td class="text-success"><?php echo $fila[2]; ?></td>
                                            <?php } else { ?>
                                                <td class="text-danger"><?php echo $fila[2]; ?></td>

                                            <?php } ?>
                                            <td><?php echo $fila[6]; ?></td>
                                            <td>
                                                <!--<a href="pedido_editar.php?vcod=<?php echo $fila[0]; ?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>-->
                                                <a href="pedido_abm.php?borrar=borrar&vcod=<?php echo $fila[0]; ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></a>

                                            </td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!--      <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                  </div>
                </div>
              </footer>-->
        <!-- End of Footer -->


        <!-- Scroll to Top Button-->


        <!-- Logout Modal-->

        <!-- Bootstrap core JavaScript-->
        <script src="../menu/vendor/jquery/jquery.min.js"></script>
        <script src="../menu/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../menu/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../menu/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../menu/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../menu/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../menu/js/demo/datatables-demo.js"></script>

    </body>

</html>
