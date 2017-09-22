<div class="row">
    <div class="{column}">
    <div class="ibox float-e-margins" id="ibox-general">
        <div class="ibox-title" style="min-height: 55px;">
            <h5 id="ibox-section-title">
                <?php if (!isset($title) || empty($title)): ?>
                    <script>
                        var section_title = $('#section-title').text();
                        $('#ibox-section-title').text(section_title);
                    </script>
                <?php else: ?>
                    {title}
                <?php endif ?>

                <?php if (isset($label)): ?>
                    <small>{label}</small>
                <?php endif ?>
            </h5>
            <div class="ibox-tools">
                <?php if ($collapse):?>
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <?php endif;?>

                <?php if (isset($actions) && count($actions) > 0): ?>
                <div class="pull-right">
                    {actions}
                        <button class="btn btn-w-m btn-{type} action" data-action="{name}" data-target="{url}" type="button" rel="{name}"><i class="fa fa-{icon}" aria-hidden="true"></i>&nbsp; {caption}</button>
                    {/actions}
                </div>
                <?php endif;?>

                <?php if (isset($tools) && count($tools) > 0): ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-filter fa-2x text-primary"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    {tools}
                        <li>
                            <a href="{url}">{option}</a>
                        </li>
                    {/tools}
                    </ul>
                <?php endif ?>
                <?php if (isset($fullscreen)): ?>
                <a class="fullscreen-link">
                    <i class="fa fa-expand"></i>
                </a>
                <?php endif ?>
                <?php if (isset($close)): ?>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
                <?php endif ?>
            </div>
        </div>
        <div class="ibox-content sk-loading">
                 <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1">
                    </div>
                    <div class="sk-rect2">
                    </div>
                    <div class="sk-rect3">
                    </div>
                    <div class="sk-rect4">
                    </div>
                    <div class="sk-rect5">
                    </div>
                </div>
                <div class="row">
                    <?php if (is_array($content)): ?>
                        <?php foreach ($content as $value): ?>
                            <?php echo $value ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php echo $content ?>
                    <?php endif ?>
                </div>
        </div>
    </div>
</div>
</div>
<script>

(function( $ ){
   $.fn.loader = function(event)
   {
        switch(event)
        {
            case 'show':
            case 'on':
                this.children('.ibox-content').toggleClass('sk-loading');
            break;
            default:
            case 'hide':
            case 'off':
                this.children('.ibox-content').removeClass('sk-loading');
            break;
        }
        return this;
   };
})(jQuery);
$(window).on('load', function()
{
    $('.ibox-content').toggleClass('sk-loading');
});
</script>