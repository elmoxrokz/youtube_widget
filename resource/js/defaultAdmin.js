var showSaveBar = "false";
var adminPageSetup = {

	catOrder : function(sorting)
	{
		var curr_opt = $('div #show_html_value option:selected');

		if(sorting === 'down')
		curr_opt.insertAfter(curr_opt.next());
		else
		curr_opt.insertBefore(curr_opt.prev());
		
	},

	get_order : function()
	{
		var str = "";
		$('#show_html_value option').each(function(index){
			str += $(this).val() + ',';	
		});

		return str.substr(0, str.length-1);
	},
	
	changeWidth : function(obj)
	{
		var isCheck = $(obj).val();
		
		if(isCheck == 1){
			$('#pg_simpleyoutube_width_size').show();
			adminPageSetup.changeIframe("auto", "body");
		}else{
			$('#pg_simpleyoutube_width_size').hide();
		}

	},
	
	
	s: function()
	{
		var ordr = adminPageSetup.get_order();
		
		$('#pg_simpleyoutube_hidden_order').val(ordr);
		$('#youtubewidgetSave').submit();
	
		

	},
	
	resetDefault : function()
	{
		$('#pg_simpleyoutube_tpl_1_radio').attr('checked', true);
		$('#pg_simpleyoutube_cat_sel option:nth-child(19)').attr('selected', true);

		$('#show_html_value option:nth-child(1)').val("latest").html("Most Recent");
		$('#show_html_value option:nth-child(2)').val("popular").html("Most Popular");
		$('#show_html_value option:nth-child(3)').val("category").html("By Category");
		
		$('#pg_simpleyoutube_width_size').hide();
		$('input[name="pg_simpleyoutube_width"]:first').attr('checked', true);
	}
};

$(document).ready(function(){
	
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	if(hashes == "showSaveBar=true"){
	$('.msg_suc_box').show().delay(3000).fadeOut('slow', function(){ $('#WRAP_Simpleyoutube').resizeIframe();});
	}

	$('.class_sort').click(function()	{
	return false;
	});
	

});