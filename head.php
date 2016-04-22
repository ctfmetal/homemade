<!DOCTYPE html>
<html>
    <head>
        <title>HomeMade APP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="css/styles.css" rel="stylesheet">

        <!-- DatePker-->
        <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">

        <link rel="stylesheet" href="./css/datepicker.min.css" />
        <link rel="stylesheet" href="./datepicker3.min.css" />


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="./js/html5shiv.js"></script>
        <script src="./js/respond.min.js"></script>
        <![endif]-->
        <style>
            footer {
                position: fixed;
                height: 50px;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <?php
        include ("./connect.php");
        include ("./set/grant.php");
        ?>

        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="root.php">HomeMade APP</a></h1>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">USER: <?php echo $cod;?><b class="caret"></b></a>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <li><a href="profile.html">Profile</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <?php
                            $current=$_GET["p"];
                            //echo $current;


                            ?>
                            <li <?php if ($current=="dashboard" || $current == ""){echo 'class="current"';}?>>
                                <a href="root.php?p=dashboard">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li  class="submenu">
                                <a href="#">
                                    <i class="glyphicon glyphicon-th-list"></i>
                                    Category
                                    <span class="caret pull-right"></span>
                                </a>
                                <?php
                                    //Se loggato Admin
                                    if ($profile == "0") {
                                        $query = "SELECT * FROM category";
                                        $esegui = mysql_query($query) or die(mysql_error());

                                        while ($results = mysql_fetch_array($esegui)) {


                                            $id = $results[idcategory];
                                            $name = $results[name];
                                            $type = $results[type];
                                            $owner = $results[owner];
                                            $priv = $results[priv];

                                            if($priv == "1"){
                                                $icon ="<i class='glyphicon glyphicon-lock'></i>";
                                            }else $icon = "<i class='glyphicon glyphicon-share'></i>";


                                            if($owner == $cod){
                                                $owner_res = "My";
                                            }else $owner_res = $owner;

                                            echo "<ul>";
                                            echo "<li><a href='root.php?p=category&cat=$id'>
                                            $icon $owner_res: $name</a></li>";
                                            echo "</ul>";

                                        }
                                    }
                                    //Se loggato user
                                    if ($profile == "1") {
                                        $query = "SELECT * FROM category WHERE owner = '$cod' OR priv = 0 ORDER BY owner";
                                        $esegui = mysql_query($query) or die(mysql_error());

                                        while ($results = mysql_fetch_array($esegui)) {


                                            $id = $results[idcategory];
                                            $name = $results[name];
                                            $type = $results[type];
                                            $owner = $results[owner];

                                            if($owner == $cod){
                                                $owner = "My";
                                                $icon ="<i class='glyphicon glyphicon-lock'></i>";
                                            }else $icon = "<i class='glyphicon glyphicon-share'></i>";

                                            echo "<ul>";
                                            echo "<li><a href='root.php?p=category&cat=$id'>
                                            $icon $owner: $name</a></li>";
                                            echo "</ul>";

                                        }
                                    }
                                    ?>
                            </li>

                            <li  class="submenu">
                                <a href="#">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                    <span class="caret pull-right"></span>
                                </a>
                                <!-- Sub menu -->
                                <ul>
                                    <li <?php if ($current=="add_entry")
                                    {echo 'class="current"';}?>>
                                        <a href="root.php?p=add_entry">
                                           Category ADD
                                        </a>
                                    </li>
                                    <li <?php if ($current == "mod_entry")
                                    {echo 'class="current"';}?>>
                                        <a href="root.php?p=mod_entry">
                                           Category DEL
                                        </a>
                                    </li>
                                    <?php
                                    if ($profile == "0") {

                                            echo "<li>
                                                    <a href='root.php?p=user'>
                                                   User
                                                </a>
                                            </li>";

                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                //Operazioni di servizio.
                $page=$_GET['p'];
                $page_compete="$page.php";
                include("$page_compete");
                ?>
            </div>
        </div>
             <footer>
                    <div class="footer text-center">
                        Powered By Fabio Catania on Bootstrap-Admin-Theme-3-master Copyright 2016 <a href='#'>Website</a>
                    </div>
             </footer>


                <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="./js/jquery.js"></script>
                <!-- jQuery UI -->
                <script src=./js/jquery-ui.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="bootstrap/js/bootstrap.min.js"></script>

                <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

                <script src="vendors/datatables/dataTables.bootstrap.js"></script>

                <script src="js/custom.js"></script>
                <script src="js/tables.js"></script>





            <script src="./js/bootstrap-datepicker.min.js">

            </script>
            <script>
            $(document).ready(function() {
                $('#dateRangePicker')
                    .datepicker({
                        format: 'dd/mm/yyyy',
                        startDate: '01/01/2010',
                        endDate: '31/12/2030'
                    })
                    .on('changeDate', function(e) {
                        // Revalidate the date field
                        $('#dateRangeForm').formValidation('revalidateField', 'date');
                    });

                $('#dateRangeForm').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        date: {
                            validators: {
                                notEmpty: {
                                    message: 'The date is required'
                                },
                                date: {
                                    format: 'DD/MM/YYYY',
                                    min: '01/01/2010',
                                    max: '12/30/2020',
                                    message: 'The date is not a valid'
                                }
                            }
                        }
                    }
                });
            });
            </script>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
    </body>
</html>