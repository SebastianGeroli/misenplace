<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
<!--       <li><a href="#">Users Online: <?php echo users_online(); ?></a></li>-->
              <li><a href="#">Users Online: <span class="useronline"></span></a></li>

        <li><a href="../index.php">HOME SITE</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i> <?php //echo $_SESSION['first_name'] . " " . $_SESSION['last_name']?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user "></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fas fa-tachometer-alt fa-lg"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#products_dropdown"><i class="fab fa-product-hunt fa-lg"></i> Productos <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="products_dropdown" class="collapse">
                    <li>
                        <a href="./products.php">Ver todos los Productos</a>
                    </li>
                    <li>
                        <a href="products.php?source=add_product">Añadir Nuevo Producto</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"> <i class="fas fa-utensils fa-lg"></i> Categorias</a>
            </li>
            
            <li class="">
                <a href="comments.php"><i class="far fa-comments fa-lg"></i> Comments</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fas fa-users fa-lg"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">Ver Todos los Usuarios</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Añadir un Usuario</a>
                    </li>
                </ul>
            </li>
             <li>
                <a href="profile.php"><i class="fas fa-user-circle fa-lg"></i> Perfil</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
