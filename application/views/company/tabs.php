<?php
	$mainSelected = ($action == 'main' || $action == 'savegeneral')? " ui-tabs-selected ui-state-active": "";
	$contactSelected = ($action == 'contact' || $action == 'savecontact')? " ui-tabs-selected ui-state-active": "";
	$securitySelected = ($action == 'security' || $action == 'savesecurity')? " ui-tabs-selected ui-state-active": "";
	$customersSelected = ($action == 'customers' || $action == 'savecustomers')? " ui-tabs-selected ui-state-active": "";
	$providersSelected = ($action == 'providers' || $action == 'saveproviders')? " ui-tabs-selected ui-state-active": "";
	$legalSelected = ($action == 'legal' || $action == 'savelegal')? " ui-tabs-selected ui-state-active": "";
	$branchesSelected = ($action == 'branches' || $action == 'savebranches')? " ui-tabs-selected ui-state-active": "";
?>
			<div class="headings altheading">
				<h2 class="left"><?=LBL_HEADER?></h2>
				<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top<?=$mainSelected?>"><a href="<?=SITE_URL?>company/main/<?=$company['id']?>"><?=LBL_TAB_GENERAL_INFO?></a></li>
<?php
	if($company['id'] > 0) { 
?>
					<li class="ui-state-default ui-corner-top<?=$contactSelected?>"><a href="<?=SITE_URL?>company/contact/<?=$company['id']?>"><?=LBL_TAB_ACCOUNTING_CONTACT?></a></li>
					<li class="ui-state-default ui-corner-top<?=$securitySelected?>"><a href="<?=SITE_URL?>company/security/<?=$company['id']?>"><?=LBL_TAB_SECURITY_MGMT?></a></li>
					<li class="ui-state-default ui-corner-top<?=$customersSelected?>"><a href="<?=SITE_URL?>company/customers/<?=$company['id']?>"><?=LBL_TAB_CUSTOMERS?></a></li>
					<li class="ui-state-default ui-corner-top<?=$providersSelected?>"><a href="<?=SITE_URL?>company/providers/<?=$company['id']?>"><?=LBL_TAB_PROVIDERS?></a></li>
					<li class="ui-state-default ui-corner-top<?=$branchesSelected?>"><a href="<?=SITE_URL?>company/branches/<?=$company['id']?>"><?=LBL_TAB_BRANCHES?></a></li>
<?php
	} 
?>
				</ul>
			</div>