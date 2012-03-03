<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Телефонный справочник</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Телефонный справочник">
    <meta name="author" content="Big_Shark">

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" href="ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="ico/apple-touch-icon-114x114.png">
</head>
<body>
	
	<table id="table" class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th class="span4">ФИО</th>
				<th>Город</th>
				<th>Улицу</th>
				<th>Дату рождения</th>
				<th>Номер телефона</th>
				<th>Действия</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($people as $person):?>
			<tr data-person-id="<?=$person->pk();?>">
				<td><?=$person->name;?></td>
				<td><?=$person->city;?></td>
				<td><?=$person->street;?></td>
				<td><?=$person->birthday;?></td>
				<td><?=$person->phone;?></td>
				<td><i class="icon-edit" /></i> <i class="icon-remove" /></i></td>
			</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
	<a class="btn" data-toggle="modal" id="add" href="#modal" >Добавить нового сотрудника</a>
	
	<div class="modal hide fade" id="modal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Форма добавления сотрудника</h3>
		</div>
		<div class="modal-body">
			<form id="form" class="form-horizontal">
				<div class="control-group">
					<label for="last_name" class="control-label">Фамилия</label>
					<div class="controls">
					  <input required type="text" name="last_name" id="last_name" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="first_name" class="control-label">Имя</label>
					<div class="controls">
					  <input required type="text" name="first_name" id="first_name" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="middle_name" class="control-label">Отчество</label>
					<div class="controls">
					  <input required type="text" name="middle_name" id="middle_name" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="city" class="control-label">Город</label>
					<div class="controls">
					  <input required type="text" name="city" id="city" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="street" class="control-label">Улицу</label>
					<div class="controls">
					  <input required type="text" name="street" id="street" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="birthday" class="control-label">Дату рождения</label>
					<div class="controls">
					  <input required type="date" name="birthday" id="birthday" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="phone" class="control-label">Номер телефона</label>
					<div class="controls">
					  <input required type="tel" name="phone" id="phone" class="input-xlarge" />
					</div>
				</div>
				<input type="hidden" name="id" id="id"/>
			</form>
		</div>
		<div class="modal-footer">
			<a id="submit" class="btn btn-primary" data-action="add">Сохранить</a>
			<a data-dismiss="modal" class="btn">Закрыть</a>
		</div>
    </div>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.html5form-1.5-min.js"></script>
    <script src="assets/js/application.js"></script>
	
</body>
</html>