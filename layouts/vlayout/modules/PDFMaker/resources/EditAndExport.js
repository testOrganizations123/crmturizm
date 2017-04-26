/*********************************************************************************
 * The content of this file is subject to the EMAIL Maker license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

jQuery.Class("PDFMaker_EditAndExport_Js",{

    },{
    formElement : false,
    templatesElements : {}, 
    getForm : function(){
        if(this.formElement == false){
                this.setForm(jQuery('#editPDFForm'));
        }
        return this.formElement;
    },
    setForm : function(element){
        this.formElement = element;
        return this;
    },   

    SavePDFToDoc : function(EditContainer){  
            
            var thisInstance = this;
            
            var form = thisInstance.getForm();
            var SavePDFUrl = form.serializeFormData();
                  
            if (SavePDFUrl["notes_title"] == ''){
                    var alert_label = jQuery('#alert_doc_title').html();
                    alert(alert_label);
                    return false;
            } else {
            
                    jQuery.each(thisInstance.templatesElements,function(index, value){
                        SavePDFUrl[index] = value.getData();
                    });            
            
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position' : 'html',
                        'blockInfo' : {
                            'enabled' : true
                        }
                    });
                    
                    AppConnector.request(SavePDFUrl).then(
                            function(data) {
                                    thisInstance.HideDocSettings(EditContainer);
                                    var response = data['result'];
                                    var result = response['success'];

                                    if(result == true){
                                        type_r = 'info';
                                    } else {
                                        type_r = 'error';
                                    }

                                    var params = {
                                    text: response['message'],
                                    type: type_r
                                    };

                                    progressIndicatorElement.progressIndicator({'mode':'hide'});
                                    Vtiger_Helper_Js.showMessage(params); 
                            },
                            function(error,err){

                            }
                    );  
            }
    },
        
    HideDocSettings : function(EditContainer) {
            var thisInstance = this;
            jQuery('#docSettings').hide();
            jQuery('#editTemplate').show();
            jQuery('[name="action"]', EditContainer).val("CreatePDFFromTemplate");
    },    
        
    registerHideDocSettings : function(EditContainer){
            var thisInstance = this;
            
            EditContainer.find('.cancelDocDiv').on('click', function(e){
                thisInstance.HideDocSettings(EditContainer);
                return false;
            })
    },

    registerSaveIntoDoc : function(EditContainer){
            var thisInstance = this;
            
            EditContainer.find('.saveIntoDoc').on('click', function(e){
                thisInstance.SavePDFToDoc(EditContainer);
                return false;
            })
    },

    registerCKEditor : function(){
            var thisInstance = this;
            
            var templateids =  jQuery('[name="commontemplateid"]').val();
            
            var templateidsarray = templateids.split(';');
            for(index=0; index<templateidsarray.length; index++) {
                var templateid = templateidsarray[index];
                thisInstance.templatesElements['body' + templateid] = CKEDITOR.replace('body' + templateid , {height: '300'});
                thisInstance.templatesElements['header' + templateid] = CKEDITOR.replace('header' + templateid , {height: '300'});
                thisInstance.templatesElements['footer' + templateid] = CKEDITOR.replace('footer' + templateid , {height: '300'});
            }
    },



    registerEvents : function(){
            var thisInstance = this;
            var EditContainer = jQuery('#composePDFContainer');
            thisInstance.registerHideDocSettings(EditContainer);
            thisInstance.registerSaveIntoDoc(EditContainer);
            thisInstance.registerCKEditor();
    }
});  


jQuery(document).ready(function(e){
	var instance = new PDFMaker_EditAndExport_Js();
	instance.registerEvents();
})
