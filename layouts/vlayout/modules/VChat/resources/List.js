var startupdate=0;
var next=3000;


function getInfo()
{
	
}

function selectMenu()
{
	$('#optionchat').css("display","block");
}


function closeOption()
{
	$('#optionchat').css("display","none");
}


function getPassword()
{
	$.ajax({
		url:'?module=VChat&view=getPassword',
		success: function(data) 
		{
			$("#GetPassword").html(data);
		}
	});
}


function closeDialog(userChannelTo,type)
{
	$.ajax({
		url:'?module=VChat&view=closeDialog&userto='+userChannelTo+'&type='+type,
		success: function(data) 
		{
			if (type=="channel")
			{
				$(".channel"+userChannelTo+" .badge").css("display","none");
			}
			else
			{
				$(".user"+userChannelTo+" .badge").css("display","none");
			}
		}
	});
}


function closePanelVChat2()
{
	if (document.getElementById("uniqid").value>0)
	{
		selectChannel($("#uniqid").val(),$("#uniqidnamechannel").val(),'',0);
	}
	$("#TB_overlay").css("display","none");
	$(".panelVChatChannel").css("display","none");
	$(".rowVChat").css("display","none");
	$(".rowVChatButton").css("display","none");
	$(".inputloaduserVChat").css("display","none");
	$("#containerUserVChat").html("");
	$("#selectuser").css("display","none");
}

function closePanelVChat()
{
	$("#TB_overlay").css("display","none");
	$(".panelVChatChannel").css("display","none");
	$(".rowVChat").css("display","none");
	$(".rowVChatButton").css("display","none");
	$(".inputloaduserVChat").css("display","none");
	$("#containerUserVChat").html("");
	$("#selectuser").css("display","none");
	
	
}

function getUserVChat(word,channel,type)
{
	//alert(channel);
	var listUser="";
	$.ajax({
		url:'?module=VChat&action=Commander&mode=getUserList&word='+word+'&subfolder='+channel,
		success: function(data) 
		{
			if (data.result.success==true)
			{
				var htmluserlist=data.result.htmluser;
					for (var i=0;i<=htmluserlist.userid.length-1;i++)
					{
						if (htmluserlist.consist[i]==1)
						{
							listUser=listUser+'<div class="selectuserclass" id="userselect'+htmluserlist.userid[i]+'">  '+htmluserlist.username[i]+' [Добавлен] </div>';
						}
						else
						{
							listUser=listUser+'<div id="userselect'+htmluserlist.userid[i]+'"><a href="# return false"  onclick="selectUserForChannel('+htmluserlist.userid[i]+','+channel+')">'+htmluserlist.username[i]+'</a></div>';
						}
					}
				$("#userListVChat").html(listUser);
			}
		}
	});
}

function openeVChatNameChannel(channel,param)
{
	$("#TB_overlay").css("display","block");
	$(".panelVChatChannel").css("display","block");
	
	
	$("#userListVChat").html("");
	
	if (param=="change")
	{
		$(".rowVChat").css("display","none");
		$(".rowVChatButton").css("display","none");
		$(".inputloaduserVChat").css("display","none");	
		$("#uniqid").val(channel);
		$("#uniqidnamechannel").val($("#nameVChannel").val());
		getUserVChat("",channel);
		
	}
	else
	if (param=="new")
	{
		if (channel==0)
		{
			$("#uniqidnamechannel").val("");
			$("#uniqid").val("");
			$("#subchanel").val("");	
		}
		$(".rowVChat").css("display","block");
		$(".rowVChatButton").css("display","block");
		$(".inputloaduserVChat").css("display","none");	
		$("#containerUserVChat").html("");
	}
	else
	{
		$(".rowVChat").css("display","none");
		$(".rowVChatButton").css("display","none");
		$(".inputloaduserVChat").css("display","none");	
		$("#containerUserVChat").html("");
		var word="";
		getUserVChat(word,channel);
	}
	
	if (channel>0)
	{
		$("#subchanel").val(channel);
	}
}


function loaduserforchannel(channelid)
{	$.ajax({
			url:'?module=VChat&action=Commander&mode=addChannel&namechannel='+$("#nameVChannel").val()+'&channelid='+channelid,
			success: function(data) 
			{
				/*jjjj
				$("#selectuser").css("display","block");
				$(".inputloaduserVChat").css("display","block");
				var strdata=jQuery.parseJSON(data);
				var htmluserlist=data.result.htmluser;
				
				//data.result.getUniqueID
				
				$("#uniqid").val(data.result.getUniqueID);
				$("#uniqidnamechannel").val($("#nameVChannel").val());
				//
				/**/
				for (var i=0;i<=htmluserlist.username.length-1;i++)
				{
					listUser=listUser+'<div id="userselect'+htmluserlist.userid[i]+'">'+htmluserlist.username[i]+' [ <span class="currenuserlistadd_'+htmluserlist.userid[i]+'"><a href="# return false"   onclick="selectUserForChannel('+htmluserlist.userid[i]+','+data.result.getUniqueID+')"> Добавить </a> </span> ] </div>';
				}
				$("#containerUserVChat").html(listUser);
			}
	});
}

function saveVChatNameChannel()
{
	$(".rowVChat").css("display","none");
	$(".rowVChatButton").css("display","none");
	var listUser="";
	var subFolder=$("#subchanel").val();	
	//alert(subFolder)
	$("#containerUserVChat").html("<div style='padding:100px;'><img src='layouts/vlayout/modules/VChat/img/load.gif' style='text-align:center' width='60px' /></div>");
	//alert('?module=VChat&action=Commander&mode=addChannel&namechannel='+$("#nameVChannel").val()+'&subfolder='+subFolder);
	$.ajax({
			url:'?module=VChat&action=Commander&mode=addChannel&subfolder='+subFolder+'&namechannel='+$("#nameVChannel").val(),
			success: function(data) 
			{
				if (subFolder==0)
				{
					
					selectChannel(data.result.getUniqueID,$("#nameVChannel").val(),'',0);
					closePanelVChat2();
				}
				else
				{
					$("#selectuser").css("display","block");
					$(".inputloaduserVChat").css("display","block");
					var strdata=jQuery.parseJSON(data);
					var htmluserlist=data.result.htmluser;
					
					//data.result.getUniqueID
					
					$("#uniqid").val(data.result.getUniqueID);
					$("#uniqidnamechannel").val($("#nameVChannel").val());
					//
					
					for (var i=0;i<=htmluserlist.username.length-1;i++)
					{
						listUser=listUser+'<div id="userselect'+htmluserlist.userid[i]+'">'+htmluserlist.username[i]+' [ <span class="currenuserlistadd_'+htmluserlist.userid[i]+'"><a href="# return false"   onclick="selectUserForChannel('+htmluserlist.userid[i]+','+data.result.getUniqueID+')"> Добавить </a> </span> ] </div>';
					}
					$("#containerUserVChat").html(listUser);
				}
			}
	});
}

function selectUserForChannel(id, uniqueID,type)
{
	
	$(".currenuserlistadd_"+id).html("Добавлено");
	$("#userselect"+id).addClass("selectuserclass");
	$.ajax({
		url:'?module=VChat&action=Commander&mode=addUsertChannel&namechannel='+uniqueID+"&userforchannel="+id,
		success: function(data) 
		{
			if (data.result.success==true)
			{
				//$("#currenuserlistadd_"+id).html('<a href="# return false" onclick="selectUserForChannel('+id+', '+uniqueID+')">Отменить</a>');
			}
			else
			{
				/*
				if (confirm('Удалить?')) {
					//alert('Удалено');
				} else {
					// Do nothing!
				}
				/**/
				//selectChannel($("#listChannelTo").val(),$("#toUserVchat").html(),'',0); //
				
				uploadsubdata($("#listChannelTo").val());
				
				//alert("Удалить?");
			}
			
		}
	});
	
	//$("#userselect"+id).addClass("selectuserclass");
	
	/*
	if (type!=1)
	{
		$("#userselect"+id).addClass("selectuserclass");
	}
	else
	{
		$("#userselect"+id).removeClass("selectuserclass");
		$("#userselectdel"+id).remove();
	}
	
	
	$.ajax({
		url:'?module=VChat&action=Commander&mode=addUsertChannel&namechannel='+uniqueID+"&userforchannel="+id,
		success: function(data) 
		{
			if (type!=1)
			{
				$("#userselect"+id).prepend('<span class="userselectdel'+id+'">[ <a href="# return false" onclick="selectUserForChannel('+id+', '+uniqueID+',1)">Удалить</a> ]</span>');
			}
			if (data.result.success==true)
			{
				//$("#currenuserlistadd_"+id).html('<a href="# return false" onclick="selectUserForChannel('+id+', '+uniqueID+')">Отменить</a>');
			}
			else
			{
				if (confirm('Удалить?')) {
					//alert('Удалено');
				} else {
					// Do nothing!
				}
				
				//alert("Удалить?");
			}
			
		}
	});
	/**/
}

function cencelVChatNameChannel()
{
	$("#TB_overlay").css("display","none");
	$(".panelVChatChannel").css("display","none");
}

//rowuserVChat '+selectChannelSearch+' badge

function selectUser(userid,namechannel)
{
	$("#firstButtonSendVChat").prop('disabled',true);
	document.getElementById("textmessageVChat").innerHTML="";
	$("#textmessageVChat").html("<div id='loaddatames' style='text-align:center;'><img src='layouts/vlayout/modules/VChat/img/load_content.gif' style='width:500px;text-align:center' /></div>");
	closeDialog(userid,"user");

	document.getElementById("listChannelTo").value=0;
	document.getElementById("userChannelTo").value=userid;
	document.getElementById("toUserVchat").innerHTML=namechannel;

	updatechat(userid,10,"user");
	$(".rowuserVChat").removeClass("selectTUser");
	$(".user"+userid).addClass("selectTUser");
}


function selectChannel(userid,namechannel,typeobject,startload)
{
	if (startload>0)
	{
		$(".strupload").html("<div id='loaddatames' style='text-align:center;'><img src='layouts/vlayout/modules/VChat/img/load_content.gif' style='width:500px;text-align:center' /></div>");
		
		updatechat(userid,10,"channel",startload);
	}
	else
	{
		closeDialog(userid,"channel");
		uploadsubdata(userid);
		$("#firstButtonSendVChat").prop('disabled',true);
		$("#textmessageVChat").html("<div id='loaddatames' style='text-align:center;'><img src='layouts/vlayout/modules/VChat/img/load_content.gif' style='width:500px;text-align:center' /></div>");
		document.getElementById("listChannelTo").value=userid;
		document.getElementById("userChannelTo").value=0;
		document.getElementById("toUserVchat").innerHTML=namechannel;
		updatechat(userid,10,"channel",0);
		$(".rowuserVChat").removeClass("selectTUser");
		$(".channel"+userid).addClass("selectTUser");
	}
}


function addFavorites(id)
{
	if ($("#mes"+id).hasClass("yellowdiv")) {
	//$("#mes"+id+"").css("background-color","#fff0a8");
		$("#mes"+id).removeClass("yellowdiv");
	}
	else
	{
		$("#mes"+id).addClass("yellowdiv");
	}
	
	$("#mes"+id+" .addtotoppos").html("<img src='layouts/vlayout/modules/VChat/img/load.gif' style='text-align:center' width='20px' />");
	$.ajax({
		url:'?module=VChat&action=Commander&mode=addFavorites&record='+id,
		success: function(data) 
		{
			if (data.result.success!=false)
			{
				//$("#mes"+id).addClass("yellowdiv");
				$("#mes"+id+" .addtotoppos").html('<a href="javascript:addFavorites('+id+')">Убрать из закладок</a>');
				/*
				var htmluserlist=data.result.htmluser;
				
				for (var i=0;i<=htmluserlist.namechannels.length-1;i++)
				{
					listUser=listUser+'<div class="rowuserVChat" onclick="setChatUser(\''+htmluserlist.nameaccount[i]+'\')">'+htmluserlist.namechannels[i]+'</div>';
					//'<div class="rowuserVChat '+selectSearch+' user'+htmluserlist.channelsid[i]+' " onclick="javascript:selectUser(\''+htmluserlist.channelsid[i]+'\',\''+htmluserlist.username[i]+'\')">['+htmluserlist.rolename[i]+'] '+htmluserlist.username[i]+'</div>';
				}
				$(".rightVChatPanlelUserList").html("<div>[<a href='# return false' onclick='openeVChatNameChannel("+userid+")'>Добавить участников</a>]</div>"+listUser);
				/**/
			}
		}
	});
		
	//$(this).css("display","none");
}

function setChatUser(id)
{
	$("#relMessage").html('<div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility"><input type="hidden" value="'+id+'" id="mestoid" /><b>Ответ: '+$("#mes"+id+" .nameUserVChat").html()+" "+$("#mes"+id+" .timeVchat").html()+'</b> <div style="width:100px;float:right;text-align:right"><a href="# return false" onclick="$(\'#relMessage div\').remove()">Отмена</a></div></div>');
}

function view_addpanel()
{
	$(".rightVChatPanlelUserList").css("display","none");
	$(".topMessageUserList").css("display","none");
	$(".uploadsFilesForm").css("display","block");
}

function view_adduserlist()
{
	$(".rightVChatPanlelUserList").css("display","block");
	$(".topMessageUserList").css("display","none");
	$(".uploadsFilesForm").css("display","none");
}


function view_addtopmespanel()
{
	$(".rightVChatPanlelUserList").css("display","none");
	$(".topMessageUserList").css("display","block");
	$(".uploadsFilesForm").css("display","none");
}


function deleteVChatNameChannel(userid,topid)
{
	if (confirm('Удалить?')) 
	{
		$.ajax({
				url:'?module=VChat&action=Commander&mode=deleteEntity&type=channel&record='+userid,
				success: function(data) 
				{
					if (userid!=topid)
					{
						selectChannel(topid,'Главный канал','',0);
						//alert("Удалено");
					}
					else
					{
						selectChannel(5,'Главный канал','',0);
						//alert("Удалено");
						//document.location.href='?module=VChat&view=List';
						//return false;
					}
					
					$(".channel"+userid).css("display","none");
					
				}
		});
	} 
	else 
	{
					// Do nothing!
	}
}


function uploadsubdata(userid)
{
	var strpanel="";
	if (userid!="")
	{ 
		var listUser="";
		$.ajax({
			url:'?module=VChat&action=Commander&mode=uploadsubdata&userid='+userid,
			success: function(data) 
			{
				if (data.result.success!=false)
				{
					var htmluserlist=data.result.htmluser;
					
					listUser=listUser+'<div class="rowuserVChat" onclick="selectChannel(\''+data.result.homeid+'\',\''+data.result.homename+'\',\'\',0)"><b>'+data.result.homename+'</b></div>';
					
					if (data.result.countchannels>0)
					{
						var htmlchannellist=data.result.htmlchannels;
						for (var i=0;i<=htmlchannellist.channelsid.length-1;i++)
						{
							listUser=listUser+'<div class="rowuserVChat channel'+htmlchannellist.channelsid[i]+'" onclick="selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\',\'\',0)">[Папка] '+htmlchannellist.namechannels[i]+'</div>';
						}
					}
					
					for (var i=0;i<=htmluserlist.namechannels.length-1;i++)
					{
						delluser='<span style="float:right">[<a href="# return false" onclick="selectUserForChannel('+htmluserlist.nameaccountid[i]+','+$("#listChannelTo").val()+')">Удалить</a>]</span>';
						//class="rowuserVChat" onclick="setChatUser(\''+htmluserlist.nameaccount[i]+'\')"
						listUser=listUser+'<div>'+htmluserlist.namechannels[i]+' '+delluser+' </div>';
					}
					//============================
					if (userid!=5)
					{
						$(".rightVChatPanlelUserList").html('<div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'new\')">Добавить подпапку</a>]</div><div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'change\')">Добавить участников</a>]</div>'+listUser+'<br><div>[<a href="# return false" onclick="deleteVChatNameChannel('+userid+','+data.result.homeid+')">Удалить текущий канал: '+$("#toUserVchat").html()+'</a>]</div>');
					}
					else
					{
						$(".rightVChatPanlelUserList").html('<div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'new\')">Добавить подпапку</a>]</div><div>[<a href="# return false" onclick="openeVChatNameChannel('+userid+',\'change\')">Добавить участников</a>]</div>'+listUser);
					}
					//============================
				}
			}
		});
	}
}


function sendMessage()
{
	next=0;
	var userto=0;
	var relto="";
	var message=$("#textmessage").val();
	if (message=="")
	{
		alert("Введите текст");
		return false;
	}
	var toName="Отправка сообщения";

	$("#textmessageVChat").append("<div class='rowmessage tempclass'  style='background:#CCC' tabindex='100000000' href='2' id='mes7h999'><div><img src='/layouts/vlayout/modules/VChat/img/user.png' class='imgiconVChat' /><b>"+toName+"</b> <span class='timeVchat'>time</span></div><div>"+message+"</div></div>");
	$( "#mes7h999" ).focus();	
		
		
	if (document.getElementById("mestoid"))
	{
		relto=document.getElementById("mestoid").value;
	}	
	if (document.getElementById("userChannelTo"))
	{
		userto=document.getElementById("userChannelTo").value;
	}
	if (document.getElementById("listChannelTo"))
	{
		channelto=document.getElementById("listChannelTo").value;
	}
	
	$("#firstButtonSendVChat").css("display","none");
	$("#thButtonSendVChat").css("display","block");
	
			
	if ((message!="")&&((userto>0)||(channelto>0)))
	{
		$.ajax({
			url:'?module=VChat&action=Commander&mode=saveMessage&message='+encodeURI(message)+'&userto='+userto+'&channelto='+channelto+"&relto="+relto,
			success: function(data) 
			{
				$("#thButtonSendVChat").css("display","none");
				$("#firstButtonSendVChat").css("display","block");
				$("#textmessage").val("");	
				
				if (relto>0)
				{
					$("#relMessage").html("");	
				}
			}
		});
	}
}

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function updateuser()
{
}

function setstartfavtop()
{
	next=0;
	$(".contentVChat").html("<div id='loaddatames' style='text-align:center;'><img src='layouts/vlayout/modules/VChat/img/load_content.gif' style='width:500px;text-align:center' /></div>");
	if ($("#listChannelTo").val()!="")
	{
		updatechat($("#listChannelTo").val(),10,"channel",0,1);
	}
	
	//selectChannel($("#listChannelTo").val(),'','',0);
}

function updatechat(user,start,typeobj,startload,topfav)
{
	if (start!=10)
	{
		start=0;
		//startupdate=startupdate+500;
		
		if (next>20000)
		{
			//next=20000;
		}
		if (startupdate<next)
		{
			//return false;
		}
		else
		{
			//startupdate=0;
		}
	}

	var yellowstr="";
	var list="";
	var addmestotop="";
	var currentuser="";
	var countelement=0;
	var mainchannel="";
	var idlast=0;
	if ((start>0))
	{
		if (user==0)
		{
			typeobj="channel";
			user=document.getElementById("listChannelTo").value;
		}
		
		$.ajax({
			url:'?module=VChat&view=ShowMessage&user='+user+'&start='+start+"&typeobj="+typeobj+"&startload="+startload+"&topfav="+topfav,
			success: function(data) 
			{
				//next=next+1000;
				var mes=jQuery.parseJSON(data);
				if ((mes.message!=null)&&(mes.message.length>0))
				{
					next=1000;
					for (var i=0;i<=mes.message.length-1;i++)
					{
						//if (!document.getElementById("mes"+mes.message[i].id))
						{
							idlast=mes.message[i].id;
							addmestotop='<span class="addtotoppos"><a href="javascript:addFavorites(\''+mes.message[i].id+'\')">Закладка</a></span>';
							
							if (mes.message[i].yellowdiv==1)
							{
								yellowstr=" yellowdiv ";
							}
							else
							{
								yellowstr="  ";
							}
							
							
							if (mes.message[i].mainchannelid>0)
							{
								mainchannel='В канале <a href="# return false" onclick="selectChannel('+mes.message[i].mainchannelid+',\''+mes.message[i].mainchannel+'\',\'\',0)" >#'+mes.message[i].mainchannel+'</a>';
							}
							else
							{
								mainchannel="";
							}
							
							if (mes.message[i].vchattexttoid!="")
							{
								
								list=list+'<div class="rowmessage '+yellowstr+' " tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <div><img src="'+mes.message[i].img+'" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span>'+mainchannel+'</div><div class="messageUserVChat"><div class="answer"><div class="containeranswer">'+mes.message[i].vchattexttoid+'</div></div>'+mes.message[i].messagetext+'</div></div>';
							
							}
							else
							{
								if (currentuser!=mes.message[i].user)
								{
									list=list+'<div class="rowmessage '+yellowstr+' " tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <div><img src="'+mes.message[i].img+'" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span></div><div class="messageUserVChat">'+mainchannel+''+mes.message[i].vchattexttoid+' '+mes.message[i].messagetext+'</div></div>';
									currentuser=mes.message[i].user;
								}
								else
								{
									list=list+'<div class="rowmessage '+yellowstr+' " style="padding: 2px 20px 2px 10px!important;" tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div style="position:absolute;z-index:1000;background:#FFF;text-align:right"><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <span class="timeVchat" style="">&nbsp;&nbsp;'+mes.message[i].time+'&nbsp;&nbsp;&nbsp;</span> '+mainchannel+' '+mes.message[i].vchattexttoid+' '+mes.message[i].messagetext+'</div>';
								}
							}
							//$("#textmessageVChat").append('<div class="rowmessage" tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <a href="javascript:addFavorites(\''+mes.message[i].id+'\')">Закладка</a></div></div> <div><img src="http://s1.iconbird.com/ico/0612/GooglePlusInterfaceIcons/w128h1281338911651user.png" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span></div><div class="messageUserVChat">'+mes.message[i].messagetext+'</div></div>');
						}
					}
				
					if (startload>0)
					{
						$("#textmessageVChat").prepend(list);
						$(".strupload").remove();
						
					}
					else
					{
						$("#textmessageVChat").append(list);
						$(".strupload").remove();
					}
					
					if (typeobj=="channel")
					{
						$("#textmessageVChat").prepend('<div class="strupload" style="text-align:center"><a href="javascript:selectChannel(\''+user+'\',\'0\',\''+typeobj+'\',\''+mes.starload+'\')">Показать еще записи</a></div>');
					}
					else
					{
						$("#textmessageVChat").prepend('<div class="strupload"  style="text-align:center"><a href="javascript:selectChannel(\''+user+'\',\'0\',\''+typeobj+'\',\''+mes.starload+'\')">Показать еще записи</a></div>');
					}
					$("#loaddatames").remove();					
				}
				else
				{
					
					$("#loaddatames").remove();		
				}
				
				if (idlast!=0)
				{
					$( "#mes"+idlast ).focus();
				}
				
				$("#firstButtonSendVChat").prop('disabled',false);	
			}
		});
	}
	else
	if (document.getElementById("userChannelTo"))
	{
		var start=0;
		var user=document.getElementById("userChannelTo").value;
		if (user==0)
		{
			typeobj="channel";
			user=document.getElementById("listChannelTo").value;
		}
		$.ajax({
			url:'?module=VChat&view=ShowMessage&user='+user+'&start=0&typeobj='+typeobj+'&next='+next,
			success: function(data) 
			{
				next=next+1000;
			/*
				var mes=jQuery.parseJSON(data);
				if ((mes.message!=null)&&(mes.message.length>0))
				{
					for (var i=0;i<=mes.message.length-1;i++)
					{
						if (!document.getElementById("mes"+mes.message[i].id))
						{
							$(".tempclass").remove();
							addmestotop='<span class="addtotoppos"><a href="javascript:addFavorites(\''+mes.message[i].id+'\')">Закладка</a></span>';
							
							//$("#textmessageVChat").append("<div style='background:#CCC' class='rowmessage' tabindex='"+mes.message[i].id+"' href='2' id='mes"+mes.message[i].id+"'><div class='rightbuttonVChat'><div><a href=>Ответить</a> <a href=>Закладка</a></div></div><div><img src='http://s1.iconbird.com/ico/0612/GooglePlusInterfaceIcons/w128h1281338911651user.png' class='imgiconVChat' /><b>"+mes.message[i].user+"</b> <span class='timeVchat'>"+mes.message[i].time+"</span></div><div>"+mes.message[i].messagetext+"</div></div>");
							$("#textmessageVChat").append('<div class="rowmessage" tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | '+addmestotop+'</div></div> <div><img src="'+mes.message[i].img+'" class="imgiconVChat" /><b>'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span></div><div>'+mes.message[i].messagetext+'</div></div>');
						
							$("#mes"+mes.message[i].id).animate({"background-color" : "#FFFFFF"}, 3000);
							$( "#mes"+mes.message[i].id+"" ).focus();
							if (mes.message[i].type==1)
							{
								//$("#headerLinks").prepend("<span id='audioplay'></span><a href='?module=VChat&view=List'><div id='checkCallVChat' style='background: red;padding: 3px;  margin-bottom: 0px; float:left;margin-right:15px;margin-top:4px;width:5px;height:5px; border-radius: 5px;' class='radiusHeaderVChat'></div></a>");
								//$("#audioplay").html("<audio autoplay><source src='vk.mp3'><source src='vk.mp3'></source></audio>");
							}
							
							
						}
					}
					$("#loaddatames").remove();
					
				}
				else
				{
					$("#loaddatames").remove();		
					//$("#textmessageVChat").html("<div class='rowmessage' tabindex='0' href='0' id='0'>Напишите первое сообщение</div>");
				}
				$("#firstButtonSendVChat").prop('disabled',false);	
			/**/
			
				var mes=jQuery.parseJSON(data);
				if ((mes.message!=null)&&(mes.message.length>0))
				{
					next=1000;
					//containeranswer
					for (var i=0;i<=mes.message.length-1;i++)
					{
						
						if (!document.getElementById("mes"+mes.message[i].id))
						{
							$(".tempclass").remove();
							idlast=mes.message[i].id;
							addmestotop='<span class="addtotoppos"><a href="javascript:addFavorites(\''+mes.message[i].id+'\')">Закладка</a></span>';
							
							if (mes.message[i].yellowdiv==1)
							{
								yellowstr=" yellowdiv ";
							}
							else
							{
								yellowstr="  ";
							}
							
							
							if (mes.message[i].mainchannel>0)
							{
								mainchannel="В канале <a href=>#"+mes.message[i].mainchannel+"</a>";
							}
							else
							{
								mainchannel="";
							}
							
							if (mes.message[i].vchattexttoid!="")
							{
								
								list=list+'<div class="rowmessage '+yellowstr+' " tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <div><img src="'+mes.message[i].img+'" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span>'+mainchannel+'</div><div class="messageUserVChat"><div class="answer"><div class="containeranswer">'+mes.message[i].vchattexttoid+'</div></div>'+mes.message[i].messagetext+'</div></div>';
							
							}
							else
							{
								if (currentuser!=mes.message[i].user)
								{
									list=list+'<div class="rowmessage '+yellowstr+' " tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <div><img src="'+mes.message[i].img+'" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span></div><div class="messageUserVChat">'+mainchannel+''+mes.message[i].vchattexttoid+' '+mes.message[i].messagetext+'</div></div>';
									currentuser=mes.message[i].user;
								}
								else
								{
									list=list+'<div class="rowmessage '+yellowstr+' " style="padding: 2px 20px 2px 10px!important;" tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div style="position:absolute;z-index:1000;background:#FFF;text-align:right"><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <span class="addtotop">'+ addmestotop+'</span></div></div> <span class="timeVchat" style="">&nbsp;&nbsp;'+mes.message[i].time+'&nbsp;&nbsp;&nbsp;</span> '+mainchannel+' '+mes.message[i].vchattexttoid+' '+mes.message[i].messagetext+'</div>';
								}
							}
							//$("#textmessageVChat").append('<div class="rowmessage" tabindex="'+mes.message[i].id+'" href="2" id="mes'+mes.message[i].id+'"><div class="rightbuttonVChat"><div><a href="# return false" onclick="javascript:setChatUser(\''+mes.message[i].id+'\')">Ответить</a> | <a href="javascript:addFavorites(\''+mes.message[i].id+'\')">Закладка</a></div></div> <div><img src="http://s1.iconbird.com/ico/0612/GooglePlusInterfaceIcons/w128h1281338911651user.png" class="imgiconVChat" /><b class="nameUserVChat" >'+mes.message[i].user+'</b> <span class="timeVchat">'+mes.message[i].time+'</span></div><div class="messageUserVChat">'+mes.message[i].messagetext+'</div></div>');
						}
					}
				
					if (startload>0)
					{
						$("#textmessageVChat").prepend(list);
						$(".strupload").remove();
						
					}
					else
					{
						$("#textmessageVChat").append(list);
						$(".strupload").remove();
					}
					
					if (typeobj=="channel")
					{
						$("#textmessageVChat").prepend('<div class="strupload" style="text-align:center"><a href="javascript:selectChannel(\''+user+'\',\'0\',\''+typeobj+'\',\''+mes.starload+'\')">Показать еще записи</a></div>');
					}
					else
					{
						$("#textmessageVChat").prepend('<div class="strupload"  style="text-align:center"><a href="javascript:selectChannel(\''+user+'\',\'0\',\''+typeobj+'\',\''+mes.starload+'\')">Показать еще записи</a></div>');
					}
					$("#loaddatames").remove();					
				}
				else
				{
					
					$("#loaddatames").remove();		
				}
				
				if (idlast!=0)
				{
					$( "#mes"+idlast ).focus();
				}
				
				$("#firstButtonSendVChat").prop('disabled',false);	
			/**/
			
			}
		});
	}
	else
	{
		//alert(3);
	}
}



function loadword2()
{
	var search=$("#search").val();
	if (search!="")
	{
		//return false;
	}
	var startsearch=$("#startsearch").val();
	var userChannelTo=document.getElementById("userChannelTo").value;
	var userChannelTo2="";
	if (userChannelTo==0)
	{
		var userChannelTo2=document.getElementById("listChannelTo").value;
	}
	var listUser="";
	var selectSearch;
	var listChannelUser="";
	//alert($("#startsearchCannnelAndUser").val());
	//if (startsearch!=1)
	{
		$.ajax({
			url:'?module=VChat&action=Commander&mode=seachUserLeftPanel&search=true&selectTUser2='+userChannelTo2+'&selectTUser='+userChannelTo+'&startsearchCannnelAndUser='+$("#startsearchCannnelAndUser").val(),
			success: function(data) 
			{
				$("#logsql").val(data.result.datecreate);
				$("#startsearchCannnelAndUser").val("1");
				if (data.result.success!=false)
				{
					var htmlchannellist=data.result.htmlhtmlchannellist;
					var htmluserlist=data.result.htmluser;
					for (var i=0;i<=htmluserlist.username.length-1;i++)
					{
						if (htmluserlist.userid!=undefined)
						{
							next=1000;
							var selectSearch=htmluserlist.selectTUser[i];
							if (htmluserlist.radiusVChat[i]>0)
							{
								listUser=listUser+'<div class="rowuserVChat '+selectSearch+' user'+htmluserlist.userid[i]+' " onclick="javascript:selectUser(\''+htmluserlist.userid[i]+'\',\''+htmluserlist.username[i]+'\',\'\',0)">['+htmluserlist.rolename[i]+'] '+htmluserlist.username[i]+'<span class="badge">'+htmluserlist.radiusVChat[i]+'</span></div>';
							}
							else
							{
								listUser=listUser+'<div class="rowuserVChat '+selectSearch+' user'+htmluserlist.userid[i]+' " onclick="javascript:selectUser(\''+htmluserlist.userid[i]+'\',\''+htmluserlist.username[i]+'\',\'\',0)">['+htmluserlist.rolename[i]+'] '+htmluserlist.username[i]+'</div>';
							}
						}
					}
					if (data.result.countChannel>0)
					{
						for (var i=0;i<=htmlchannellist.channelsid.length-1;i++)
						{
							var selectChannelSearch="";
							selectChannelSearch=htmlchannellist.selectTChannel[i];
							if (htmlchannellist.channelsid!=undefined)
							{
								if (htmlchannellist.radiusVChat[i]>0)
								{
									listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\',\'\',0)">['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'<span class="badge">'+htmlchannellist.radiusVChat[i]+'</span></div>';
								}
								else
								{
									listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\',\'\',0)">['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'</div>';
								}
							}
						}
					}
					else
					{
						listChannelUser="Каналов не обнаружено";
					}
					$("#innersearchclose").html(listUser);
					$("#innersearchcloseVChannel").html(listChannelUser);
					
				}
			}
		});
	}	
}
setTimeout(loadword2, 1000);



if (document.getElementById("startChannel").value==0)
{
	//selectUser(0,"Все");
}
selectChannel('5','Все');
//selectUser(39,"Все");
setstartfavtop();
setInterval(updatechat, 15000);
setInterval(loadword2, 15000);

window.onload = function(){
var socket = new WebSocket("ws://crmturizm.ru:8082");
var status = document.querySelector("#status");
socket.onopen = function() {
};
socket.onclose = function(event) {
};

socket.onmessage = function(event) {
	updatechat();
	loadword2();
  //status.innerHTML += "<div>пришли данные " + event.data + "</div>";
};
socket.onerror = function(event) {
	//alert(1);
  //status.innerHTML = "ошибка " + event.message;
};
$( "#firstButtonSendVChat" ).click(function() {
  socket.send("124##message##123");
});



}

