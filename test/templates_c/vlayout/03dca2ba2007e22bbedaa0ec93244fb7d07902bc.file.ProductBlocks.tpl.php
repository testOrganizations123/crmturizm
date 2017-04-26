<?php /* Smarty version Smarty-3.1.7, created on 2017-03-01 01:16:31
         compiled from "/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ProductBlocks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167712665258b5f6c0013017-62673401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03dca2ba2007e22bbedaa0ec93244fb7d07902bc' => 
    array (
      0 => '/var/www/moihottur/data/www/crmturizm.ru/includes/runtime/../../layouts/vlayout/modules/PDFMaker/ProductBlocks.tpl',
      1 => 1471260282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167712665258b5f6c0013017-62673401',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PB_TEMPLATES' => 0,
    'tpl_id' => 0,
    'tpl_value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_58b5f6c00568d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5f6c00568d')) {function content_58b5f6c00568d($_smarty_tpl) {?>
<div class="container-fluid" id="ProductBlocksContainer">
    <form name="product_blocks" action="index.php" method="post" class="form-horizontal">
    <input type="hidden" name="module" value="PDFMaker" />
    <input type="hidden" name="view" value="EditProductBlock" />
    <input type="hidden" name="action" value="" />
    <input type="hidden" name="tplid" value="" />
    <input type="hidden" name="mode" value="" />
    <br>
    <label class="pull-left themeTextColor font-x-x-large"><?php echo vtranslate('LBL_PRODUCTBLOCKTPL','PDFMaker');?>
</label>
    <br clear="all"><?php echo vtranslate('LBL_PRODUCTBLOCKTPL_DESC','PDFMaker');?>

    <hr>
    <br />
    <div class="row-fluid">
        <label class="fieldLabel"><strong><?php echo vtranslate('LBL_DEFINE_PBTPL','PDFMaker');?>
:</strong></label><br>    
        <div class="row-fluid">           
            <button type="button" class="btn btn-danger span1 marginLeftZero" onclick="confirm_delete();"><?php echo vtranslate('LBL_DELETE');?>
</button>    
            <div class="pull-right btn-group">
                <button type="submit" class="addProductBlock btn addButton marginLeftZero" data-url="?module=PDFMaker&view=IndexAjax&mode=editProductBlock"><i class="icon-plus icon-white"></i>&nbsp;<strong> <?php echo vtranslate('LBL_ADD');?>
</strong></button>
                
                <button type="reset" class="btn span1 marginLeftZero" onClick="window.history.back();"><?php echo vtranslate('LBL_CANCEL');?>
</button>
            </div>  
        </div>    
        <div class="pushDownHalfper">    
            <table id="ProductBlocksTable" class="table table-bordered table-condensed ProductBlocksTable" style="padding:0px;margin:0px" id="lbltbl">
            <thead>
                <tr class="blockHeader">
                    <th style="border-left: 1px solid #DDD !important;" width="20px" align="center"><input type="checkbox" name="chx_all" onclick="checkedAll(this);"/></th>
                    <th style="border-left: 1px solid #DDD !important;" width="250px"><?php echo vtranslate('LBL_PDF_NAME','PDFMaker');?>
</th>
                    <th style="border-left: 1px solid #DDD !important;" id="bodyColumn"><?php echo vtranslate('LBL_BODY','PDFMaker');?>
</th>
                    <th style="border-left: 0px solid #DDD !important;" width="150px" nowrap></th>
                </tr>
            </thead>
            <tbody>
            <script type="text/javascript" language="javascript">var existingKeys = new Array();</script>
            <?php  $_smarty_tpl->tpl_vars['tpl_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tpl_value']->_loop = false;
 $_smarty_tpl->tpl_vars['tpl_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PB_TEMPLATES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tpl_foreach']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['tpl_value']->key => $_smarty_tpl->tpl_vars['tpl_value']->value){
$_smarty_tpl->tpl_vars['tpl_value']->_loop = true;
 $_smarty_tpl->tpl_vars['tpl_id']->value = $_smarty_tpl->tpl_vars['tpl_value']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tpl_foreach']['index']++;
?>
                <tr class="opacity">
                    <td>
                        <input type="checkbox" name="chx_<?php echo $_smarty_tpl->tpl_vars['tpl_id']->value;?>
" id="chx_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tpl_foreach']['index'];?>
"/>
                    </td>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['tpl_value']->value['name'];?>

                    </td>
                    <td>
                        <div style="overflow-x:auto; overflow-y:auto; width:100px;" class="bodyCell">
                            <?php echo $_smarty_tpl->tpl_vars['tpl_value']->value['body'];?>

                        </div>
                    </td>
                    <td style="border-left: none;">
                        <div class="pull-right actions">
                            <div class="btn-group">
                                <button type="submit" class="btn marginLeftZero" onClick="this.form.tplid.value='<?php echo $_smarty_tpl->tpl_vars['tpl_id']->value;?>
'">
                                        <i title="Edit" class="icon-pencil alignBottom"></i></button><button class="btn marginLeftZero" <button type="submit" class="btn marginLeftZero" onClick="this.form.tplid.value='<?php echo $_smarty_tpl->tpl_vars['tpl_id']->value;?>
';this.form.mode.value='duplicate'"><?php echo vtranslate('LBL_DUPLICATE','PDFMaker');?>
</button>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php }
if (!$_smarty_tpl->tpl_vars['tpl_value']->_loop) {
?>
                <tr id="noItemFountTr">
                    <td colspan="4" class="cellText" align="center" style="padding:10px;"><strong><?php echo vtranslate('LBL_NO_ITEM_FOUND','PDFMaker');?>
</strong></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
        <div id="otherLangsDiv" style="display:none; width:350px; position:absolute;" class="layerPopup"></div>    
        <div class="row-fluid pushDownHalfper">    
            <button type="button" class="btn btn-danger span1 marginLeftZero" onclick="confirm_delete();"><?php echo vtranslate('LBL_DELETE');?>
</button>    
            <div class="pull-right btn-group">
                <button type="submit" class="addProductBlock btn addButton marginLeftZero" data-url="?module=PDFMaker&view=IndexAjax&mode=editProductBlock"><i class="icon-plus icon-white"></i>&nbsp;<strong> <?php echo vtranslate('LBL_ADD');?>
</strong></button>
                
                <button type="reset" class="btn span1 marginLeftZero" onClick="window.history.back();"><?php echo vtranslate('LBL_CANCEL');?>
</button>
            </div>  
        </div>
    </div>    

</form>
</div>
	
<script type="text/javascript" language="javascript">
    
function checkedAll(oTrigger)
{
    var tableName = document.getElementById('ProductBlocksTable');
    totalNoOfRows = tableName.rows.length;
    ControlRows = totalNoOfRows - 1;    
    
    for(i = 0; i < ControlRows; i++)
    {
        var tmpChx = document.getElementById('chx_' + i);
        if(tmpChx != 'undefined')
        {
            tmpChx.checked = oTrigger.checked;
        }
    }
}

function confirm_delete()
{
   var tableName = document.getElementById('ProductBlocksTable');
    totalNoOfRows = tableName.rows.length;
    ControlRows = totalNoOfRows - 1;
        
    var toDelete = 0;
    for(i = 0; i < ControlRows; i++)
    {
        var tmpChx = document.getElementById('chx_' + i);
        if(tmpChx != 'undefined')
        {
            if(tmpChx.checked == true)
                toDelete++;
        }
    }
    
    if(toDelete > 0)
    {
        var message = app.vtranslate('LBL_MASS_DELETE_CONFIRMATION');
        Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(function(data) {
                document.product_blocks.view.value = '';
                document.product_blocks.action.value = 'IndexAjax';
                document.product_blocks.mode.value = 'deleteProductBlocks';

                document.product_blocks.submit();
            },
            function(error, err) {
            }
        );
    }
}

 jQuery(document).ready(function() {
            var elmWidth = jQuery("#bodyColumn").width();
            jQuery(".bodyCell").each(function() {
                jQuery(this).css("width", elmWidth + "px");
            });
        });
        
//PDFMaker_ProductBlocks_Js.registerEvents();
</script>
<?php }} ?>