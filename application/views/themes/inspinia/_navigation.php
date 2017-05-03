<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" width="48" height="48" src="{base_url}/public/theme/img/profile_small.png">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{username}</strong>
                            </span> <span class="text-muted text-xs block">{groupname}<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{logout_url}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    CI+
                </div>
            </li>
            {menu}
        </ul>
    </div>
</nav>