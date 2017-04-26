<?php /* Smarty version Smarty-3.1.7, created on 2016-10-06 14:53:57
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Users/ForgotPassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11331577957f63b55df0159-61897075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '906c8da90d39361efb3f29fff001e58628de53fc' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/Users/ForgotPassword.tpl',
      1 => 1450875180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11331577957f63b55df0159-61897075',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LOGOURL' => 0,
    'TITLE' => 0,
    'LINK_EXPIRED' => 0,
    'MODULE' => 0,
    'TRACKURL' => 0,
    'USERNAME' => 0,
    'SHORTURL_ID' => 0,
    'SECRET_HASH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_57f63b55e44e4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f63b55e44e4')) {function content_57f63b55e44e4($_smarty_tpl) {?><!--/* +********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ******************************************************************************* */-->

<!DOCTYPE html>
<html>
    <head>
		
		<meta charset="utf-8">
		
        <style type="text/css">
            body{
               font-family: Tahoma, "Trebuchet MS","Lucida Grande",Verdana !important;
				background: #F5FAEE !important;/*#f1f6e8;*/
				color : #555 !important;
				font-size: 85% !important;
				height: 98% !important;
            }
			hr{
				border: 1px solid #ddd;
				margin: 13px 0;
			}
            #container{
                min-width:280px;
                width:50%;
                margin-top:2%;
            }
            #content{
                padding:8px 20px;
                border:1px solid #ddd;
                background:#fff;
                border-radius:5px;
            }
            #footer{
                float:right;
            }
            #footer p{
                text-align:right;
                margin-right:20px;
            }
			.button-container a{
				text-decoration: none;
			}
			.button-container{
				float: right;
			}
			.button-container .btn{
				margin-left: 15px;
				min-width: 100px;
				font-weight: bold;
			}
			.logo{
				padding: 15px 0 ;
			}
        </style>
		<script language='JavaScript'>
			function checkPassword () {
				var password = document.getElementById('password').value;
				var confirmPassword = document.getElementById('confirmPassword').value;
				if(password == '' && confirmPassword == ''){
					alert('Please enter new Password');
					return false;
				} else if(password != confirmPassword) {
					alert('Password and Confirm Password should be same');
					return false;
				}else{
					return true;
				}
			}
		</script>
    </head>
    <body>
        <div id="container">
            <div class="logo">
				<img  src="<?php echo $_smarty_tpl->tpl_vars['LOGOURL']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
" style="height: 4em;width: 12em;"><br><br><br>
			</div>
			<div>
                            <?php if ($_smarty_tpl->tpl_vars['LINK_EXPIRED']->value!='true'){?>   
				<div id="content">
					<span><b><?php echo vtranslate('LBL_CHANGE_PASSWORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></span>
					<hr>
					<div id="changePasswordBlock" align='left'>
						<form name="changePassword" id="changePassword" action="<?php echo $_smarty_tpl->tpl_vars['TRACKURL']->value;?>
" method="post" accept-charset="utf-8">
							<input type="hidden" name="username" value="<?php echo $_smarty_tpl->tpl_vars['USERNAME']->value;?>
">
                                                        <input type="hidden" name="shorturl_id" value="<?php echo $_smarty_tpl->tpl_vars['SHORTURL_ID']->value;?>
"> 
                                                        <input type="hidden" name="secret_hash" value="<?php echo $_smarty_tpl->tpl_vars['SECRET_HASH']->value;?>
"> 
							<table align='center'>
								<tr>
									<td><label class="control-label" for="password"><?php echo vtranslate('LBL_NEW_PASSWORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
									<td><input type="password" id="password" name="password" placeholder="New Password"></td>
								</tr>
								<tr><td></td></tr>
								<tr>
									<td><label class="control-label" for="confirm_password"><?php echo vtranslate('LBL_CONFIRM_PASSWORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
									<td><input type="password" id="confirmPassword" name="confirmPassword"  placeholder="Confirm Password"></td>
								</tr>
								<tr><td></td></tr>
								<tr>
									<td></td>
									
									<td><input type="submit" id="btn" value=<?php echo vtranslate('Submit',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 onclick="return checkPassword();"/></td>
									
									
								</tr>
							</table>
						</form>
					</div>
					<?php }else{ ?> 
                                            <div id="content"> 
                                                <?php echo vtranslate('LBL_PASSWORD_LINK_EXPIRED_OR_INVALID_PASSWORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 
                                            </div>
                                         <?php }?>
				</div>
			</div>
            
        </div>
	</div>
</div>
</body>
</html>
<?php }} ?>