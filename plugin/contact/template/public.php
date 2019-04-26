<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/header.php');
echo $runPlugin->getConfigVal('content1');
?>

<?php show::msg($msg); ?>
<form method="post" action="<?php echo $core->makeUrl('contact', array('action' => 'send')); ?>">

  <div class="form-group">
    <input required="required" name="name" type="text" class="form-control" placeholder="Nom"
      value="<?php echo $name; ?>">
  </div>

  <div class="form-group">
    <input required="required" name="firstname" type="text" class="form-control" placeholder="Prénom"
      value="<?php echo $firstname; ?>">
  </div>

  <div class="form-group">
    <input required="email" name="email" type="email" class="form-control" placeholder="Mail"
      value="<?php echo $email; ?>">
  </div>
  <div class="form-group">
    <textarea class="form-control" required="required" name="message"
      placeholder="Message"><?php echo $message; ?></textarea>
  </div>

  <div class="form-check">
    <input type="checkbox" required="required" class="form-check-input">
    <label class="form-check-label"><?php echo $runPlugin->getConfigVal('acceptation'); ?></label>
  </div>
  <div class="form-group">
    <button type="submit" value="Envoyer" class="btn btn-primary">Envoyer</button>
  </div>
</form>

<?php
echo $runPlugin->getConfigVal('content2');
include_once(ROOT.'theme/'.$core->getConfigVal('theme').'/footer.php');
?>