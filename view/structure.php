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
			<?php if (isset($_GET['pod'])): ?>
				<?php if ($_GET['pod']=='department_id'): ?>
					<?php if ($back[$ident][1]=='id'): ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-podid="<?=$back[$ident][0]?>">
					<?php endif ?>
					<?php if ($back[$ident][1]=='parentid'): ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-parenttype="<?=$back[$ident][0]?>" data-podid="<?=$back[$ident][0]?>">
					<?php endif ?>
					<?php if ($back[$ident][1]==''): ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod">
					<?php endif ?>
					<!-- <div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="organization_id" data-svalue="pod" data-podid="<?=$_GET['id']?>"> -->
				<?php else: ?>
						<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="pod(this)" data-sttype="<?=$_GET['structure']?>" data-svalue="pod">
				<?php endif ?>
			<?php else: ?>
				<div class="col-lg-2 d-flex align-items-center flex-wrap" onclick="<?=$backs?>" data-loadpage="main">
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
			<div class="col-lg-12">
				<div class="infoText clickable" onclick="searchPage(this)">Як користуватися пошуком?</div>
			</div>
			<div class="col-lg-12">
				<div class="searchForm d-flex align-items-center">
					<?php if ($_GET['req']==''): ?>
						<input type="search" class="inputSearch" id="searchInput" placeholder="Пошук (працює по <?=$title1?>)" value="<?=$search_req?>">
					<?php else: ?>
						<input type="search" class="inputSearch" id="searchInput" placeholder="Пошук (працює по <?=$title?>)" value="<?=$search_req?>">
					<?php endif ?>
					<input type="hidden" id="type_search" value="<?=$type['search']?>">
					<input type="hidden" id="type_value" value="<?=$type['value']?>">
					<?php if (isset($back)): ?>
						<input type="hidden" id="back_link" value='<?=json_encode($back)?>'>
					<?php endif ?>
					<?php if ($_GET['pod']): ?>
						<input type="hidden" id="pod_link" value='<?=$_GET['pod']?>'>
					<?php endif ?>
					<div class="buttonSearch" onclick="search(this)">Search</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tableRes">
		<div class="row">
			<div class="col-lg-6">
					<?php if ($_GET['req']==''): ?>
						<div class="title"><p class="title tableTitle"><?=$title1?></p></div>
					<?php else: ?>
						<div class="title"><p class="title tableTitle"><?=$title?></p></div>
					<?php endif ?>
				<p class="tableText">Співробітників: <span id="tableNumber"><?=$data['count_list']?></span></p>
			</div>
			<div class="paging col-lg-6">
					<div class=" d-flex justify-content-end">
						<div class="pagingMain d-flex">
							<?php if (isset($_GET['paging']) and $_GET['paging']>0): ?>
								<div class="leftpaging leftpagingactive clickable" id="leftpaging" data-paging="<?=$_GET['paging']-1?>" onclick="pagingDep(this)"></div>
								<div class="paging_number"><?=$_GET['paging']+1?></div>
								<?php if (($_GET['paging']+1)==$paging_count): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>" onclick="pagingDep(this)"></div>	
								<?php endif ?>
							<?php else: ?>
								<div class="leftpaging clickable" id="leftpaging" data-paging="0"></div>
								<div class="paging_number">1</div>
								<?php if (1==$paging_count or 0==$paging_count): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="1"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="1" onclick="pagingDep(this)"></div>	
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
									<td height="70px"><a href="tel:<?=$users['phone']?>" style="color: #3676B8;"><?=$users['phone']?></a></td>
									<td height="70px"><a href="mailto:<?=$users['email']?>" style="color: #3676B8;"><?=$users['email']?></a></td>
									<!-- <td><?=$users['org_name']?></td> -->
									<td height="70px" ><?=$users['dep_name']?></td>
									<td height="70px" ><?=$users['post_name']?></td>
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
			<div class="col-lg-12 d-flex">
				<div class="main_data">
					<table class="table resultTable">
						<thead>
							<tr>
								<th class="col-lg-1">Прізвище</th>
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

					<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"  data-bs-touch="false" data-bs-touch="false">
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
		    <div class="carousel-item" id="cor2">
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
									<td height="52px"><a class="userLink" href="tel:<?=$users['phone']?>" style="color: #3676B8;"><?=$users['phone']?></a></td>
									<td height="52px"><a class="userLink" href="mailto:<?=$users['email']?>" style="color: #3676B8;"><?=$users['email']?></a></td>
								</tr>
								<?php  }
							}
						?>
					</tbody>
				</table>
		    </div>
		    <div class="carousel-item" id="cor3">
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
										<td height="52px" style="padding: 0; padding-left: 5px;"><?=mb_substr($users['dep_name'], 0, 10)?>...</td>
										<td height="52px" style="padding: 0;"><?=mb_substr($users['post_name'], 0, 10)?>...</td>
									</tr>
								<?php  }
							}
						?>
					</tbody>
				</table>
		    </div>
		  </div>
		  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev"  onclick="showSlide(this)">
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
								<div class="leftpaging leftpagingactive clickable" id="leftpaging" data-paging="<?=$_GET['paging']-1?>" onclick="pagingDep(this)"></div>
								<div class="paging_number"><?=$_GET['paging']+1?></div>
								<?php if (($_GET['paging']+1)==$paging_count): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="<?=$_GET['paging']+1?>" onclick="pagingDep(this)"></div>	
								<?php endif ?>
							<?php else: ?>
								<div class="leftpaging clickable" id="leftpaging" data-paging="0"></div>
								<div class="paging_number">1</div>
								<?php if (1==$paging_count or $paging_count==0): ?>
									<div class="rightpaging" id="rightpaging"  data-paging="1"></div>	
								<?php else: ?>
									<div class="rightpaging clickable rightpagingactive" id="rightpaging"  data-paging="1" onclick="pagingDep(this)"></div>	
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
<script defer>
	$('#searchInput').keyup(function(e){
		if (e.key=='Enter') {
			search('structure');
		}
	})
</script>