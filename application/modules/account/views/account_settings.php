<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('settings_page_name'); ?></title>
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />
<link type="text/css" rel="stylesheet" href="resource/css/style.css" />
</head>
<body>
<?php echo $this->load->view('header'); ?>
<?php echo $this->load->view('account/account_menu', array('current' => 'account_settings')); ?>
<div id="content">
    <div class="container_12">
        <div class="grid_12">
            <h2><?php echo anchor(current_url(), lang('settings_page_name')); ?></h2>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <p><?php echo sprintf(lang('settings_privacy_statement'), anchor('page/privacy-policy', lang('settings_privacy_policy'))); ?></p><br />
        </div>
        <div class="grid_8">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <?php if (isset($settings_info)) : ?>
            <div class="grid_8 alpha omega">
                <div class="form_info"><?php echo $settings_info; ?></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_email'), 'settings_email'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_input(array(
                        'name' => 'settings_email',
                        'id' => 'settings_email',
                        'value' => set_value('settings_email') ? set_value('settings_email') : (isset($account->email) ? $account->email : ''),
                        'maxlength' => 160
                    )); ?>
                <?php echo form_error('settings_email'); ?>
                <?php if (isset($settings_email_error)) : ?>
                <span class="field_error"><?php echo $settings_email_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_fullname'), 'settings_fullname'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_input(array(
                        'name' => 'settings_fullname',
                        'id' => 'settings_fullname',
                        'value' => set_value('settings_fullname') ? set_value('settings_fullname') : (isset($account_details->fullname) ? $account_details->fullname : ''),
                        'maxlength' => 160
                    )); ?>
                <?php echo form_error('settings_fullname'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_firstname'), 'settings_firstname'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_input(array(
                        'name' => 'settings_firstname',
                        'id' => 'settings_firstname',
                        'value' => set_value('settings_firstname') ? set_value('settings_firstname') : (isset($account_details->firstname) ? $account_details->firstname : ''),
                        'maxlength' => 80
                    )); ?>
                <?php echo form_error('settings_firstname'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_lastname'), 'settings_lastname'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_input(array(
                        'name' => 'settings_lastname',
                        'id' => 'settings_lastname',
                        'value' => set_value('settings_lastname') ? set_value('settings_lastname') : (isset($account_details->lastname) ? $account_details->lastname : ''),
                        'maxlength' => 80
                    )); ?>
                <?php echo form_error('settings_lastname'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_dateofbirth')); ?>
            </div>
            <div class="grid_6 omega">    
                <?php $m = $this->input->post('settings_dob_month') ? $this->input->post('settings_dob_month') : (isset($account_details->dob_month) ? $account_details->dob_month : ''); ?>
                <select name="settings_dob_month">
                    <option value=""><?php echo lang('dateofbirth_month'); ?></option>
                    <option value="1"<?php if ($m == 1) echo ' selected="selected"'; ?>><?php echo lang('month_jan'); ?></option>
                    <option value="2"<?php if ($m == 2) echo ' selected="selected"'; ?>><?php echo lang('month_feb'); ?></option>
                    <option value="3"<?php if ($m == 3) echo ' selected="selected"'; ?>><?php echo lang('month_mar'); ?></option>
                    <option value="4"<?php if ($m == 4) echo ' selected="selected"'; ?>><?php echo lang('month_apr'); ?></option>
                    <option value="5"<?php if ($m == 5) echo ' selected="selected"'; ?>><?php echo lang('month_may'); ?></option>
                    <option value="6"<?php if ($m == 6) echo ' selected="selected"'; ?>><?php echo lang('month_jun'); ?></option>
                    <option value="7"<?php if ($m == 7) echo ' selected="selected"'; ?>><?php echo lang('month_jul'); ?></option>
                    <option value="8"<?php if ($m == 8) echo ' selected="selected"'; ?>><?php echo lang('month_aug'); ?></option>
                    <option value="9"<?php if ($m == 9) echo ' selected="selected"'; ?>><?php echo lang('month_sep'); ?></option>
                    <option value="10"<?php if ($m == 10) echo ' selected="selected"'; ?>><?php echo lang('month_oct'); ?></option>
                    <option value="11"<?php if ($m == 11) echo ' selected="selected"'; ?>><?php echo lang('month_nov'); ?></option>
                    <option value="12"<?php if ($m == 12) echo ' selected="selected"'; ?>><?php echo lang('month_dec'); ?></option>
                </select>
                <?php $d = $this->input->post('settings_dob_day') ? $this->input->post('settings_dob_day') : (isset($account_details->dob_day) ? $account_details->dob_day : ''); ?>
                <select name="settings_dob_day">
                    <option value="" selected="selected"><?php echo lang('dateofbirth_day'); ?></option>
                    <?php for ($i=1; $i<32; $i++) : ?>
                    <option value="<?php echo $i; ?>"<?php if ($d == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <?php $y = $this->input->post('settings_dob_year') ? $this->input->post('settings_dob_year') : (isset($account_details->dob_year) ? $account_details->dob_year : ''); ?>
                <select name="settings_dob_year">
                    <option value=""><?php echo lang('dateofbirth_year'); ?></option>
                    <?php $year = mdate('%Y', now()); for ($i=$year; $i>1900; $i--) : ?>
                    <option value="<?php echo $i; ?>"<?php if ($y == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <?php if (isset($settings_dob_error)) : ?>
                <span class="field_error"><?php echo $settings_dob_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_gender')); ?>
            </div>
            <div class="grid_6 omega">
                <?php $s = ($this->input->post('settings_gender') ? $this->input->post('settings_gender') : (isset($account_details->gender) ? $account_details->gender : '')); ?>
                <select name="settings_gender">
                    <option value=""><?php echo lang('settings_select'); ?></option>
                    <option value="m"<?php if ($s == 'm') echo ' selected="selected"'; ?>><?php echo lang('gender_male'); ?></option>
                    <option value="f"<?php if ($s == 'f') echo ' selected="selected"'; ?>><?php echo lang('gender_female'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_postalcode'), 'settings_postalcode'); ?>
            </div>
            <div class="grid_6 omega">
                <?php echo form_input(array(
                        'name' => 'settings_postalcode',
                        'id' => 'settings_postalcode',
                        'value' => set_value('settings_postalcode') ? set_value('settings_postalcode') : (isset($account_details->postalcode) ? $account_details->postalcode : ''),
                        'maxlength' => 40
                    )); ?>
                <?php echo form_error('settings_postalcode'); ?>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_country'), 'settings_country'); ?>
            </div>
            <div class="grid_6 omega">
                <?php $account_country = ($this->input->post('settings_country') ? $this->input->post('settings_country') : (isset($account_details->country) ? $account_details->country : '')); ?>
                <select id="settings_country" name="settings_country" class="select">
                    <option value=""><?php echo lang('settings_select'); ?></option>
                    <?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country->alpha2; ?>"<?php if ($account_country == $country->alpha2) echo ' selected="selected"'; ?>>
                        <?php echo $country->country; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_language'), 'settings_language'); ?>
            </div>
            <div class="grid_6 omega">
                <?php $account_language = ($this->input->post('settings_language') ? $this->input->post('settings_language') : (isset($account_details->language) ? $account_details->language : '')); ?>
                <select id="settings_language" name="settings_language" class="select">
                    <option value=""><?php echo lang('settings_select'); ?></option>
                    <?php foreach ($languages as $language) : ?>
                    <option value="<?php echo $language->one; ?>"<?php if ($account_language == $language->one) echo ' selected="selected"'; ?>>
                        <?php echo $language->language; ?><?php if ($language->native && $language->native != $language->language) echo ' ('.$language->native.')'; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="clear"></div>
            <div class="grid_2 alpha">
                <?php echo form_label(lang('settings_timezone'), 'settings_timezone'); ?>
            </div>
            <div class="grid_6 omega">
                <?php $account_timezone = ($this->input->post('settings_timezone') ? $this->input->post('settings_timezone') : (isset($account_details->timezone) ? $account_details->timezone : '')); ?>
                <select id="settings_timezone" name="settings_timezone" class="select">
                    <option value=""><?php echo lang('settings_select'); ?></option>
                    <?php foreach ($zoneinfos as $zoneinfo) : ?>
                    <option value="<?php echo $zoneinfo->zoneinfo; ?>"<?php if ($account_timezone == $zoneinfo->zoneinfo) echo ' selected="selected"'; ?>>
                        <?php echo $zoneinfo->zoneinfo; ?><?php if ($zoneinfo->offset) echo ' ('.$zoneinfo->offset.')'; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="clear"></div>
            <div class="prefix_2 grid_6 alpha omega">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'button',
                        'content' => lang('settings_save')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>
</body>
</html>