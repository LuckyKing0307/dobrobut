linked = new Array();
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
			if ($(e).data('podid')) {
				if ($(e).data('back')) {
						linked.splice($(e).data('back'), 1);
				}else{
					if (linked[linked.length-1][0]!=$(e).data('podid')) {
						link_datas[0] = $(e).data('podid');
						link_datas[1] = 'parentid';
						linked[linked.length] = link_datas;
					}
				}
			console.log(linked);
			}
			$.get( location.href+"model/structure.php?structure="+$(e).data('sttype')+"&req="+$(e).data('svalue')+"&pod="+$(e).data('sttype')+"&id="+$(e).data('ids')+"&back="+JSON.stringify(linked), function( data ) {
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
	search_text = '';
	if ($('#back_link').val()!='') {
		search_text=search_text+"&back="+$("#back_link").val()
	}if ($('#pod_link').val()!='') {
		search_text=search_text+"&pod="+$("#pod_link").val()
	}
	$.get( location.href+"model/structure.php?structure="+$("#type_search").val()+"&req="+$("#type_value").val()+"&search="+text_input+""+search_text, function( data ) {
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
	if ($(e).data('palcement')) {
		$.get( location.href+"view/search.php?place="+$(e).data('palcement'), function( data ) {
		  $( "body" ).html(data);
		});
	}else{
		$.get( location.href+"view/search.php", function( data ) {
		  $( "body" ).html(data);
		})
	}

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
function getUser(e){
	if ($(e).data('parentid')) {
		if ($("#type_value").val()!='') {

			// if (linked[linked.length-1][0]!=$(e).data('podid')) {
			// 	link_datas[0] = $(e).data('podid');
			// 	link_datas[1] = 'parentid';
			// 	linked[linked.length] = link_datas;
			// }
			console.log('asdasd');
			$.get( location.href+"model/user.php?id="+$(e).data('userid')+"&parentid="+$(e).data('parentid')+"&type_value="+$("#type_value").val()+"&type_search="+$("#type_search").val()+"&back="+JSON.stringify(linked), function( data ) {
			  $( "body" ).html(data);
			});
		}else{
			$.get( location.href+"model/user.php?id="+$(e).data('userid')+"&parentid="+$(e).data('parentid'), function( data ) {
			  $( "body" ).html(data);
			});
		}
	}else{
		if ($("#type_value").val()!='') {

			// if (linked[linked.length-1][0]!=$(e).data('podid')) {
			// 	link_datas[0] = $(e).data('podid');
			// 	link_datas[1] = 'parentid';
			// 	linked[linked.length] = link_datas;
			// }
			console.log('asdasd');
			$.get( location.href+"model/user.php?id="+$(e).data('userid')+"&type_value="+$("#type_value").val()+"&type_search="+$("#type_search").val()+"&back="+JSON.stringify(linked), function( data ) {
			  $( "body" ).html(data);
			});

		}else{
			$.get( location.href+"model/user.php?id="+$(e).data('userid')+"", function( data ) {
			  $( "body" ).html(data);
			});
		}
	}

}
function pagingDep(e){
	let search_text = location.href+"model/structure.php?paging="+$(e).data('paging');
	if ($('#searchInput').val()!='') {
		search_text=search_text+"&search="+$("#searchInput").val()
	}if ($('#type_search').val()!='') {
		search_text=search_text+"&structure="+$("#type_search").val()
	}if ($('#type_search').val()!='') {
		search_text=search_text+"&back="+$("#back_link").val()
	}if ($('#pod_link').val()!='') {
		search_text=search_text+"&pod="+$("#pod_link").val()
	}
	search_text=search_text+"&req="+$("#type_value").val()
	$.get( search_text, function( data ) {
	  $( "body" ).html(data);
	});

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
	let link_datas = new Array();
	if ($(e).data('svalue')=='pod') {
		if ($(e).data('podid')) {
			if ($(e).data('parenttype')) {
				if ($(e).data('back')) {
					linked.splice($(e).data('back'), 1);
				}else{
					if (linked[linked.length-1][0]!=$(e).data('podid')) {
						link_datas[0] = $(e).data('podid');
						link_datas[1] = 'parentid';
						linked[linked.length] = link_datas;
					}
				}
				$.get( location.href+"model/pod.php?pod="+$(e).data('sttype')+"&parentid="+$(e).data('podid')+"&back="+JSON.stringify(linked), function( data ) {
				  $( "body" ).html(data);
				});
				console.log(JSON.stringify(linked));
			}else{
				if ($(e).data('back')) {
					linked.splice($(e).data('back'), 1);
				}else{
					if (linked[linked.length-1][0]!=$(e).data('podid')) {
						link_datas[0] = $(e).data('podid');
						link_datas[1] = 'id';
						linked[linked.length] = link_datas;
					}
				}
				console.log(JSON.stringify(linked));
				$.get( location.href+"model/pod.php?pod="+$(e).data('sttype')+"&id="+$(e).data('podid')+"&back="+JSON.stringify(linked), function( data ) {
				  $( "body" ).html(data);
				});
			}
		}else{
			if ($(e).data('back')) {
					linked.splice($(e).data('back'), 1);
			}else{
				if (linked.length==0) {
					link_datas[0] = $(e).data('podid');
					link_datas[1] = '';
					linked[linked.length] = link_datas;
				}
			}
			$.get( location.href+"model/pod.php?pod="+$(e).data('sttype'), function( data ) {
			  $( "body" ).html(data);
			});
		}
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
			console.log('asdasd123321');
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
	if (document.body.clientWidth<1000) {
		$("#"+e).css("display", "flex");
	}
}
function typesExit(e){
	$("#"+e).css("display", "none");
}