            <?php 
                $footer = $this->content_model->get(['in' => 'footer', 'parent' => 'null']); 
            ?>

            <!-- Modal -->
            <div class="modal fade" id="passModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>This is a small modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer <?php echo (isset($reset_footer) ? $reset_footer : 'footer-default')  ?>">
                <div class=" container ">

                    <nav>
                        <ul>
                            <?php foreach($footer AS $link): ?>
                                <li>
                                    <a href="<?= site_url('home/page/'.$link['safelink'])?>">
                                        <?= $link['title']?>
                                    </a>
                                </li>
                            <?php endforeach; ?> 
                        </ul>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Designed by
                        <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>

        <!--   Core JS Files   -->
        <script src="<?php echo base_url('resources/js/core/popper.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('resources/js/core/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="<?php echo base_url('resources/js/plugins/bootstrap-switch.js'); ?>"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?php echo base_url('resources/js/plugins/nouislider.min.js'); ?>" type="text/javascript"></script>
        <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
        <script src="<?php echo base_url('resources/js/plugins/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
        <script src="<?php echo base_url('resources/js/now-ui-kit.js?v=1.3.0'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('resources/pass/js/passcontest-v2.0.js'); ?>" type="text/javascript"></script>
        <!-- Form validations -->
        <script src="<?php echo base_url('resources/js/plugins/jquery.validate.js'); ?>"></script>
        <script src="<?php echo base_url('resources/pass/js/validation.rules.js'); ?>"></script>
    </body>

</html>
