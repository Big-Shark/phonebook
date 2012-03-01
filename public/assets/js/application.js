$(function(){
	var form = $('#form');
	
	form.html5form();
	$('#add').modal({'show':false});
	$("#add").alert();
	$('#submit').bind("click", function(e){
		$.ajax({
			url: "/add/",
			data: $("form").serialize(),
			type:"post",
			success: function(data){
				if (data.type == "success") {
					$('#add').modal('hide');
					a = data.data;
					name = a.last_name+' '+a.first_name+' '+a.middle_name; 
					$('#table tbody').append(
						'<tr>'+
							'<td>'+name+'</td>'+
							'<td>'+a.city+'</td>'+
							'<td>'+a.street+'</td>'+
							'<td>'+a.birthday+'</td>'+
							'<td>'+a.phone+'</td>'+
							'<td><i class="icon-edit" /></i> <i class="icon-remove" /></i></td>'+
						'</tr>');
				}
				else
				{
					$.each(data.message, function(index, value) { 
						i = form.find('#'+index);
						i.parents("div.control-group").addClass('error');
						i.popover({title:"Ошибка", content:value, delay: { show: 100, hide: 100 }});
					});
				}
			},
			error: function(data){
				console.log(data.status+" "+data.statusText+" - извините, запрос не может быть выполнен, обратитесь, пожалуйста, к администратору сайта");
			},
			dataType:"json"
		 });
	});
});
