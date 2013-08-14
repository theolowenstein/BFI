<?php /* Smarty version 2.6.27, created on 2013-08-11 12:20:06
         compiled from CRM/Contribute/Form/AdditionalInfo/Honoree.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'ts', 'CRM/Contribute/Form/AdditionalInfo/Honoree.tpl', 33, false),)), $this); ?>
<div id="id-honoree" class="section-shown crm-contribution-additionalinfo-honoree-form-block">
      <table class="form-layout-compressed">
         <?php if ($this->_tpl_vars['form']['honor_type_id']['html']): ?>
      <tr class="crm-contribution-form-block-honor_type_id">
         <td colspan="3">
      <?php echo $this->_tpl_vars['form']['honor_type_id']['html']; ?>

      <span class="crm-clear-link">(<a href="#" title="unselect" onclick="unselectRadio('honor_type_id', '<?php echo $this->_tpl_vars['form']['formName']; ?>
'); enableHonorType(); return false;"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>clear<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)</span><br />
      <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please include the name, and / or email address of the person you are honoring.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
         </td>
      </tr>
         <?php endif; ?>
   <tr id="honorType">
      <td><?php echo $this->_tpl_vars['form']['honor_prefix_id']['html']; ?>
<br />
         <span class="description"><?php echo $this->_tpl_vars['form']['honor_prefix_id']['label']; ?>
</span></td>
      <td><?php echo $this->_tpl_vars['form']['honor_first_name']['html']; ?>
<br />
         <span class="description"><?php echo $this->_tpl_vars['form']['honor_first_name']['label']; ?>
</span></td>
      <td><?php echo $this->_tpl_vars['form']['honor_last_name']['html']; ?>
<br />
         <span class="description"><?php echo $this->_tpl_vars['form']['honor_last_name']['label']; ?>
</span></td>
   </tr>
   <tr id="honorTypeEmail">
      <td></td>
      <td colspan="2"><?php echo $this->_tpl_vars['form']['honor_email']['html']; ?>
<br />
                <span class="description"><?php echo $this->_tpl_vars['form']['honor_email']['label']; ?>
</td>
         </tr>
      </table>
</div>
<?php if ($this->_tpl_vars['form']['honor_type_id']['html']): ?>
<?php echo '
<script type="text/javascript">
   enableHonorType();
   function enableHonorType( ) {
      var element = document.getElementsByName("honor_type_id");
      for (var i = 0; i < element.length; i++ ) {
  var isHonor = false;
  if ( element[i].checked == true ) {
      var isHonor = true;
      break;
  }
      }
      if ( isHonor ) {
   cj(\'#honorType\').show();
   cj(\'#honorTypeEmail\').show();
      } else {
   cj(\'#honor_first_name\').val(\'\');
   cj(\'#honor_last_name\').val(\'\');
   cj(\'#honor_email\').val(\'\');
   cj(\'#honor_prefix_id\').val(\'\');
   cj(\'#honorType\').hide();
   cj(\'#honorTypeEmail\').hide();
      }
   }
</script>
'; ?>

<?php endif; ?>