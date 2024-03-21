<?php
  namespace Steampixel;
  // Get the component props
  $lang = $this->prop('lang', [
    'type' => 'string',
    'required' => true
  ]);

  $title = $this->prop('title', [
    'type' => 'string',
    'required' => true
  ]);
  $pages = $this->prop('pages', [
    'type' => 'string',
    'required' => true
  ]);
?>
<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/style')->assign(['pages'=>$pages])->render() ?>
  </head>
  <?php if( $pages == "guest") { echo '<body class="auth-body-bg">'; } else { echo '<body>'; } ?>
    <div>
      <div class="container-fluid p-0">
        <?=Component::create('partials/content') ?>
      </div>
    </div>
    <?=Component::create('partials/javascript')->assign(['pages'=>$pages])->render() ?>
  </body>
</html>
