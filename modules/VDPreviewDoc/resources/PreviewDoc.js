var VDPreviewDoc_Js = {
    token:'',  
    registerDoc : function(){
       var self = VDPreviewDoc_Js;
       var content_list = $('td[data-field-type="documentsFileUpload"]');
       for (var i = 0; i<content_list.length; i++){
           var element = $(content_list[i]);
           
           var preview = $(content_list[i]).attr('rel');
           
                $(content_list[i]).attr('rel','preview');
                var a = element.children('a');
				if (a){
					var href = a.attr('href');
					if (href){
					var click = a.attr('onclick');
					
				
                var filename = a.text();
           
                if (filename.length > 18){
                        var cat_filename = filename.substring(0,17)+"…";
                    a.text(cat_filename);
                }
                element.append('<span>'+self.downloadIcon(content_list[i],click, href) + self.previewIcon(content_list[i], href)+'</span>');
					}
				}
            
			
       }
    },
    registerDocWidget : function(){
       var self = VDPreviewDoc_Js;
       var content_list = $('span#DownloadableLink');
       for (var i = 0; i<content_list.length; i++){
           var preview = $(content_list[i]).attr('rel');
           if (!preview){
           $(content_list[i]).attr('rel','preview');
           var element = $(content_list[i]);
           var a = element.children('a[onclick^="Javascript:"]');
           var click = a.attr('onclick');
           var href = a.attr('href');
           var filename = a.text();
           var width = element.width();
          
           var maxCh = parseInt((width - 10)/8);
          
           var filename = a.text();
                if (filename.length > maxCh){
                     filename = filename.substring(0,maxCh-1)+"…";
                    a.text(filename);
                }
           
           element.prepend(self.downloadIcon(content_list[i],click, href) + self.previewIcon(content_list[i], href));
            }
       }
    },
    registerDocHome : function(){
       var self = VDPreviewDoc_Js;
       var content_list = $('.dashboardWidget a[href^="index.php?module=Documents&view=Detail"]');
       if (content_list.length > 0){
        for (var i = 0; i<content_list.length; i++){
            var element = $(content_list[i]).parent('div');
            var a = $(content_list[i]);
            
            var preview = a.attr('rel');
            if (!preview){
                a.attr('rel','preview');
                var href = a.attr('href');
                var width = element.width();
                var maxCh = parseInt((width - 45)/8);
                var filename = element.attr('title');
                if (filename.length > maxCh){
                     filename = filename.substring(0,maxCh-1)+"…";
                    
                }
                element.html(self.downloadIconHome(content_list[i], href) + self.previewIconHome(content_list[i], href)+ filename).prepend(a);
            }
        }
    }
    },
    downloadIcon : function(element,click,href){
        element = $(element);
        
        return '<a class="PreviewDoc" onclick="'+click+'" href="'+href+'" title="Download"><i class="alignMiddle icon-download-alt" title="Download"></i></a>';
    },
     downloadIconHome : function(element,href){
         var self = VDPreviewDoc_Js;
        element = $(element);
        var parseLink = self.parseLink(href);
        href =  "index.php?module=VDPreviewDoc&action=DownloadFile&record="+parseLink.record;
        return '<a class="PreviewDocHome" onclick="VDPreviewDoc_Js.DownloadFile(event);return false;" href="'+href+'" title="Download"><i class="alignMiddle icon-download-alt" title="Download"></i></a>';
    },
    previewIcon : function(element, href){
        var self = VDPreviewDoc_Js;
        element = $(element);
        var data = self.parseLink(href);
       
        href = 'index.php?module=VDPreviewDoc&action=Preview&'+data.url+'';
        return '<a class="PreviewDoc" data-record="'+data.record+'" data-fileid="'+data.fileid+'" onclick="VDPreviewDoc_Js.eventPreviewFile(event);return false;" href="'+href+'" title="Preview"><i class="alignMiddle icon-picture" title="Preview"></i></a>';
    },
     previewIconHome : function(element, href){
        var self = VDPreviewDoc_Js;
        element = $(element);
        var data = self.parseLink(href);
       
        href = 'index.php?module=VDPreviewDoc&action=Preview&'+data.url+'';
        return '<a class="PreviewDoc" data-record="'+data.record+'" onclick="VDPreviewDoc_Js.eventPreviewFile(event);return false;" href="'+href+'" title="Preview"><i class="alignMiddle icon-picture" title="Preview"></i></a>';
    },
    parseLink : function(href){
        href =  href.split('?');
        href = href[1];
        href = href.split('&');
        var record, fileid;
        for (var i=0; i< href.length; i++){
            var _href = href[i];
            _href = _href.split('=');
            if (_href[0]==='record'){
                record = _href[1];
            }
            if (_href[0]==='fileid'){
                fileid = _href[1];
            }
        }
        var _return = {'url':'record='+record+'&fileid='+fileid, 'record':record, 'fileid':fileid};
        return _return ;
    },
    eventPreviewFile : function(e){
        var self = VDPreviewDoc_Js;
	e.stopPropagation();
        e.preventDefault();
	var obj = jQuery(e.currentTarget);
        
        self.checkType(obj);
        
    },
    checkType: function(obj){
         var self = VDPreviewDoc_Js;
        var post ={ "data":{module:"VDPreviewDoc",action:"CheckType",fileid:obj.data('fileid'),record:obj.data('record')}, dataType : 'json'};
        AppConnector.request(post).then(function(responce){
            
              if (responce.success === true){
                  var type = responce.result.type;
                  if (type == "MS"){
                      var dataType = "json";
                      var show = responce.result.show;

                  }
                  else {
                      var dataType = "html";
                  }
                  var post ={ "data":{'module':"VDPreviewDoc",'action':"Preview",'fileid':obj.data('fileid'),'record':obj.data('record'),'type':type}, "dataType" : dataType};
                  AppConnector.request(post).then(function(data){
                      if (type == "MS"){
                          if (show == "SHOW"){
                                bootbox.confirm('<div"><h5> ' +
                                                'Preview of MS Office docs launching through https://view.officeapps.live.com' + 
                                                '</h5></div><div > <br /> ' +
                                                '<input type="checkbox" onclick="VDPreviewDoc_Js.showWarning(this)" /><label style="display:inline;margin-left:3px">' +
                                                'Don`t show again' + 
                                                '</label><br /></div>', 
                                                function(result){
                                                    if (result === true){
                                                        self.previewMS(data.result);
                                                    }
                        
                                                });
                           }
                           else {
                                self.previewMS(data.result);
                            }
                        }
                      else {
                          var popUp={"data":data,"css":{"width":"85%","height":"auto"}};
                          app.showModalWindow(popUp);
                      }
                  });
              }
              else {
                   var _params = {
				title : 'Error',
				text: responce.error.message,
				animation: 'show',
				type: 'error'}
                    Vtiger_Helper_Js.showPnotify(_params);
              }
        });
        
    },
    previewMS : function(link){
        
            var ws = parseInt(jQuery(window).width()*0.85);
            var hs = parseInt(jQuery(window).height()*0.85);
            var parametr = "menubar=no,toolbar=no,location=no,directories=no,resizable=yes,scrollbars=yes,width="+ws+",height="+hs;
            var c = window.open(link, 'MS', parametr);
            c.focus();
    },
    showWarning: function(element) {
        var self = VDPreviewDoc_Js;
        if(jQuery(element).prop("checked")){
                  self.saveDontShowWarning();
           }
           else {
                  self.saveShowWarning();
           }
    },
     saveShowWarning : function() {
        post ={ "data":{module:"VDPreviewDoc",action:"Setting", show:"SHOW", dataType : 'json'}};
         AppConnector.request(post);
    },
    saveDontShowWarning : function() {
        post ={ "data":{module:"VDPreviewDoc",action:"Setting", show:"NONE", dataType : 'json'}};
         AppConnector.request(post);
    },
}


$(document).ready(function(){
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    var module = jQuery('#module').val();
    var view = jQuery('#view').val();
    var relatedModule = jQuery('input[name="relatedModuleName"]').val();
    
    if (module === "Home"){
        jQuery('.dashboardWidget').on(Vtiger_Widget_Js.widgetPostLoadEvent, function() {
			 VDPreviewDoc_Js.registerDocHome();
		});
       jQuery('.dashboardWidget').on(Vtiger_Widget_Js.widgetPostRefereshEvent, function() {
			 VDPreviewDoc_Js.registerDocHome();
		});
    }
    else if (module === "Documents"){
       if (view === "List"){
           VDPreviewDoc_Js.registerDoc();
           var target = document.querySelector('#listViewContents');
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    
                     VDPreviewDoc_Js.registerDoc();
           });
       });
        var config = { childList: true };
        observer.observe(target, config);
       }
    }
    
    else if (relatedModule === "Documents") {
         VDPreviewDoc_Js.registerDoc();
          var target = document.querySelector('.contents');
           var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                   
                     VDPreviewDoc_Js.registerDoc();
                     if (jQuery("div").is(".widgetContainer_documents")){
        
        
     jQuery('.widget_contents').on("Vtiger.Widget.PostLoad", function() {
                           
			 VDPreviewDoc_Js.registerDocWidget();
		});
            }
           });
       });
        var config = { childList: true };
        observer.observe(target, config);
         
    }
    else {
        if (jQuery("div").is(".contents")){
        var target = document.querySelector('.contents');
        var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    
                     VDPreviewDoc_Js.registerDoc();
                      if (jQuery("div").is(".widgetContainer_documents")){
        
        
     jQuery('.widget_contents').on("Vtiger.Widget.PostLoad", function() {
                           
			 VDPreviewDoc_Js.registerDocWidget();
		});
            }
           });
       });
        var config = { childList: true };
        observer.observe(target, config);
        }
    }
    if (jQuery("div").is(".widgetContainer_documents")){
        
        
     jQuery('.widget_contents').on("Vtiger.Widget.PostLoad", function() {
                           
			 VDPreviewDoc_Js.registerDocWidget();
		});
            }
            
    
});
