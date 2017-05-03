<div class="{column}">
    <div class="tabs-container" id="{id}">
        <div class="{position}">
            <ul class="nav nav-tabs">
                {tabs}
                    <li class="{active}">
                        <a data-toggle="tab" href="#{id}">{icon}{title}{label}</a>
                    </li>
                {/tabs}
            </ul>
            <div class="tab-content">
                {tabs}
                    <div id="{id}" class="tab-pane {active}">
                        <div class="panel-body">
                            {content}
                        </div>
                    </div>
                {/tabs}
            </div>
        </div>
    </div>
</div>