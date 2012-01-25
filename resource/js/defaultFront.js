$(document).ready(function(){
	
	var iHolderWidth = $('#pg_simpleyoutube_holder').width();
	var str  = "";

	$('#pg_simpleyoutube_holder').append('<div id="pg_sy_ajaxloader"><img src="../_sdk/img/youtubewidget/ajax-loader.gif" /></div>');
	
	$.ajax({
		url: usbuilder.getUrl("apiContentsInit"),
		type: "POST",
		data:{idx:idx,iHolderWidth:iHolderWidth}
	}).done(function(data){
		aOrder = data.Data.aOrder;
		aList = data.Data.aList;
		sCtgry = data.Data.sCtgry;
		
		str += '<ul class="pg_simpleyoutube_tabs">';
		
		$.each(aOrder, function(k,val){
			str += '<li class="'+val['cl']+'"><a href="#" id="'+val['id']+'" id2="'+val['alt']+'" class="pg_sy_tab" onclick="frontPageyoutubewidget.tab_change(this);"><span>'+val['text']+'</span></a></li>';
		});
		
		str += '</ul>';
		str += '<div class="pg_simpleyoutube_list">';
		str +=	'<ul class="pg_simpleyoutube_popular">';
			if(aList.length > 0){
				$.each(aList, function(k,val){
				
					title = (iHolderWidth > 350)? val['title']: val['title2'];
					author = (iHolderWidth > 350)? val['author']: val['author2'];
					str += '<li class="pg_simpleyoutube_item">';
					str += '<div class="pg_simpleyoutube_preview"><a href="'+val['watch']+'" target="_blank"><img src="'+val['thumbnail']+'" alt="thumbnail" width="108" height="65"/><p class="pg_sy_time">'+val['length']+'</p></a></div>';
					str += '<p class="pg_simpleyoutube_item_title"><a href="'+val['watch']+'" >'+title+'</a></p>';
					str += '<p class="pg_simpleyoutube_item_author">by'+author+'</p>';
					str += '<p class="pg_simpleyoutube_item_views"> '+val['views']+' views</p>';
					str += '</li>';
				});
			}else{
				str +=  '<li id="no_vids_avail">Sorry, the videos for this category are not available at the moment. You may change the category in the admin settings.</li>';
			}
		str +=  '</ul>';
		str += '</div>';
			
			str += '<div id="pg_simpleyoutube_init_front">';
			str += '<input type="hidden" name="pg_simpleyoutube_ctgry_category" id="pg_simpleyoutube_ctgry_category" value="'+sCtgry+'" />';
			str += '</div>';
					
			$('#pg_simpleyoutube_holder').append(str);
			$('#pg_sy_ajaxloader').remove();
		
	});

	
});

var frontPageyoutubewidget = {

	tab_change : function(obj)
	{
		var cat = $(obj).attr('id2');
		var c = $('#pg_simpleyoutube_ctgry_category').val();
	
		
		$('[class^=pg_sy_tab]').parent().attr('class', 'off');
		$('#pg_sy_tab_'+cat).parent().attr('class', 'on');

		$('.pg_sy_tab').blur();
		
		$('[class^=pg_simpleyoutube_list]').remove();
		$('<div class="pg_simpleyoutube_list"></div>').insertAfter('ul.pg_simpleyoutube_tabs');

		$('[class^=pg_simpleyoutube_list]').append('<div id="pg_sy_ajaxloader"><img src="../_sdk/img/youtubewidget/ajax-loader.gif" /></div>' );
				
		$.ajax({
			url: usbuilder.getUrl("apiContentsYoutubeWidget"),
			type:"POST",
			cache: false,
			data:{category: cat, ctgry : c}
		}).done(function(data){	
			frontPageyoutubewidget.ajaxCallBackJsonTabChange(data.Data);
		});
	
	},

	ajaxCallBackJsonTabChange : function(result)
	{
		var str="";
		var count = result.length;
		var iHolderWidth = $('#pg_simpleyoutube_holder').width();
		$('#pg_sy_ajaxloader').remove();
		
		if(count > 0) {		
			$.each(result, function(index, entry) {
				title = (iHolderWidth > 350)?entry.title : entry.title2;
				author = (iHolderWidth > 350)?entry.author : entry.author2;
				str += '<li class="pg_simpleyoutube_item">';
				str += '<div class="pg_simpleyoutube_preview"><a href="'+entry.watch+'" target="_blank"><img src="'+entry.thumbnail+'" alt="thumbnail" width="108" height="65"/><p class="pg_sy_time">'+entry.length+'</p></a></div>';
				str += '<p class="pg_simpleyoutube_item_title"><a href="'+entry.watch+'">'+title+'</a></p>';
				str += '<p class="pg_simpleyoutube_item_author">by '+author+'</p>';
				str += '<p class="pg_simpleyoutube_item_views">'+entry.views+' views</p></li>';
			});
		} else {
			str += '<li id="no_vids_avail">Sorry, the videos for this category are not available at the moment. You may change the category in the admin settings.</li>';
		}

		$('[class^=pg_simpleyoutube_list]').html('<ul class="pg_simpleyoutube_popular"></ul>');
		$('.pg_simpleyoutube_popular').html(str);
	}

};

