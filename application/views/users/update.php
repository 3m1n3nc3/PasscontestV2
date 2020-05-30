            <div class="registration-page section text-center">
                <div class="container"> 
 
                    <div class="container mt-3">
                        <div class="photo-container">
                            <img src="<?php echo $this->creative_lib->fetch_image($do == 'apply' ? $contest['avatar'] : $avatar); ?>" alt="<?php echo $do == 'apply' ? $contest['title'] : $name; ?> Avatar">
                        </div>
                        <h3 class="title"><?php echo $do == 'apply' ? $contest['title'] : $name; ?></h3>
                        <p class="category"><?php echo $do == 'apply' ? $contest['slug'] : '' ?></p> 
                        <h4 class="description title"><?php echo $do == 'apply' ? 'Application Form' : 'Update Profile Data' ?></h4>
                    </div> 
                    <hr>

                    <div class="row">
                        <div class="col-md-12 text-left ml-auto mr-auto">
                            
                            <?php $switch = ($this->input->post() ? 1 : null) ?>

                            <?php echo $this->session->flashdata('msg') ?>

                            <?php if ($do == 'apply' && !$contest['entry']): ?>
                                <?= alert_notice(lang('registration_closed'), 'info')?>
                            <?php endif; ?>

                        </div>

                        <div class="col-md-12 text-left ml-auto mr-auto">

                            <?php echo form_open(isset($update_action) ? $update_action : 'user/account/update', ['id' => 'paform', 'class' => 'needs-validation', 'novalidate' => null]); ?>

                                <?php if ($do == 'apply' && $contest['categories']): ?>
                                <label class="font-weight-bold" for="personal_block">Contest Info</label>
                                <div class="border row p-3 mb-3" id="personal_block"> 
                                    <div class="form-group col-md-12">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" placeholder="" name="category">
                                            <?php foreach (explode(',', $contest['categories']) as $category): ?>
                                                <?php echo '<option value="'.$category.'">'.ucwords($category).'</option>' ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('category'); ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <label class="font-weight-bold" for="personal_block">Personal Info</label>
                                <div class="border row p-3 mb-3" id="personal_block"> 
                                    <div class="form-group col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="<?php echo $switch ? set_value('first_name') : $first_name; ?>"> 
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        <?php echo form_error('first_name'); ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo $switch ? set_value('last_name') : $last_name; ?>">
                                        <?php echo form_error('last_name'); ?>
                                    </div> 

                                    <div class="form-group col-md-4">
                                        <label for="other_name">Other Names</label>
                                        <input type="text" class="form-control" id="other_name" placeholder="Other Names" name="other_name" value="<?php echo $switch ? set_value('other_name') : $other_name; ?>">
                                        <?php echo form_error('other_name'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="stage_name">Stage Name</label>
                                        <input type="text" class="form-control" id="stage_name" placeholder="Stage Name" name="stage_name" value="<?php echo $switch ? set_value('stage_name') : $stage_name; ?>">
                                        <?php echo form_error('stage_name'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $switch ? set_value('dob') : $dob; ?>">
                                        <?php echo form_error('dob'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" placeholder="" name="gender">
                                            <option value="male" <?php echo set_select('gender', 'male', int_bool($gender == 'male' ? 1 : 0)); ?>>Male</option>
                                            <option value="female" <?php echo set_select('gender', 'female', int_bool($gender == 'female' ? 1 : 0)); ?>>Female</option>
                                            <option value="other" <?php echo set_select('gender', 'other', int_bool($gender == 'other' ? 1 : 0)); ?>>Other</option>
                                        </select>
                                        <?php echo form_error('gender'); ?>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="religion">Religion</label>
                                        <input type="text" class="form-control" id="religion" placeholder="Religion" name="religion" value="<?php echo $switch ? set_value('religion') : $religion; ?>">
                                        <?php echo form_error('religion'); ?>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="bio">Introduce Yourself</label>
                                        <textarea class="form-control" id="bio" placeholder="Introduce Yourself" name="bio"><?php echo $switch ? set_value('bio') : $bio; ?></textarea>
                                        <?php echo form_error('bio'); ?>
                                    </div>
                                </div>
                                
                                <label class="font-weight-bold" for="contact_block">Contact Info</label>
                                <div class="border row p-3 mb-3" id="contact_block"> 
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" value="<?php echo $switch ? set_value('phone') : $phone; ?>">
                                        <?php echo form_error('phone'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email Address</label>
                                        <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" value="<?php echo $switch ? set_value('email') : $email; ?>">
                                        <?php echo form_error('email'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="country">Nationality</label>
                                        <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo $switch ? set_value('country') :  $country; ?>">
                                        <?php echo form_error('country'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="state">State of Origin</label>
                                        <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $switch ? set_value('state') : $state; ?>">
                                        <?php echo form_error('state'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="city">Hometown</label>
                                        <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $switch ? set_value('city') : $city; ?>">
                                        <?php echo form_error('city'); ?>
                                    </div>

                                    <div class="form-group col-md-6"></div>

                                    <div class="form-group col-md-6">
                                        <label for="curr_address">Current Address</label>
                                        <textarea class="form-control" id="curr_address" placeholder="Current Address" name="curr_address"><?php echo $switch ? set_value('curr_address') : $curr_address; ?></textarea>
                                        <?php echo form_error('curr_address'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="perm_address">Permanent Address</label>
                                        <textarea class="form-control" id="perm_address" placeholder="Permanent Address" name="perm_address"><?php echo $switch ? set_value('perm_address') : $perm_address; ?></textarea>
                                        <?php echo form_error('perm_address'); ?>
                                    </div>
                                </div>
                                
                                <label class="font-weight-bold" for="education_block">Educational Info</label>
                                <div class="border row p-3 mb-3" id="education_block"> 
                                    <div class="form-group col-md-6">
                                        <label for="qualification">Educational Qualification</label>
                                        <input type="text" class="form-control" id="qualification" placeholder="Qualification" name="qualification" value="<?php echo $switch ? set_value('qualification') : $qualification; ?>">
                                        <?php echo form_error('qualification'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="school">School or College</label>
                                        <input type="text" class="form-control" id="school" placeholder="School" name="school" value="<?php echo $switch ? set_value('school') : $school; ?>">
                                        <?php echo form_error('school'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="course">Course/Specialization</label>
                                        <input type="text" class="form-control" id="course" placeholder="Course" name="course" value="<?php echo $switch ? set_value('course') : $course; ?>">
                                        <?php echo form_error('course'); ?>
                                    </div> 
                                </div>
                                
                                <label class="font-weight-bold" for="background_block">Background Info</label>
                                <div class="border row p-3 mb-3" id="background_block"> 
                                    <div class="form-group col-md-6">
                                        <label for="contested">Have you contested in a pageant before?</label> 
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="contested" name="contested" value="1" <?php echo set_radio('contested', '1', TRUE); ?>>Yes
                                                <span class="form-check-sign"></span>
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="contested1" name="contested" value="0" <?php echo set_radio('contested', '0'); ?>>No
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div> 
                                        <?php echo form_error('contested'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="prev_contest">If you have contested in a pageant before, state the brand name and crown</label> 
                                        <input type="text" class="form-control" id="prev_contest" placeholder="" name="prev_contest" value="<?php echo $switch ? set_value('prev_contest') : $prev_contest; ?>"> 
                                        <?php echo form_error('prev_contest'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="ref_name">Referee</label>
                                        <input type="text" class="form-control" id="ref_name" placeholder="Referee" name="ref_name" value="<?php echo $switch ? set_value('ref_name') : $ref_name; ?>">
                                        <?php echo form_error('ref_name'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="ref_phone">Referee Phone Number</label>
                                        <input type="text" class="form-control" id="ref_phone" placeholder="Referee Phone" name="ref_phone" value="<?php echo $switch ? set_value('ref_phone') : $ref_phone; ?>">
                                        <?php echo form_error('ref_phone'); ?>
                                    </div>
                                </div> 

                                <?php if ($do == 'apply' && $contest['use_payment']): ?>
                                    <?php $key_error = form_error('key'); $border = $key_error ? 'border-danger' : 'border-info'; ?>
                                    <label class="font-weight-bold text text-primary" for="payment_block">Payment Info</label>
                                    <div class="border <?= $border; ?> bg-light row p-3 mb-3" id="payment_block"> 
                                        <div class="form-group col-md-12">
                                            <label class="text-primary" for="key">Payment Serial Number</label>
                                            <input type="text" class="form-control bg-white <?= $border; ?> text-primary" id="key" placeholder="Serial Number" name="key" value="<?= set_value('key') ?>">
                                            <?= $key_error; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($do == 'apply' && $contest['entry']):?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1" name="accept" required>
                                        I have read and accepted the Terms and Conditions for entry into this pageant
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    | <a href="#">Read the Terms and conditions</a> 
                                    <div class="mt-0 text-danger" id="accept-terms-error"> </div>
                                    <?php echo form_error('accept'); ?>
                                </div>

                                <?php endif; ?>
                                
                                <?php if ( $do !== 'apply' || ($do === 'apply' && $contest['entry']) ):?>
                                <div class="send-button">
                                    <button type="submit" name="submit" class="btn btn-primary btn-round btn-lg"><?php echo $do == 'apply' ? 'Submit' : 'Update' ?></button>
                                </div>
                                <?php endif; ?>

                            <?php echo form_close(); ?>     
                        </div>
                    </div>
                </div>
            </div>  
