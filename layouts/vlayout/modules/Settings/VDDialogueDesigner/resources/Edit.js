/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
Settings_Vtiger_Edit_Js("Settings_VDColorList_Edit_Js",{

    instance : {}

},{

    currentInstance : false,

    colorListContainer : false,

    init : function() {
        this.initiate();
    },

    /**
     * Function to get the container which holds all the colorList elements
     * @return jQuery object
     */
    getContainer : function() {
        return this.colorListContainer;
    },

    /**
     * Function to set the reports container
     * @params : element - which represents the colorList container
     * @return : current instance
     */
    setContainer : function(element) {
        this.colorListContainer = element;
        return this;
    },


    /**
     * Function to return the instance based on the step of the colorList
     */
    getInstance : function(step) {
        if(step in Settings_VDColorList_Edit_Js.instance ){
            return Settings_VDColorList_Edit_Js.instance[step];
        } else {
            var moduleClassName = 'Settings_VDColorList_Edit'+step+'_Js' ;
            Settings_VDColorList_Edit_Js.instance[step] =  new window[moduleClassName]();
            return Settings_VDColorList_Edit_Js.instance[step]
        }
    },

    /**
     * Function to get the value of the step
     * returns 1 or 2 or 3
     */
    getStepValue : function(){
        var container = this.currentInstance.getContainer();
        return jQuery('.step',container).val();
    },

    /**
     * Function to initiate the step 1 instance
     */
    initiate : function(container){
        if(typeof container == 'undefined') {
            container = jQuery('.colorListContents');
        }
        if(container.is('.colorListContents')) {
            this.setContainer(container);
        }else{
            this.setContainer(jQuery('.colorListContents',container));
        }
        this.initiateStep('1');
        this.currentInstance.registerEvents();
    },

    /**
     * Function to initiate all the operations for a step
     * @params step value
     */
    initiateStep : function(stepVal) {
        var step = 'step'+stepVal;
        this.activateHeader(step);
        var currentInstance = this.getInstance(stepVal);
        this.currentInstance = currentInstance;
    },

    /**
     * Function to activate the header based on the class
     * @params class name
     */
    activateHeader : function(step) {
        var headersContainer = jQuery('.crumbs ');
        headersContainer.find('.active').removeClass('active');
        jQuery('#'+step,headersContainer).addClass('active');
    },

    /**
     * Function to register the click event for next button
     */
    registerFormSubmitEvent : function(form) {
        var thisInstance = this;
        if(jQuery.isFunction(thisInstance.currentInstance.submit)){
            form.on('submit',function(e){
                var form = jQuery(e.currentTarget);
                var specialValidation = true;
                if(jQuery.isFunction(thisInstance.currentInstance.isFormValidate)){
                    var specialValidation =  thisInstance.currentInstance.isFormValidate();
                }
                if ( form.validationEngine('validate') && specialValidation) {
                    thisInstance.currentInstance.submit().then(function(data){
                        thisInstance.getContainer().append(data);
                        var stepVal = thisInstance.getStepValue();
                        var nextStepVal = parseInt(stepVal) + 1;
                        thisInstance.initiateStep(nextStepVal);
                        thisInstance.currentInstance.initialize();
                        var container = thisInstance.currentInstance.getContainer();
                        thisInstance.registerFormSubmitEvent(container);
                        thisInstance.currentInstance.registerEvents();
                    });

                }
                e.preventDefault();
            })
        }
    },

    back : function(){
        var step = this.getStepValue();
        var prevStep = parseInt(step) - 1;
        this.currentInstance.initialize();
        var container = this.currentInstance.getContainer();
        var colorListRecordElement = jQuery('[name="record"]',container);
        var colorListId = colorListRecordElement.val();
        container.remove();
        this.initiateStep(prevStep);
        var currentContainer = this.currentInstance.getContainer();
        currentContainer.show();
        jQuery('[name="record"]',currentContainer).val(colorListId);
        var modulesList = jQuery('#moduleName',currentContainer);
        if(modulesList.length > 0 && colorListId != '') {
            modulesList.attr('disabled','disabled').trigger('liszt:updated');
        }
    },

    getPopUp : function(container) {
        var thisInstance = this;
        if(typeof container == 'undefined') {
            container = thisInstance.getContainer();
        }
        container.on('click','.getPopupUi',function(e) {
            var fieldValueElement = jQuery(e.currentTarget);
            var fieldValue = fieldValueElement.val();
            var fieldUiHolder  = fieldValueElement.closest('.fieldUiHolder');
            var valueType = fieldUiHolder.find('[name="valuetype"]').val();
            if(valueType == '') {
                valueType = 'rawtext';
            }
            var conditionsContainer = fieldValueElement.closest('.conditionsContainer');
            var conditionRow = fieldValueElement.closest('.conditionRow');

            var clonedPopupUi = conditionsContainer.find('.popupUi').clone(true,true).removeClass('popupUi').addClass('clonedPopupUi')
            clonedPopupUi.find('select').addClass('chzn-select');
            clonedPopupUi.find('.fieldValue').val(fieldValue);
            if(fieldValueElement.hasClass('date')){
                clonedPopupUi.find('.textType').find('option[value="rawtext"]').attr('data-ui','input');
                var dataFormat = fieldValueElement.data('date-format');
                if(valueType == 'rawtext') {
                    var value = fieldValueElement.val();
                } else {
                    value = '';
                }
                var clonedDateElement = '<input type="text" class="row-fluid dateField fieldValue span4" value="'+value+'" data-date-format="'+dataFormat+'" data-input="true" >'
                clonedPopupUi.find('.fieldValueContainer').prepend(clonedDateElement);
            } else if(fieldValueElement.hasClass('time')) {
                clonedPopupUi.find('.textType').find('option[value="rawtext"]').attr('data-ui','input');
                if(valueType == 'rawtext') {
                    var value = fieldValueElement.val();
                } else {
                    value = '';
                }
                var clonedTimeElement = '<input type="text" class="row-fluid timepicker-default fieldValue span4" value="'+value+'" data-input="true" >'
                clonedPopupUi.find('.fieldValueContainer').prepend(clonedTimeElement);
            } else if(fieldValueElement.hasClass('boolean')) {
                clonedPopupUi.find('.textType').find('option[value="rawtext"]').attr('data-ui','input');
                if(valueType == 'rawtext') {
                    var value = fieldValueElement.val();
                } else {
                    value = '';
                }
                var clonedBooleanElement = '<input type="checkbox" class="row-fluid fieldValue span4" value="'+value+'" data-input="true" >';
                clonedPopupUi.find('.fieldValueContainer').prepend(clonedBooleanElement);

                var fieldValue = clonedPopupUi.find('.fieldValueContainer input').val();
                if(value == 'true:boolean' || value == '') {
                    clonedPopupUi.find('.fieldValueContainer input').attr('checked', 'checked');
                } else {
                    clonedPopupUi.find('.fieldValueContainer input').removeAttr('checked');
                }
            }
            var callBackFunction = function(data) {
                data.find('.clonedPopupUi').removeClass('hide');
                var moduleNameElement = conditionRow.find('[name="modulename"]');
                if(moduleNameElement.length > 0){
                    var moduleName = moduleNameElement.val();
                    data.find('.useFieldElement').addClass('hide');
                    data.find('[name="'+moduleName+'"]').removeClass('hide');
                }
                app.changeSelectElementView(data);
                app.registerEventForDatePickerFields(data);
                app.registerEventForTimeFields(data);
                thisInstance.postShowModalAction(data,valueType);
                thisInstance.registerChangeFieldEvent(data);
                thisInstance.registerSelectOptionEvent(data);
                thisInstance.registerPopUpSaveEvent(data,fieldUiHolder);
                thisInstance.registerRemoveModalEvent(data);
                data.find('.fieldValue').filter(':visible').trigger('focus');
            }
            conditionsContainer.find('.clonedPopUp').html(clonedPopupUi);
            jQuery('.clonedPopupUi').on('shown', function () {
                if(typeof callBackFunction == 'function'){
                    callBackFunction(jQuery('.clonedPopupUi',conditionsContainer));
                }
            });
            jQuery('.clonedPopUp',conditionsContainer).find('.clonedPopupUi').modal();
        });
    },

    registerRemoveModalEvent : function(data) {
        data.on('click','.closeModal',function(e) {
            data.modal('hide');
        });
    },

    registerPopUpSaveEvent : function(data,fieldUiHolder) {
        jQuery('[name="saveButton"]',data).on('click',function(e){
            var valueType = jQuery('.textType',data).val();

            fieldUiHolder.find('[name="valuetype"]').val(valueType);
            var fieldValueElement = fieldUiHolder.find('.getPopupUi');
            if(valueType != 'rawtext'){
                fieldValueElement.removeAttr('data-validation-engine');
                fieldValueElement.removeClass('validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]');
            }else{
                fieldValueElement.addClass('validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]');
                fieldValueElement.attr('data-validation-engine','validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]');
            }
            var fieldType = data.find('.fieldValue').filter(':visible').attr('type');
            var fieldValue = data.find('.fieldValue').filter(':visible').val();
            //For checkbox field type, handling fieldValue
            if(fieldType == 'checkbox'){
                if(data.find('.fieldValue').filter(':visible').is(':checked')) {
                    fieldValue = 'true:boolean';
                } else {
                    fieldValue = 'false:boolean';
                }
            }
            fieldValueElement.val(fieldValue);
            data.modal('hide');
            fieldValueElement.validationEngine('hide');
        });
    },

    registerSelectOptionEvent : function(data) {
        jQuery('.useField,.useFunction',data).on('change',function(e){
            var currentElement = jQuery(e.currentTarget);
            var newValue = currentElement.val();
            var oldValue  = data.find('.fieldValue').filter(':visible').val();
            if(currentElement.hasClass('useField')){
                if(oldValue != ''){
                    var concatenatedValue = oldValue+' '+newValue;
                } else {
                    concatenatedValue = newValue;
                }
            } else {
                concatenatedValue = oldValue+newValue;
            }
            data.find('.fieldValue').val(concatenatedValue);
            currentElement.val('').trigger('liszt:updated');
        });
    },

    registerChangeFieldEvent : function(data) {
        jQuery('.textType',data).on('change',function(e){
            var valueType =  jQuery(e.currentTarget).val();
            var useFieldContainer = jQuery('.useFieldContainer',data);
            var useFunctionContainer = jQuery('.useFunctionContainer',data);
            var uiType = jQuery(e.currentTarget).find('option:selected').data('ui');
            jQuery('.fieldValue',data).hide();
            jQuery('[data-'+uiType+']',data).show();
            if(valueType == 'fieldname') {
                useFieldContainer.removeClass('hide');
                useFunctionContainer.addClass('hide');
            } else if(valueType == 'expression') {
                useFieldContainer.removeClass('hide');
                useFunctionContainer.removeClass('hide');
            } else {
                useFieldContainer.addClass('hide');
                useFunctionContainer.addClass('hide');
            }
            jQuery('.helpmessagebox',data).addClass('hide');
            jQuery('#'+valueType+'_help',data).removeClass('hide');
            data.find('.fieldValue').val('');
        });
    },

    postShowModalAction : function(data,valueType) {
        if(valueType == 'fieldname') {
            jQuery('.useFieldContainer',data).removeClass('hide');
            jQuery('.textType',data).val(valueType).trigger('liszt:updated');
        } else if(valueType == 'expression') {
            jQuery('.useFieldContainer',data).removeClass('hide');
            jQuery('.useFunctionContainer',data).removeClass('hide');
            jQuery('.textType',data).val(valueType).trigger('liszt:updated');
        }
        jQuery('#'+valueType+'_help',data).removeClass('hide');
        var uiType = jQuery('.textType',data).find('option:selected').data('ui');
        jQuery('.fieldValue',data).hide();
        jQuery('[data-'+uiType+']',data).show();
    },

    /**
     * Function to register the click event for back step
     */
    registerBackStepClickEvent : function(){
        var thisInstance = this;
        var container = this.getContainer();
        container.on('click','.backStep',function(e){
            thisInstance.back();
        });
    },

    registerEvents : function(){
        var form = this.currentInstance.getContainer();
        this.registerFormSubmitEvent(form);
        this.registerBackStepClickEvent();
    }
});

Settings_VDColorList_Edit_Js("Settings_VDColorList_Edit1_Js",{},{
       
        relatedModulesMapping  : false,
        secondaryModulesContainer : false,
	init : function() {
		this.initialize();
	},

	/**
	 * Function to get the container which holds all the reports step1 elements
	 * @return jQuery object
	 */
	getContainer : function() {
		return this.step1Container;
	},

	/**
	 * Function to set the reports step1 container
	 * @params : element - which represents the reports step1 container
	 * @return : current instance
	 */
	setContainer : function(element) {
		this.step1Container = element;
		return this;
	},
        /*
	 * Function to get the secondary module container 
	 */
	getSecondaryModuleContainer  : function(){
		if(this.secondaryModulesContainer == false){
			this.secondaryModulesContainer = jQuery('#secondary_module'); 
		}
		return this.secondaryModulesContainer;
	},
        /**
	 * Function which will save the related modules mapping
	 */
	intializeOperationMappingDetails : function() {
		this.relatedModulesMapping = jQuery('#relatedModules').data('value');
	},
        /**
	 * Function which will return set of condition for the given field type
	 * @return array of conditions
	 */
	getRelatedModulesFromPrimaryModule : function(primaryModule){
                
		return this.relatedModulesMapping[primaryModule];
	},
        loadRelatedModules : function(primaryModule){
               
		var relatedModulesMapping = this.getRelatedModulesFromPrimaryModule(primaryModule);
		var options = '';
		for(var key in relatedModulesMapping) {
			//IE Browser consider the prototype properties also, it should consider has own properties only.
			if(relatedModulesMapping.hasOwnProperty(key)) {
				options += '<option value="'+key+'">'+relatedModulesMapping[key]+'</option>';
			}
		}
                
		var secondaryModulesContainer = this.getSecondaryModuleContainer();
		secondaryModulesContainer.html(options).trigger("change");
		
	},
	registerPrimaryModuleChangeEvent : function(){
		var thisInstance = this;
		jQuery('#primary_module').on('change',function(e){
			var primaryModule = jQuery(e.currentTarget).val();
			thisInstance.loadRelatedModules(primaryModule);
		});
	},
	/**
	 * Function which will register the select2 elements for secondary modules selection
	 */
	registerSelect2ElementForSecondaryModulesSelection : function() {
		var secondaryModulesContainer = this.getSecondaryModuleContainer();
		app.changeSelectElementView(secondaryModulesContainer, 'select2', {maximumSelectionSize: 2});
	},
	/**
	 * Function  to initialize the reports step1
	 */
	initialize : function(container) {
		if(typeof container == 'undefined') {
			container = jQuery('#colorList_step1');
		}
		if(container.is('#colorList_step1')) {
			this.setContainer(container);
		}else{
			this.setContainer(jQuery('#colorList_step1'));
		}
                this.intializeOperationMappingDetails();
	},

	submit : function(){
		var aDeferred = jQuery.Deferred();
		var form = this.getContainer();
		var formData = form.serializeFormData();
		var progressIndicatorElement = jQuery.progressIndicator({
			'position' : 'html',
			'blockInfo' : {
				'enabled' : true
			}
		});
		AppConnector.request(formData).then(
			function(data) {
				form.hide();
				progressIndicatorElement.progressIndicator({
					'mode' : 'hide'
				});
				aDeferred.resolve(data);
			},
			function(error,err) {
			}
		);
		return aDeferred.promise();
	},
	
	registerEvents : function(){
                 this.registerPrimaryModuleChangeEvent();
		this.registerSelect2ElementForSecondaryModulesSelection();
		var container = this.getContainer();
		
		//After loading 1st step only, we will enable the Next button
		container.find('[type="submit"]').removeAttr('disabled');
		
		var opts = app.validationEngineOptions;
		// to prevent the page reload after the validation has completed
		opts['onValidationComplete'] = function(form,valid) {
            //returns the valid status
            return valid;
        };
		opts['promptPosition'] = "bottomRight";
		container.validationEngine(opts);
	}
});

Settings_VDColorList_Edit_Js("Settings_VDColorList_Edit2_Js",{}, {

    step2Container : false,

    advanceFilterInstance : false,

    init : function() {
        this.initialize();
    },

    /**
     * Function to get the container which holds all the reports step1 elements
     * @return jQuery object
     */
    getContainer : function() {
        return this.step2Container;
    },

    /**
     * Function to set the reports step1 container
     * @params : element - which represents the reports step1 container
     * @return : current instance
     */
    setContainer : function(element) {
        this.step2Container = element;
        return this;
    },

    /**
     * Function  to intialize the reports step1
     */
    initialize : function(container) {
        if(typeof container == 'undefined') {
            container = jQuery('#colorList_step2');
        }
        if(container.is('#colorList_step2')) {
            this.setContainer(container);
        }else{
            this.setContainer(jQuery('#colorList_step2'));
        }
    },

    calculateValues : function(){
		//handled advanced filters saved values.
		var advfilterlist = this.advanceFilterInstance.getValues();
		jQuery('#advanced_filter').val(JSON.stringify(advfilterlist));
	},

    submit : function(){
        var aDeferred = jQuery.Deferred();
        var form = this.getContainer();
        this.calculateValues();
        var formData = form.serializeFormData();
        jQuery.progressIndicator({
            'position' : 'html',
            'blockInfo' : {
                'enabled' : true
            }
        });
        AppConnector.request(formData).then(
            function(data) {
                window.history.back();
            },
            function(error,err) {

            }
        );
        return aDeferred.promise();
    },

    registerEnableFilterOption : function() {
        jQuery('[name="conditionstype"]').on('change',function(e) {
            var advanceFilterContainer = jQuery('#advanceFilterContainer');
            var currentRadioButtonElement = jQuery(e.currentTarget);
            if(currentRadioButtonElement.hasClass('recreate')) {
                if(currentRadioButtonElement.is(':checked')) {
                    advanceFilterContainer.removeClass('zeroOpacity');
                }
            } else {
                advanceFilterContainer.addClass('zeroOpacity');
            }
        });
    },




    registerEvents : function(){
        var opts = app.validationEngineOptions;
        // to prevent the page reload after the validation has completed
        opts['onValidationComplete'] = function(form,valid) {
            //returns the valid status
            return valid;
        };
        opts['promptPosition'] = "bottomRight";
        jQuery('#colorList_step2').validationEngine(opts);

        var container = this.getContainer();
        jQuery('button[type="submit"]',container).on('click',function(e) {
            var fieldUiHolders = jQuery('.fieldUiHolder')
            for(var i=0; i<fieldUiHolders.length;i++){
                var fieldUiHolder  = fieldUiHolders[i];
                var fieldValueElement = jQuery('.getPopupUi',fieldUiHolder);
                var valueType = jQuery('[name="valuetype"]',fieldUiHolder).val();
                if(valueType != 'rawtext'){
                    fieldValueElement.removeAttr('data-validation-engine');
                    fieldValueElement.removeClass('validate[funcCall[Vtiger_Base_Validator_Js.invokeValidation]]');
                }
            }
        });
        app.changeSelectElementView(container);
        this.advanceFilterInstance = Vtiger_AdvanceFilter_Js.getInstance(jQuery('.filterContainer',container));
        this.getPopUp();
        if(jQuery('[name="filtersavedinnew"]',container).val() == '5') {
            this.registerEnableFilterOption();
        }
    }
});