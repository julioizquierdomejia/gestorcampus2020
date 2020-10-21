$(document).ready(function(){

	cardInicio()

	function cardInicio(){
		$('.box').css({'display':'none'});
		$('.box').css({'left':'500px', 'transform':'rotate(20deg)', 'opacity':0});

		$('.box_more_result').css({'display':'none'});
		$('.box_more_result').css({'left':'500px', 'transform':'rotate(20deg)', 'opacity':0});
	}
	

	$('#tabla').DataTable({
		"pagingType": "full_numbers",
        "ordering": false,
        "info":     true,
	});

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN' : $("input[name=_token]")
		}
	})

	$('#buscar_usuario').click(function(e){

		cardInicio()
		
		e.preventDefault();
		
		var nombre = $("input[name=nombre]").val();
		$.ajax({
			type:'GET',
			url: "user/"+nombre,
			data:{name:nombre},

			success:function(data){

				if(data.length == 0){
					console.log('no hay resultados');
				}
				if(data.length == 1){

					$('.box').css({'display':'block'});
					$('.boxname').html(data[0].name + ' ' + '<b>' +data[0].last_name + ' ' + data[0].mothers_last_name + '</b>');
					$('.boxavatar').attr('src', '../assets/img/'+data[0].avatar );

					var tl = gsap.timeline({});
					tl.to(".box", .64, {left: 0, rotation: 0, opacity:1, duration: .64});
					tl.from(".boxavatar", .64,  {y: -106, opacity:0, duration: .64, ease: "elastic"});
					tl.from(".boxname", .64,  {y: 32, opacity:0, duration: .64, ease: "elastic"});

				}

				if(data.length > 1){

					$('.box_more_result').css({'display':'block'});
					$('.list-group-item-action').remove();
					$('.boxavatar').attr('src', '../assets/img/'+data[0].avatar );

					data.forEach(function(usuario, index) {
					  console.log("Persona " + usuario.id + " | Nombre: " + usuario.name + " Edad: " + usuario.mothers_last_name)
					  $('.multi_usuarios_lista').append('<a href="#" class="list-group-item list-group-item-action self_user botoncito" id='+ usuario.id +'>' + usuario.name + ' <b> ' +usuario.last_name + ' ' + usuario.mothers_last_name + '</b></a>')
					});

					var tl = gsap.timeline({});
					tl.to(".box_more_result", .64, {left: 0, rotation: 0, opacity:1, duration: .64});
					
				}
				
			}
		})
	})


	$(".multi_usuarios_lista").on("click", ".botoncito", function(){
		
		var id = $(this).attr('id');

		$.ajax({
			type:'GET',
			url: "user/"+id,
			data:{name:id},

			success:function(data){

				console.log('---->>>>>>>>>>')
				console.log(data[0]);

				$('.box_more_result').css({'display':'none'});
				$('.box').css({'display':'block'});

				$('.boxname').html(data[0].name + ' ' + '<b>' +data[0].last_name + ' ' + data[0].mothers_last_name + '</b>');
				$('.boxavatar').attr('src', '../assets/img/'+data[0].avatar );

				var tl = gsap.timeline({});
				tl.to(".box", .64, {left: 0, rotation: 0, opacity:1, duration: .64});
				tl.from(".boxavatar", .64,  {y: -106, opacity:0, duration: .64, ease: "elastic"});
				tl.from(".boxname", .64,  {y: 32, opacity:0, duration: .64, ease: "elastic"});
				
			}
		})

	});


	//programacion para los cards de los cursos par amatriculas
	$('.card_curso').on('click', function(e){
		e.preventDefault();
		//gsap.to(me, {rotation: 27, x: 100, duration: 1});
		console.log($(this).attr('id'));
	})

	$('.card_curso').mouseover(function(){
		me = $(this).find('.overall');

		gsap.to(me, {opacity: 0.32, duration: 0.32});

	})

	$('.card_curso').mouseout(function(){
		me = $(this).find('.overall');

		gsap.to(me, {opacity: 0, duration: 0.32});

	})


})