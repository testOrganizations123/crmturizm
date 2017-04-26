<?php

/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
include_once '/libraries/csrf-magic/csrf-magic.php';
?>
<script type="text/javascript" src="libraries/csrf-magic/csrf-magic.js"></script>
<div class="modal-dialog">
	
    <form method="POST" id="QuickCreate" class="form-horizontal recordEditView" name="QuickCreate" action="index.php" >
        <input type="hidden" name="module" value="Events" />
        <input type="hidden" name="action" value="Save" />
        <input type="hidden" name="mode" value="saveExpressTask" />
    <!-- Modal content-->
    <div class="modal-content">
	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Новая экспресс заявка</h4>
      </div>
      <div class="modal-body">
		  <div class="row">
		  <div class="span9">
		  <div class="form-group form-group-required">
			<label for="">Имя <i class="fa fa-check"></i></label>
			<input class="form-control" name="firstname" value="" id="client_name" required="" type="text">
		  </div>
		  <div class="form-group form-group-required">
			<label for="">Телефон <i class="fa fa-check"></i></label>
                        <input class="form-control phone" name="phone" value="" id="client_phone" required="" onmousemove="jQuery('.phone').inputmask({'mask': '+7(999) 999-9999'})" type="text">
		  </div>
		  </div>
		  </div>
		 <div class="row">
		<div class="span9">
            <div class="form-group form-group-required">
                <label>Новая задача <i class="fa fa-check"></i></label>
                <textarea rows="4" name="description" id="description" class="form-control form-textarea-vertical" required="">Перезвонить туристу , уточнить все данные по туру</textarea>
            </div>
        </div>
		</div>
        <input class="form-control" name="userId" value="202" id="userId" type="hidden">
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-success" value="Создать заявку" /> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
	
	</form>
	
  </div>
<script>
    jQuery('.modal-dialog').on('click',function(){
    alert('OK');
    console.log(jQuery(".phone").inputmask({'mask': '+7(999) 999-9999'}));
    });
    </script>