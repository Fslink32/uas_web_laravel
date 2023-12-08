<?php if(!empty(session('message'))){?>
<input type="hidden" name="display_alert_message" id="display_alert_message" value="<?php echo session('message'); ?>">
<?php }?>

<?php if(!empty(session('message_error'))){?>
<input type="hidden" name="display_alert_message_error" id="display_alert_message_error" value="<?php echo session('message_error'); ?>">
<?php }?>

<?php if(!empty($_GET['status'])){
          if($_GET['status']=='true'){?>
<input type="hidden" name="display_alert_message_get_true" id="display_alert_message_get_true"
    value="<?php echo $_GET['message']; ?>">
<?php }else{?>
<input type="hidden" name="display_alert_message_get_false" id="display_alert_message_get_false"
    value="<?php echo $_GET['message']; ?>">
<?php } ?>
<?php }?>
<?php session()->forget('message'); ?>
<?php session()->forget('message_error'); ?>
