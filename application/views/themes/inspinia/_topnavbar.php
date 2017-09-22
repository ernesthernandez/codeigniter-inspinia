<div class="row border-bottom">
    <nav class="navbar <?php echo $nav_class; ?>" role="navigation">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="javascript:void(0);" onclick="this.blur();"><i class="fa fa-bars"></i> </a>
            <form id="app-search" role="search" class="navbar-form-custom" method="post" autocomplete="off">
                <div class="form-group text-uppercase" >
                    <input type="text" placeholder="<?php echo $search_label; ?>" class="form-control" name="top-search" id="top-search" />
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <?php if (isset($message)): ?>
                <li>
                    <span class="m-r-sm text-muted welcome-message"><?php echo $message; ?></span>
                </li>
            <?php endif ?>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" href="#" data-toggle="dropdown">
                    <i class="fa fa-globe"></i>
                </a>
                <?php echo $lang_list; ?>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-bell"></i>  <span class="label label-warning">2</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-rocket fa-fw"></i> Template Load Time
                                <span class="pull-right text-muted small"> {elapsed_time}</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-flash fa-fw"></i> Memory Usage
                                <span class="pull-right text-muted small"> {memory_usage}</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo $logout_url; ?>">
                    <i class="fa fa-sign-out"></i><?php echo $logout_label; ?>
                </a>
            </li>
        </ul>
    </nav>
</div>