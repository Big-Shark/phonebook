$(function(){
	var form = $('#form');
	var modal = $('#modal');
	var submit = $('#submit');
	var tbody = $('#table tbody');
	
	form.html5form();
	modal.modal({'show':false});
	submit.bind("click", function(e){
		if(submit.data('action') == 'add')
		{
			$.ajax({
				url: "/add/",
				data: $("form").serialize(),
				type:"post",
				success: function(data){
					if (data.type == "success") {
						modal.modal('hide');
						a = data.data;
						template = 
							'<tr data-person-id="'+a.id+'>'+
								'<td>'+a.last_name+' '+a.first_name+' '+a.middle_name+'</td>'+
								'<td>'+a.city+'</td>'+
								'<td>'+a.street+'</td>'+
								'<td>'+a.birthday+'</td>'+
								'<td>'+a.phone+'</td>'+
								'<td><i class="icon-edit" /></i> <i class="icon-remove" /></i></td>'+
							'</tr>';
						tbody.append(template)
						clear_form();
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
				dataType:"json"
			 });
		}
		else if(submit.data('action') == 'edit')
		{
			$.ajax({
				url: "/edit/",
				data: $("form").serialize(),
				type:"post",
				success: function(data){
					if (data.type == "success") {
						modal.modal('hide');
						a = data.data;
						template = 
								'<td>'+a.last_name+' '+a.first_name+' '+a.middle_name+'</td>'+
								'<td>'+a.city+'</td>'+
								'<td>'+a.street+'</td>'+
								'<td>'+a.birthday+'</td>'+
								'<td>'+a.phone+'</td>'+
								'<td><i class="icon-edit" /></i> <i class="icon-remove" /></i></td>';
						tbody.find("tr[data-person-id="+a.id+"]").html(template);
						clear_form();
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
				dataType:"json"
			 });
		}
	});
	
	$('.icon-edit').bind("click", function(e){
		clear_form();
		submit.data('action', 'edit');
		id = $(e.target).parents("tr").data("personId");
		$.getJSON('load/'+id, function(data) {

			$.each(data, function(key, val) {
				form.find('#'+key).val(val);
			});
			modal.modal('show');
		});
	});
	
	$('.icon-remove').bind("click", function(e){
		id = $(e.target).parents("tr").data("personId");
		$.ajax({
			url: "/remove/",
			data: {'id': id},
			type:"post",
			success: function(data){
				if (data.type == "success") {
					tbody.find("tr[data-person-id="+a.id+"]").remove();
				}
			},
			dataType:"json"
		 });
	});
	
	$('#add').bind("click", function(e){
		clear_form();
		submit.data('action', 'add');
	});
	
	function clear_form(){
		form.find('input').each(function () {
			$(this).val("");
			$(this).parents("div.control-group").removeClass('error');
			$(this).popover();							
		});
	}
});
