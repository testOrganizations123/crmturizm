/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function pff( k, v ) {
  var r = {};
  r[ k ] = v;
  return r;
}
function openLeads(elem){
    var record = jQuery(elem).data('record');
    var params = { 
                    module: "Leads", 
                    view: "Detail", 
                    mod: "read", 
                    record: record,
                   
                }
                
               var popupInstance = Vtiger_Popup_Js.getInstance();
                
		popupInstance.show(params,function(data){});
}

var indexStep = 0;
function VDDialogueDesignerNextStep(elem){
    if (jQuery('select[name="leadsource"]').length){
        if (jQuery('select[name="leadsource"]').val() == ''){
            alert ('Выберите источник обращения');
            jQuery('select[name="leadsource"]').focus();
            return false;
        }
    }
    if (jQuery('input[name="leadid"]').length){
        var radios = document.getElementsByName('leadid');
        var sel = false;
        for(var k = 0; k < radios.length; k++){
            if(radios[k].type == "radio"){
                if(radios[k].checked){
                sel = true;
                break;
            }
            }
        }
        if(!sel){
            alert ('Выберите заявку');
            jQuery('input[name="leadid"]').focus();
            return false;
        }
    }
    var id = jQuery(elem).data('record');
    var next = jQuery(elem).data('url');
    var container = jQuery('#VDDialogueDesigner_container'); 
    var currentStep = jQuery('#step-'+id);
    var currentStepAnswer = jQuery('#historyStep-'+id);
    var currentAnswer = jQuery('#answerHistory-'+id);
    var nameStep = jQuery('#nameStep-'+id);
    var input = {};
    var pattern = /\r\n|\r|\n/g;
    if (jQuery(elem).data('exit') == 'Calendar'){
        window.location.href = '/index.php?module=Calendar&view=List';
    }
    else {
    jQuery('#step-'+id+' .dataContentDialogue input').each(function(){
       
        inputDialogueDesigner[jQuery(this).attr('name')] = jQuery(this).val();
        input[jQuery(this).attr('name')] = jQuery(this).val();
    });
    jQuery('#step-'+id+' .dataContentDialogue textarea').each(function(){
        var value = jQuery(this).val();
        var newvalue = value.replace(/\r\n|\r|\n/g,' ');
        var name = jQuery(this).attr('name');
        name = name.replace("[]","");
        if (name == 'description'){
            if (inputDialogueDesigner.description){
                inputDialogueDesigner.description[id] = newvalue;
            }
            else {
                inputDialogueDesigner.description = pff(id,newvalue);
            }
        }
        else if (typeof inputDialogueDesigner[name] == 'undefined'){
            
            
           
        }else if (inputDialogueDesigner[name] != ''){
            
            
            inputDialogueDesigner[name] += " " + newvalue;
        }
        else{
            inputDialogueDesigner[name] = newvalue;
        }
        if (typeof input[name] == 'undefined'){
            input[name] = newvalue;
        }
        else if (input[name]!=""){
            input[name] += " "+ newvalue;
        }else {
            input[name] = newvalue;
        }
    });
    if (jQuery('#type_answer-'+id).val() === 'Buttons'){
        
            input.button = jQuery(elem).data('answer');
        
    }
        //jQuery('#step-'+next).remove();  
        var isIndex = false;
        if (indexStep == 0){
            if (jQuery('div').is('#step-'+next)){
                indexStep ++;
                isIndex = true;
            }
        }
        else {
            if (jQuery('div').is('#step-'+next)){
                indexStep ++;
                isIndex = true;
            }
            else {
                for (var i=1; i <= indexStep; i++){
                    if (jQuery('div').is('#step-'+next+'-'+i)){
                        indexStep ++;
                        isIndex = true;
                    }
                }
            }
        }
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'RunScript',
                        record : next,
                        backstep : id,
                        type_answer : jQuery('#type_answer-'+id).val(),
                        inputs: inputDialogueDesigner,
                        input: input,
                        leadid: jQuery('input[name="leadid"]').val(),
                    },
                    dataType : 'json',
                };
                if (isIndex){
                    params.data.index = indexStep;
                }
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
                        currentStep.hide();
                        currentStep.after(data.qustion);
                        currentAnswer.html(data.answer);
                        
                        currentStepAnswer.after(data.newqustion);
                        nameStep.hide();
                        nameStep.after(data.header);
                        app.registerEventForDatePickerFields();
                        app.registerEventForTimeFields();
                        phoneMask();
                        var customParams = {
					calendars: 3,
					mode: 'range',
					className : 'rangeCalendar',
					onChange: function(formated) {
						jQuery('input[name="departure"]').val(formated.join(','));
					}
				}
			app.registerEventForDatePickerFields(jQuery('input[name="departure"]'),false,customParams);
                        var customParams = {
					calendars: 3,
					mode: 'range',
					className : 'rangeCalendar',
					onChange: function(formated) {
						jQuery('input[name="arrival"]').val(formated.join(','));
					}
				}
                        app.registerEventForDatePickerFields(jQuery('input[name="arrival"]'),false,customParams);
                        
                        
                    });
                     jQuery('body,html').animate({scrollTop: 0}, 400);
                     
                }
}
function VDDialogueDesignerNextStepSearch(elem){
    if (jQuery('select[name="leadsource"]').length){
        if (jQuery('select[name="leadsource"]').val() == ''){
            alert ('Выберите источник обращения');
            jQuery('select[name="leadsource"]').focus();
            return false;
        }
    }
     var id = jQuery(elem).data('record');
    var next = jQuery(elem).data('url');
    var container = jQuery('#VDDialogueDesigner_container'); 
    var currentStep = jQuery('#step-'+id);
    var currentStepAnswer = jQuery('#historyStep-'+id);
    var currentAnswer = jQuery('#answerHistory-'+id);
    var nameStep = jQuery('#nameStep-'+id);
    var input = {};
    var pattern = /\r\n|\r|\n/g;
   
    jQuery('#step-'+id+' .dataContentDialogue input').each(function(){
       
        inputDialogueDesigner[jQuery(this).attr('name')] = jQuery(this).val();
        input[jQuery(this).attr('name')] = jQuery(this).val();
    });
    jQuery('#step-'+id+' .dataContentDialogue textarea').each(function(){
        var value = jQuery(this).val();
        var newvalue = value.replace(/\r\n|\r|\n/g,' ');
        var name = jQuery(this).attr('name');
        name = name.replace("[]","");
        if (name == 'description'){
            if (inputDialogueDesigner.description){
                inputDialogueDesigner.description[id] = newvalue;
            }
            else {
                inputDialogueDesigner.description = pff(id,newvalue);
            }
        }
        else if (inputDialogueDesigner[name]!=""){
            inputDialogueDesigner[name] += " " + newvalue;
        }else{
            inputDialogueDesigner[name] = newvalue;
        }
        if (input[name]!=""){
            input[name] += " "+ newvalue;
        }else {
            input[name] = newvalue;
        }
    });
    if (jQuery('#type_answer-'+id).val() === 'Buttons'){
        
            input.button = jQuery(elem).data('answer');
        
    }
        //jQuery('#step-'+next).remove();  
        var isIndex = false;
        if (indexStep == 0){
            if (jQuery('div').is('#step-'+next)){
                indexStep ++;
                isIndex = true;
            }
        }
        else {
            if (jQuery('div').is('#step-'+next)){
                indexStep ++;
                isIndex = true;
            }
            else {
                for (var i=1; i <= indexStep; i++){
                    if (jQuery('div').is('#step-'+next+'-'+i)){
                        indexStep ++;
                        isIndex = true;
                    }
                }
            }
        }
                var params = {
                    data : {
                        module : app.getModuleName(),
                        action : 'Script',
                        mode : 'RunScriptSearch',
                        record : next,
                        backstep : id,
                        type_answer : jQuery('#type_answer-'+id).val(),
                        inputs: inputDialogueDesigner,
                        input: input,
                    },
                    dataType : 'json',
                };
                if (isIndex){
                    params.data.index = indexStep;
                }
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
                        currentStep.hide();
                        currentStep.after(data.qustion);
                        currentAnswer.html(data.answer);
                        
                        currentStepAnswer.after(data.newqustion);
                        nameStep.hide();
                        nameStep.after(data.header);
                        app.registerEventForDatePickerFields();
                        
                        
                    
                        app.registerEventForTimeFields();
                        phoneMask();
                        var customParams = {
					calendars: 3,
					mode: 'range',
					className : 'rangeCalendar',
					onChange: function(formated) {
						jQuery('input[name="departure"]').val(formated.join(','));
					}
				}
			app.registerEventForDatePickerFields(jQuery('input[name="departure"]'),false,customParams);
                        var customParams = {
					calendars: 3,
					mode: 'range',
					className : 'rangeCalendar',
					onChange: function(formated) {
						jQuery('input[name="arrival"]').val(formated.join(','));
					}
				}
                        app.registerEventForDatePickerFields(jQuery('input[name="arrival"]'),false,customParams);
                        
                    });
                     jQuery('body,html').animate({scrollTop: 0}, 400);
                    
                
}
function VDDialogueDesignerBackStep(elem){
     var id = jQuery(elem).data('record');
    jQuery('#step-'+jQuery(elem).data('backstep')).show();
    jQuery('#step-'+id).remove(); 
    jQuery('#historyStep-'+id).remove();
    jQuery('#nameStep-'+id).remove();
    jQuery('#nameStep-'+jQuery(elem).data('backstep')).show();
    jQuery('body,html').animate({scrollTop: 0}, 400);
}
function phoneMask() {
    jQuery('.phone').inputmask({'mask': '+7(999) 999-9999'});
}  

function newSuggections(event,elem,$categoryVDDialogue){
    var data = jQuery(elem).data();
    var categoryVDDialogue = $categoryVDDialogue;
    var params = { 
                    module: "Suggestions", 
                    view: "QuickCreateAjax", 
                    suggestions: data.name,
                    category: categoryVDDialogue,
                    script: data.script,
                    sugstatus: "Новый",
                }
     var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
			if(data){
                            var param = {data:data, css:{'top':"100px"}};
                        progressIndicatorInstance.hide();
                        app.showModalWindow(param, function(){
                            
                        });
                    }
                });
}
function SaveSuggections(event){
    event.preventDefault();
    var type_payment = jQuery('form[name="QuickCreate"] select[name="sugtype"]');
    if (type_payment.val() == ""){
        type_payment.attr('requared', '1');
        type_payment.trigger('list:update');
        alert('выберите "Тип предложения"');
        type_payment.focus();
        return false;
    }
    var type_payment = jQuery('form[name="QuickCreate"] textarea[name="description"]');
    if (type_payment.val() == ""){
        type_payment.attr('requared', '1');
        type_payment.trigger('list:update');
        alert('Напишите "Описание"');
        type_payment.focus();
        return false;
    }
    var progressIndicatorInstance = jQuery.progressIndicator({});
    var form = jQuery('form[name="QuickCreate"]');
    var params = form.serialize();
    jQuery('#globalmodal button.close').trigger('click');
    AppConnector.request(params).then(
					function(data){
                                           if(data.success) {
                                               
                                                    progressIndicatorInstance.progressIndicator({
							'mode' : 'hide'
                                                    });
                                                    var params = {
							text: "Ваше замечание сохранено и отправлено на доработку",
							type: 'info'
						};
							Vtiger_Helper_Js.showPnotify(params);
						} else {
                                                    progressIndicatorInstance.progressIndicator({
							'mode' : 'hide'
                                                    });
							Vtiger_Helper_Js.showPnotify(data.errors);
						}
                                        });
    
    
}
function VDDialogueDesignerExit(){
    var express = jQuery('input[name="express"]').val();
    if (express != "") {
        var link = 'index.php?module=Calendar&view=List&express='+express;
    }
    else {
        var link = 'index.php?module=Calendar&view=List';
    }
    window.location.href = link;
}