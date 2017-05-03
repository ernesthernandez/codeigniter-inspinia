<?php if ($type = ''  or $type = 'large'): ?>

	{bars}
	<div class="progress" id="{id}">
	  <div class="progress-bar {options}" role="progressbar" aria-valuenow="{progress}" aria-valuemin="0" aria-valuemax="100" style="width: {progress}%">
	    <span>{label}</span>
	  </div>
	</div>
	{/bars}
<?php endif ?>
<!--
<?php if ($type = 'medium' or $type = 'small'): ?>
	
	{bars}
	    <div class='goal-container' id="{id}">
	        <span>{label}</span>
	        <small class="pull-right">{progress}%</small>
	    </div>
	    <div class="progress progress-small {options}">
	        <div style="width: {progress}%;" class="progress-bar"></div>
	    </div>
	{/bars}

<?php endif ?>

<?php if ($type = 'mini'): ?>
	{bars}
	 <div class='goal-container' id="{id}">
	<h5>{label}</h5>
	<h2>{progress}%</h2>
	<div class="progress progress-mini {options}">
	<div style="width: {progress}%;" class="progress-bar"></div>
	</div>

	<div class="m-t-sm small">Total de {label}:  {progress} </div>
	</div>
	{/bars}

<?php endif ?>

-->