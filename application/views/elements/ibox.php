<div class="{column}">
    <div class="ibox float-e-margins" id="{id}">
        <div class="ibox-title">
            <h5>{title}
            <?php if (!empty($label)): ?>
            <small>{label}</small>
            <?php endif ?>
            </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <?php if (!empty($tools)): ?>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
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
        <div class="ibox-content">
                <div class="row">
                    <?php foreach ($content as $value): ?>
                        <?php echo $value ?>
                    <?php endforeach ?>
                </div>
        </div>
    </div>
</div>