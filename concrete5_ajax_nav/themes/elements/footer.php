<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
// start: condition footer or not
if (!isset($_REQUEST['ajax_page']))
{
	?>
	</div>
	<div id="footer">
			<span class="powered-by"><a href="http://www.concrete5.org" title="<?php echo t('concrete5 - open source content management system for PHP and MySQL')?>"><?php echo t('concrete5 - open source CMS')?></a></span>
			&copy; <?php echo date('Y')?> <a href="<?php echo DIR_REL?>/"><?php echo SITE?></a>.
			&nbsp;&nbsp;
			<?php echo t('All rights reserved.')?>
			<?php 
			$u = new User();
			if ($u->isRegistered()) { ?>
				<?php  
				if (Config::get("ENABLE_USER_PROFILES")) {
					$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
				} else {
					$userName = $u->getUserName();
				}
				?>
				<span class="sign-in"><?php echo t('Currently logged in as <b>%s</b>.', $userName)?> <a href="<?php echo $this->url('/login', 'logout')?>"><?php echo t('Sign Out')?></a></span>
			<?php  } else { ?>
				<span class="sign-in"><a href="<?php echo $this->url('/login')?>"><?php echo t('Sign In to Edit this Site')?></a></span>
			<?php  } ?>
            
	</div>

</div>

<?php  Loader::element('footer_required'); ?>

</body>
</html>
<?php
	// end: condition footer or not
}
else
{
	$content = ob_get_contents();
	ob_end_clean();
	
	$pageTitle = sprintf(PAGE_TITLE_FORMAT, SITE, htmlspecialchars($c->getCollectionName(), ENT_COMPAT, APP_CHARSET));
	
	$valt = Loader::helper('validation/token');
	
	echo json_encode(array('title' => $pageTitle, 'content' => $content, 'CCM_CID' => $c->getCollectionId(), 'CCM_SECURITY_TOKEN' => $valt->generate()));
}
?>