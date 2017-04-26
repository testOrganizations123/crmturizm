/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
var superIntracePotentials;

Vtiger_Edit_Js("Potentials_Edit_Js",{ },{
    
    
    /**
	 * Function to get popup params
	**/
    listTurist : [],
    getPopUpParams : function(container) {
        var params = this._super(container);
        var sourceFieldElement = jQuery('input[class="sourceField"]',container);

        if(sourceFieldElement.attr('name') == 'contact_id' ) {
        
            var form = this.getForm();
            var parentIdElement  = form.find('[name="related_to"]');
        
            if(parentIdElement.length > 0 && parentIdElement.val().length > 0 && parentIdElement.val() != 0) {
                var closestContainer = parentIdElement.closest('td');
                params['related_parent_id'] = parentIdElement.val();
                params['related_parent_module'] = closestContainer.find('[name="popupReferenceModule"]').val();
            }
        }
     
        return params;
    },
    openPopUp2 : function(e){
		var thisInstance = this;
		var parentElem = jQuery(e.target).closest('td');
                var containerTR = jQuery('tr.addturist');
                
		var params = { 
                    module: "Contacts", 
                    src_module: "Potentials", 
                    src_field: "turist_id", 
                    src_record: jQuery('input[name="record"]').val(),
                    multi_select: true,
                }
                
                
		var isMultiple = false;
		if(params.multi_select) {
			isMultiple = true;
		}

		var sourceFieldElement = jQuery('input[class="sourceField"]',parentElem);
                
		
		

		var popupInstance = Vtiger_Popup_Js.getInstance();
                
		popupInstance.show(params,function(data){
			var responseData = JSON.parse(data);
                       
			var dataList = new Array();
			for(var id in responseData){
				var data = id;
				dataList.push(data);
				
			}
                        var url = {data :
                                    {
                            data: dataList,
                            module: 'Potentials',
                            action: 'Turist',
                            
                        }, url : 'index.php', type:'POST', dataType: 'html',};
                        AppConnector.request(url).then(function(data){
                            containerTR.before(data);
                           thisInstance.updateListTuristSelect();
                        });
		});
	},
    updateListTuristSelect: function(){
        var thisInstance = this;
        superIntracePotentials = this;
        thisInstance.listTurist = [];
        var i = 0;
        jQuery('input.listTurist').each(function(){
            thisInstance.listTurist[i] = {id:jQuery(this).val(), name: jQuery('#touristName_'+jQuery(this).val()).val()};
            i++;
        });
        
        jQuery('select.listTurist').each(function(){
            var option_selected = [];
            for (var s = 0; s < this.options.length; s++) {
                var option = this.options[s];
                if(option.selected) {
                    option_selected[option.value] = 1;
                }
            }
            for (var _i = 0; _i < i ; _i++){
                if (option_selected[thisInstance.listTurist[_i].id] == 1){
                    this.options[_i] = new Option(thisInstance.listTurist[_i].name, thisInstance.listTurist[_i].id, true, true);
                }
                else {
                    this.options[_i] = new Option(thisInstance.listTurist[_i].name, thisInstance.listTurist[_i].id);
                }
            }
            this.options.length=i;
            jQuery(this).trigger("liszt:updated");
        });
        
    },
    turistPopupRegisterEvent : function(container){
		var thisInstance = this;
		jQuery('#addTurist').on("click", function(e){
                    
			thisInstance.openPopUp2(e);
		});
		
	},
    registerEvents: function(){
        this._super();
	this.turistPopupRegisterEvent();
        this.updateListTuristSelect();
    }

});
function chekMailSend(){
    var recordId = jQuery('input[name="record"]').val();
    var params = {
        module: 'Potentials',
        action: 'Checkmail',
        record: recordId
    };
     AppConnector.request(params);  
}
function changeDogovor(id){
    jQuery('input[name="contact_id"]').val(id);
    document.getElementById('EditView').submit();
    
}
function visaOff(element,id){
    var select = jQuery('#doc_select_'+id);
    if (jQuery(element).prop("checked")){
        jQuery('#cont_doc_'+id).hide();
        
    }else {
        jQuery('#cont_doc_'+id).show();
        
    }
}
function addPayments(event){
   
    event.preventDefault();
    var now = new Date();
    var mon = now.getMonth()+1;
    if(mon < 10){
        mon = '-0'+mon+'-';
    }
    else {
         mon = '-'+mon+'-';
    }
    var params = { 
                    module: "SPPayments", 
                    view: "QuickCreateAjax", 
                    pay_type: "Receipt", 
                    pay_date: now.getDate()+mon+now.getFullYear(),
                    payer: jQuery('input[name="contact_id"]').val(),
                    spstatus:"Executed",
                    related_to:jQuery('input[name="record"]').val(),
                    spcompany:jQuery('select[name="spcompany"]').val(),
                    amount:jQuery('input[name="balance"]').val(),
                    office:jQuery('select[name="office"]').val(),
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
					if(data){
                                            var param = {data:data, css:{'top':"100px"}};
                        progressIndicatorInstance.hide();
                        app.showModalWindow(param, function(){
                            jQuery('.datepicker').datepicker();
                        });
                    }
                });
    
}
function editPayment(event,id){
   
    event.preventDefault();
    
    var params = { 
                    module: "SPPayments", 
                    view: "QuickCreateAjax", 
                    record: id, 
                    
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
					if(data){
                                            var param = {data:data, css:{'top':"100px"}};
                        progressIndicatorInstance.hide();
                        app.showModalWindow(param, function(){
                            jQuery('.datepicker').datepicker();
                        });
                    }
                });
    
}
function addPaymentsTo(event,payer){
   
    event.preventDefault();
    
    if ( typeof payer == 'undefined'){
       
        payer = jQuery('input[name="tur_vendor"]').val();
        var amount = jQuery('input[name="balance_to"]').val();
    }
    else {
        var amount = jQuery('#balance_vendor_'+payer).val();
    }
    var now = new Date();
    var mon = now.getMonth()+1;
    if(mon < 10){
        mon = '-0'+mon+'-';
    }
    else {
         mon = '-'+mon+'-';
    }
    var params = { 
                    module: "SPPayments", 
                    view: "QuickCreateAjax", 
                    pay_type: "Expense", 
                    pay_date: now.getDate()+mon+now.getFullYear(),
                    payer:  payer,
                    spstatus:"Executed",
                    related_to:jQuery('input[name="record"]').val(),
                    spcompany:jQuery('select[name="spcompany"]').val(),
                    amount:amount,
                    office:jQuery('select[name="office"]').val(),
                    
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
					if(data){
                        progressIndicatorInstance.hide();
                        app.showModalWindow(data, function(){
                            jQuery('.datepicker').datepicker();
                        });
                    }
                });
    
}
var oldAmount;
function changeExchange(){
    var type = jQuery('select[name="typeaddpayment"]').val();
    if (type == 'PART') {
        var changeAmount = jQuery('input[name="balance"]').val();
    }
    else {
        var changeAmount = jQuery('input[name="amount"]').val();
    }
    var exchange = jQuery('input[name="exchange"]').val();
     
    var newexchange = jQuery('input[name="newexchange"]').val();
    
    if (exchange != newexchange){
       var _delta =  (newexchange-exchange)/exchange;
       
       var addAmount = changeAmount * _delta;
      
       if (addAmount >= 100){
           addAmount = Math.floor(addAmount/100)*100;
           jQuery('span.add_price').html(addAmount.toFixed(2));
           jQuery('small.add_price_phrase').html(number_to_string(addAmount.toFixed(2)));
           var amount = jQuery('input[name="amount"]').val()*1;
           
           var newamount = amount + addAmount;
           
           jQuery('span.new_price').html(newamount.toFixed(2));
           jQuery('small.new_price_phrase').html(number_to_string(newamount.toFixed(2)));
           jQuery('input[name="addcursamount"]').val(parseInt(jQuery('input[name="addcursamount"]').val()) + addAmount);
           jQuery('.additional-payment').show();
       } else if (addAmount <= -100){
           addAmount = Math.floor(addAmount/100)*100;
           jQuery('span.add_price').html(addAmount.toFixed(2));
           jQuery('small.add_price_phrase').html(number_to_string(addAmount.toFixed(2)));
           var amount = jQuery('input[name="amount"]').val()*1;

           var newamount = amount + addAmount;

           jQuery('span.new_price').html(newamount.toFixed(2));
           jQuery('small.new_price_phrase').html(number_to_string(newamount.toFixed(2)));
           jQuery('input[name="addcursamount"]').val(parseInt(jQuery('input[name="addcursamount"]').val()) + addAmount);
           jQuery('.additional-payment').show();
       }
    }
}
function cancelCurs(){
     jQuery('.additional-payment').hide();
     jQuery(".before-currency-change").show();
     jQuery(".cursCon").hide();
     jQuery('input[name="newexchange"]').val(jQuery('input[name="exchange"]').val());
     jQuery('input[name="addcursamount"]').val(oldAmount);
     
}
function calculateSumm(){
    var containerSumm = jQuery('input[name="cenawithdiscount"]');
    var summ = jQuery('input[name="cena"]').val();
    var discount = jQuery('input[name="discount"]').val();
    var totallSumm = jQuery('input[name="amount"]');
    var total_price = jQuery('span.total_price');
    var total_price_phrase = jQuery('small.total_price_phrase');
    
    if (summ === 0) {
        containerSumm.val(0.00);
    }
    else if (discount === 0) {
        containerSumm.val(summ.toFixed(2));
    }
    else {
        var newSumm = summ - summ * discount / 100;
        containerSumm.val(newSumm.toFixed(2));
    }
    var addSum = addCalculateSumm();
    if (addSum !== 0){
        newSumm += addSum;
    }
    newSumm = Math.floor(newSumm/100)*100;
    totallSumm.val(newSumm.toFixed(2));
    oldAmount = jQuery('input[name="addcursamount"]').val()*1;
    total_price.html(newSumm.toFixed(2));
    total_price_phrase.html(number_to_string(newSumm.toFixed(2)));
    var amount_cur = jQuery('input[name="amount_cur"]').val();
    var symbol = jQuery('select[name="currenc"]').val();
    
    var exchange = jQuery('input[name="exchange"]').val();
    var total_price_cur = jQuery('span.curencyAmmount');
    var i_class = "";
    if (symbol !== ""){
        i_class = 'fa-'+symbol;
    }
    if (amount_cur > 0){
        
    }
    if(symbol !== ""){
        if (exchange != 0){
            amount_cur = newSumm / exchange;
            
            }
    }
   
    if (amount_cur > 0){
        total_price_cur.html('( <i class="fa '+i_class+'"></i> '+ amount_cur + ' )');
    }
}
function addCalculateSumm(){
    var addSum = 0;
    if (jQuery('input').is('[name="addcursamount"]')) addSum += jQuery('input[name="addcursamount"]').val() * 1;
  
    if (jQuery('input').is('[name="visaammount"]')) addSum += jQuery('input[name="visaammount"]').val() * jQuery('select[name="visacount"]').val();
   
    if (jQuery('input').is('[name="visaammount"]')) addSum += jQuery('input[name="chvisaammount"]').val() * jQuery('select[name="chvisacount"]').val();
   
    if (jQuery('input').is('[name="inshurout"]')) addSum += jQuery('input[name="inshurout"]').val() * jQuery('select[name="inshuroutcount"]').val();
   
    if (jQuery('input').is('[name="inshuradd"]')) addSum += jQuery('input[name="inshuradd"]').val() * jQuery('select[name="inshuraddcount"]').val();
    
    if (jQuery('input').is('[name="fuelammount"]')) addSum += jQuery('input[name="fuelammount"]').val() * jQuery('select[name="fuelcount"]').val();
  
    addSum += getServiseSum();
    
    return addSum;
}
function getServiseSum(){
    var addServise = 0;
    jQuery('input[name="addserviseamount[]"]').each(function(){
        addServise += jQuery(this).val() * jQuery(this).closest('div.row-fluid').find('[name="addservisecount[]"]').val();
    });
    
    return addServise;
}

function addRoomType(event){
    event.preventDefault();
    
    var container = jQuery('#type_room');
    var select = container.find('select:last');
    var cloneselect = select.clone();
    select.attr('name', 'type_room[]');
    
    cloneselect.attr('id', cloneselect.attr('id')+'-1');
    cloneselect.removeClass('chzn-done');
    cloneselect.val('');

    container.append(cloneselect);
    cloneselect.show();
    container.append('<button class="btn btn-default" onclick="deleteRoomType(event,\''+cloneselect.attr('id')+'\')"><i class="fa fa-times"></i></button>');
    cloneselect.chosen();
    return false;
}

function deleteRoomType(event, id){
    event.preventDefault();
    var chDiv = jQuery('#'+id);
    chDiv.next('button').remove();
    chDiv.remove();
    return false;
}
function addFlite(event, element){
    event.preventDefault();
    var flite = jQuery(element).closest('div.flite');
    var cloneflite = flite.clone();
    var container = flite.parent('div');
    cloneflite.find('label').remove();
    cloneflite.css({marginTop:"0px"});
   
    cloneflite.find('button').remove();
    
    cloneflite.find('select').attr('id', function(){
        
        return jQuery(this).attr('id') + '-' + container.find('div.flite').length;
    });
    cloneflite.find('div.chzn-container').remove();
   cloneflite.find('select.chzn-select').removeClass('chzn-done');
    var name = cloneflite.find('select.chzn-select').attr('name');
    if ( typeof name != 'undefined'){
        
    name = name.split('[')[0];
    name = name+'['+container.find('div.flite').length+'][]';
    cloneflite.find('select.chzn-select').attr('name', name);
        }
    cloneflite.find('input').attr('id', function(){
        
        return jQuery(this).attr('id') + '-' + container.find('div.flite').length;
    });
    cloneflite.find('select').val('');
    cloneflite.find('input').val('');
    cloneflite.find('input.hasDatepicker').removeClass('hasDatepicker');
    flite.parent('div').append(cloneflite);
    jQuery('select.chzn-select').chosen();
    cloneflite.find('.addButtonContainer').append('<button class="btn btn-default del-row-fluid" onclick="deleteFlite(event, this)"><i class="fa fa-times"></i></button>');
    cloneflite.find('.datetimepicker').datetimepicker();
   jQuery('.input-group-addon').on('click', function(){
        jQuery(this).prev('input').focus();
    });
    jQuery('select.listTuristPrice').on('change', function(){
                var price = jQuery(this).closest('div.flite').find('input.ticketprice').val();
                if (price > 0){
                    calculateTicket();
                }
        
    });
    jQuery('input.ticketprice').on('change', function(){
                var price = jQuery(this).val();
                if (price > 0){
                    calculateTicket();
                }
        
    });
    jQuery('.addPayContainer input').on('change', function(){
        calculateSumm(); 
    });
     jQuery('.addPayContainer select').on('change', function(){
        
         if (jQuery(this).hasClass('addServiseCalculate')){
             var container = jQuery(this).closest('div.row-fluid');
             var type = container.find('select[name="addservisetype[]"]').val();
             var listTur = container.find('select.listTurist');
             var option_selected = 0;
                for (var s = 0; s < this.options.length; s++) {
                    var option = this.options[s];
                    if(option.selected) {
                        option_selected++;
                    }
                }
            if (type > 2){
                option_selected = option_selected * 2;
            }
            container.find('[name="addservisecount[]"]').val(option_selected);
           
         }
        calculateSumm(); 
    });
    return false; 
}
function deleteFlite(event, element){
     event.preventDefault();
     jQuery(element).closest('div.flite').empty();
}
function removeTurist(event,id){
    event.preventDefault();
    jQuery('#turist-'+id).remove();
    superIntracePotentials.updateListTuristSelect();
    
}
function deletePayment(event,recordId){
    event.preventDefault();
    var message = app.vtranslate('LBL_DELETE_CONFIRMATION');
		Vtiger_Helper_Js.showConfirmationBox({'message' : message}).then(
			function(e) {
				var module = app.getModuleName();
				var postData = {
					"module": 'SPPayments',
					"action": "DeleteAjax",
					"record": recordId,
					
				}
				var deleteMessage = app.vtranslate('JS_RECORD_GETTING_DELETED');
				var progressIndicatorElement = jQuery.progressIndicator({
					'message' : deleteMessage,
					'position' : 'html',
					'blockInfo' : {
						'enabled' : true
					}
				});
				AppConnector.request(postData).then(
					function(data){
						
						if(data.success) {
							document.getElementById('EditView').submit();
						} else {
                                                    progressIndicatorElement.progressIndicator({
							'mode' : 'hide'
                                                    });
							Vtiger_Helper_Js.showPnotify(data.errors);
						}
					},
					function(error,err){
                                                  progressIndicatorElement.progressIndicator({
							'mode' : 'hide'
						})
					}
                                               
				);
                       
			},
			function(error, err){
			}
		);
	
    
}
function calculateTicket(){
    var ammountTicket = 0;
    jQuery('select.listTuristPrice').each(function(){
        var price = jQuery(this).closest('div.flite').find('input.ticketprice').val();
        if (price > 0){
             var option_selected = 0;
                for (var s = 0; s < this.options.length; s++) {
                    var option = this.options[s];
                    if(option.selected) {
                        option_selected++;
                    }
                }
            ammountTicket += option_selected * price;
        }
    });
    if (ammountTicket > 0){
        jQuery('input[name="cena"]').val(ammountTicket);
     
        calculateSumm(); 
    }
   
}
function SavePayment(event){
    event.preventDefault();
    var type_payment = jQuery('select[name="type_payment"]');
    if (type_payment.val() == ""){
        type_payment.attr('requared', '1');
        type_payment.trigger('list:update');
        alert('выберите "Вид оплаты"');
        type_payment.focus();
        return false;
    }
    var form = jQuery('form[name="QuickCreate"]');
    var params = form.serialize();
    var progressIndicatorElement = jQuery.progressIndicator({
					
					'position' : 'html',
					'blockInfo' : {
						'enabled' : true
					}
				});
    AppConnector.request(params).then(
					function(data){
                                           if(data.success) {
							document.getElementById('EditView').submit();
						} else {
                                                    progressIndicatorElement.progressIndicator({
							'mode' : 'hide'
                                                    });
							Vtiger_Helper_Js.showPnotify(data.errors);
						}
                                        });
    
    
}
function addTurOption(event,type){
    
     event.preventDefault();
     var container = jQuery('#'+type+'-container');
     var index = container.children().length;
     var progressIndicatorElement = jQuery.progressIndicator({
					
					'position' : 'html',
					'blockInfo' : {
						'enabled' : true
					}
				});
     var url = {data :
                                    {
                            module: 'Potentials',
                            action: 'Turoption',
                            index: index,
                            mode: type,
                            
                        }, url : 'index.php', type:'POST', dataType: 'html',};
   
    AppConnector.request(url).then(function(data){
        
                            var addContainer = container.append(data);
                            container.css('background','#eaeaea').css('border','1px solid #ccc');
                            jQuery('select.chzn-select').chosen();
                            superIntracePotentials.updateListTuristSelect();
                            container.find('.datetimepicker').datetimepicker();
                            container.find('.datepicker').datepicker();
                            progressIndicatorElement.progressIndicator({
							'mode' : 'hide'
                                                    });
                            
                        });
     
}
function addPaymentRelated (event,element,id) {
	     event.preventDefault();
            var relatedController = new Vtiger_RelatedList_Js(id, app.getModuleName(), selectedTabElement, relatedModuleName);
			relatedController.addRelatedRecord(element);
		
	}
function number_to_string(_number) {
        var _arr_numbers = new Array();
        _arr_numbers[1] = new Array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', 'десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        _arr_numbers[2] = new Array('', '', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
        _arr_numbers[3] = new Array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
        function number_parser(_num, _desc) {
                var _string = '';
                var _num_hundred = '';
                if (_num.length == 3) {
                        _num_hundred = _num.substr(0, 1);
                        _num = _num.substr(1, 3);
                        _string = _arr_numbers[3][_num_hundred] + ' ';
                }
                if (_num < 20) _string += _arr_numbers[1][parseFloat(_num)] + ' ';
                else {
                        var _first_num = _num.substr(0, 1);
                        var _second_num = _num.substr(1, 2);
                        _string += _arr_numbers[2][_first_num] + ' ' + _arr_numbers[1][_second_num] + ' ';
                }              
                switch (_desc){
                        case 0:
                                var _last_num = parseFloat(_num.substr(-1));
                                if (_last_num == 1) _string += 'рубль';
                                else if (_last_num > 1 && _last_num < 5) _string += 'рубля';
                                else _string += 'рублей';
                                break;
                        case 1:
                                var _last_num = parseFloat(_num.substr(-1));
                                if (_last_num == 1) _string += 'тысяча ';
                                else if (_last_num > 1 && _last_num < 5) _string += 'тысячи ';
                                else _string += 'тысяч ';
                                _string = _string.replace('один ', 'одна ');
                                _string = _string.replace('два ', 'две ');
                                break;
                        case 2:
                                var _last_num = parseFloat(_num.substr(-1));
                                if (_last_num == 1) _string += 'миллион ';
                                else if (_last_num > 1 && _last_num < 5) _string += 'миллиона ';
                                else _string += 'миллионов ';
                                break;
                        case 3:
                                var _last_num = parseFloat(_num.substr(-1));
                                if (_last_num == 1) _string += 'миллиард ';
                                else if (_last_num > 1 && _last_num < 5) _string += 'миллиарда ';
                                else _string += 'миллиардов ';
                                break;
                }
                _string = _string.replace('  ', ' ');
                return _string;
        }
        function decimals_parser(_num) {
                var _first_num = _num.substr(0, 1);
                var _second_num = parseFloat(_num.substr(1, 2));
                var _string = ' ' + _first_num + _second_num;
                if (_second_num == 1) _string += ' копейка';
                else if (_second_num > 1 && _second_num < 5) _string += ' копейки';
                else _string += ' копеек';
                return _string;
        }
        if (!_number || _number == 0) return false;
        if (typeof _number !== 'number') {
                _number = _number.replace(',', '.');
                _number = parseFloat(_number);
                if (isNaN(_number)) return false;
        }
        _number = _number.toFixed(2);
        if(_number.indexOf('.') != -1) {
                var _number_arr = _number.split('.');
                var _number = _number_arr[0];
                var _number_decimals = _number_arr[1];
        }
        var _number_length = _number.length;
        var _string = '';
        var _num_parser = '';
        var _count = 0;
        for (var _p = (_number_length - 1); _p >= 0; _p--) {
                var _num_digit = _number.substr(_p, 1);
                _num_parser = _num_digit +  _num_parser;
                if ((_num_parser.length == 3 || _p == 0) && !isNaN(parseFloat(_num_parser))) {
                        _string = number_parser(_num_parser, _count) + _string;
                        _num_parser = '';
                        _count++;
                }
        }
        if (_number_decimals) _string += decimals_parser(_number_decimals);
        return _string;
}
function packetTurType(){
    jQuery('.addShow').hide();
     jQuery('.blockShow').show();
     jQuery('.turPaket').show();
     
}
jQuery('document').ready(function(){
     var balance_to = jQuery('input[name="balance_to"]').val() * 1;
     jQuery('input#balance_to_dogovor').val(balance_to.toFixed(2));
     var balance = jQuery('input[name="balance"]').val() * 1;
     jQuery('input#balance_dogovor').val(balance.toFixed(2));
     jQuery(".popoverpop").popover();
     jQuery('input[name="pay_to"]').on('change', function(){
         var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
         var paid = jQuery('input[name="paid_to"]').val();
         var newPayTo = jQuery(this).val();
         var newBalance = newPayTo-paid;
         jQuery('input[name="balance_to"]').val(newBalance.toFixed(2));
         jQuery('input#balance_to_dogovor').val(newBalance.toFixed(2));
     });
     
    jQuery('select[name="opportunity_type"]').on('change', function(){
        jQuery('.blockShow').hide();
         jQuery('.addShow').hide();
        var value = jQuery(this).val();
       
        if (value == "Пакетный Тур"){
            jQuery('#turist_label').html('Туристы');
            jQuery('#amount_tur_label').html('Стоимость тура');
            jQuery('#label_total').html('Полная стоимость тура');
            jQuery('#label_total_change').html('Новая стоимость тура');
            jQuery('.width14').css('width','14%');
             jQuery('.width15').css('width','15%');
              jQuery('.width11').css('width','11%');
            packetTurType();
            
        }
        else if (value == "Индивидуальный Тур"){
            jQuery('div.row-fluid:nth-child(19) > div:nth-child(1) > button:nth-child(1) > strong:nth-child(1)').html('Далее');
            jQuery('span.pull-right:nth-child(2) > span:nth-child(1) > button:nth-child(1) > strong:nth-child(1)').html('Далее');
            jQuery('.blockShow').remove();
            jQuery('.addShow').remove();
            jQuery(this).attr('onchange', "this.selectedIndex=4");
        }
        else if (value == "Авиа билеты"){
            jQuery('#turist_label').html('Пассажиры');
            jQuery('#amount_tur_label').html('Стоимость');
            jQuery('#label_total').html('Полная стоимость');
            jQuery('#label_total_change').html('Новая стоимость');
            jQuery('.width14').css('width','11%');
             jQuery('.width15').css('width','11%');
              jQuery('.width11').css('width','6%');
            jQuery('.addShow').hide();
             jQuery('.blockShow').show();
              jQuery('.ticket').show();
              
        }
        else if (value == "ЖД билеты"){
            jQuery('#turist_label').html('Пассажиры');
            jQuery('#amount_tur_label').html('Стоимость');
            jQuery('#label_total').html('Полная стоимость');
            jQuery('#label_total_change').html('Новая стоимость');
            jQuery('.width14').css('width','13%');
             jQuery('.width15').css('width','12%');
              jQuery('.width11').css('width','7%');
            jQuery('.addShow').hide();
            jQuery('.blockShow').show();
            jQuery('.rail').show();
        }
    });
    calculateTicket();
    calculateSumm();
     jQuery('select.listTuristPrice').on('change', function(){
                var price = jQuery(this).closest('div.flite').find('input.ticketprice').val();
                if (price > 0){
                    calculateTicket();
                }
        
    });
    jQuery('input.ticketprice').on('change', function(){
                var price = jQuery(this).val();
                if (price > 0){
                    calculateTicket();
                }
        
    });
    jQuery('input[name="discount"]').on('change',function(){
        var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
       calculateSumm(); 
    });
    jQuery('input[name="addcursamount"]').on('change',function(){
        var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
       calculateSumm(); 
    });
    jQuery('input[name="exchange"]').on('change',function(){
        var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
       calculateSumm(); 
    });
    jQuery('select[name="currenc"]').on('change',function(){
       
       calculateSumm(); 
    });
    jQuery('input[name="cena"]').on('change',function(){
        var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
       calculateSumm(); 
    });
    jQuery('.input-group-addon').on('click', function(){
        
        jQuery(this).prev('input').focus();
    });
    jQuery('.addPayContainer select').on('change', function(){
      
         if (jQuery(this).hasClass('addServiseCalculate')){
             var container = jQuery(this).closest('div.row-fluid');
             var type = container.find('select[name="addservisetype[]"]').val();
             var listTur = container.find('select.listTurist option:selected').length; 
             
            if (type > 2){
                listTur = listTur * 2;
            }
            container.find('[name="addservisecount[]"]').val(listTur);
            
         }
        
        calculateSumm(); 
    
    });
    jQuery('.addPayContainer input').on('change', function(){
         if (jQuery(this).hasClass("datepicker")){
            
        }
        else if (jQuery(this).attr("name")=='booking_no'){
        
        }
        else if (jQuery(this).attr("name")=='control_data'){
        
        }
        else if (jQuery(this).attr("type")=='checkbox'){
        
        }
        
        else {
        var x = parseFloat(this.value.replace(',', '.'));
        jQuery(this).val(x.toFixed(2));
        if(jQuery(this).val() == 'NaN'){
            jQuery(this).val(0.00);
        }
        calculateSumm(); 
    }
    });
    
        
    
    jQuery.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: '<Пред',
	nextText: 'След>',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
	'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
	'Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};

if(jQuery.timepicker){
jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']);


jQuery.timepicker.regional['ru'] = {
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	millisecText: 'Миллисекунды',
	timezoneText: 'Часовой пояс',
	currentText: 'Сейчас',
	closeText: 'Закрыть',
	timeFormat: 'HH:mm',
	amNames: ['AM', 'A'],
	pmNames: ['PM', 'P'],
	isRTL: false
};
    jQuery.timepicker.setDefaults(jQuery.timepicker.regional['ru']);
    jQuery('.datetimepicker').datetimepicker();
    jQuery('.datepicker').datepicker();
}
    jQuery('select[name="visa_status"]').on('change', function(){
        var value = jQuery(this).val();
        if (value === "Виза не нужна"){
            jQuery('#visa_date_container').hide();
        }
        else {
            jQuery('#visa_date_container').show();
        }
    });
    jQuery('.changeExchance').on('change', function(){
        
        changeExchange();
    });
    jQuery('select[name="country"]').on('change', function(){
        var country = jQuery(this).val();
        var resort = jQuery('select[name="resort');
        var params = { 
                    module: "Potentials", 
                    action: "Resort", 
                    country: country, 
                    
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
                                    progressIndicatorInstance.hide();
                                    
					if(data.success === true){
                                  var option = data.result;
                                 
                                  var option_html = '';
                                  for (var key in option){
                                      option_html += '<option value="'+key+'">'+option[key]+'<option>';
                                  }
                                  
                                   resort.html(option_html);    
                                  }
                   })
              
        
    });
    jQuery('.suumTurOption').on('change', function(){
        var ammount = 0;
        jQuery('.suumTurOption').each(function(){
            ammount += jQuery(this).val()*1;
        });
        jQuery('#Potentials_editView_fieldName_cena').val(ammount);
    });
    
});
function getResorts(id){
     var country = jQuery('#ind_source_name_'+id).val();
        var resort = jQuery('#ind_source_resort_'+id);
        var params = { 
                    module: "Potentials", 
                    action: "Resort", 
                    country: country, 
                    
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
                                    progressIndicatorInstance.hide();
                                    
					if(data.success === true){
                                  var option = data.result;
                                 
                                  var option_html = '';
                                  for (var key in option){
                                      option_html += '<option value="'+key+'">'+option[key]+'<option>';
                                  }
                                  
                                   resort.html(option_html);    
                                  }
                   })
}
function validDate(elem){
    var actualDate = new Date(jQuery('#dataDogovora').val());
    var a = jQuery(elem).val().split('.');
    
    var b = a[2].split(' ');
    var firstDate=new Date();
    firstDate.setFullYear(b[0],(a[1] - 1 ),a[0]);
    if (firstDate < actualDate){
        
        jQuery(elem).css('borderColor','red');
       
        
        return false;
    }
    else {
        jQuery(elem).css('borderColor','rgb(204,204,204)');
         return false;
    }

}
function validDate2(elem){
    var actualDate = new Date(jQuery('#dataDogovora').val());
    
    var c = jQuery(elem).closest('.width14').prev().prev().find('input').val().split('.');
    console.log(c);
    var d = c[2].split(' ');
    var a = jQuery(elem).val().split('.');
   
    var b = a[2].split(' ');
    var dateDeparture = new Date();
    dateDeparture.setFullYear(d[0],(c[1] - 1 ),c[0]);
    var firstDate=new Date();
    firstDate.setFullYear(b[0],(a[1] - 1 ),a[0]);
     console.log(dateDeparture);
    console.log(actualDate);
    if (firstDate < actualDate){
        
        jQuery(elem).css('borderColor','red');
       
        
        return false;
    }
     if (firstDate < dateDeparture){
         jQuery(elem).css('borderColor','red');
       
        
        return false;
     }
  
        jQuery(elem).css('borderColor','rgb(204,204,204)');
         return false;
   

}
function sendMail(e, id, contact, type){
    e.preventDefault();
    var params = {module: 'Potentials',
		view: "SendDocuments",
		record: id,
                mode: sendMail,
                type: type,
                contactID:contact,
	};
       
	AppConnector.request(params).then(
					function(data) {
						
					});
}

function editTurist(e,recordId){
    e.preventDefault();
    var params = { 
                    module: "Contacts", 
                    view: "QuickCreateAjax", 
                    record: recordId, 
                    
                }
    var progressIndicatorInstance = jQuery.progressIndicator({});
            AppConnector.request(params).then(
				function(data){
					if(data){
                                            var param = {data:data, css:{'top':"100px"}};
                        progressIndicatorInstance.hide();
                        app.showModalWindow(param, function(){
                            jQuery('.datepicker').datepicker();
                        });
                    }
                });
    
                
    
}
function printDogovor(){
    var record = jQuery('input[name="record"]').val();
    var params = { 
                    module: "Potentials", 
                    action: "PrintMode", 
                    record: record,
                    mode: "printDogovor",
                    
                }
                AppConnector.request(params).then(
				function(data){
				window.location.reload();	
                   
                });
}
function printDopDogovor(){
    var record = jQuery('input[name="record"]').val();
    var params = { 
                    module: "Potentials", 
                    action: "PrintMode", 
                    record: record,
                    mode: "printDopnik",
                    
                }
                AppConnector.request(params).then(
				function(data){
				window.location.reload();	
                   
                });
}
function changePaytoVendor(elem,vendor){
    elem = jQuery(elem);
    var oldPayto = jQuery('#payto_vendor_old_'+vendor).val();
    var newPayto = elem.val();
    var oldBalance = jQuery('#balance_vendor_'+vendor).val();
    var delta = newPayto - oldPayto;
    var n_balanse = oldBalance + delta;
    jQuery('#balance_vendor_'+vendor).val(n_balanse);
    changeSummPayto();
}
function changeSummPayto() {
    var newPayto = 0;
    var newBalance = 0;
    jQuery('.payto_vendor_input').each(function () {
        var vendor = jQuery(this).data('vendor');
        newPayto += (jQuery(this).val() * 1);
        newBalance += (jQuery('#balance_vendor_' + vendor).val() * 1);
    });
    jQuery('#payto_all_vendor').val(newPayto);
    jQuery('#balance_all_vendor').val(newBalance);

}
function changeStartCurs() {
    var record = jQuery('input[name="record"]').val();
    var currenc = jQuery('select[name="currenc"]').val();
    var exchange = jQuery('input[name="newexchange"]').val();
    var params = {
        module: "Potentials",
        action: "ChangeCurency",
        record: record,
        currenc: currenc,
        exchange:exchange,


    }
    AppConnector.request(params).then(
        function(data){
            window.location.reload();

        });

}