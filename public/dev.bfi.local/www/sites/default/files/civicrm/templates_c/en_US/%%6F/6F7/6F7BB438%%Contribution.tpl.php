<?php /* Smarty version 2.6.27, created on 2013-08-11 12:19:52
         compiled from CRM/Contribute/Form/Contribution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'ts', 'CRM/Contribute/Form/Contribution.tpl', 37, false),array('function', 'crmURL', 'CRM/Contribute/Form/Contribution.tpl', 74, false),array('function', 'help', 'CRM/Contribute/Form/Contribution.tpl', 100, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/Contribution.tpl', 112, false),array('modifier', 'crmDate', 'CRM/Contribute/Form/Contribution.tpl', 150, false),array('modifier', 'crmReplace', 'CRM/Contribute/Form/Contribution.tpl', 215, false),)), $this); ?>

<?php if ($this->_tpl_vars['cdType']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/CustomData.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['priceSetId']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Price/Form/PriceSet.tpl", 'smarty_include_vars' => array('context' => 'standalone','extends' => 'Contribution')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['showAdditionalInfo'] && $this->_tpl_vars['formType']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/AdditionalInfo/".($this->_tpl_vars['formType']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>

  <?php if ($this->_tpl_vars['contributionMode']): ?>
  <h3><?php if ($this->_tpl_vars['ppID']): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Credit Card Pledge Payment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Credit Card Contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></h3>
    <?php elseif ($this->_tpl_vars['context'] != 'standalone'): ?>
  <h3><?php if ($this->_tpl_vars['action'] == 1 || $this->_tpl_vars['action'] == 1024): ?><?php if ($this->_tpl_vars['ppID']): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pledge Payment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php elseif ($this->_tpl_vars['action'] == 8): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete Contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></h3>
  <?php endif; ?>

  <div class="crm-block crm-form-block crm-contribution-form-block">

  <?php if ($this->_tpl_vars['contributionMode'] == 'test'): ?>
    <?php $this->assign('contribMode', 'TEST'); ?>
    <?php elseif ($this->_tpl_vars['contributionMode'] == 'live'): ?>
    <?php $this->assign('contribMode', 'LIVE'); ?>
  <?php endif; ?>

  <?php if (! $this->_tpl_vars['email'] && $this->_tpl_vars['action'] != 8 && $this->_tpl_vars['context'] != 'standalone'): ?>
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>&nbsp;<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You will not be able to send an automatic email receipt for this contribution because there is no email address recorded for this contact. If you want a receipt to be sent when this contribution is recorded, click Cancel and then click Edit from the Summary tab to add an email address before recording the contribution.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['contributionMode']): ?>
  <div id="help">
    <?php if ($this->_tpl_vars['contactId']): ?>
      <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'],'2' => $this->_tpl_vars['contribMode'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to submit a new contribution on behalf of %1. <strong>A %2 transaction will be submitted</strong> using the selected payment processor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php else: ?>
      <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'],'2' => $this->_tpl_vars['contribMode'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to submit a new contribution. <strong>A %2 transaction will be submitted</strong> using the selected payment processor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['action'] == 8): ?>
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>WARNING: Deleting this contribution will result in the loss of the associated financial transactions (if any).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Do you want to continue?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <?php else: ?>
  <div class="crm-submit-buttons">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php if ($this->_tpl_vars['newCredit'] && $this->_tpl_vars['action'] == 1 && $this->_tpl_vars['contributionMode'] == null): ?>
      <?php if ($this->_tpl_vars['contactId']): ?>
        <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "reset=1&action=add&cid=".($this->_tpl_vars['contactId'])."&context=".($this->_tpl_vars['context'])."&mode=live"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ccModeLink', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "reset=1&action=add&context=standalone&mode=live"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ccModeLink', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>
      <span class="action-link crm-link-credit-card-mode">&nbsp;<a href="<?php echo $this->_tpl_vars['ccModeLink']; ?>
">&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>submit credit card contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    <?php endif; ?>
  </div>
  <?php if ($this->_tpl_vars['isOnline']): ?><?php $this->assign('valueStyle', " class='view-value'"); ?><?php else: ?><?php $this->assign('valueStyle', ""); ?><?php endif; ?>
  <table class="form-layout-compressed">
    <?php if ($this->_tpl_vars['context'] != 'standalone'): ?>
    <tr>
      <td class="font-size12pt label"><strong><strong><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contributor<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></td><td class="font-size12pt"><strong><?php echo $this->_tpl_vars['displayName']; ?>
</strong></td>
    </tr>
    <?php else: ?>
      <?php if (! $this->_tpl_vars['contributionMode'] && ! $this->_tpl_vars['email'] && $this->_tpl_vars['outBound_option'] != 2): ?>
        <?php $this->assign('profileCreateCallback', 1); ?>
      <?php endif; ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/NewContact.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['contributionMode']): ?>
    <tr class="crm-contribution-form-block-payment_processor_id"><td class="label nowrap"><?php echo $this->_tpl_vars['form']['payment_processor_id']['label']; ?>
<span class="marker"> * </span></td><td><?php echo $this->_tpl_vars['form']['payment_processor_id']['html']; ?>
</td></tr>
    <?php endif; ?>
    <tr class="crm-contribution-form-block-contribution_type_id crm-contribution-form-block-financial_type_id">
      <td class="label"><?php echo $this->_tpl_vars['form']['financial_type_id']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['financial_type_id']['html']; ?>
&nbsp;
      <?php if ($this->_tpl_vars['is_test']): ?>
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(test)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?> <?php echo smarty_function_help(array('id' => "id-financial_type"), $this);?>

      </td>
    </tr>
    <?php if ($this->_tpl_vars['action'] == 2 && $this->_tpl_vars['lineItem'] && ! $this->_tpl_vars['defaultContribution']): ?>
    <tr>
      <td class="label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contribution Amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Price/Page/LineItem.tpl", 'smarty_include_vars' => array('context' => 'Contribution')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
    <?php else: ?>
    <tr  class="crm-contribution-form-block-total_amount">
      <td class="label"><?php echo $this->_tpl_vars['form']['total_amount']['label']; ?>
</td>
      <td <?php echo $this->_tpl_vars['valueStyle']; ?>
>
        <span id='totalAmount'><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['currency']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'eight') : smarty_modifier_crmAddClass($_tmp, 'eight')); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['total_amount']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'eight') : smarty_modifier_crmAddClass($_tmp, 'eight')); ?>
</span>
        <?php if ($this->_tpl_vars['hasPriceSets']): ?>
          <span id='totalAmountORPriceSet'> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>OR<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
          <span id='selectPriceSet'><?php echo $this->_tpl_vars['form']['price_set_id']['html']; ?>
</span>
          <div id="priceset" class="hiddenElement"></div>
        <?php endif; ?>

        <?php if ($this->_tpl_vars['ppID']): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href='#' onclick='adjustPayment();'>adjust payment amount</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo smarty_function_help(array('id' => "adjust-payment-amount"), $this);?>
<?php endif; ?>
        <br /><span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actual amount given by contributor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if ($this->_tpl_vars['hasPriceSets']): ?> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Alternatively, you can use a price set.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></span>
      </td>
    </tr>

      <?php if ($this->_tpl_vars['buildRecurBlock'] && ! $this->_tpl_vars['ppID']): ?>
      <tr id='recurringPaymentBlock' class='hiddenElement'>
        <td></td>
        <td>
          <strong><?php echo $this->_tpl_vars['form']['is_recur']['html']; ?>
 <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>every<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            &nbsp;<?php echo $this->_tpl_vars['form']['frequency_interval']['html']; ?>

            &nbsp;<?php echo $this->_tpl_vars['form']['frequency_unit']['html']; ?>
&nbsp;
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>for<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            &nbsp;<?php echo $this->_tpl_vars['form']['installments']['html']; ?>

            &nbsp;<?php echo $this->_tpl_vars['form']['installments']['label']; ?>

          </strong>
          <br />
          <span class="description">
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your recurring contribution will be processed automatically for the number of installments you specify. You can leave the number of installments blank if you want to make an open-ended commitment. In either case, you can choose to cancel at any time. You will receive an email receipt for each recurring contribution. The receipts will include a link you can use if you decide to modify or cancel your future contributions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </span>
        </td>
      </tr>
      <?php endif; ?>

    <tr id="adjust-option-type" class="crm-contribution-form-block-option_type">
      <td class="label"></td><td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['option_type']['html']; ?>
</td>
    </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['contributionMode'] && $this->_tpl_vars['processorSupportsFutureStartDate']): ?>
    <tr id='start_date' class="crm-contribution-form-block-receive_date">
      <td class="label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php if ($this->_tpl_vars['hideCalender'] != true): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/jcalendar.tpl", 'smarty_include_vars' => array('elementName' => 'receive_date')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['receive_date'])) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?>
<?php endif; ?><br />
        <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You can set a start date for recurring contributions and the first payment will be on that date. For a single post-dated contribution you must select recurring and choose one installment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </td>
    </tr>
    <?php endif; ?>

  <tr class="crm-contribution-form-block-source">
    <td class="label"><?php echo $this->_tpl_vars['form']['source']['label']; ?>
</td>
    <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['source']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>
 <?php echo smarty_function_help(array('id' => "id-contrib_source"), $this);?>

    </td>
  </tr>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Campaign/Form/addCampaignToComponent.tpl", 'smarty_include_vars' => array('campaignTrClass' => "crm-contribution-form-block-campaign_id")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if ($this->_tpl_vars['contributionMode']): ?>
    <?php if ($this->_tpl_vars['email'] && $this->_tpl_vars['outBound_option'] != 2): ?>
     <tr class="crm-contribution-form-block-is_email_receipt">
       <td class="label"><?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td>
       <td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
&nbsp; <span class="description"><?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['email'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this contribution to %1?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
       </td>
     </tr>
     <?php elseif ($this->_tpl_vars['context'] == 'standalone' && $this->_tpl_vars['outBound_option'] != 2): ?>
       <tr id="email-receipt" style="display:none;" class="crm-contribution-form-block-is_email_receipt"><td class="label"><?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
 <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this contribution to <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span id="email-address"></span>?</span></td></tr>
    <?php endif; ?>
    <tr id="fromEmail" style="display:none;" >
      <td class="label"><?php echo $this->_tpl_vars['form']['from_email_address']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['from_email_address']['html']; ?>
</td>
    </tr>
    <tr id="receiptDate" class="crm-contribution-form-block-receipt_date">
      <td class="label"><?php echo $this->_tpl_vars['form']['receipt_date']['label']; ?>
</td>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/jcalendar.tpl", 'smarty_include_vars' => array('elementName' => 'receipt_date')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><br />
        <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date that a receipt was sent to the contributor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </td>
    </tr>
    <?php endif; ?>
    <?php if (! $this->_tpl_vars['contributionMode']): ?>
      <tr class="crm-contribution-form-block-contribution_status_id">
        <td class="label"><?php echo $this->_tpl_vars['form']['contribution_status_id']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['contribution_status_id']['html']; ?>

        <?php if ($this->_tpl_vars['contribution_status_id'] == 2): ?><?php if ($this->_tpl_vars['is_pay_later']): ?>: <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pay Later<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php else: ?>: <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Incomplete Transaction<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
        </td>
      </tr>

            <tr id="cancelInfo" class="crm-contribution-form-block-cancelInfo">
        <td>&nbsp;</td>
        <td><fieldset><legend><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cancellation or Refund Information<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></legend>
          <table class="form-layout-compressed">
            <tr id="cancelDate" class="crm-contribution-form-block-cancel_date">
              <td class="label"><?php echo $this->_tpl_vars['form']['cancel_date']['label']; ?>
</td>
              <td>
                <?php if ($this->_tpl_vars['hideCalendar'] != true): ?>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/jcalendar.tpl", 'smarty_include_vars' => array('elementName' => 'cancel_date')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php else: ?>
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['cancel_date']['html'])) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?>

                <?php endif; ?>
              </td>
            </tr>
            <tr id="cancelDescription" class="crm-contribution-form-block-cancel_reason">
              <td class="label">&nbsp;</td>
              <td class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter the cancellation or refunded date, or you can skip this field and the cancellation date or refunded date will be automatically set to TODAY.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
            </tr>
            <tr id="cancelReason">
              <td class="label" style="vertical-align: top;"><?php echo $this->_tpl_vars['form']['cancel_reason']['label']; ?>
</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['cancel_reason']['html'])) ? $this->_run_mod_handler('crmReplace', true, $_tmp, 'class', 'huge') : smarty_modifier_crmReplace($_tmp, 'class', 'huge')); ?>
</td>
            </tr>
          </table>
        </fieldset>
        </td>
      </tr>
    <?php endif; ?>
  <tr id="softCreditID" class="crm-contribution-form-block-soft_credit_to"><td class="label"><?php echo $this->_tpl_vars['form']['soft_credit_to']['label']; ?>
</td>
    <td <?php echo $this->_tpl_vars['valueStyle']; ?>
>
      <?php echo $this->_tpl_vars['form']['soft_credit_to']['html']; ?>
 <?php echo smarty_function_help(array('id' => "id-soft_credit"), $this);?>

      <?php if ($this->_tpl_vars['siteHasPCPs']): ?>
        <div id="showPCPLink"><a href='#' onclick='showPCP(); return false;'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>credit this contribution to a personal campaign page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php echo smarty_function_help(array('id' => "id-link_pcp"), $this);?>
</div>
      <?php endif; ?>
    </td>
  </tr>
    <?php if ($this->_tpl_vars['siteHasPCPs']): ?>    <tr id="pcpID" class="crm-contribution-form-block-pcp_made_through_id">
      <td class="label"><?php echo $this->_tpl_vars['form']['pcp_made_through']['label']; ?>
</td>
      <td>
        <?php echo $this->_tpl_vars['form']['pcp_made_through']['html']; ?>
 &nbsp;
        <span class="showSoftCreditLink"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="#" onclick='showSoftCredit(); return false;'>unlink from personal campaign page</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
        <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search for the Personal Campaign Page by the fund-raiser's last name or email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        <div class="spacer"></div>
        <div class="crm-contribution-form-block-pcp_details">
          <table class="crm-contribution-form-table-credit_to_pcp">
            <tr id="pcpDisplayRollID" class="crm-contribution-form-block-pcp_display_in_roll"><td class="label"><?php echo $this->_tpl_vars['form']['pcp_display_in_roll']['label']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['pcp_display_in_roll']['html']; ?>
</td>
            </tr>
            <tr id="nickID" class="crm-contribution-form-block-pcp_roll_nickname">
              <td class="label"><?php echo $this->_tpl_vars['form']['pcp_roll_nickname']['label']; ?>
</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['pcp_roll_nickname']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'big') : smarty_modifier_crmAddClass($_tmp, 'big')); ?>
<br />
                <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name or nickname contributor wants to be displayed in the Honor Roll. Enter "Anonymous" for anonymous contributions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td>
            </tr>
            <tr id="personalNoteID" class="crm-contribution-form-block-pcp_personal_note">
              <td class="label" style="vertical-align: top"><?php echo $this->_tpl_vars['form']['pcp_personal_note']['label']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['pcp_personal_note']['html']; ?>

                <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Personal message submitted by contributor for display in the Honor Roll.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <?php endif; ?>
  </table>
    <?php if (! $this->_tpl_vars['contributionMode']): ?>
    <div class="crm-accordion-wrapper crm-accordion_title-accordion crm-accordion-processed" id="paymentDetails_Information">
      <div class="crm-accordion-header">
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Payment Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
      <div class="crm-accordion-body">
        <table class="form-layout-compressed" >
          <tr class="crm-contribution-form-block-receive_date">
            <td class="label"><?php echo $this->_tpl_vars['form']['receive_date']['label']; ?>
</td>
            <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/jcalendar.tpl", 'smarty_include_vars' => array('elementName' => 'receive_date')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><br />
              <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The date this contribution was received.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
          </tr>
          <tr class="crm-contribution-form-block-payment_instrument_id">
            <td class="label"><?php echo $this->_tpl_vars['form']['payment_instrument_id']['label']; ?>
</td>
            <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['payment_instrument_id']['html']; ?>
<br />
              <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Leave blank for non-monetary contributions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
          </tr>
          <?php if ($this->_tpl_vars['showCheckNumber'] || ! $this->_tpl_vars['isOnline']): ?>
            <tr id="checkNumber" class="crm-contribution-form-block-check_number">
              <td class="label"><?php echo $this->_tpl_vars['form']['check_number']['label']; ?>
</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['check_number']['html'])) ? $this->_run_mod_handler('crmReplace', true, $_tmp, 'class', 'six') : smarty_modifier_crmReplace($_tmp, 'class', 'six')); ?>
</td>
            </tr>
          <?php endif; ?>
          <tr class="crm-contribution-form-block-trxn_id">
            <td class="label"><?php echo $this->_tpl_vars['form']['trxn_id']['label']; ?>
</td>
            <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['trxn_id']['html'])) ? $this->_run_mod_handler('crmReplace', true, $_tmp, 'class', 'twelve') : smarty_modifier_crmReplace($_tmp, 'class', 'twelve')); ?>
 <?php echo smarty_function_help(array('id' => "id-trans_id"), $this);?>
</td>
          </tr>
          <?php if ($this->_tpl_vars['email'] && $this->_tpl_vars['outBound_option'] != 2): ?>
            <tr class="crm-contribution-form-block-is_email_receipt">
              <td class="label">
                <?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
&nbsp;
                <span class="description"><?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['email'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this payment to %1?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
              </td>
            </tr>
            <?php elseif ($this->_tpl_vars['context'] == 'standalone' && $this->_tpl_vars['outBound_option'] != 2): ?>
            <tr id="email-receipt" style="display:none;" class="crm-contribution-form-block-is_email_receipt">
              <td class="label"><?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
 <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this payment to <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span id="email-address"></span>?</span>
              </td>
            </tr>
          <?php endif; ?>
          <tr id="receiptDate" class="crm-contribution-form-block-receipt_date">
            <td class="label"><?php echo $this->_tpl_vars['form']['receipt_date']['label']; ?>
</td>
            <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/jcalendar.tpl", 'smarty_include_vars' => array('elementName' => 'receipt_date')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><br />
              <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date that a receipt was sent to the contributor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
          </tr>
          <tr id="fromEmail" class="crm-contribution-form-block-receipt_date" style="display:none;">
            <td class="label"><?php echo $this->_tpl_vars['form']['from_email_address']['label']; ?>
</td>
            <td><?php echo $this->_tpl_vars['form']['from_email_address']['html']; ?>
</td>
          </tr>
        </table>
      </div>
    </div>
    <?php endif; ?>

  <div id="customData" class="crm-contribution-form-block-customData"></div>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/customData.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php echo '
    <script type="text/javascript">
      cj( function( ) {
    '; ?>

    CRM.buildCustomData( '<?php echo $this->_tpl_vars['customDataType']; ?>
' );
    <?php if ($this->_tpl_vars['customDataSubType']): ?>
      CRM.buildCustomData( '<?php echo $this->_tpl_vars['customDataType']; ?>
', <?php echo $this->_tpl_vars['customDataSubType']; ?>
 );
    <?php endif; ?>
    <?php echo '
    });

    // bind first click of accordion header to load crm-accordion-body with snippet
    // everything else taken care of by cj().crm-accordions()
    cj(function() {
      cj(\'#adjust-option-type\').hide();
      cj(\'.crm-ajax-accordion .crm-accordion-header\').one(\'click\', function() {
        loadPanes(cj(this).attr(\'id\'));
      });
      cj(\'.crm-ajax-accordion:not(.collapsed) .crm-accordion-header\').each(function(index) {
        loadPanes(cj(this).attr(\'id\'));
      });
    });
    // load panes function calls for snippet based on id of crm-accordion-header
    function loadPanes( id ) {
      var url = "'; ?>
<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => 'snippet=4&formType=','h' => 0), $this);?>
<?php echo '" + id;
      '; ?>

      <?php if ($this->_tpl_vars['contributionMode']): ?>
        url = url + "&mode=<?php echo $this->_tpl_vars['contributionMode']; ?>
";
      <?php endif; ?>
      <?php if ($this->_tpl_vars['qfKey']): ?>
        url = url + "&qfKey=<?php echo $this->_tpl_vars['qfKey']; ?>
";
      <?php endif; ?>
      <?php echo '
      if (! cj(\'div.\'+id).html()) {
        var loading = \'<img src="'; ?>
<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/loading.gif<?php echo '" alt="'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>loading<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '" />&nbsp;'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Loading<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '...\';
        cj(\'div.\'+id).html(loading);
        cj.ajax({
          url    : url,
          success: function(data) { cj(\'div.\'+id).html(data); }
        });
      }
    }

  var url = "'; ?>
<?php echo $this->_tpl_vars['dataUrl']; ?>
<?php echo '";

  cj(\'#soft_credit_to\').autocomplete( url, { width : 180, selectFirst : false, matchContains: true
  }).result( function(event, data, formatted) {
      cj( "#soft_contact_id" ).val( data[1] );
  });
  '; ?>

    <?php if ($this->_tpl_vars['context'] == 'standalone' && $this->_tpl_vars['outBound_option'] != 2): ?>
      <?php echo '
      cj( function( ) {
        cj("#contact_1").blur( function( ) {
          checkEmail( );
        });
        checkEmail( );
        showHideByValue( \'is_email_receipt\', \'\', \'receiptDate\', \'table-row\', \'radio\', true);
        showHideByValue( \'is_email_receipt\', \'\', \'fromEmail\', \'table-row\', \'radio\', false );
      });

      function checkEmail( ) {
        var contactID = cj("input[name=\'contact_select_id[1]\']").val();
        if (contactID) {
          var postUrl = "'; ?>
<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/ajax/checkemail','h' => 0), $this);?>
<?php echo '";
          cj.post( postUrl, {contact_id: contactID},
            function (response) {
              if (response) {
                cj("#email-receipt").show( );
                cj("#email-address").html(response);
              }
              else {
                cj("#email-receipt").hide( );
              }
            }
          );
        }
        else {
          cj("#email-receipt").hide( );
        }
      }

      function profileCreateCallback( blockNo ) {
        checkEmail( );
      }
    '; ?>

    <?php endif; ?>
  </script>

  <div class="accordion ui-accordion ui-widget ui-helper-reset">
      <?php $_from = $this->_tpl_vars['allPanes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paneName'] => $this->_tpl_vars['paneValue']):
?>

      <div class="crm-accordion-wrapper crm-ajax-accordion crm-<?php echo $this->_tpl_vars['paneValue']['id']; ?>
-accordion <?php if ($this->_tpl_vars['paneValue']['open'] != 'true'): ?>collapsed<?php endif; ?>">
        <div class="crm-accordion-header" id="<?php echo $this->_tpl_vars['paneValue']['id']; ?>
">

          <?php echo $this->_tpl_vars['paneName']; ?>

        </div><!-- /.crm-accordion-header -->
        <div class="crm-accordion-body">

          <div class="<?php echo $this->_tpl_vars['paneValue']['id']; ?>
"></div>
        </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->

    <?php endforeach; endif; unset($_from); ?>
  </div>

  <?php endif; ?>
<br />
<div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>

  <?php echo '
  <script type="text/javascript">
  function verify( ) {
    if (cj(\'#is_email_receipt\').attr( \'checked\' )) {
      var ok = confirm( \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click OK to save this contribution record AND send a receipt to the contributor now<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '.\' );
      if (!ok) {
        return false;
      }
    }
  }
  
  function status() {
    cj("#cancel_date").val(\'\');
    cj("#cancel_reason").val(\'\');
  }

  </script>
  '; ?>


  <?php if ($this->_tpl_vars['action'] != 8): ?>
    <?php echo '
    <script type="text/javascript">
      cj( function( ) {
        checkEmailDependancies( );
        cj(\'#is_email_receipt\').click( function( ) {
          checkEmailDependancies( );
        });
      });

      function checkEmailDependancies( ) {
        if (cj(\'#is_email_receipt\').attr( \'checked\' )) {
          cj(\'#fromEmail\').show( );
          cj(\'#receiptDate\').hide( );
        }
        else {
          cj(\'#fromEmail\').hide( );
          cj(\'#receiptDate\').show( );
        }
      }

    '; ?>
<?php if (! $this->_tpl_vars['contributionMode']): ?><?php echo '
     cj( function( ) {
      showHideCancelInfo(cj(\'#contribution_status_id\'));	
      
      cj(\'#contribution_status_id\').change(function() {
       showHideCancelInfo(this);
      }
       );
     });

     function showHideCancelInfo(obj) {
       contributionStatus = cj(obj).val();
       if (contributionStatus == 3 || contributionStatus == 7) {
         cj(\'#cancelInfo\').show( );
       }
       else {
       	 status();          
         cj(\'#cancelInfo\').hide( );
       }
     }

    '; ?>
<?php endif; ?><?php echo '
    </script>	
    '; ?>

      <?php if (! $this->_tpl_vars['contributionMode']): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/showHideByFieldValue.tpl", 'smarty_include_vars' => array('trigger_field_id' => 'payment_instrument_id','trigger_value' => '4','target_element_id' => 'checkNumber','target_element_type' => "table-row",'field_type' => 'select','invert' => 0)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
  <?php endif; ?> 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formNavigate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endif; ?> 
<?php echo '
<script type="text/javascript">
cj(function() {
  cj().crmAccordions();
});

'; ?>


// load form during form rule.
<?php if ($this->_tpl_vars['buildPriceSet']): ?><?php echo 'buildAmount( );'; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['siteHasPCPs']): ?>
  <?php echo '
  var pcpUrl = "'; ?>
<?php echo $this->_tpl_vars['pcpDataUrl']; ?>
<?php echo '";

  cj(\'#pcp_made_through\').autocomplete( pcpUrl, { width : 360, selectFirst : false, matchContains: true
  }).result( function(event, data, formatted) {
      cj( "#pcp_made_through_id" ).val( data[1] );
  });
'; ?>


  <?php if ($this->_tpl_vars['pcpLinked']): ?>
    <?php echo 'hideSoftCredit( );'; ?>
  <?php else: ?>
    <?php echo 'cj(\'#pcpID\').hide();'; ?>
  <?php endif; ?>

  <?php echo '
  function hideSoftCredit ( ){
    cj("#softCreditID").hide();
  }
  function showPCP( ) {
    cj(\'#pcpID\').show();
    cj("#softCreditID").hide();
  }
  function showSoftCredit( ) {
    cj(\'#pcp_made_through_id\').val(\'\');
    cj(\'#pcp_made_through\').val(\'\');
    cj(\'#pcp_roll_nickname\').val(\'\');
    cj(\'#pcp_personal_note\').val(\'\');
    cj(\'#pcp_display_in_roll\').attr(\'checked\', false);
    cj("#pcpID").hide();
    cj(\'#softCreditID\').show();
  }
  '; ?>

<?php endif; ?>

<?php echo '
function buildAmount( priceSetId ) {
  if (!priceSetId) priceSetId = cj("#price_set_id").val( );

  var fname = \'#priceset\';
  if (!priceSetId) {
    // hide price set fields.
    cj(fname).hide( );

    // show/hide price set amount and total amount.
    cj("#totalAmountORPriceSet").show( );
    cj("#totalAmount").show( );
    var choose = "'; ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose price set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '";
    cj("#price_set_id option[value=\'\']").html( choose );

    //we might want to build recur block.
    if (cj("#is_recur")) buildRecurBlock( null );
    return;
  }

  //don\'t allow recurring w/ priceset.
  if ( cj( "#is_recur" ) && cj( \'input:radio[name="is_recur"]:checked\').val( ) ) {
    //reset the values of recur block.
    cj("#installments").val(\'\');
    cj("#frequency_interval").val(\'\');
    cj(\'input:radio[name="is_recur"]\')[0].checked = true;
    cj("#recurringPaymentBlock").hide( );
  }

  var dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('h' => 0,'q' => 'snippet=4'), $this);?>
"<?php echo ' + \'&priceSetId=\' + priceSetId;

  var response = cj.ajax({
    url: dataUrl,
    async: false
  }).responseText;

  cj( fname ).show( ).html( response );
  // freeze total amount text field.
  cj( "#total_amount").val(\'\');

  cj( "#totalAmountORPriceSet" ).hide( );
  cj( "#totalAmount").hide( );
  var manual = "'; ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manual contribution amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '";
  cj("#price_set_id option[value=\'\']").html( manual );
}

function adjustPayment( ) {
  cj(\'#adjust-option-type\').show();
  cj("#total_amount").removeAttr("READONLY");
  cj("#total_amount").css(\'background-color\', \'#ffffff\');
}

'; ?>
<?php if ($this->_tpl_vars['processorSupportsFutureStartDate']): ?><?php echo '
cj (\'input:radio[name="is_recur"]\').click( function( ) {
  showStartDate( );
});

showStartDate( );

function showStartDate( ) {
  if (cj( \'input:radio[name="is_recur"]:checked\').val( ) == 0 ) {
    cj(\'#start_date\').hide( );
  }
  else {
    cj(\'#start_date\').show( );
  }
}

'; ?>
<?php endif; ?><?php echo '
cj(\'#fee_amount\').change( function() {
  var totalAmount = cj(\'#total_amount\').val();
  var feeAmount = cj(\'#fee_amount\').val();  
  var netAmount = totalAmount.replace(/,/g, \'\') - feeAmount.replace(/,/g, \'\');
  if (!cj(\'#net_amount\').val()) {
    cj(\'#net_amount\').val(netAmount);
  }
});
</script>
'; ?>
