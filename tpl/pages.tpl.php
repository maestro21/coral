<?php
switch($do) {
	case 'default':
	case 'view': ?>
		<p><?=$data;?></p>
	<?	break;
	case 'firstpage': ?>	.
		<script language="javascript" src="js/jquery.js"></script>
		<script language="javascript" src="js/slider.js"></script>
		<script language="javascript" src="shadowbox/shadowbox.js"></script>
		<script type="text/javascript">
		Shadowbox.init();
		</script>
		<div class="slider-index-wrapper">
			<div class="slider-index">
				<div class="arrow-left" style="display: block;"></div>
				<div class="arrow-right" style="display: block;"></div>
				<div class="slide" group="0" style="display: none;">
					<a href="products/bi-luron"><img src="up/bigpic4.jpg"></a>
				</div> 					
				<div class="slide" group="0" style="display: none;">
					<a href="products/fitogard"><img src="up/bigpic1.jpg"></a>
				</div>
				<div class="slide" group="0" style="display: none;">
					<a href="products/akvaoks"><img src="up/bigpic2.jpg"></a>
				</div>
				<div class="slide" group="0" style="display: none;">
					<a href="products/zaferan"><img src="up/bigpic3.jpg"></a>
				</div>				
			</div>
        </div>
	
	
		<img alt="" src="up/frontpic.jpg" align="none">
		<h1><?=$data['title'];?></h1>
		<p><?=$data['text'];?></p>
		<center>
			<a href="http://www.youtube.com/v/R7nI19r8l-A?autoplay=1" rel="shadowbox;width=700;height=500;player=swf"><img src="up/youtube.jpg"></a>
		</center>	
	<?		
	break;
	
	case 'edit': $id = $data['id'];

	case 'new': ?>
	
	<form method="POST" action="<?=BASE_PATH;?>pages/save">
		<? if(@$data['id']>0) { ?>
			<input name="data[id]" type="hidden" value="<?=$data['id'];?>">
		<? } ?>
		<div>
			<table>
			<tr>
				<td class="label">
					<?=T('lang');?>:
				</td>
				<td>
					<select name="data[lang]">
						<? foreach ($langs as $k=>$v) { ?>
							<option value="<?=$k;?>"<?=(@$data['lang']==$k?' selected':'');?>><?=$v;?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<?=T('url');?>:
				</td>
				<td>
					<input name="data[url]" type="text" value="<?=@$data['url'];?>">
				</td>
			</tr>
			<tr>
				<td class="label">
					<?=T('title');?>:
				</td>
				<td>
					<input name="data[title]" type="text" value="<?=@$data['title'];?>">
				</td>
			</tr>	
			</tr>
			<tr>
				<td class="label">
					<?=T('text');?>:
				</td>
				<td>	
					<textarea cols="100" rows="50" name="data[text]" id="text" >
					<?=@$data['text'];?>
					</textarea>
					<script type='text/javascript'>
						bkLib.onDomLoaded(function() {
							new nicEditor({fullPanel : true,maxHeight : 300}).panelInstance('text');
						}); 						 
					</script>
				</td>
			</tr>
						</tr>
			<tr>
				<td class="label">
					<?=T('public');?>
				</td>
				<td>
					
					<select name="data[publish]">
						<option value="0"<?=(@$data['published']==0?' selected':'');?>><?=T('hidden');?></option>
						<option value="1"<?=(@$data['published']==1?' selected':'');?>><?=T('visible');?></option>
						<option value="2"<?=(@$data['published']==2?' selected':'');?>><?=T('main menu');?></option>
						<option value="3"<?=(@$data['published']==3?' selected':'');?>><?=T('bottom');?></option>
						<option value="4"<?=(@$data['published']==4?' selected':'');?>><?=T('first page');?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
				
				</td>
				<td>
					<input type="submit">
				</td>
			</tr>
		</table>
		</div>		
	</form>
	<? break;
	
	
	case 'admin': ?>
	<img src="<?=BASE_PATH;?>img/<?=$data['lang'];?>.png">
	<? foreach ($langs as $k=>$v) { ?><div class="ln"><a href="<?=BASE_PATH;?>pages/admin/<?=$k;?>"><b><img src="<?=BASE_PATH;?>img/<?=$k;?>.png"> <?=$v;?></b></a></div> <? } ?>
	<div class="item">
		<table>
			<thead>
			<tr>
				<td>
					<?=T('id');?>
				</td>
				<td>
					<?=T('url');?>
				</td>
				<td>
					<?=T('title');?>
				</td>
				<td>
					<?=T('public');?>
				</td>
				<td>
					<?=T('options');?>
				</td>
			</tr>	
			</thead>
			<?  if(isset($data['pages']))
				foreach ($data['pages'] as $kk => $vv) { ?>
			<tr>
				<td>
					<?=$vv['id'];?>
				</td>
				<td>
					<a href="<?=BASE_PATH.$vv['url'];?>" target="_blank"><?=$vv['url'];?></a>
				</td>
				<td>
					<?=$vv['title'];?>
				</td>
				<td>
					<? $options = array( 
							T('hidden'), 
							T('visible'), 
							T('main menu'),
							T('bottom'),
							T('first page'),
						);								
					echo $options[$vv['published']]; ?>
				</td>
				<td>
					<a href="<?=BASE_PATH;?>pages/edit/<?=$vv['id'];?>"><?=T('edit');?></a>
					<a href="<?=BASE_PATH;?>pages/del/<?=$vv['id'];?>"><?=T('del');?></a>
				</td>
			</tr>
			
			<? } ?>
		</table>
	</div>
	<? break; ?>
<? } ?>