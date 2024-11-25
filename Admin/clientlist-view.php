<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Clientes</title>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Lista de Clientes</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clientes = ejecutar::consultar("SELECT * FROM cliente");
                    while ($row = mysqli_fetch_array($clientes)) {
                        echo "<tr>";
                        echo "<td>" . $row['NIT'] . "</td>";
                        echo "<td>" . $row['NombreCompleto'] . "</td>";
                        echo "<td>" . $row['Apellido'] . "</td>";
                        echo "<td>" . $row['Telefono'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Direccion'] . "</td>";
                        echo '<td>
                            <form action="process/delclient.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="nit" value="' . $row['NIT'] . '">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>';
                        echo "</tr>";
                    }
                    mysqli_free_result($clientes);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
