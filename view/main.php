<?php 
	if ($data['count']%10>0) {
		$paging_count=($data['count']-$data['count']%10)/10+1;
	}else{
		$paging_count=$data['count']/10;
	}
	$search_req='';
	if (isset($_GET['search'])) {
		$search_req = $_GET['search'];
	}
?>
<div class="container">
	<div class="selectType">
		<div class="row">
			<div class="col-lg-4 d-flex align-items-center flex-wrap justify-content-between flex-nowrap tree_block_select">
				<div class="title">
					<p class="title text-nowrap">Структура компанії</p>
				</div>
				<div class="checker d-flex align-items-center justify-content-between tree_select_btn">
					<span class="text">Таблиця</span>
					<div class="checkBox" onclick="tree('tree')">
						<div class="checkBoxPoint"></div>
					</div>
					<span class="text">Дерево</span>
				</div>
			</div>
		</div>
	</div>
	<div class="searchBox">
		<div class="row">
			<div class="col-lg-12">
				<div class="infoText clickable" onclick="searchPage(this)" data-loadpage="search">Як користуватися пошуком?</div>
			</div>
			<div class="col-lg-12">
				<div class="searchForm d-flex align-items-center">
					<input type="search" class="inputSearch" id="searchInput" placeholder="Пошук (працює по всій компанії)" value="<?=$search_req?>">
					<div class="buttonSearch" onclick="searchUser(this)">Search</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="selectItem">
				  <div class="selectBox" data-seltype="organization_id">
				    <div class="titleSelect" data-seltype="organization_id">Організаційна структура</div>
				    <div class="buttonSelect" id="organization_idButton" >
				      <img src="front/img/dropDown.svg" alt="" data-seltype="organization_id">
				    </div>
				  </div>
				  <div class="selectList" id="organization_id">
				    <?php 	foreach ($data['org'] as $org) { ?>
				    	<div onclick="loadwebpage(this)" data-sttype="organization_id" data-svalue="<?=$org['id']?>"><?=$org['name']?></div>
					<?php	} ?>
				  </div>
				</div>
			</div>
			<div class="col-lg-4">

				<div class="selectItem">
				  <div class="selectBox" data-seltype="direction">
				    <div class="titleSelect" data-seltype="direction">Функціональна структура</div>
				    <div class="buttonSelect" id="directionButton">
				      <img src="front/img/dropDown.svg" alt="" data-seltype="direction">
				    </div>
				  </div>
				  <div class="selectList" id="direction">
				    <?php 	foreach ($data['per_dir'] as $org) { ?>
				    	<div onclick="loadwebpage(this)" data-sttype="direction" data-svalue="<?=$org['id']?>"><?=$org['name']?></div>
					<?php	} ?>
				  </div>
				</div>
			</div>
			<div class="col-lg-4">

				<div class="selectItem">
				  <div class="selectBox" data-seltype="position_type">
				    <div class="titleSelect" data-seltype="position_type">За типами співробітників</div>
				    <div class="buttonSelect" id="position_typeButton">
				      <img src="front/img/dropDown.svg" alt="" data-seltype="position_type">
				    </div>
				  </div>
				  <div class="selectList" id="position_type">
				    <?php 	foreach ($data['per_type'] as $org) { ?>
				    	<div onclick="loadwebpage(this)" data-sttype="position_type" data-svalue="<?=$org['id']?>"><?=$org['name']?></div>
					<?php	} ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="tableRes">
		<div class="row">
			<div class="col-lg-6">
				<div class="title"><p class="title tableTitle">Організаційна структура ММ “Добробут”</p></div>
				<p class="tableText">Співробітників: <span id="tableNumber"><?=$data['count']?></span></p>
			</div>
			<div class="paging col-lg-6">
					<div class=" d-flex justify-content-end">
						<div class="pagingMain d-flex">
							<?php if (isset($_GET['paging']) and $_GET['paging']>0): ?>
								<div class="leftpaging leftpagingactive clickable" id="leftpaging" data-paging="<?=$_GET['paging']-1?>" onclick="paging(this)"></div>
								<div class="paging_number"><?=$_GET['paging']+1?></div>
								<?php if (($_GET['paging']+1)==$paging_count): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>" onclick="paging(this)"></div>	
								<?php endif ?>
							<?php else: ?>
								<div class="leftpaging clickable" id="leftpaging" data-paging="0"></div>
								<div class="paging_number">1</div>
								<?php if (1==$paging_count or $paging_count==0): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="1"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="1" onclick="paging(this)"></div>	
								<?php endif ?>
							<?php endif ?>
						</div>
						<div class="pagingText">з <span>&nbsp <?=$paging_count?> &nbsp</span> сторінок</div>
					</div>
			</div>
			<div class="col-lg-12">
				<table class="table resultTable">
					<thead>
						<tr>
							<!-- <th class="col-lg-1">Тип персоналу </th> -->
							<th class="" style="width: 10%;">Прізвище </th>
							<th class="" style="width: 10%;">Ім’я </th>
							<th class="" style="width: 11%;">По батькові </th>
							<th class="" style="width: 12%;">Телефон </th>
							<th class="" style="width: 12%;">Email </th>
							<!-- <th class="col-lg-1">Підрозділ </th> -->
							<th class=""  style="width: 20%;">Відділ </th>
							<th class="" style="width: 15%;">Посада </th>
							<!-- <th class="col-lg-1">Керівник </th> -->
							<!-- <th class="col-lg-1">Напрямок </th> -->
						</tr>
					</thead>
					<tbody>
						<?php 
							if (isset($data['users'])) {
								foreach ($data['users'] as $users) { ?>
									
								<tr>
									<!-- <td><?=$users['pos_name']?></td> -->
									<td height="70px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['last_name']?></td>
									<td height="70px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['name']?></td>
									<td height="70px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['second_name']?></td>
									<td height="70px"><a href="tel:<?=$users['phone']?>"  style="color: #3676B8; white-space: nowrap;"><?=$users['phone']?></a></td>
									<td height="70px"><a href="mailto:<?=$users['email']?>"  style="color: #3676B8;"><?=$users['email']?></a></td>
									<!-- <td><?=$users['org_name']?></td> -->
									<td height="70px"><?=$users['dep_name']?></td>
									<td height="70px"><?=$users['post_name']?></td>
									<!-- <td>Пивовар А. А.</td> -->
									<!-- <td><?=$users['der_name']?></td> -->
								</tr>
								<?php  }
							}
						?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
	<div class="tableRes tableMobile">
		<div class="row" style="width: 100%;">
			<div class="col-lg-6">
				<div class="title"><p class="title tableTitle">Організаційна структура ММ “Добробут”</p></div>
				<p class="tableText">Співробітників: <span id="tableNumber"><?=$data['count']?></span></p>
			</div>
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
								if (isset($data['users'])) {
									foreach ($data['users'] as $users) { ?>
										
									<tr>
										<td height="52px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['last_name']?></td>
									</tr>
									<?php  }
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
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($data['users'])) {
											foreach ($data['users'] as $users) { ?>
												
											<tr>
												<td height="52px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['name']?></td>
												<td height="52px" class="userLink clickable" onclick="getUser(this)" data-userid="<?=$users['id']?>"><?=$users['second_name']?></td>
												<td height="52px"></td>
											</tr>
											<?php  }
										}
									?>
								</tbody>
							</table>
					    </div>
					    <div class="carousel-item"  id="cor2">
							<table class="table resultTable">
								<thead>
									<tr>
										<th>Телефон </th>
										<th>Email </th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($data['users'])) {
											foreach ($data['users'] as $users) { ?>
												
											<tr>
												<td height="52px"><a href="tel:<?=$users['phone']?>" style="color: #3676B8;"><?=$users['phone']?></a></td>
												<td height="52px"><a href="mailto:<?=$users['email']?>" style="color: #3676B8;"><?=$users['email']?></a></td>
											</tr>
											<?php  }
										}
									?>
								</tbody>
							</table>
					    </div>
					    <div class="carousel-item"  id="cor3">
							<table class="table resultTable">
								<thead>
									<tr>
										<th>Відділ </th>
										<th>Посада </th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($data['users'])) {
											foreach ($data['users'] as $users) { ?>
												
											<tr>
												<td height="52px" style="padding: 0; padding-left: 3px;"><?=mb_substr($users['dep_name'], 0, 15)?>...</td>
												<td height="52px" style="padding: 0;"><?=mb_substr($users['post_name'], 0, 15)?>...</td>
											</tr>
											<?php  }
										}
									?>
								</tbody>
							</table>
					    </div>
					  </div>
					  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" onclick="showSlide(this)">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Previous</span>
					  </button>
					  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next"  onclick="showSlide(this)">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Next</span>
					  </button>
					 </div>		   			
				</div> 
			</div>

			<div class="paging col-lg-6">
					<div class=" d-flex justify-content-end">
						<div class="pagingMain d-flex">
							<?php if (isset($_GET['paging']) and $_GET['paging']>0): ?>
								<div class="leftpaging leftpagingactive clickable" id="leftpaging" data-paging="<?=$_GET['paging']-1?>" onclick="paging(this)"></div>
								<div class="paging_number"><?=$_GET['paging']+1?></div>
								<?php if (($_GET['paging']+1)==$paging_count): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>" onclick="paging(this)"></div>	
								<?php endif ?>
							<?php else: ?>
								<div class="leftpaging clickable" id="leftpaging" data-paging="0"></div>
								<div class="paging_number">1</div>
								<?php if (1==$paging_count or $paging_count==0): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="1"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="1" onclick="paging(this)"></div>	
								<?php endif ?>
							<?php endif ?>
						</div>
						<div class="pagingText">з <span>&nbsp <?=$paging_count?> &nbsp</span> сторінок</div>
					</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://dobrobut.learn-solve.com/front/js/main.js" defer=""></script>
<script>
	$('#searchInput').keyup(function(e){
		if (e.key=='Enter') {
			searchUser();
		}
	})
</script>
