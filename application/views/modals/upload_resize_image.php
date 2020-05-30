                    <div class="container-fluid">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Photo</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body container-fluid">

                            <div class="row">
                                <div class="col mx-auto mb-3">
                                    <div id="upload-status"></div>
                                </div>
                            </div> 
 
                            <div class="row">
                                <div class="col mx-auto">
                                    <div id="uploaded-image-preview"></div>
                                    <div id="croppie-image-preview" style="display: none;"></div>
                                    <div id="croppie-wide-preview" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="container-fluid" id="action-buttons">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="image-input" class="btn btn-block btn-info font-weight-bold image-selection-label" id="image-input-label">
                                            Change Profile Photo 
                                            <i class="fas fa-image"></i>
                                        </label>
                                        <input type="file" id="image-input" class="image-selection" style="display: none;">

                                        <label for="image-input-wide" class="btn btn-block btn-primary font-weight-bold image-selection-label" id="image-input-label">
                                            Change Cover Photo 
                                            <i class="fas fa-image"></i>
                                        </label>
                                        <input type="file" id="image-input-wide" class="image-selection" style="display: none;">

                                        <button class="btn btn-block btn-success btn-upload-image my-1" style="display: none;" onclick="upload_action(0<?= ($endpoint_id ? ', '.$endpoint_id : '').($endpoint ? ', \''.$endpoint.'\'' : '')?>)">
                                            <i class="fas fa-upload"></i>
                                            Upload Photo
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <script src="<?php echo base_url('resources/pass/js/upload-handler.js?time=121'); ?>" type="text/javascript"></script>