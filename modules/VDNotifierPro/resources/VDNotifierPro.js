/* * *******************************************************************************
 * The content of this file is subject to the Notificator Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is http://www.vordoom.net
 * Portions created by Vordoom.net are Copyright(C) Vordoom.net
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class('VDNotifierPro_Basic_Js',{},{
	//stores the module that need to be searched
	container : false,
	sound: true,
        message: true,
	ajax: 1,
        time:15000,
        demo:'',
        
        title : document.title,
        alert: '!!!New Notifier for you!!!',
        timer:false,
        
	
	/**
	 * Function to get the search module
	 */
        start : function(){
            //var self = this;
           
            if (this.container === false){
                var self = this;
                var metka = $('#headerLinksBig');
                metka.prepend(this.getHeader(self));
                this.container = $('#VDNotifierPro');
                var sound = '';
                var message = '';
                
                if (this.sound == true) sound = 'checked="checked"';
                if (this.message == true) message = 'checked="checked"';
                var content = '<div class="row-fluid" id="VDNotifierSetting"><h5>Setting</h5>';
                        content += '<div class="span4"><div><b>Sound:</b></div><br /><div><b>Message:</b></div></div>';
                        content += '<div class="span2"><div><input type="checkbox" name="sound" '+sound+' onchange="saveSetting(this)" /></div>';
                        content +='<br /><div><input type="checkbox" name="message" '+message+' onchange="saveSetting(this)" /></div></div><a class="pull-right" onclick="VDNotifierSetting(event)" href="#">Close</a></div>';
                        
                $('#VDNotifierProSettingContainer').prepend(content);
                $('ul.dropdown-menu.VDNotifierPro-ul').live('click', function(event){
                       
                        $(this).parent().toggleClass('open')
                });
            }
            //console.log(this);
            
            
        },
        set : function(name, value){
            this[name] = value;
        },
        setSetting : function(data){
            
            this.sound = data.sound;
            this.message = data.message;
            this.ajax = data.ajax;
            this.time = data.time;
            if (data.demo){
                this.demo = data.demo;
            }
           
        },
        getHeader : function(self) {
            
            return '<span id="VDNotifier" class="dropdown span settingIcons">'+
                    '<a id="VDNotifierPro" class="dropdown-toggle" data-toggle="dropdown" href="#">'+
                    '<img src="modules/VDNotifierPro/resources/bell.png" alt="VDNotifier" title="VDNotifier"><span id="rowVDNotifier"></span></a>'+
                    '<ul class="dropdown-menu VDNotifierPro-ul">'+
                    '<div id="VDNotifierProHeader"><div class="row-fluid"><div class="span12"><div class="pull-left"><h5>Notification</h5></div>'+
                    '<div class="pull-right"><a id="notifieProClean" onclick="VDNotifierClean(event)" ><i class="icon-trash alignMiddle"></i></a><a id="notifieProSetting" onclick="VDNotifierSetting(event)"><i class="icon-wrench alignMiddle"></i></a>'+
                    '</div></div></div><hr /><div id="VDNotifierProContainer"></div><div id="VDNotifierProSettingContainer"></div></div></div><div class="footerVDNotifier">'+self.demo+'</div></ul><audio><source src="modules/VDNotifierPro/resources/beep.mp3"></source><source src="modules/VDNotifierPro/resources/beep.ogg"></source><audio></audio></span>';
        },
        
        run : function() {
            var self = this;
            var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'getVDNotifier'
               };
           
            AppConnector.request(postData).then(function(data){
               
                if (data.success){
                    var row = data.result;
                    self.getContent(row);
                }
            });
        },
        changeValue: function(elem){
            var self = this;
            var name = elem.attr('name');
            var moduleId = elem.data('module');
            if (name == 'status'){
                
                var value = this.changeAllBox(elem);
            }
            else if (elem.prop("checked")) {
                $('input[data-module="'+moduleId+'"][name="status"]').attr('checked','checked');
                 var value = 1;
            }
            else {
                var value = 0;
            }
           
             var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'setSeting',
                'field': name,
                'value': value,
                'moduleId': moduleId,
                
               };
            AppConnector.request(postData).then(function(data){
                
            });
            
        },
        getContent : function(row){
            var container = $('#VDNotifierProContainer');
           
            if (row.length > 0){
                var i = row.length;
                var alarm = 0;
                $('#rowVDNotifier').html(i);
                for (key in row){
                    if (row[key].type == 'Reminder'){
                        if (this.checkVDNotifierPopander(row[key].id)){
                            if(row[key].status != 5){
                                 if (this.sound){
                                    alarm ++;
                                    }
                                }
                                    var content = '<div class="row-fluid" id="VDNotifierPopunder-'+row[key].id+'">';
                                    content += '<div class="span2"><img src="'+row[key].modiImg+'" class="summaryImg"></div>';
                                    content += '<div class="span9"><div class="header"><b>'+row[key].modiName+'</b> <span>'+row[key].action+'</span> ';
                                    content += '<span>'+row[key].module+' - <span></div><div class="title"><a href="index.php?'+row[key].link+'" >';
                                    content += row[key].title + '</a></div><div class="VDNotifierTime">'+row[key].modifiedtime+'</div></div>';
                                    content += '<div class="span1"><a class="deleteVDNotifier" onclick="deleteVDPopunder(event,'+row[key].id+')" >x</a><a class="btn pull-right" onclick="VDPostpone(event,'+row[key].id+')">'+row[key].Postponed+'</a></div>';
                                    content += '</div><hr id="VDNotifierPopunder-'+row[key].id+'-hr"/>';
                        container.prepend(content);
                         if(row[key].status != 5){
                        if (alarm < 4){
                            if (this.message){
                                        var params = {
						title : '<span>'+row[key].action+'</span> <span>'+row[key].module+'</span>',
						text: '<a onclick="changeVDPopunder(event,'+row[key].id+');" class="closePopup"></a><a href="index.php?'+row[key].link+'" onclick="jQuery(this).closest(\'div.ui-pnotify-container\').find(\'span.icon-remove\').trigger(\'click\')">'+row[key].title+'</a><a class="btn pull-right" onclick="VDPostpone(event,'+row[key].id+');jQuery(this).closest(\'div.ui-pnotify-container\').find(\'span.icon-remove\').trigger(\'click\')">'+row[key].Postponed+'</a>',
						animation: 'show',
						type: 'info',
                                                hide: false,
					};
                                        Vtiger_Helper_Js.showPnotify(params);
                                    }
                        }               
                    }
                        }
                        
                   
                    }
                    
                    else if (this.checkVDNotifierId(row[key].id)){
                        if(row[key].status != 5){
                        if (this.sound){
                           alarm ++;
                        }
                    }
                        var content = '<div class="row-fluid" id="VDNotifierMessage-'+row[key].id+'">';
                        content += '<div class="span2"><img src="'+row[key].modiImg+'" class="summaryImg"></div>';
                        content += '<div class="span9"><div class="header"><b>'+row[key].modiName+'</b> <span>'+row[key].action+'</span> ';
                        content += '<span>'+row[key].module+' - <span></div><div class="title"><a href="index.php?'+row[key].link+'" >';
                        content += row[key].title + '</a></div><div class="VDNotifierTime">'+row[key].modifiedtime+'</div></div>';
                        content += '<div class="span1"><a class="changeVDNotifier" onclick="deleteVDNotifier(event,'+row[key].id+')" >x</a></div>';
                        content += '</div><hr id="VDNotifierMessage-'+row[key].id+'-hr"/>';
                        container.prepend(content);
                        if(row[key].status != 5){
                        if (alarm < 4){
                            if (this.message){
                                        var params = {
						title : row[key].modiName+' <span>'+row[key].action+'</span> <span>'+row[key].module+'</span>',
						text: '<a onclick="changeVDNotifier(event,'+row[key].id+');" class="closePopup"></a><a href="index.php?'+row[key].link+'" onclick="jQuery(this).closest(\'div.ui-pnotify-container\').find(\'span.icon-remove\').trigger(\'click\')">'+row[key].title+'</a>',
						animation: 'show',
						type: 'info',
                                                hide: false,
					};
                                        Vtiger_Helper_Js.showPnotify(params);
                                    }
                        }               
                    }
                }
                }
                
                if (alarm > 0){
                    var audio = document.getElementsByTagName("audio")[0];
                    audio.play();
                    

            
                    titleAlert(this);
                }
            }
            else {
                $('#rowVDNotifier').html('');
            }
            return;
        },
        titleAlert: function() {
            var r = this.alert;
            var t = document.title;
           
            if(t != r) {
		document.title = r;
            }
            else {
		document.title = this.title;
            }
            return;
        },
        checkVDNotifierId : function(id){
            if ($('div').is('#VDNotifierMessage-'+id)){
                return false;
            }
            else {
            return true;
        }
        },
        checkVDNotifierPopander : function(id){
            if ($('div').is('#VDNotifierPopunder-'+id)){
                return false;
            }
            else {
            return true;
        }
        },
        changeAllBox : function(elem){
            var moduleId = elem.data('module');
            if (elem.prop("checked")){
                $('input[data-module="'+moduleId+'"]').attr('checked','checked');
                return 1;
            }
            else {
                $('input[data-module="'+moduleId+'"]').removeAttr('checked');
                return 0;
            }
            
        }
            
        });
	


var $VDNotifierPro;

jQuery(document).ready(function(){
   
    jQuery('body').on('click', '.ui-pnotify-closer .icon-remove', function(){
        jQuery(this).closest('div.ui-pnotify-container').find('a.closePopup').trigger('click');
    });
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'setting'
                    };
                 AppConnector.request(postData).then(function(data){
                      if (data.success){
                          $VDNotifierPro = new VDNotifierPro_Basic_Js();
                          $VDNotifierPro.setSetting(data.result);
                          $VDNotifierPro.start();
                          runVDNotifier($VDNotifierPro);
                      }
                 });
    
    
    $('.VDNotifierProInput').bind('click', function(){
                
                $VDNotifierPro.changeValue($(this));
          });
     $('[data-toggle="tooltips"]').tooltip();
    $('.saveSetting').on('click', function(){
        var a = 0;
        if ($('#ajaxVDNotifier').prop("checked")){
         a = 1;
        }
        var k = $('#keyVDNotifier').val();
        var t = $('#ajaxTime').val();
        var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'setSetingGlob',
                'a': a,
                't': t,
                'k': k,
                
                
               };
            AppConnector.request(postData).then(function(data){
                
            });
    return false;
    });
    $('.installDomen').on('click', function(){
        
        var k = $('#keyVDNotifier');
        if ( k.val(). length != 12 ){
            alert ('Key incorect');
            return false;
        }
        var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'installDomen',
                'k': k.val(),
                
                
               };
            AppConnector.request(postData).then(function(data){
                                        var params = {
						title : data.result.title,
						text: data.result.text,
						animation: 'show',
						type: data.result.type,
					};
                                        Vtiger_Helper_Js.showPnotify(params);
                                        if (data.result.type == 'info'){
                                            window.location.reload();
                                        }
                
            });
    return false;
    });
    $('.deleteDomen').on('click', function(){
        
        var k = $('#keyVDNotifier');
        var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'deleteDomen',
                'k': k.val(),
                
                
               };
            AppConnector.request(postData).then(function(data){
                                        var params = {
						title : data.result.title,
						text: data.result.text,
						animation: 'show',
						type: data.result.type,
					};
                                        Vtiger_Helper_Js.showPnotify(params);
                                        if (data.result.type == 'info'){
                                            window.location.reload();
                                        }
                
            });
    return false;
    });
    
    
});
function deleteVDNotifier (e, id){
     e.stopPropagation();
    
     var i = parseInt($('#rowVDNotifier').text())-1;
     if (i == 0) i='';
     if (i == 'NaN') i='';
     $('#rowVDNotifier').html(i);
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'deleteVDNotifier',
                'id': id
            };
     AppConnector.request(postData);
      $('#VDNotifierMessage-'+id).remove();
     $('#VDNotifierMessage-'+id+'-hr').remove();
     return true;
     
}
function changeVDNotifier (e, id){
     e.stopPropagation();
    
     
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'changeVDNotifier',
                'id': id
            };
     AppConnector.request(postData);
     
     return true;
     
}
function deleteVDPopunder (e, id){
     e.stopPropagation();
     
     var i = parseInt($('#rowVDNotifier').text())-1;
     if (i == 0) i='';
     if (i == 'NaN') i='';
     $('#rowVDNotifier').html(i);
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'deleteVDPopunder',
                'id': id
            };
     AppConnector.request(postData);
     $('#VDNotifierPopunder-'+id).remove();
     $('#VDNotifierPopunder-'+id+'-hr').remove();
     return true;
     
}
function changeVDPopunder (e, id){
     e.stopPropagation();
     
     
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'changeVDPopunder',
                'id': id
            };
     AppConnector.request(postData);
     
     return true;
     
}
function VDPostpone (e, id){
     e.stopPropagation();
     
     var i = parseInt($('#rowVDNotifier').text())-1;
     if (i == 0) i='';
     if (i == 'NaN') i='';
     $('#rowVDNotifier').html(i);
     var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'postpone',
                'id': id
            };
     AppConnector.request(postData);
     $('#VDNotifierPopunder-'+id).remove();
     $('#VDNotifierPopunder-'+id+'-hr').remove();
     return true;
     
}
function VDNotifierSetting(e){
    e.stopPropagation();
    $('#VDNotifierProContainer').toggle('fast')
    $('#VDNotifierProSettingContainer').toggle('fast')    
       
}
function VDNotifierClean(e){
    e.stopPropagation();
    var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'cleanMessage',
               };
            AppConnector.request(postData).then(function(data){
                 if (data.success){
                    $('#VDNotifierProContainer').html(''); 
                    $('#rowVDNotifier').html('');
                 }
            });
}
function runVDNotifier(obj){
    obj.run()
    if ($VDNotifierPro.ajax == 1){
     setTimeout(function(){
         runVDNotifier (obj)
     },$VDNotifierPro.time);}
    
}


function saveSetting(cont){
    
    var elem = $(cont);
    var name = elem.attr('name');
    var value = 0;
    if (elem.prop("checked")){
        value = 1;
    }
    $VDNotifierPro.set(name,value);
    var postData = {
                'action': 'ActivityVDNotifier',
                'module' : 'VDNotifierPro',
                'mode': 'setSetingUser',
                'field': name,
                'value': value,
                
                
               };
            AppConnector.request(postData).then(function(data){
                
            });
    return false;
}
function titleAlert(obj){
            if (focus === true) {
                clearTimeout(obj.timer);
                document.title = obj.title;
            };

            if (focus === false) {
               obj.titleAlert();
                obj.timer = setTimeout(function(){
                titleAlert(obj)
                    },1000);
            };
    
 }
 var focus = true;
 $(function() {
           

            $(window).bind('focus', function() {
                focus = true;
                
            });

            $(window).bind('blur', function() {
                focus = false;
                
            });
        });