$('body').click(function( e ) {
	if ($(e.target).data('seltype')) {
		openSelect(e.target)
	}else {
		closeAllSelect()
	}
})
function loadwebpage(e){
	if ($(e).data('sttype')) {
		if ($(e).data('pod')) {
			$.get( location.href+"model/structure.php?structure="+$(e).data('sttype')+"&req="+$(e).data('svalue')+"&pod="+$(e).data('sttype'), function( data ) {
			  $( "body" ).html(data);
			});
		}else{
			$.get( location.href+"model/structure.php?structure="+$(e).data('sttype')+"&req="+$(e).data('svalue'), function( data ) {
			  $( "body" ).html(data);
			});
		}
	}else if (e=='tree') {
		$.get( location.href+"model/tree.php", function( data ) {
		  $( "body" ).html(data);
		});
	}
	else{
		$.get( location.href+"model/main.php", function( data ) {
		  $( "body" ).html(data);
		});
		$('#searchInput').keyup(function(e){
			if (e.key=='Enter') {
				searchUser();
			}
		})
		$('body').off("click");
		$('body').click(function( e ) {
			if ($(e.target).data('seltype')) {
				console.log('adsadasd');
				openSelect(e.target);
			}else {
				closeAllSelect()
			}
		})
	}
}
function search(e){
	let text_input = $("#searchInput").val().toLowerCase();
	text_input = text_input.charAt(0).toUpperCase() + text_input.slice(1);
	$.get( location.href+"model/structure.php?structure="+$("#type_search").val()+"&req="+$("#type_value").val()+"&search="+text_input, function( data ) {
		console.log('asdasdasd');
	 	  $( "body" ).html(data);
	  	  $("#searchInput").focus();
	  	  let old_val = $("#searchInput").val();
	  	  $("#searchInput").val('').val(old_val);
	});
}
function searchUser(e){
	let text_input = $("#searchInput").val().toLowerCase();
	text_input = text_input.charAt(0).toUpperCase() + text_input.slice(1);
		$.get( location.href+"model/main.php?search="+text_input, function( data ) {
		  console.log('asdasdasd12312');
		  $( "body" ).html(data);
	  	  $("#searchInput").focus();
	  	  let old_val = $("#searchInput").val();
	  	  $("#searchInput").val('').val(old_val);
		});
		$('#searchInput').keyup(function(e){
			if (e.key=='Enter') {
				searchUser();
			}
		})
		$('body').click(function( e ) {
			if ($(e.target).data('seltype')) {
				openSelect(e.target)
			}else {
				closeAllSelect()
			}
		})		
}
function paging(e){
	if ($('#searchInput').val()!='') {
		$.get( location.href+"model/main.php?paging="+$(e).data('paging')+"&search="+$("#searchInput").val(), function( data ) {
		  $( "body" ).html(data);
		});
	}else{
		$.get( location.href+"model/main.php?paging="+$(e).data('paging'), function( data ) {
		  $( "body" ).html(data);
		});
		$('#searchInput').keyup(function(e){
			if (e.key=='Enter') {
				searchUser();
			}
		})
	}
	$('body').click(function( e ) {
		if ($(e.target).data('seltype')) {
			openSelect(e.target)
		}else {
			closeAllSelect()
		}
	})		
}
function searchPage(e){
	$.get( location.href+"view/search.php", function( data ) {
	  $( "body" ).html(data);
	});
}
function getUser(e){
	if ($(e).data('parentid')) {
		$.get( location.href+"model/user.php?id="+$(e).data('userid')+"&parentid="+$(e).data('parentid'), function( data ) {
		  $( "body" ).html(data);
		});
	}else{
		$.get( location.href+"model/user.php?id="+$(e).data('userid'), function( data ) {
		  $( "body" ).html(data);
		});
	}

}
function pagingDep(e){
	let search_text = location.href+"model/structure.php?paging="+$(e).data('paging');
	if ($('#searchInput').val()!='') {
		search_text=search_text+"&search="+$("#searchInput").val()
	}if ($('#type_search').val()!='') {
		search_text=search_text+"&structure="+$("#type_search").val()
	}
	search_text=search_text+"&req="+$("#type_value").val()
	$.get( search_text, function( data ) {
	  $( "body" ).html(data);
	});
}
function openSelect(e) {
		let selectid = $(e).data('seltype');
		if ($(e).data('seltype')) {
			if ($('#'+selectid).hasClass('active')) {
				$('.buttonSelect').removeClass('btn_active')
				$('.selectList').removeClass('active');

			}else{
				$('.buttonSelect').removeClass('btn_active')
				$('#'+$(e).data('seltype')+'Button').addClass('btn_active')
				let selectid = $(e).data('seltype');
				$('.selectList').removeClass('active');
				$('#'+selectid).addClass('active');
			}

		}
}
function closeAllSelect(){
	$('.buttonSelect').removeClass('btn_active')
	$('.selectList').removeClass('active');
}

function showSlide(e){
	$('.carousel-control-prev').css('display','flex');
	$('.carousel-control-next').css('display','flex');
	
	if ($('#cor2').hasClass( "active" )) {
		$(e).css('display','none');
	}
}
function showUserSlide(e){
	
	$('.carousel-control-prev').css('display','flex');
	$('.carousel-control-next').css('display','flex');
	if ($('#cor2').hasClass( "active" )===false) {
		$('.carousel-control-next').css('display','none');
	}
	if ($('#cor1').hasClass( "active" )===false) {
		$('.carousel-control-prev').css('display','none');
	}


	console.log($('#cor2').hasClass("active"));
}
function pod(e){
	if ($(e).data('svalue')=='pod') {
		$.get( location.href+"model/pod.php?pod="+$(e).data('sttype'), function( data ) {
		  $( "body" ).html(data);
		});
	}else{
		$.get( location.href+"model/tree.php", function( data ) {
		  $( "body" ).html(data);
		});
	}
}


function tree(e){
	if (e=='back') {
		$.get( location.href+"model/main.php", function( data ) {
		  $( "body" ).html(data);
		});
		$('#searchInput').keyup(function(e){
			if (e.key=='Enter') {
				searchUser();
			}
		})

		$('body').click(function( e ) {
			if ($(e.target).data('seltype')) {
				openSelect(e.target)
			}else {
				closeAllSelect()
			}
		})
	}else{
		$.get( location.href+"model/tree.php", function( data ) {
		  $( "body" ).html(data);
		});
	}
}

function types(e){
	$("#"+e).css("display", "flex");
}
function typesExit(e){
	$("#"+e).css("display", "none");
}