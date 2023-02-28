<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../front/css/main.css">
</head>
<body>
<div class="container">
	<div class="selectType">
		<div class="row">
			<div class="col-lg-4 d-flex align-items-center flex-wrap justify-content-between flex-nowrap">
				<div class="title">
					<p class="title text-nowrap">Структура компанії</p>
				</div>
				<div class="checker d-flex align-items-center justify-content-between">
					<span class="text">Таблиця</span>
					<div class="checkBox checkBoxActive" onclick="tree('back')">
						<div class="checkBoxPoint"></div>
					</div>
					<span class="text">Дерево</span>
				</div>
			</div>
		</div>
	</div>
	<div class="searchBox">
		<div class="row tree">
			<ul class="col-lg-12 d-flex flex-nowrap justify-content-center">
				<li class="main_roots">
					<div class="three_block three_block_main">
						<div class="three_block_title">Dobrobut</div>
						<div class="three_block_text">
							<p>Співробітників: <?=$data['count']?></p>
						</div>
					</div>
					<ul class="d-flex flex-nowrap ul_intem">
						<li class="li_tree">
							<div class="three_block">
								<div class="three_block_title" onclick="types('organization_id')">Організаційна структура</div>
								<div class="three_block_text">
									<p>Керівник: Кривий Г. О,</p>
									<p>Підрозділи: <?=count($data['org'])?></p>
								</div>
								<div class="three_btn desc_three">
									<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="organization_id" data-svalue="">Всі співробітники</div>
									<div class="btn three_button" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod">Підрозділи</div>
								</div>
							</div>
						</li>
						<li class="li_tree">
							<div class="three_block">
								<div class="three_block_title" onclick="types('direction')">Функціональна структура</div>
								<div class="three_block_text">
									<p>Керівник: Кривий Г. О,</p>
									<p>Підрозділи: <?=count($data['per_dir'])?></p>
								</div>
								<div class="three_btn desc_three">
									<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="direction" data-svalue="">Всі співробітники</div>
									<div class="btn three_button" onclick="pod(this)" data-sttype="direction" data-svalue="pod">Підрозділи</div>
								</div>
							</div>
						</li>
						<li class="li_tree">
							<div class="three_block">
								<div class="three_block_title" onclick="types('position_type')">За типами співробітників</div>
									<div class="three_block_text">
									<p>Керівник: Кривий Г. О,</p>
									<p>Підрозділи: <?=count($data['per_type'])?></p>
								</div>
								<div class="three_btn desc_three">
									<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="position_type" data-svalue="">Всі співробітники</div>
									<div class="btn three_button" onclick="pod(this)" data-sttype="position_type" data-svalue="pod">Підрозділи</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
	<div class="block_mobile" id="organization_id">
		<div class="background"></div>
		<div class="tree_mobile">
			<div class="close" onclick="typesExit('organization_id')">
				<img src="../front/img/exit1.svg" alt="">
			</div>
			<div class="mobile_block_title">Організаційна структура</div>
			<div class="content">
				<p class="mobile_text">Керівник: Кривий Г. О,</p>
				<p class="mobile_text">Співробітників: <?=count($data['org'])?></p>
			</div>
			<div class="three_btn">
				<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="organization_id" data-svalue="">Всі співробітники</div>
				<div class="btn three_button" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod">Підрозділи</div>
			</div>
		</div>
	</div><div class="block_mobile" id="direction">
		<div class="background"></div>
		<div class="tree_mobile">
			<div class="close" onclick="typesExit('direction')">
				<img src="../front/img/exit1.svg" alt="">
			</div>
			<div class="mobile_block_title">Функціональна структура</div>
			<div class="content">
				<p class="mobile_text">Керівник: Кривий Г. О,</p>
				<p class="mobile_text">Співробітників: <?=count($data['per_dir'])?></p>
			</div>
			<div class="three_btn">
				<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="direction" data-svalue="">Всі співробітники</div>
				<div class="btn three_button" onclick="pod(this)" data-sttype="direction" data-svalue="pod">Підрозділи</div>
			</div>
		</div>
	</div><div class="block_mobile" id="position_type">
		<div class="background"></div>
		<div class="tree_mobile">
			<div class="close" onclick="typesExit('position_type')">
				<img src="../front/img/exit1.svg" alt="">
			</div>
			<div class="mobile_block_title">За типами співробітників</div>
			<div class="content">
				<p class="mobile_text">Керівник: Кривий Г. О,</p>
				<p class="mobile_text">Співробітників: <?=count($data['per_type'])?></p>
			</div>
			<div class="three_btn">
				<div class="btn three_button three_button_blue" onclick="loadwebpage(this)" data-sttype="position_type" data-svalue="">Всі співробітники</div>
				<div class="btn three_button" onclick="pod(this)" data-sttype="position_type" data-svalue="pod">Підрозділи</div>
			</div>
		</div>
	</div>
</body>
</html>