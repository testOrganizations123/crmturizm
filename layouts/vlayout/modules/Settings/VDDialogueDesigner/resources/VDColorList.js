/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: Vordoom.net
 * The Initial Developer of the Original Code is Vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/

jQuery.Class("VDColorList_Js",{},{

    records : null,

    registerEventsForListView : function() {
        if(!this.validListData()) return;

        var aDeferred = jQuery.Deferred();
        var viewName = app.getViewName();
        var thisInstance = this;
        var records = [];
        var params = {};

        jQuery('.listViewEntries').each(function() {
            records.push(jQuery(this).attr('data-id'));
        });

        if(!records.length) return;

        params['module'] = 'VDColorList';
        params['action'] = 'ColorListRow';
        if(viewName == 'List') {
            params['current_module'] = app.getModuleName();
        }
        if(viewName == 'Detail') {
            params['current_module'] = jQuery('.relatedModuleName').val();
        }
        params['records'] = records;
        AppConnector.request(params).then(
            function(data) {
                if(data.success) {
                    if(data.result) {
                        thisInstance.records = data.result;
                        thisInstance.setBackgroundColor();
                    }
                }
                aDeferred.resolve(data);
            },

            function(error) {
                aDeferred.reject(error);
            }
        );
        return aDeferred.promise();
    },

    validListData : function() {
        var viewName = app.getViewName();

        // List view
        if(viewName == 'List') {
            if(jQuery('#listViewContents .listViewEntriesTable tr.listViewEntries').length > 0) {
                this.listViewContainer = jQuery('#listViewContents');
                return true;
            }
        }

        // Related list view
        if(viewName == 'Detail') {
            if(jQuery('.relatedContents .listViewEntriesTable tr.listViewEntries').length > 0) {
                this.listViewContainer = jQuery('.relatedContainer');
                return true;
            }
        }

        return false;
    },

    setBackgroundColor : function() {
        for(var index in this.records) {
            var color = this.records[index];
            jQuery('.listViewEntriesTable').find('tr[data-id='+index+']').css('background-color', color);
        }
    },

    registerEvents : function() {
        this.registerEventsForListView();
    }
});

jQuery(document).ready(function() {
    var ColorListInstance  =  new VDColorList_Js();
    ColorListInstance.registerEvents();
    app.listenPostAjaxReady(function() {
        var ColorListInstance  =  new VDColorList_Js();
        ColorListInstance.registerEvents();
    });
});