<form class="youtubewidgetSave" id="youtubewidgetSave" name="youtubewidgetSave" method="post" >

			<table border="1" cellspacing="0" class="table_input_vr">
			<colgroup>
				<col width="115px">
				<col width="*">
			</colgroup>
			<tbody><tr>
				<th><label for="category">Category</label></th>
				<td>
					<div class="content">	
					
						<select name="pg_simpleyoutube_cat_sel" id="pg_simpleyoutube_cat_sel">
						<?php foreach($aList as $val){ ?>
														<option value="<?php echo $val[term]?>" <?php if($sCategory == $val[term]){echo "selected";}?>><?php echo $val[label];?></option>
						<?php } ?>
														
													</select>
					</div>
				</td>
			</tr>
			<tr>
				<th><label for="show_html_value">Tab</label></th>
			
				<td>
					<div class="content">
						<a href="#" onclick="adminPageSetup.catOrder('up');" class="class_sort"><img src="/_sdk/img/youtubewidget/order_top.png" alt="Order By Top"></a>
						<a href="#" onclick="adminPageSetup.catOrder('down');" class="class_sort"><img src="/_sdk/img/youtubewidget/order_bottom.png" alt="Order By Bottom"></a>
					</div>	
					<div class="content">
						<select title="select tab" class="tab" id="show_html_value" size="4">
						<?php $i = 0; foreach($aOrder as $val){ ?>
															<option id="optyoutubewidget_<?php echo $i; ?>" value="<?php echo $val[alt]?>"><?php echo $val[text] ?></option>	
															
							<?php $i++; };?>	
													</select>
					</div>
				</td>
			</tr>

			</tbody></table>
	
			<div class="tbl_lb_wide_btn">
				<a href="#" class="btn_apply" title="Save changes" onclick="adminPageSetup.s();">Save</a>
				<a href="#" class="add_link" title="Reset to default" onclick="adminPageSetup.resetDefault();">Reset to Default</a>
			</div>
			<input type="hidden" name="pg_simpleyoutube_hidden_order" id="pg_simpleyoutube_hidden_order" value="">
	</form>