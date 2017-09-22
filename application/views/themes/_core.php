<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php echo $meta; ?>
		<base href="<?php echo $base_url; ?>">
		<link href="<?php echo $favicon; ?>" rel="icon" type="image/png">
        <title><?php echo $app_title; ?></title>
		<?php echo $css_files; ?>
        <script>var rules, addons, l = <?=json_encode($this->lang->load("messages", (isset($template_lang) ? $template_lang: 'spanish'), TRUE))?>;</script>
    </head>
    <body id="app" class="<?php echo $body_class; ?>">
        <?php echo $js_files; ?>
        <?php echo $body; ?>
    </body>
    <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</html>