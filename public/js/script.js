$(document).ready(function(){

	gsap.to(".box", 0, {x: 500, rotation: 45, opacity:0, duration: 0});

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
		
		e.preventDefault();
		var nombre = $("input[name=nombre]").val();
		$.ajax({
			type:'GET',
			url: "user/"+nombre,
			data:{name:nombre},

			success:function(data){
				if(data == 0){
					console.log('no hay resultados');
				}else{
					console.log(data[0].name);

					$('.boxname').html(data[0].name + ' ' + '<b>' +data[0].last_name + ' ' + data[0].mothers_last_name + '</b>') ;

					var tl = gsap.timeline({});
					tl.to(".box", .64, {x: 0, rotation: 0, opacity:1, duration: 1});
					tl.from(".boxavatar", .64,  {y: -106, opacity:0, duration: 1, ease: "elastic"});
					tl.from(".boxname", 2,  {y: 32, opacity:0, duration: 1, ease: "elastic"});
				}
				
			}
		})
	})

})