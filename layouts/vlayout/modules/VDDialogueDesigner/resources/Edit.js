/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("VDDialogueDesigner_Edit_Js",{},{
	
	
	registerSelecteEvent : function() {
            jQuery('select[name="type_answer"]').on('change',function(e){
                var containerSelect = jQuery('#container-type-answer');    
            
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'TypeAnswer',
                        value : jQuery(this).val(),
                    },
                    dataType : 'html',
                };
                
                if (jQuery(this).val() != ''){
                    var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
			'enabled' : true
			}
		});
                    AppConnector.request(params).then(function(data){
			
			progressIndicatorElement.progressIndicator({
				mode : 'hide'
			});
                        containerSelect.html(data);
                        containerSelect.find('select.chzn-select').chosen();
                    });
                }
                else {
                    containerSelect.empty();
                }
                
                
		
            });
            
        },
	
	
	
	registerEvents : function() {
                this._super();
		var form = this.getForm();
		this.registerSelecteEvent();
		
	}       
});
 function addAnswerBotton (elem) {
                var elem = jQuery(elem);
                var containerSelect = jQuery('#container-type-answer');    
            
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'TypeAnswer',
                        value : 'Buttons',
                        current_button : elem.data('current'),
                    },
                    dataType : 'html',
                };
                var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
			'enabled' : true
			}
		});
                    AppConnector.request(params).then(function(data){
			
			progressIndicatorElement.progressIndicator({
				mode : 'hide'
			});
                        elem.hide();
                        containerSelect.append(data);
                        
                    });
         
            }
    function addAnswerModule (elem) {
                var elem = jQuery(elem);
                var current = elem.attr("data-current");
                var next =  parseInt(current) + 1;
                jQuery('#moduleField-'+current).after('<tr id="moduleField-'+next+'"></tr>');
                var containerSelect = jQuery('#moduleField-'+next);    
                var relatedModule = jQuery('select[name="type_answer_module_name"]').val();
                if (relatedModule == "") return false;
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'TypeAnswer',
                        value : 'getModuleFields',
                        relatedModule : relatedModule,
                        current: next,
                    },
                    dataType : 'html',
                };
                var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
			'enabled' : true
			}
		});
                    AppConnector.request(params).then(function(data){
			
			progressIndicatorElement.progressIndicator({
				mode : 'hide'
			});
                        elem.attr('data-current', next);
                        containerSelect.append(data);
                        containerSelect.find('select.chzn-select').chosen();
                        
                    });
         
            }
            function addAnswerModuleDefault (elem) {
                var elem = jQuery(elem);
                var current = elem.attr("data-current");
                var next =  parseInt(current) + 1;
                jQuery('#moduleField-'+current).after('<tr id="moduleField-'+next+'"></tr>');
                var containerSelect = jQuery('#moduleField-'+next);    
                var relatedModule = jQuery('select[name="type_answer_module_name"]').val();
                if (relatedModule == "") return false;
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'TypeAnswer',
                        value : 'getModuleFieldsDefault',
                        relatedModule : relatedModule,
                        current: next,
                    },
                    dataType : 'html',
                };
                var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
			'enabled' : true
			}
		});
                    AppConnector.request(params).then(function(data){
			
			progressIndicatorElement.progressIndicator({
				mode : 'hide'
			});
                        elem.attr('data-current', next);
                        containerSelect.append(data);
                        containerSelect.find('select.chzn-select').chosen();
                        
                    });
         
            }
     function deleteAnswerModule (elem) {
        var container = jQuery(elem).closest('tr');
        container.remove();  
    } 
    function deleteAnswerBotton (elem) {
        var container = jQuery(elem).closest('table');
        if (container.find('.addButton').is(':visible')){
          
             container.prev('table').find('.addButton').show();
        }
        container.remove();  
    } 
    function getModuleFields(elem){
        var elem = jQuery(elem);
                var containerSelect = jQuery('#moduleField');    
            
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'TypeAnswer',
                        value : 'getModuleFields',
                        relatedModule : elem.val(),
                        current: 1,
                    },
                    dataType : 'html',
                };
                var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
			'enabled' : true
			}
		});
                    AppConnector.request(params).then(function(data){
			
			progressIndicatorElement.progressIndicator({
				mode : 'hide'
			});
                        containerSelect.html(data);
                        containerSelect.find('select.chzn-select').chosen();
                    });
         
            }
    