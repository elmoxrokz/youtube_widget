$(document).ready(function(){
	
	var tab_id = $('#pg_simpleyoutube_holder ul.pg_simpleyoutube_tabs').find('li a:first').attr('id');
	var show_this = $('#pg_simpleyoutube_holder .pg_simpleyoutube_list').find('ul');
	
//		$('#pg_simpleyoutube_wrap').parent().css('overflow','auto');
//		$('#pg_simpleyoutube_wrap').parent().parent().css('overflow','auto');
//		$('#pg_simpleyoutube_wrap').parent().parent().parent().css('overflow','auto');



	$('#pg_simpleyoutube_wrap').each(function(){
		$(this).find('div').css('overflow','auto');
	})
	
	show_this.each(function(k,v){
		if($(v).attr('id') == tab_id){
			$(v).show();
		}
	});
	
	
});

var frontPageyoutubewidget = {

	tab_change : function(obj)
	{
		var idx = $(obj).attr('id');
		var find_id = $(obj).parents('#pg_simpleyoutube_holder').find('.pg_simpleyoutube_list').find('ul');
		var tab = $(obj).parents('.pg_simpleyoutube_tabs').find('li');
		tab.each(function(k,v){
			$(v).attr('class', 'off');
		});
		$(obj).parent().attr('class','on');
		
		find_id.each( function(k,v) {
			
			if($(v).attr('id') == idx){
				$(v).show();
			}else{
				$(v).hide();
			}
			
		});
		
	}

	

};

