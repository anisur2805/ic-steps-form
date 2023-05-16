<?php
    global $wpdb;
    $users_table = $wpdb->prefix . 'users';
    $table_name  = $wpdb->prefix . 'ic_members';
    $query       = "SELECT * FROM {$table_name} WHERE user_id = " . $id;
    $results     = $wpdb->get_results( $query, ARRAY_A );


    $query_pass = $wpdb->prepare("
        SELECT u.user_pass 
        FROM {$users_table} AS u
        INNER JOIN {$table_name} AS m ON u.ID = m.user_id
        WHERE m.user_id = %d
    ", $id);

    $formatted_date = date( 'Y-m-d', strtotime( $results[0]['dob'] ) );
?>

<div class="panel-body wizard-content">
    <p class="form-handler-message"></p>
    <form enctype="multipart/form-data" method="post" id="example-form" class="tab-wizard wizard-circle">
        <!-- Step 1 -->
        <h6></h6>
        <section class="mb-30">
            <div class="row">
                <!-- Full Name -->
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Name*</label>
                    <input name="name" type="text" class="form-control required" value="<?php echo $results[0]['name']; ?>" placeholder="Enter your full name">
                </div>
                <!-- User Name -->
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">User Name*</label>
                    <input name="user-name" value="<?php echo $results[0]['user_name']; ?>" type="text" class="form-control required" placeholder="Enter User Name">
                </div>

                <!-- Email Address -->
                    <div class="col-lg-6 mb-25">
                        <label class="form-label">Email Address*</label>
                        <input name="email" type="email" value="<?php echo $results[0]['email']; ?>" class="form-control required" placeholder="Enter your email address" />
                    </div>                  
                <!-- Phone Number -->
                <div class="col-lg-6 mb-25">
                    <label class="form-label">Phone Number*</label>
                    <input name="phone" type="number" minlength="10" maxlength="14" value="<?php echo $results[0]['phone']; ?>" class="form-control required"
                        placeholder="Enter your phone number">
                </div>
                <!-- Password -->
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Password*</label>
                    <input name="pass" id="password" value="<?php echo $query_pass; ?>" type="password" class="form-control required" placeholder="Password">
                </div>
                <!-- Confirm password -->
                <div class="col-lg-6 " style="display: none;">
                    <label for="confirm" class="form-label">Confirm Password*</label>
                    <input id="confirm" name="confirm" value="<?php //echo $results[0]['cpassword']; ?>" type="password" class="form-control required"
                        placeholder="Confirm password">
                </div>
            </div>
        </section>

        <!-- Step 2 -->
        <h6></h6>
        <section class="mb-30">
            <div class="row ">
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Present Address*</label>
                    <textarea name="present-addr" class="form-control required" placeholder="Present Address"><?php echo $results[0]['present_addr']; ?></textarea>
                </div>
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Permanent Address*</label>
                    <textarea name="permanent-addr" class="form-control required" placeholder="Permanent Address"><?php echo $results[0]['permanent_addr']; ?></textarea>
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">NID No*</label>
                    <input type="number" name="nid-no" minlength="10" maxlength="17" value="<?php echo $results[0]['nid_no']; ?>" class="form-control required" placeholder="NID No"></input>
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Facebook URL*</label>
                    <input type="text" name="fburl" class="form-control required" value="<?php echo $results[0]['fb_url']; ?>" placeholder="https:facebook.com"></input>
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Linked In URL</label>
                    <input type="text" name="linkedinurl" class="form-control" value="<?php echo $results[0]['linkedin_url']; ?>" placeholder="https://www.linkedin.com/"></input>
                </div>

                <?php $dib = '05-12-2023'; ?>
                <!-- Date of Birth -->
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Date of Birth*</label>
                    <input name="date" type="date" class="form-control required" value="<?php echo $formatted_date; ?>" placeholder="dd/mm/yy">
                </div>
                <!-- Company Name -->
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Business Name*</label>
                    <input name="business-name" type="text" value="<?php echo $results[0]['business_name']; ?>" class="form-control required"
                        placeholder="Business Name">
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Position in you Business*</label>
                    <input name="position-name" type="text" value="<?php echo $results[0]['position_name']; ?>" class="form-control required"
                        placeholder="Position in you Business">
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Business Email*</label>
                    <input name="business-email" type="text" value="<?php echo $results[0]['business_email']; ?>" class="form-control required" placeholder="business@email.com">
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Business Phone*</label>
                    <input name="business-phone" minlength="10" maxlength="14" type="number" value="<?php echo $results[0]['business_phone']; ?>" class="form-control required" placeholder="Business Phone">
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Business URL*</label>
                    <input name="url" type="text" value="<?php echo $results[0]['url']; ?>" class="form-control required"
                        placeholder="Business URL">
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Last Educational Qualification (optional)</label>
                    <input name="last-educational" value="<?php echo $results[0]['last_educational_qualification']; ?>" type="text" class="form-control"
                        placeholder="Last Educational Qualification (optional)">
                </div>
            </div>
        </section>

        <!-- Step 3 -->
        <h6></h6>
        <h5 class="ic-title cl-pm fw-500 mb-20 d-none">Personal Interest Information: (Please check the
            box according to your interest)
        </h5>

        <section class="mb-30">
            <div class="row ">
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Father's Name*</label>
                    <textarea name="father-name" class="form-control required" placeholder="Father's Name"><?php echo $results[0]['fathers_name']; ?></textarea>
                </div>

                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Mother's Name*</label>
                    <textarea name="mother-name" class="form-control required" placeholder="Mother's Name"><?php echo $results[0]['mothers_name']; ?></textarea>
                </div>

                <div class="col-lg-6 mb-25 is-married-col">
                    <label for="" class="form-label">Marital Status*</label>
                    <select name="isMarried" class="form-select required" aria-label="Default select example">
                        <option value="0" <?php echo ($results[0]['is_married'] == '0') ? 'selected' : ''; ?>>Choose Options</option>
                        <option value="1" <?php echo ($results[0]['is_married'] == '1') ? 'selected' : ''; ?>>Yes</option>
                        <option value="2" <?php echo ($results[0]['is_married'] == '2') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <div class="col-lg-6 mb-25 condition condition-1">
                    <label for="" class="form-label">Spouse Name</label>
                    <input name="spouse-name" value="<?php echo $results[0]['spouse_name']; ?>" class="form-control" placeholder="Spouse Name" />
                </div>

                <div class="col-lg-6 mb-25 condition condition-1">
                    <label for="" class="form-label">Marriage Anniversary</label>
                    <input type="date" name="anniversary" class="form-control" value="<?php echo $results[0]['anniversary']; ?>" placeholder="Marriage Anniversary" />
                </div>

                <div class="col-lg-6 mb-25 condition is-children-col condition-1">
                    <label for="" class="form-label">Have children?</label>
                    <select name="have-children" class="form-select">
                        <option value="0" <?php //echo ($child == '0') ? 'selected' : ''; ?>>Choose Options</option>
                        <option value="1" <?php //echo ($child == '1') ? 'selected' : ''; ?>>Yes</option>
                        <option value="2" <?php //echo ($child == '2') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">First Kid's Name</label>
                    <input name="first-kids-name" class="form-control" value="<?php echo $results[0]['first_child_name']; ?>" placeholder="First Kid's Name" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">First Kid's DOB</label>
                    <input type="date" name="first-kids-dob" value="<?php echo $results[0]['first_child_dob']; ?>" class="form-control" placeholder="" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">First Kid's Gender</label>
                    <div class="form-radio">
                        <label for="male">
                            <input type="radio" value="male" id="male" name="first-kids-gender" class="form-check-input" <?php //checked( $first_kids_gender, 'male' ); ?> /> Male
                        </label> &nbsp;&nbsp;
                        <label for="female-1">
                            <input type="radio" value="female" id="female-1" name="first-kids-gender" class="form-check-input" <?php //checked( $first_kids_gender, 'female' ); ?> /> Female
                        </label>

                    </div>
                </div>


                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Second Kid's Name</label>
                    <input name="second-kids-name" class="form-control" value="<?php echo $results[0]['second_child_name']; ?>" placeholder="second Kid's Name" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Second Kid's DOB</label>
                    <input type="date" name="second-kids-dob" class="form-control" value="<?php echo $results[0]['second_child_dob']; ?>" placeholder="" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Second Kid's Gender</label>
                    <div class="form-radio">
                        <label for="second-male-1">
                        <input type="radio" value="male" id="second-male-1" name="second-kids-gender" class="form-check-input" <?php //checked( $second_kids_gender, 'male' ); ?> /> Male
                        </label> &nbsp;&nbsp;
                        <label for="second-female-2">
                        <input type="radio" value="female" id="second-female-2" name="second-kids-gender" class="form-check-input" <?php //checked( $second_kids_gender, 'female' ); ?> /> Female
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Third Kid's Name</label>
                    <input name="third-kids-name" class="form-control" value="<?php echo $results[0]['third_child_name']; ?>" placeholder="third Kid's Name" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Third Kid's DOB</label>
                    <input type="date" name="third-kids-dob" value="<?php echo $results[0]['third_child_dob']; ?>" class="form-control" placeholder="" />
                </div>
                <div class="col-lg-6 mb-25 condition condition-2">
                    <label for="" class="form-label">Third Kid's Gender</label>
                    <div class="form-radio">
                        <label for="third-male-1">
                        <input type="radio" value="male" id="third-male-1" name="third-kids-gender" class="form-check-input"  <?php //checked( $third_kids_gender, 'male' ); ?>/> Male
                        </label> &nbsp;&nbsp;
                        <label for="third-female-2">
                        <input type="radio" value="female" id="third-female-2" name="third-kids-gender" class="form-check-input" <?php //checked( $third_kids_gender, 'female' ); ?> /> Female
                        </label>
                    </div>
                </div>

        </section>

        <!-- Step 4 -->
        <h6></h6>
        <section class="mb-30">
            <div class="ic-file-upload-wrapper row">
                <div class="col-lg-6 mb-25">
                    <label for="" class="form-label">Reference By</label>
                    <input name="refer_by" type="text" class="form-control" value="<?php echo $results[0]['refer_by']; ?>" placeholder="Enter referer name" />
                </div>
                <div class="col-lg-6 mb-25">
                    <label for="membership_type" class="form-label">Membership Type*</label>
                    <select name="membership_type" id="membership_type" class="form-select required" aria-label="Default select example">
                        <option value="0">Choose Type</option>
                        <option value="ec-members" <?php //echo ($membership_type == 'ec-members') ? 'selected' : ''; ?>>EC Members</option>
                        <option value="general-members" <?php //echo ($membership_type == 'general-members') ? 'selected' : ''; ?>>General Members</option>
                        <option value="founding-members" <?php //echo ($membership_type == 'founding-members') ? 'selected' : ''; ?>>Founding Members</option>
                        <option value="lifetime-members" <?php //echo ($membership_type == 'lifetime-members') ? 'selected' : ''; ?>>Lifetime Members</option>
                    </select>
                </div>


                <div class="ic-file-upload-item">
                    <h6 class="cl-pm fw-500 mb-15">Applicant's photo</h6>
                    <input type="file" name="photo" accept="image/png, image/gif, image/jpeg, image/jpg">
                </div>

                <div class="ic-file-upload-item">
                    <h6 class="cl-pm fw-500 mb-15">NID</h6>
                    <input type="file" name="nid" accept="image/png, image/gif, image/jpeg, image/jpg">
                </div>
                <div class="ic-file-upload-item">
                    <h6 class="cl-pm fw-500 mb-15">Trade License</h6>
                    <input type="file" name="trade" accept="image/png, image/gif, image/jpeg, image/jpg">
                </div>
                <div class="ic-file-upload-item">
                    <h6 class="cl-pm fw-500 mb-15">CV</h6>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx">
                </div>

                <?php wp_nonce_field( 'ic_edit_action', 'ic_edit_name' );?>
            </div>
        </section>
    </form>
</div>