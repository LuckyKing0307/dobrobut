<div class="container">
	<div class="selectType">
		<?php if (isset($_GET['parentid'])): ?>
			<div class="row">
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="getUser(this)" data-userid="<?=$_GET['parentid']?>">
					<div class="leftArrow">
						<img src="front/img/leftArrow.svg" alt="">
					</div>
					<p class="leftArrowText">Назад</p>
				</div>
			</div>
		<?php else: ?>
			<div class="row">
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="loadwebpage(this)" data-loadpage="main">
					<div class="leftArrow">
						<img src="front/img/leftArrow.svg" alt="">
					</div>
					<p class="leftArrowText">Назад</p>
				</div>
			</div>
		<?php endif ?>
	</div>
	<div class="userInfo">
		<div class="row">
			<div class="col-lg-5 d-flex align-items-center">
				<?php if ($data[$main]['photo']!=''): ?>
					<div class="ava" style='background-image:url("<?=$data[$main]['photo']?>");
    background-repeat: no-repeat;
    background-size: cover; '></div>
				<?php else: ?>
					<div class="ava"><?=$first_character_name?><?=$first_character_lastname?></div>
				<?php endif ?>

				<div class="name title"><?=$data[$main]['last_name']?> <?=$first_character_name?>.<?=$first_character_lastname?>.</div>
			</div>
		</div>
	</div>
	<div class="userTable">
		<div class="row d-flex justify-content-between">
			<div class="col-lg-12">
				<table class="table resultTable">
					<thead>
						<tr>
							<th style="font-size: 15px;">Прізвище </th>
							<th style="font-size: 15px;">Ім’я </th>
							<th style="font-size: 15px;">По батькові </th>
							<th style="font-size: 15px;">Телефон </th>
							<th style="font-size: 15px;">Email </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="font-size: 14px;"><?=$data[$main]['last_name']?> </td>
							<td style="font-size: 14px;"><?=$data[$main]['name']?>  </td>
							<td style="font-size: 14px;"><?=$data[$main]['second_name']?>  </td>
							<td style="font-size: 14px;"><?=$data[$main]['phone']?> </td>
							<td style="font-size: 14px;"><?=$data[$main]['email']?> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="tableRes tableMobile">
		<div class="row" style="width: 100%;">
			<div class="col-lg-12 d-flex" style="padding: 5px;">
				<div class="main_data">
					<table class="table resultTable">
						<thead>
							<tr>
								<th>Прізвище </th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if (isset($data[$main])) { ?>
										
									<tr>
										<td height="52px" style=" padding-left: 3px;"><?=$data[$main]['last_name']?> </td>
									</tr>
									<?php  
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="cor">
					<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false" data-bs-touch="false">
					  <div class="carousel-inner">
					    <div class="carousel-item active" id="cor1">
							<table class="table resultTable">
								<thead>
									<tr>
										<th>Ім’я </th>
										<th>По батькові </th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($data[$main])) { ?>
												
											<tr>
												<td height="52px"><?=$data[$main]['name']?>  </td>
												<td height="52px"><?=$data[$main]['second_name']?>  </td>
											</tr>
											<?php  
										}
									?>
								</tbody>
							</table>
					    </div>
					    <div class="carousel-item"  id="cor2">
							<table class="table resultTable">
								<thead>
									<tr>
										<th style="">Телефон </th>
										<th style="">Email </th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($data[$main])) { ?>
												
											<tr>
												<td height="52px"><?=$data[$main]['phone']?> </td>
												<td height="52px"><?=$data[$main]['email']?> </td>
											</tr>
											<?php  
										}
									?>
								</tbody>
							</table>
					    </div>
					  </div>
					  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" onclick="showUserSlide(this)">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Previous</span>
					  </button>
					  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next"  onclick="showUserSlide(this)">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Next</span>
					  </button>
					 </div>		   			
				</div> 
			</div>
		</div>
	</div>
	<div class="userDetails">
		<div class="row d-flex justify-content-between">
			<div class="col-lg-5">
				<div class="title">
					Основне місце роботи
				</div>
				<div class="userDetail">
					<div class="detail d-flex ">
						<p class="detailTitle first_detail">Тип персоналу</p>
						<p class="detailText"><?=$data[$main]['pos_name']?></p>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle">Підрозділ</p>
						<p class="detailText"><?=$data[$main]['org_name']?></p>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle">Відділ</p>
						<p class="detailText"><?=$data[$main]['dep_name']?></p>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle">Посада</p>
						<p class="detailText"><?=$data[$main]['post_name']?></p>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle">Керівник</p>
						<?php if (is_array($data[$main]['header'])): ?>
						<p class="userLink clickable detailText" style="font-size: 12px;"  onclick="getUser(this)" data-userid="<?=$data[$main]['header']['id']?>"  data-parentid="<?=$data[$main]['id']?>"><?=$data[$main]['header']['last_name']?> <?=$first_character_headername?>.<?=$first_character_headerlastname?>.</p>
						<?php else: ?>
						<p class="detailText">_</p>
						<?php endif ?>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle">Напрямок</p>
						<p class="detailText"><?=$data[$main]['der_name']?></p>
					</div>
					<div class="detail d-flex">
						<p class="detailTitle lastdetailTitle">Лідер напрямку</p>
						<p class="detailText">_</p>
					</div>
				</div>
			</div>
			<div class="col-lg-5 work_hist">
				<?php if (count($data)>1): ?>
					<div class="title">
						Місця роботи за сумісництвом
					</div>
					<?php 
					$work_count = 2;
					for ($i=0; $i < count($data); $i++) { 
						if ($i!=$main){ 
					?>
							<div class="userDetail">
								<div class="detail d-flex">
									<p class="detailTitle">Відділ <?=$work_count?></p>
									<p class="detailText"><?=$data[$i]['dep_name']?></p>
								</div>
								<div class="detail d-flex">
									<p class="detailTitle lastdetailTitle">Посада <?=$work_count?></p>
									<p class="detailText"><?=$data[$i]['post_name']?></p>
								</div>
							</div>
						<?php  
						$work_count = $work_count+1;
					}} ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
