<div class="container">
	<div class="selectType">
		<?php if ($user_linked[$ident-1]!=''): ?>
			<div class="row">
				<?php if (isset($_GET['back']) and $_GET['back']!='[]'): ?>
					<input type="hidden" id="back_link" value='<?=json_encode($back)?>'>
				<?php endif ?>
				<input type="hidden" id="type_search" value="<?=$type_search?>">
				<input type="hidden" id="type_value" value="<?=$type_value?>">
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="getUser(this)" data-userid="<?=$user_linked[$ident-1]?>" data-back="<?=$ident?>">
					<div class="leftArrow">
						<img src="front/img/leftArrow.svg" alt="">
					</div>
					<p class="leftArrowText">Назад</p>
				</div>
			</div>
		<?php else: ?>
			<div class="row">
				<?php if (isset($type_value) and $type_value!=''): ?>
					<?php if (isset($_GET['back']) and $_GET['back']!='[]'): ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="loadwebpage(this)" data-sttype="<?=$type_search?>" data-subpod="<?=$type_value?>" data-svalue="<?=$type_value?>" data-pod="1" data-userback="<?=$ident?>">
						<input type="hidden" id="back_link" value='<?=json_encode($back)?>'>
						<input type="hidden" id="type_search" value="<?=$type_search?>">
						<input type="hidden" id="type_value" value="<?=$type_value?>">
					<?php else: ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="loadwebpage(this)" data-sttype="<?=$type_search?>" data-svalue="<?=$type_value?>" data-userback="<?=$ident?>">
						<input type="hidden" id="type_search" value="<?=$type_search?>">
						<input type="hidden" id="type_value" value="<?=$type_value?>">
					<?php endif ?>
				<?php else: ?>	
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="loadwebpage(this)" data-loadpage="main" data-userback="<?=$ident?>">
				<?php endif ?>
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
				<?php if (isset($data[$main]['photo'])): ?>
					<div class="ava" data-imgsrc="<?=$data[$main]['photo']?>" data-names="<?=$first_character_name?><?=$first_character_lastname?>" style='
			    background-repeat: no-repeat;
			    background-size: cover; '></div>
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
						<?php if (is_array($data[$main]['header']) and ($data[$main]['header']['last_name'].''.$first_character_headername)!=($data[$main]['last_name'].''.$first_character_name)): ?>
						<p class="userLink clickable detailText" style="font-size: 14px;"  onclick="getUser(this)" data-userid="<?=$data[$main]['header']['id']?>"  data-parentid="<?=$data[$main]['id']?>"><?=$data[$main]['header']['last_name']?> <?=$first_character_headername?>.<?=$first_character_headerlastname?>.</p>
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
						<?php if (is_array($data[$main]['der_header'])): ?>
						<p class="userLink clickable detailText" style="font-size: 14px;"  onclick="getUser(this)" data-userid="<?=$data[$main]['der_header']['id']?>"  data-parentid="<?=$data[$main]['id']?>"><?=$data[$main]['der_header']['last_name']?> <?=$first_character_leadername?>.<?=$first_character_leaderlastname?>.</p>
						<?php else: ?>
						<p class="detailText">_</p>
						<?php endif ?>
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
								<div class="detail d-flex">
									<p class="detailTitle lastdetailTitle">Керівник <?=$work_count?></p>
									<?php if (is_array($data[$i]['header']) and ($data[$i]['header']['last_name'].''.$first_character_headername)!=($data[$i]['last_name'].''.$first_character_name)): ?>
									<p class="userLink clickable detailText" style="font-size: 14px;"  onclick="getUser(this)" data-userid="<?=$data[$i]['header']['id']?>"  data-parentid="<?=$data[$i]['id']?>"><?=$data[$i]['header']['last_name']?> <?=mb_substr($data[$i]['header']['name'], 0, 1)?>.<?=mb_substr($data[$i]['header']['second_name'], 0, 1)?>.</p>
									<?php else: ?>
									<p class="detailText">_</p>
									<?php endif ?>
								</div>
								<div class="detail d-flex">
									<p class="detailTitle lastdetailTitle">Напрямок <?=$work_count?></p>
									<p class="detailText"><?=$data[$i]['der_name']?></p>
								</div>
								<div class="detail d-flex">
									<p class="detailTitle lastdetailTitle">Лідер напрямку <?=$work_count?></p>
									<?php if (is_array($data[$i]['der_header'])): ?>
									<p class="userLink clickable detailText" style="font-size: 14px;"  onclick="getUser(this)" data-userid="<?=$data[$i]['der_header']['id']?>"  data-parentid="<?=$data[$i]['id']?>"><?=$data[$i]['der_header']['last_name']?> <?=mb_substr($data[$i]['der_header']['name'], 0, 1)?>.<?=mb_substr($data[$i]['der_header']['second_name'], 0, 1)?>.</p>
									<?php else: ?>
									<p class="detailText">_</p>
									<?php endif ?>
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
<script defer>
	// CHECK IF IMAGE EXISTS
function checkIfImageExists(url, callback) {
  const img = new Image();
  img.src = url;
  
  if (img.complete) {
    callback(true);
  } else {
    img.onload = () => {
      callback(true);
    };
    
    img.onerror = (e) => {
      callback(false);
    };
  }
}


ava = $('.ava');
// USAGE
if (ava.data('imgsrc')) {
	console.log(ava.data('imgsrc'))
	checkIfImageExists(ava.data('imgsrc'), (exists) => {
	  if (exists) {
 		ava.css("background-image", "url("+ava.data('imgsrc')+")");
	  } else {
 		ava.html( ava.data('names') );
 		ava.attr('src','ссылка находится на другом хостинге');
	  }
	});	
}else{
 	ava.html( ava.data('names') );
}
</script>
