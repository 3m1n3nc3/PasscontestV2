          <!-- Modal -->
          <div class="modal fade" id="passModal" role="dialog">
              <div class="modal-dialog modal-md">
                  <div class="modal-content">

                  </div>
              </div>
          </div>

          <!-- Action Modal -->
          <div class="modal fade" id="actionModal" role="dialog">
              <div class="modal-dialog modal-md">
                  <div class="modal-content container-fluid">
                      <div class="modal-header container-fluid">
                          <h4 class="modal-title float-left"></h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body container-fluid">
                          
                      </div> 
                  </div>
              </div>
          </div> 

          <footer class="footer">
          <div class=" container-fluid ">
            <nav>
              <ul>
                <li>
                  <a href="https://www.creative-tim.com">
                    Creative Tim
                  </a>
                </li>
                <li>
                  <a href="http://presentation.creative-tim.com">
                    About Us
                  </a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com">
                    Blog
                  </a>
                </li>
              </ul>
            </nav>
            <div class="copyright" id="copyright">
              &copy; <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
              </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!--   Core JS Files   --> 
    <script src="<?php echo base_url('resources/js/core/popper.min.js'); ?>"></script> 
    <script src="<?php echo base_url('resources/js/core/bootstrap.min.js'); ?>"></script>  
    <script src="<?php echo base_url('resources/js/plugins/perfect-scrollbar.jquery.min.js'); ?>"></script>   
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS --> 
    <script src="<?php echo base_url('resources/js/plugins/chartjs.min.js'); ?>"></script>   
    <!--  Notifications Plugin    --> 
    <script src="<?php echo base_url('resources/js/plugins/bootstrap-notify.js'); ?>"></script>  
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url('resources/js/now-ui-dashboard.min.js?v=1.5.0'); ?>"></script>  
    <script src="<?php echo base_url('resources/pass/js/passcontest-v2.0.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('resources/js/plugins/croppie.js'); ?>"></script>  
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url('resources/demo/demo.js'); ?>"></script>  
    <!-- Datatables -->
    <?php if (isset($use_datatables) && $use_datatables): ?>
      <script src="<?php echo base_url(); ?>resources/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url(); ?>resources/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
      <!-- page script -->
      <script>
        $(function () {
          $('#datatables_table').DataTable({  
            "scrollX": true,    
            "pageLength" : 10,
            "serverSide": true,
            "order": [[0, "asc" ]],
            "ajax":{
                  url :  '<?php echo site_url('ajax/datatables/'.$table_method); ?>',
                  type : 'POST'
              },
              rowId: 20
          }) 
        })
      </script>
    <?php endif ?> 
  </body>

</html>
