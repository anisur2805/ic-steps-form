<?php
  
    $name = fieldCheck( 'name' );
    $user_name = fieldCheck( 'user-name' );
    $email = fieldCheck( 'email' );
    $phone = fieldCheck( 'phone' );
    $password = fieldCheck( 'pass' );
    $cpassword = fieldCheck( 'confirm' );
    $presentAddr = fieldCheck( 'present-addr' );
    $permanentAddr = fieldCheck( 'permanent-addr' );
    $nid = fieldCheck( 'nid-no' );
    $fburl = fieldCheck( 'fburl' );
    $linkedinurl = fieldCheck( 'linkedinurl' );
    $date = fieldCheck( 'date' );
    $businessName = fieldCheck( 'business-name' );
    $positionName = fieldCheck( 'position-name' );
    $businessEmail = fieldCheck( 'business-email' );
    $businessPhone = fieldCheck( 'business-phone' );
    $url = fieldCheck( 'url' );
    $lastEducational = fieldCheck( 'last-educational' );

    $father = fieldCheck( 'father-name' );
    $mother = fieldCheck( 'mother-name' );
    $married = fieldCheck( 'isMarried' );
    $spouse = fieldCheck( 'spouse-name' );
    $anniversary = fieldCheck( 'anniversary' );
    $child = fieldCheck( 'have-children' );

    $first_kids_gender = fieldCheck( 'first-kids-gender' );
    $first_kids_name = fieldCheck( 'first-kids-name' );
    $first_kids_dob = fieldCheck( 'first-kids-dob' );
    $refer_by = fieldCheck( 'refer_by' );


    $second_kids_gender = fieldCheck( 'second-kids-gender' );
    $second_kids_name = fieldCheck( 'second-kids-name' );
    $second_kids_dob = fieldCheck( 'second-kids-dob' );

    $third_kids_gender = fieldCheck( 'third-kids-gender' ); 
    $third_kids_name = fieldCheck( 'third-kids-name' );
    $third_kids_dob = fieldCheck( 'third-kids-dob' );
    $membership_type = fieldCheck( 'membership_type' );

        echo '<pre>';
          print_r( $name );
          print_r( $membership_type );
    echo '</pre>';

?>
<section class="ic-membership-form ic-section-space">
    <div class="container ">
        <div class="panel ic-form">
            <?php
                if ( isset( $_GET['registration'] ) && $_GET['registration'] == 'failed' ) {
                    echo '<div class="show-reg-msg error-reg-msg"><p>Username or email already exists</p></div>';
                } else if( isset( $_GET['registration'] ) && $_GET['registration'] == 'success' ) {
                    echo '<div class="show-reg-msg success-reg-msg"><p>User register successfully</p></div>';
                }
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
                                <input name="name" type="text" class="form-control required" value="<?php echo $name; ?>" placeholder="Enter your full name">
                            </div>
                            <!-- User Name -->
                            <?php  if ( isset( $_GET['registration'] ) && $_GET['registration'] == 'failed' ) { ?>
                                <div class="col-lg-6 mb-25 error">
                                    <label for="" class="form-label">User Name*</label>
                                    <input name="user-name" value="<?php echo $user_name; ?>" type="text" class="form-control required" placeholder="Enter User Name">
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-6 mb-25">
                                    <label for="" class="form-label">User Name*</label>
                                    <input name="user-name" value="<?php echo $user_name; ?>" type="text" class="form-control required" placeholder="Enter User Name">
                                </div>
                            <?php } ?>

                            <!-- Email Address -->
                            <?php  if ( isset( $_GET['registration'] ) && $_GET['registration'] == 'failed' ) { ?>
                                <div class="col-lg-6 mb-25 error">
                                    <label class="form-label">Email Address*</label>
                                    <input name="email" type="email" value="<?php echo $email; ?>" class="form-control required error" placeholder="Enter your email address" />
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-6 mb-25">
                                    <label class="form-label">Email Address*</label>
                                    <input name="email" type="email" value="<?php echo $email; ?>" class="form-control required error" placeholder="Enter your email address" />
                                </div>
                            <?php } ?>
                            <!-- Phone Number -->
                            <div class="col-lg-6 mb-25">
                                <label class="form-label">Phone Number*</label>
                                <input name="phone" type="tel" minlength="10" maxlength="14" value="<?php echo $phone; ?>" class="form-control required"
                                    placeholder="Enter your phone number">
                            </div>
                            <!-- Password -->
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Password*</label>
                                <input name="pass" id="password" value="<?php echo $password; ?>" type="password" class="form-control required" placeholder="Password">
                            </div>
                            <!-- Confirm password -->
                            <div class="col-lg-6 ">
                                <label for="confirm" class="form-label">Confirm Password*</label>
                                <input id="confirm" name="confirm" value="<?php echo $cpassword; ?>" type="password" class="form-control required"
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
                                <textarea name="present-addr" class="form-control required" placeholder="Present Address"><?php echo $presentAddr; ?></textarea>
                            </div>
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Permanent Address*</label>
                                <textarea name="permanent-addr" class="form-control required" placeholder="Permanent Address"><?php echo $permanentAddr; ?></textarea>
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">NID No*</label>
                                <input type="tel" name="nid-no" minlength="10" maxlength="17" value="<?php echo $nid; ?>" class="form-control required" placeholder="NID No"></input>
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Facebook URL*</label>
                                <input type="text" name="fburl" class="form-control required" value="<?php echo $fburl; ?>" placeholder="https:facebook.com"></input>
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Linked In URL</label>
                                <input type="text" name="linkedinurl" class="form-control" value="<?php echo $linkedinurl; ?>" placeholder="https://www.linkedin.com/"></input>
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Date of Birth*</label>
                                <input name="date" type="date" class="ic_dob form-control required" value="<?php echo $date; ?>" placeholder="dd/mm/yy">
                            </div>
                            <!-- Company Name -->
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Business Name*</label>
                                <input name="business-name" type="text" value="<?php echo $businessName; ?>" class="form-control required"
                                    placeholder="Business Name">
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Position in you Business*</label>
                                <input name="position-name" type="text" value="<?php echo $positionName; ?>" class="form-control required"
                                    placeholder="Position in you Business">
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Business Email*</label>
                                <input name="business-email" type="text" value="<?php echo $businessEmail; ?>" class="form-control required" placeholder="business@email.com">
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Business Phone*</label>
                                <input name="business-phone" minlength="10" maxlength="14" type="tel" value="<?php echo $businessPhone; ?>" class="form-control required" placeholder="Business Phone">
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Business URL*</label>
                                <input name="url" type="text" value="<?php echo $url; ?>" class="form-control required"
                                    placeholder="Business URL">
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Last Educational Qualification (optional)</label>
                                <input name="last-educational" value="<?php echo $lastEducational; ?>" type="text" class="form-control"
                                    placeholder="Last Educational Qualification (optional)">
                            </div>


                            <!-- <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Work Address</label>
                                <input name="work-address" type="text" class="form-control"
                                    placeholder="Work Address">
                            </div>
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Home Address</label>
                                <input name="home-address" type="text" class="form-control"
                                    placeholder="Home Address">
                            </div> -->

                            <!-- <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">URL</label>
                                <input name="url" type="text" class="form-control" placeholder="Type your subject">
                            </div> -->

                            <!-- <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Business Type</label>
                                <select name="business-type" class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Select Business Type</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> -->

                            <!-- <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Education
                                    Qualification</label>
                                <select name="education" class="form-select" aria-label="Default select example">
                                    <option selected>Select Education Qualification</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> -->

                            <!-- FAX -->
                            <!-- <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">FAX</label>
                                <input name="fax" type="text" class="form-control" placeholder="Fax no">
                            </div> -->

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
                                <textarea name="father-name" class="form-control required" placeholder="Father's Name"><?php echo $father; ?></textarea>
                            </div>

                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Mother's Name*</label>
                                <textarea name="mother-name" class="form-control required" placeholder="Mother's Name"><?php echo $mother; ?></textarea>
                            </div>

                            <div class="col-lg-6 mb-25 is-married-col">
                                <label for="" class="form-label">Marital Status*</label>
                                <span id="isMarried-error" class="error">This field is required.</span>
                                <select name="isMarried" id="isMarried" class="form-select required" required="required">
                                    <option value="0">Choose Options</option>
                                    <option value="1" <?php echo ($married == '1') ? 'selected' : ''; ?>>Yes</option>
                                    <option value="2" <?php echo ($married == '2') ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-25 condition condition-1">
                                <label for="" class="form-label">Marriage Date</label>
                                <input type="date" name="anniversary" class="form-control anniversary" value="<?php echo $anniversary; ?>" placeholder="Marriage Anniversary" />
                            </div>

                            <div class="col-lg-6 mb-25 condition condition-1">
                                <label for="" class="form-label">Spouse Name</label>
                                <input name="spouse-name" value="<?php echo $spouse; ?>" class="form-control" placeholder="Spouse Name" />
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-5 mb-25 condition is-children-col condition-1">
                                <label for="" class="form-label">Have children?</label>
                                <select name="have-children" class="form-select">
                                    <option value="0" <?php echo ($child == '0') ? 'selected' : ''; ?>>Choose Options</option>
                                    <option value="1" <?php echo ($child == '1') ? 'selected' : ''; ?>>Yes</option>
                                    <option value="2" <?php echo ($child == '2') ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>

                            <div class="col-lg-1 mb-25 add">
                            </div>

                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">First Kid's Name</label>
                                <input name="first-kids-name" class="form-control" value="<?php echo $first_kids_name; ?>" placeholder="First Kid's Name" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">First Kid's DOB</label>
                                <input type="date" name="first-kids-dob" value="<?php echo $first_kids_dob; ?>" class="first-kids-dob form-control" placeholder="" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">First Kid's Gender</label>
                                <div class="form-radio">
                                    <label for="male">
                                        <input type="radio" value="male" id="male" name="first-kids-gender" class="form-check-input" <?php checked( $first_kids_gender, 'male' ); ?> /> Male
                                    </label> &nbsp;&nbsp;
                                    <label for="female-1">
                                        <input type="radio" value="female" id="female-1" name="first-kids-gender" class="form-check-input" <?php checked( $first_kids_gender, 'female' ); ?> /> Female
                                    </label>

                                </div>
                            </div>


                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Second Kid's Name</label>
                                <input name="second-kids-name" class="form-control" value="<?php echo $second_kids_name; ?>" placeholder="second Kid's Name" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Second Kid's DOB</label>
                                <input type="date" name="second-kids-dob" class="form-control second-kids-dob" value="<?php echo $second_kids_dob; ?>" placeholder="" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Second Kid's Gender</label>
                                <div class="form-radio">
                                    <label for="second-male-1">
                                    <input type="radio" value="male" id="second-male-1" name="second-kids-gender" class="form-check-input" <?php checked( $second_kids_gender, 'male' ); ?> /> Male
                                    </label> &nbsp;&nbsp;
                                    <label for="second-female-2">
                                    <input type="radio" value="female" id="second-female-2" name="second-kids-gender" class="form-check-input" <?php checked( $second_kids_gender, 'female' ); ?> /> Female
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Third Kid's Name</label>
                                <input name="third-kids-name" class="form-control" value="<?php echo $third_kids_name; ?>" placeholder="third Kid's Name" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Third Kid's DOB</label>
                                <input type="date" name="third-kids-dob" value="<?php echo $third_kids_dob; ?>" class="third-kids-dob form-control" placeholder="" />
                            </div>
                            <div class="col-lg-6 mb-25 condition condition-2">
                                <label for="" class="form-label">Third Kid's Gender</label>
                                <div class="form-radio">
                                    <label for="third-male-1">
                                    <input type="radio" value="male" id="third-male-1" name="third-kids-gender" class="form-check-input"  <?php checked( $third_kids_gender, 'male' ); ?>/> Male
                                    </label> &nbsp;&nbsp;
                                    <label for="third-female-2">
                                    <input type="radio" value="female" id="third-female-2" name="third-kids-gender" class="form-check-input" <?php checked( $third_kids_gender, 'female' ); ?> /> Female
                                    </label>
                                </div>
                            </div>


                        <!-- <div class="ic-form-checkbox-content mb-25">
                            <h6 class="cl-pm fw-500 mb-15">Individual Area of Opportunity</h6>
                            <div class="row">
                                <ul class="ic-flex-content">
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Personal
                                                Development</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Meetings</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                            <label class="form-check-label" for="exampleCheck3">Trainer</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                            <label class="form-check-label" for="exampleCheck4">Training</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                            <label class="form-check-label" for="exampleCheck5">Membership Growth &
                                                Extension</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="ic-form-checkbox-content mb-25">
                            <h6 class="cl-pm fw-500 mb-15">Community Area of Opportunity</h6>
                            <div class="row">
                                <ul class="ic-column-content">
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                            <label class="form-check-label" for="exampleCheck6">
                                                Founders Major Emphasis Theme
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck7">
                                            <label class="form-check-label" for="exampleCheck7">Community
                                                Development</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck8">
                                            <label class="form-check-label" for="exampleCheck8">Economic
                                                Affairs</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck9">
                                            <label class="form-check-label" for="exampleCheck9">Children &
                                                Youth</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck10">
                                            <label class="form-check-label" for="exampleCheck10">Governmental &
                                                Civil Affairs</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="ic-form-checkbox-content mb-25">
                            <h6 class="cl-pm fw-500 mb-15">International Area of Opportunity</h6>
                            <div class="row">
                                <ul class="ic-flex-content">
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck11">
                                            <label class="form-check-label" for="exampleCheck11">International
                                                Affairs & Relations</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck12">
                                            <label class="form-check-label" for="exampleCheck12">Founders
                                                Meeting</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck13">
                                            <label class="form-check-label" for="exampleCheck13">Chapter
                                                Twinning</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck14">
                                            <label class="form-check-label" for="exampleCheck14">Awards</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="ic-form-checkbox-content ">
                            <h6 class="cl-pm fw-500 mb-15">Business Area of Opportunity</h6>
                            <div class="row">
                                <ul class="ic-column-content">
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck15">
                                            <label class="form-check-label" for="exampleCheck15">
                                                Finance
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck16">
                                            <label class="form-check-label" for="exampleCheck16">
                                                Strategic Planning
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck17">
                                            <label class="form-check-label" for="exampleCheck17">
                                                Business Affairs
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck18">
                                            <label class="form-check-label" for="exampleCheck18">
                                                Records
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck19">
                                            <label class="form-check-label" for="exampleCheck19">
                                                Marketing & Public relations
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck20">
                                            <label class="form-check-label" for="exampleCheck20">
                                                Chamber of Commerce Partnership
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> -->

                    </section>

                    <!-- Step 4 -->
                    <h6></h6>
                    <section class="mb-30">
                        <div class="ic-file-upload-wrapper row">
                            <div class="col-lg-6 mb-25">
                                <label for="" class="form-label">Reference By</label>
                                <input name="refer_by" type="text" class="form-control" value="" placeholder="Enter referer name" />
                            </div>
                            <div class="col-lg-6 mb-25">
                                <label for="membership_type" class="form-label">Membership Type*</label>
                                <select name="membership_type" id="membership_type" class="form-select required" aria-label="Default select example">
                                    <option value="0">Choose Type</option>
                                    <option value="ec-members" <?php echo ($membership_type == 'ec-members') ? 'selected' : ''; ?>>EC Members</option>
                                    <option value="general-members" <?php echo ($membership_type == 'general-members') ? 'selected' : ''; ?>>General Members</option>
                                    <option value="founding-members" <?php echo ($membership_type == 'founding-members') ? 'selected' : ''; ?>>Founding Members</option>
                                    <option value="lifetime-members" <?php echo ($membership_type == 'lifetime-members') ? 'selected' : ''; ?>>Lifetime Members</option>
                                </select>
                            </div>


                            <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">Applicant's photo</h6>
                                <input type="file" name="photo" accept="image/png, image/gif, image/jpeg, image/jpg" required class="required">
                            </div>

                            <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">NID</h6>
                                <input type="file" name="nid" accept="image/png, image/gif, image/jpeg, image/jpg" required class="required">
                            </div>
                            <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">Trade License</h6>
                                <input type="file" name="trade" accept="image/png, image/gif, image/jpeg, image/jpg" required class="required">
                            </div>
                            <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">CV</h6>
                                <input type="file" name="cv" accept=".pdf,.doc,.docx">
                            </div>

                            <!-- <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">Passport Size Photo</h6>
                                <input type="file" name="passport-size-photo">
                            </div>
                            <div class="ic-file-upload-item">
                                <h6 class="cl-pm fw-500 mb-15">Visiting card</h6>
                                <input type="file" name="visiting-card">
                            </div> -->

                            <?php wp_nonce_field( 'ic_register_action' );?>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>

</section>