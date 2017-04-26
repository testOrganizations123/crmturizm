var selectword;
selectword=0;
function selectWord()
{
	var countFindRez=0;
	if (document.getElementById("startword"))
	{
		var startword=$("#startword").val();
		if (startword=="")
		{
			$("#startword").val($("#search").val());
		}
	}
	if (document.getElementById("countFindRez"))
	{
		countFindRez=document.getElementById("countFindRez").value;
		selectword=parseInt(selectword)+1;
		$("#listvalsearch .list-group-item-search").removeClass("selectli");
		$("#listvalsearch #f"+selectword+" ").addClass("selectli"); 
		$("#currentRow").val(selectword);
		$("#search").val($("#listvalsearch #f"+selectword+" ").html());
		
		var d=parseInt(countFindRez)+1;
		if (selectword>=d)
		{
			selectword=1;
			$("#listvalsearch .list-group-item-search").removeClass("selectli");
			$("#listvalsearch #f"+selectword+" ").addClass("selectli"); 
			$("#currentRow").val(selectword);
			$("#search").val($("#listvalsearch #f"+selectword+" ").html());
		}
	}
	//alert(selectword);
}

function selectNWord()
{
	var countFindRez=0;
	if (document.getElementById("countFindRez"))
	{
		
		countFindRez=document.getElementById("countFindRez").value;
		
		if (selectword>1)
		{
			selectword=parseInt(selectword)-1;
			$("#listvalsearch .list-group-item-search").removeClass("selectli");
			$("#listvalsearch #f"+selectword+" ").addClass("selectli"); 
			$("#search").val($("#listvalsearch #f"+selectword+" ").html());
			$("#currentRow").val(selectword);
			if (selectword==0)
			{
				selectword=parseInt(countFindRez);
			}
		}
		else
		{
			$("#listvalsearch .list-group-item-search").removeClass("selectli");
			$("#search").val($("#startword").val());
			$("#currentRow").val(0);
			selectword=0;
		}
		
		
	}
}

function selectsearchrow(data)
{
	$("#search").val($(data).html());
	searchword();
}



function loadword2()
{
	var search=$("#search").val();
	if (search!="")
	{
		return false;
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
			//url:'?module=VChat&view=SearchUser&search=true&selectTUser='+userChannelTo,
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
					
					
					//if (htmlchannellist.countEl>0)
					if (data.result.countChannel>0)
					{
					
						for (var i=0;i<=htmlchannellist.channelsid.length-1;i++)
						{
							var selectChannelSearch="";
							selectChannelSearch=htmlchannellist.selectTChannel[i];
							//selectTUser 
							if (htmlchannellist.channelsid!=undefined)
							{
								//radiusVChat
								//listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\')"> ['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'</div>'; //countuserchannelsid
							
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
						/*countuserchannelsid*/
					}
					else
					{
						listChannelUser="Каналов не обнаружено";
					}
					

					//$(".rightVChatPanlelUserList").html(listUser);
					
					$("#innersearchclose").html(listUser);
					$("#innersearchcloseVChannel").html(listChannelUser);
					
				}
			}
		});
	}	
}

setInterval(loadword2, 1000);
	
	
function loadword(word)
{
	
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
			//url:'?module=VChat&view=SearchUser&search=true&selectTUser='+userChannelTo,
			url:'?module=VChat&action=Commander&mode=seachUserLeftPanel&search=true&selectTUser2='+userChannelTo2+'&selectTUser='+userChannelTo+'&startsearchCannnelAndUser=0&word='+word,
			success: function(data) 
			{
			
				$("#logsql").val(data.result.datecreate);
				
				$("#startsearchCannnelAndUser").val("1");
				//alert(data.result.success);
				if (data.result.success!=false)
				{
						
					var htmlchannellist=data.result.htmlhtmlchannellist;
					var htmluserlist=data.result.htmluser;

					if (data.result.countUsert>0)
					{
						
						for (var i=0;i<=htmluserlist.username.length-1;i++)
						{
							if (htmluserlist.userid!=undefined)
							{
								var selectSearch=htmluserlist.selectTUser[i];
								if (htmluserlist.radiusVChat[i]>0)
								{
									listUser=listUser+'<div class="rowuserVChat '+selectSearch+' user'+htmluserlist.userid[i]+' " onclick="javascript:selectUser(\''+htmluserlist.userid[i]+'\',\''+htmluserlist.username[i]+'\')">['+htmluserlist.rolename[i]+'] '+htmluserlist.username[i]+'<span class="badge">'+htmluserlist.radiusVChat[i]+'</span></div>';
								}
								else
								{
									listUser=listUser+'<div class="rowuserVChat '+selectSearch+' user'+htmluserlist.userid[i]+' " onclick="javascript:selectUser(\''+htmluserlist.userid[i]+'\',\''+htmluserlist.username[i]+'\')">['+htmluserlist.rolename[i]+'] '+htmluserlist.username[i]+'</div>';
								}
							}
						}
					}
				
					//alert(data.result.countChannel);
					//if (htmlchannellist.countEl>0)
					//{
					if (data.result.countChannel>0)
					{
						for (var i=0;i<=htmlchannellist.channelsid.length-1;i++)
						{
							var selectChannelSearch="";
							selectChannelSearch=htmlchannellist.selectTChannel[i];
							//selectTUser 
							if (htmlchannellist.channelsid!=undefined)
							{
								//radiusVChat
								//listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\')"> ['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'</div>'; //countuserchannelsid
							
								if (htmlchannellist.radiusVChat[i]>0)
								{
									listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\')">['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'<span class="badge">'+htmlchannellist.radiusVChat[i]+'</span></div>';
								}
								else
								{
									listChannelUser=listChannelUser+'<div class="rowuserVChat '+selectChannelSearch+' channel'+htmlchannellist.channelsid[i]+' " onclick="javascript:selectChannel(\''+htmlchannellist.channelsid[i]+'\',\''+htmlchannellist.namechannels[i]+'\')">['+htmlchannellist.countuserchannelsid[i]+'] '+htmlchannellist.namechannels[i]+'</div>';
								}
							}
						}
						/*countuserchannelsid*/
					}
					else
					{
						listChannelUser="Каналов не обнаружено";
					}
					
					$("#innersearchclose").html(listUser);
					$("#innersearchcloseVChannel").html(listChannelUser);
					//
					//$("#innersearchcloseVChannel").html(listChannelUser);
					
				}
			}
		});
		
	}	
}

function autocompletefield()
{
	var search=$("#search").val();
	
	if ((search.length<2)&&(search.length>=1))
	{
		loadword("");
	}
	else
	if (search.length>=2)
	{
		$("#innersearch").css("display","none");
		$("#oblsearch").css("display","block");
		$("#search").addClass("loading");
		loadword(search);
		$("#startsearch").val(1);
	}
	else
	{
		//$("#startsearchCannnelAndUser").val(1);
		$("#startsearch").val(0);
		$("#search").removeClass("loading");
		$("#oblsearch").css("display","none");
		$("#innersearchclose").css("display","block");
	}
}
/**/
