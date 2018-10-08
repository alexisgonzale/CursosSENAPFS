    <!-- Essential javascripts for application to work-->
    <script src="<?=URL?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?=URL?>/js/popper.min.js"></script>
    <script src="<?=URL?>/js/bootstrap.min.js"></script>
    <script src="<?=URL?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=URL?>/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?=URL?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?=URL?>/js/plugins/dataTable.responsive.min.js"></script> -->
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
    $('#sampleTable').DataTable({
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
    });
    $('#myTable').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
    }); 

    </script>
    <!-- <script>
        $(document).ready(function() {  });
    </script> -->
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?=URL?>/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/js/plugins/validaciones.js"></script>
    <!-- pag -->
    <script src="<?=URL?>/js/plugins/jquery.easyPaginate.js"></script>
    
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
  </body>
  <?php 

  if(isset($_SESSION['mensaje'])){
    echo $_SESSION['mensaje'];
    $_SESSION['mensaje']=null;
  }
?>
</diV>
</html>
