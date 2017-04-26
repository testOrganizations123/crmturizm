/**/
function sendRelTo(id,type,relto)
{
	var userto=0;
	var channelto=0;
	
	if (type=="user")
	{
		userto=id;
	}
	else
	{
		channelto=id;
	}
	var message=$("#reltomessage").val();
	$.ajax({
		url:'?module=VChat&action=Commander&mode=saveMessage&message='+encodeURI(message)+'&userto='+userto+'&channelto='+channelto+"&relto="+relto,
		success: function(data) 
		{
			closeDialogGeneral(id,type);
			viewalert();
		}
	});
}

function answerDialogGeneral(id,textmes,type,recorid)
{
	$(".callpanelVChat").css("display","block");
	$("#addDataVHat #containerAddDataVHat").html('<input type="hidden" id="reltoid" value='+id+' /><div class="containeranswer" style="margin-top:15px;margin-bottom:15px;">'+textmes+'</div><textarea id="reltomessage" style="height:100px;"></textarea><input type="button" onclick="sendRelTo('+id+',\''+type+'\',\''+recorid+'\')" value="Отправить ответ" /> <input type="button" onclick="viewalert()" value="Вернуться назад" />');
}

function closePanelVChat()
{
	$("#addDataVHat").remove();
	$(".callpanelVChat").css("display","none");
	$(".panelVChatChannel").css("display","none");
	$("#TB_overlay").css("display","none");
	
}

function loadSubMes(id)
{
	$.ajax({
		url:'?module=VChat&view=GetDataVChat&mode=loadMes&id='+id,
		success: function(data) 
		{
			var mes=data.result.htmlchat;
			mes="<div style=''><div style='text-align:left'><a href='# return false' onclick='viewalert()'>Назад</a></div><hr>"+mes+"</div>"
			mes=mes+"<div style='text-align:center'><a href='# return false'>Закрыть и отетить как прочитанное</a></div>";
			$("#addDataVHat #containerAddDataVHat").html(mes);
			//alert(data);
		}
	});	
}


function closeDialogGeneral(record,type)
{
	$.ajax({
		url:'?module=VChat&action=Commander&mode=closeDialog&record='+record+'&type='+type,
		success: function(data) 
		{
			$("#req"+record).remove();
		}
	});
}

function viewalert()
{
	var type="";
	var answer="";
	var addmes="";
	var listchat="";
	$(".callpanelVChat").css("display","block");
	$(".callpanelVChat").html("<div id='addDataVHat' style=' overflow:auto; padding:10px;background:#f3f8f9;position:absolute;width:400px;min-height:100px;max-height:500px;margin-left:-350px;margin-top:20px;border:1px solid #CCC;'><div style='margin-top:-10px;text-align:right'><a href='# return false' onclick='closePanelVChat()'>Закрыть</a></div><div id='containerAddDataVHat'><div style='padding:100px;'><img src='layouts/vlayout/modules/VChat/img/load.gif' style='text-align:center' width='60px' /></div></div>");
	$.ajax({
		url:'?module=VChat&view=GetDataVChat&mode=uploadCallMes',
		success: function(data) 
		{
			var mes=data.result.htmllistcall;
			for (var i=1;i<=mes.countel;i++)
			{
				type=mes.type[i];
				var answer='<br><div style="text-align:right"><a href="javascript:answerDialogGeneral('+mes.recoridfrom[i]+',\''+mes.userchat[i]+'\',\''+type+'\',\''+mes.mesid[i]+'\');">Ответить</a> | <a href="javascript:closeDialogGeneral('+mes.recoridfrom[i]+',\''+mes.type[i]+'\');">Пометить как прочитанное</a></div>';
				
				if (mes.countmes[i]>1)
				{
					
					addmes="<a href='javascript:loadSubMes("+mes.recorid[i]+")'>Еще: "+mes.countmes[i]+" сообщений</a>";
					
					listchat=listchat+"<div id='req"+mes.recoridfrom[i]+"' ><div><b>"+mes.fromuser[i]+"</b> "+mes.time[i]+"</div><div>"+mes.userchat[i]+"<div>"+addmes+"</div>"+answer+"<hr></div></div>";
				
				}
				else
				{
					addmes="<a href='javascript:loadSubMes("+mes.recorid[i]+")'>Еще: "+mes.countmes[i]+" сообщений</a>";
					
					listchat=listchat+"<div id='req"+mes.recoridfrom[i]+"' ><div  ><b>"+mes.fromuser[i]+"</b> "+mes.time[i]+"</div><div>"+mes.userchat[i]+"<div>"+addmes+"</div>"+answer+" <hr></div></div>";
				
				}
			}
			//<div style='margin-top:-10px;text-align:right'><a href='# return false' onclick='closePanelVChat()'>Закрыть</a></div>
			listchat="<div style='text-align:left'>"+listchat+"</div><div stle='text-align:center'><a href='?module=VChat&view=List' >Перейти в чат</a></div>";
			$("#addDataVHat #containerAddDataVHat").html(listchat);
		}
	});
	/**/
}

function updateCallVChat()
{
	$.ajax({
		url:'?module=VChat&view=GetDataVChat&mode=SearchCall',
		success: function(data) 
		{
			var mes=data.result.htmllistcall;
			if (mes.view_channels==1)
			{
				if (!document.getElementById("checkCallVChat"))
				{
					$("#headerLinks").prepend("<span id='audioplay'></span><div onclick='viewalert()' id='checkCallVChat' style='cursor:pointer; background: red;padding: 3px;  margin-bottom: 0px; float:left;margin-right:15px;margin-top:4px;width:5px;height:5px; border-radius: 5px;' class='radiusHeaderVChat'></div><div class='callpanelVChat'></div>");
				}	
				// alert(mes.alertpanel);
				//(!document.getElementById("addDataVHat"))&&
				if ((mes.alertpanel==1))
				{
					if (!document.getElementById("addDataVHat"))
					{
						viewalert();
					}
					
				}
				
			}
			else
			{
				if (document.getElementById("checkCallVChat"))
				{
					$("#checkCallVChat").remove();
				}
			}
			//
			if (mes.audioncheck==1)
			{
				$("#audioplay").html("<audio autoplay><source src='/layouts/vlayout/modules/VChat/audio/vk.mp3'><source src='vk.mp3'></source></audio>");
				
			}
			/**/
				
		}
	});
}
//updateCallVChat();
setInterval(updateCallVChat, 30000);
/**/