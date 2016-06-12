<?php
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'function/route.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Persediaan Barang JJ Education Toys</title>
  <?php include "view/component/head-include.php" ?>

</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <?php include "view/component/header.php" ?>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <?php include "view/component/menu.php" ?>
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	    <?php
			$page = (isset($_GET['page']))? $_GET['page'] : "main";
			route($page);
		?>
  </div>
  <!-- /.content-wrapper -->
  <?php include "view/component/right-sidebar.php" ?>

</div>
<!-- ./wrapper -->
<?php include "view/component/foot-include.php" ?>
</body>
</html>