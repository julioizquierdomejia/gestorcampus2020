$(document).ready(function(){

	cardInicio()

	function cardInicio(){
		$('.box').css({'display':'none'});
		$('.box').css({'left':'500px', 'transform':'rotate(20deg)', 'opacity':0});

		$('.box_more_result').css({'display':'none'});
		$('.box_more_result').css({'left':'500px', 'transform':'rotate(20deg)', 'opacity':0});

		$('.box_my_courses').css({'display':'none'});
		$('.box_my_courses').css({'left':'500px', 'transform':'rotate(20deg)', 'opacity':0});
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

					var id_usuario = data[0].id;
					traerCursos(id_usuario)

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

				$('.box_more_result').css({'display':'none'});
				$('.box').css({'display':'block'});

				$('.boxname').html(data[0].name + ' ' + '<b>' +data[0].last_name + ' ' + data[0].mothers_last_name + '</b>');
				$('.boxavatar').attr('src', '../assets/img/'+data[0].avatar );

				var tl = gsap.timeline({});
				tl.to(".box", .64, {left: 0, rotation: 0, opacity:1, duration: .64});
				tl.from(".boxavatar", .64,  {y: -106, opacity:0, duration: .64, ease: "elastic"});
				tl.from(".boxname", .64,  {y: 32, opacity:0, duration: .64, ease: "elastic"});

				var id_usuario = data[0].id;

				traerCursos(id_usuario);
				
			}
		})

	});


	function traerCursos(id_usuario){

		$.ajax({
			type:'GET',
			url: "matricula/"+id_usuario,
			data:{},

			success:function(data){

				$('.box_my_courses').css({'display':'block'});

				var tl = gsap.timeline({});
				tl.to(".box_my_courses", .64, {left: 0, rotation: 0, opacity:1, duration: .64});

				$('.table-responsive').remove();

				$('.card_table_courses').append('<div class="table-responsive"><table class="table table_courses" id="tabla"><thead class=" text-primary"><th><b>Curso</b></th><th>Categoria</th><th class="text-center">Acción</th></thead><tbody id="table_courses_body"></tbody></table></div>')
				$.each( data, function( key, value ) {
					$('#table_courses_body').append('<tr style="opacity:1; margin-left:100px" class="fila"><td>'+value.shortname+'</td><td>'+value.name+'</td><td class="text-center"><button class="btn btn-primary btn_matricular" iduser="'+ id_usuario +'" id="'+value.id+'">Matricular</button></td></tr>')

					/*
					$('#table_courses_body').on("click", ".btn_matricular", function(){
						console.log("Id del curso ->> " + $(this).attr('id') + " Id del usuario -->> " + $(this).attr('iduser'));
						//alert(value.shortname);
						//$('#modalMatricula').modal();
						//$('.modal-body').html('<p>Seguro que deseas matricular en el curso de : '+ value.shortname +'</p>')
						
					});
					*/

				});
			}
		})

		$('#table_courses_body').click(function(){
			console.log("Id del curso ->> " + $(this).attr('id') + " Id del usuario -->> " + $(this).attr('iduser'));
		})
	}

	


})