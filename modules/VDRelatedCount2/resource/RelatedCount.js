/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vordoom.net
 * The Initial Developer of the Original Code is vordoom.net.
 * All Rights Reserved.
 * If you have any questions or comments, please email: support@vordoom.net
 ************************************************************************************/
 
var VDRelatedCount_Js = {
    module: jQuery('input[name="module"]').val(),
    record: jQuery('#recordId').val(),
    getRelatedCount: function(){
        var self = VDRelatedCount_Js;
        var relatedList = jQuery('.related ul li');
        var data = [];
        var i = 0
        var comment = false;
        var comment_id = 0;
        var history = false;
        var history_id = 0;
       relatedList.each(function(){
       
           var li = jQuery(this);
           var url = li.data('url');
           url = self.parseLink(url);
          
           if (url.mode == 'showRelatedList'){
               var params={};
                        params['record'] = self.record;
                        params['action'] = 'RelationAjax';
                        params['module'] = self.module;
                        params['relatedModule'] = url.relatedModule;
                        params['mode'] = 'getRelatedListPageCount';
              AppConnector.request(params).then(function(result){
              
              if (result.success){
                  if(li.find('.VDRelatedCount').length){
						li.find('.VDRelatedCount').text("("+result.result.numberOfRecords+")");
					}else{
                                        	li.find('a').append(" <span class='VDRelatedCount'>("+result.result.numberOfRecords+")</span>");
					}
                      
                      
                    
                  }
              
              
                }); 
              
           }
		   else if (url.mode == 'showAllComments'){
                       comment = true;
              comment_id = i;
           }
           else if (url.mode == 'showRecentActivities'){
               history = true;
               history_id = i;
           }
        i++; 
       });
       var params = {data:{module:"VDRelatedCount2",action:"RelatedCount", data:{data:data, module:self.module, record:self.record}, dataType : 'json'}};
         AppConnector.request(params).then(function(result){
              
              if (comment){
              var _result = result.result['comment'];
                     if($(relatedList[comment_id]).find('.VDRelatedCount').length){
						$(relatedList[comment_id]).find('.VDRelatedCount').text("("+_result+")");
					}else{
                                        	$(relatedList[comment_id]).find('a').append(" <span class='VDRelatedCount'>("+_result+")</span>");
					}
                                    };
               if (history){                      
              var _result = result.result['history'];
               if($(relatedList[history_id]).find('.VDRelatedCount').length){
						$(relatedList[history_id]).find('.VDRelatedCount').text("("+_result+")");
					}else{
                                        	$(relatedList[history_id]).find('a').append(" <span class='VDRelatedCount'>("+_result+")</span>");
					}
                                    }       
              
         }); 
    },
    parseLink: function(url){
        url = url.split('&');
        var _url = {};
        for(var i = 0; i<url.length;i++){
            var a = url[i].split('=');
            if (a[0] == 'mode'){
                _url.mode = a[1];
            }
            else if (a[0] == 'relatedModule'){
                _url.relatedModule = a[1];
            }
            else if (a[0] == 'tab_label'){
                _url.tab_label = a[1];
            }
        }
         return (_url); 
    },
};

$(document).ready(function(){
    
    if ($('div').is('.detailViewInfo')){
        VDRelatedCount_Js.getRelatedCount();
        var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
        var target = document.querySelector('.contents');
         var observer = new MutationObserver(function(mutations) {
             mutations.forEach(function(mutation) {
                    
                     VDRelatedCount_Js.getRelatedCount();
           });
         });
         var config = { childList: true };
            observer.observe(target, config);
        
    }
   
});