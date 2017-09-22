<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" width="48" height="48" src="{base_url}/public/theme/img/profile_small.png">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold"><?php echo $template_user; ?></strong>
                            </span>
                            <span class="text-muted text-xs block">
                                <?php echo $template_group; ?><b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#"><?php echo $profile_label; ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $logout_url; ?>"><?php echo $logout_label; ?></a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    CI+
                </div>
            </li>
            <?php echo $menu; ?>
        </ul>
    </div>
</nav>