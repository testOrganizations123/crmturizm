    /*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

function newSuggections(elem){
    var data = jQuery(elem).data();
    var suggestions = gQ
    var params = { 
                    module: "Suggestions", 
                    view: "QuickCreateAjax", 
                    suggestions: data.name,
                    category: data.category,
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