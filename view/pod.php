<div class="container">
	<div class="selectType">
		<div class="row">
			<?php if (count($back)>0): ?>
				<?php if ($back[$ident][1]=='id'): ?>
					<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-podid="<?=$back[$ident][0]?>" data-back='<?=$ident+1?>'>
				<?php else: ?>
					<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-parenttype="<?=$back[$ident][0]?>" data-podid="<?=$back[$ident][0]?>" data-back='<?=$ident+1?>'>
				<?php endif ?>
			<?php else: ?>
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod()" data-loadpage="main">
			<?php endif ?>
				<div class="leftArrow">
					<img src="https://dobrobut.learn-solve.com/front/img/leftArrow.svg" alt="">
				</div>
				<p class="leftArrowText">Назад</p>
			</div>
		</div>
	</div>
	<div class="searchBox">
		<div class="row">
			<div class="col-lg-6">
				<div class="title"><p class="title tableTitle"><?=$title?></p></div>
				<?php if (isset($titled)): ?>
					<p class="tableText"><?=$titled?></p>
				<?php endif ?>
				<p class="tableText"><?=$sub_title?></p>
			</div>
		</div>
		<div class="row">

			<?php if ($title=='Організаційна структура'): ?>
				<div class="podrazd d-flex flex-wrap justify-content-start">
					<?php 
						for ($i=0; $i < count($data['list']); $i++) { ?>
							<div class="three_block col-lg-3 pod_block"  style="margin-top: 20px !important;">
								<div class="three_block_title"><?=$data['list'][$i]['name']?></div>
								<div class="three_block_text pod_text_block">
									<?php if (isset($data['list'][$i]['header_id'])): ?>
										<p >Керівник: <span style="font-size: 14px;" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$data['list'][$i]['header_id']?>"><?=$data['list'][$i]['header_name']?></span></p>
									<?php endif ?>
									<?php if (isset($data['pod']['list'][$data['list'][$i]['id']]['header'])): ?>
										<!-- <p >Керівник: <span style="font-size: 14px;" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$data['pod']['list'][$data['list'][$i]['id']]['header']['id']?>"><?=$data['pod']['list'][$data['list'][$i]['id']]['header']['last_name']?> <?=mb_substr($data['pod']['list'][$data['list'][$i]['id']]['header']['name'], 0, 1)?>.<?=mb_substr($data['pod']['list'][$data['list'][$i]['id']]['header']['second_name'], 0, 1)?></span></p> -->
										<p style="color: #F0F8FF;">dasdasdsdsadaa</p>
									<?php endif ?>
									<?php if (isset($data['list'][$i]['header_id'])==false and isset($data['pod']['list'][$data['list'][$i]['id']]['header'])==false): ?>
										<p style="color: #F0F8FF;">dasdasdsdsadaa</p>
									<?php endif ?>
									<?php if (isset($data['pod']['list'][$data['list'][$i]['id']]['count'])): ?>
										<p>Співробітників: <?=$data['pod']['list'][$data['list'][$i]['id']]['count']?></p>
									<?php endif ?>
									
									<?php if (isset($data['list'][$i]['count'])): ?>
										<p>Співробітників: <?=$data['list'][$i]['count']?></p>
									<?php endif ?>
								</div>
								<div class="three_btn">
									<?php if (isset($_GET['id']) or isset($data['list'][$i]['type'])): ?>
										<?php if (isset($data['list'][$i]['type']) and $data['list'][$i]['type']=='parent'): ?>
											<?php if ($data['list'][$i]['count']!=0): ?>
												<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="<?=$_GET['pod']?>" data-subpod="<?=$data['list'][$i]['id']?>" data-svalue="<?=$data['list'][$i]['id']?>" data-pod="1" data-pod="1" data-titled="<?=$data['list'][$i]['name']?>">Всі співробітники</div>
												<div class="btn three_button" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-parenttype="<?=$data['list'][$i]['id']?>" data-podid="<?=$data['list'][$i]['id']?>" >Детальніше</div>
											<?php else: ?>
												<div class="btn three_button" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-parenttype="<?=$data['list'][$i]['id']?>" data-podid="<?=$data['list'][$i]['id']?>" style="width: 100% !important;">Детальніше</div>
											<?php endif ?>
										<?php else: ?>
											<?php if ($data['list'][$i]['count']!=0): ?>
												<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="<?=$_GET['pod']?>" data-subpod="<?=$data['list'][$i]['id']?>" data-svalue="<?=$data['list'][$i]['id']?>" data-pod="1" data-ids="<?=$data['list'][$i]['id']?>" data-podid="<?=$back[$ident+1][0]?>" style="width: 100% !important;" data-pod="1" data-titled="<?=$data['list'][$i]['name']?>">Всі співробітники</div>
											<?php endif ?>
										<?php endif ?>
									<?php else: ?>
										<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="<?=$_GET['pod']?>" data-subpod="<?=$data['list'][$i]['id']?>" data-svalue="<?=$data['list'][$i]['id']?>" data-pod="1" data-titled="<?=$data['list'][$i]['name']?>">Всі співробітники</div>
										<div class="btn three_button" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-podid="<?=$data['list'][$i]['id']?>">Детальніше</div>
									<?php endif ?>
								</div>
							</div>
					<?php	}		?>
				</div>
			<?php else: ?>
				<div class="podrazd d-flex flex-wrap justify-content-start">
					<?php 
						for ($i=0; $i < count($data['list']); $i++) { ?>
							<div class="three_block col-lg-3 pod_block"  style="margin-top: 20px !important;">
								<div class="three_block_title"><?=$data['list'][$i]['name']?></div>
								<div class="three_block_text">
									<!-- <p>Керівник: Кривий Г. О,</p> -->
									<p>Співробітників: <?=$data['pod']['list'][$data['list'][$i]['id']]['count']?></p>
								</div>
								<div class="three_btn">
									<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="<?=$_GET['pod']?>" data-svalue="<?=$data['list'][$i]['id']?>" data-pod="1" data-title="<?=$data['list'][$i]['name']?>" style="width: 100% !important;">Всі співробітники</div>
								</div>
							</div>
					<?php	}		?>
				</div>
			<?php endif ?>
		</div>	
	</div>
</div>
