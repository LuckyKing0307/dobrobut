<div class="container">
	<div class="selectType">
		<div class="row">
			<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod()" data-loadpage="main">
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
				<p class="tableText">Підрозділи</p>
			</div>
		</div>
		<div class="row">
			<div class="podrazd d-flex flex-wrap justify-content-start">
				<?php 
					for ($i=0; $i < count($data['list']); $i++) { ?>
						<div class="three_block col-lg-3 pod_block"  style="margin-top: 20px !important;">
							<div class="three_block_title"><?=$data['list'][$i]['name']?></div>
							<div class="three_block_text">
								<p>Керівник: Кривий Г. О,</p>
								<p>Співробітників: <?=$data['pod']['list'][$data['list'][$i]['id']]['count']?></p>
							</div>
							<div class="three_btn">
								<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="<?=$_GET['pod']?>" data-svalue="<?=$data['list'][$i]['id']?>" data-pod="1" style="width: 100% !important;">Всі співробітники</div>
							</div>
						</div>
				<?php	}		?>
			</div>
		</div>	
	</div>
</div>
