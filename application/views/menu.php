<?php
/**
 * Created by IntelliJ IDEA.
 * User: gluck
 * Date: 16.12.2020
 * Time: 13:07
 */
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR);

?>

<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/include/css/main.css">
		<script src="/include/js/main.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

		<title>Меню</title>

	</head>

	<body>
		<div class="container">
			<div class="header clearfix">
				<!--nav>
					<ul class="nav nav-pills pull-right">
						<li role="presentation" class="active"><a href="#">Кнопка</a></li>
						<li role="presentation"><a href="#">Еще кнопка</a></li>
						<li role="presentation"><a href="#">Не кнопка</a></li>
					</ul>
				</nav-->
				<h4 class="text-muted">Менеджер кухни</h4>
			</div>

			<div class="jumbotron">
				<h1>Типы кухни</h1>
				<p class="lead">Добавьте название вида кухни и список ключевых слов (тегов), соответствующих этому виду кухни. Примеры тегов: “острая”, “на любителя”, “тропическая”, “возможны насекомые” и т.д.</p>
				<div class="col-md-5">
					<?php
					if ($cookingType AND sizeof($cookingType) > 0 ) { ?>
					<table class="table table-hover">
						<?php
						foreach ($cookingType as $type) { ?>
							<tr>
								<td id="type"><h3 data-toggle="modal" data-target="#editTypeModal" data-typeid="<?=$type['id']?>" data-typename="<?=$type['name']?>" class="editType"><?=$type['name']?>&nbsp;<small class="glyphicon glyphicon-edit"></small></h3>
									<div class="tags" id="<?=$type['id']?>">
										<?php
										foreach ($tags as $tag) {
											if ($tag['cookingId'] == $type['id']) { ?>
												<small class="text-muted label label-info tag" id="<?=$tag['id']?>" cooking_id="<?=$type['id']?>"><?=$tag['tag']?></small>
										<?php }
										}?>
									</div>
								</td>
								<td align="right" class="remove">
									<form action="/" method="post" name="removeForm" class="form-inline">
										<input hidden name="action" value="removeType">
										<input hidden name="id" value="<?=$type['id']?>">
										<button type="submit" class="remove"><span class="glyphicon glyphicon-remove"></span></button>
									</form>
								</td>
							</tr>
						<?php }  ?>
					</table>
				<?php } else { ?>
						<div class="alert alert-danger" role="alert">Не определено ни одной кухни</div>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<p>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTypeModal" data-content="0" >
						Добавить новую
					</button>
			</div>

			<div class="row marketing">
				<div class="col-lg-6">
					<h4>Отмазка (disclaimer)</h4>
					<p>Максимально быстрый старт без наворотов. Простейшая реализация на уровне пионера. Используются Codeigniter на бэкенде и Bootstrap/JQ на фронте. Не настроены мелкие полезности типа аякса, с которыми нужно возиться, но без которых можно жить. Где-то по коду разные IDE могут ругаться на что-то свое, но несущественное.</p>
				</div>

				<div class="col-lg-6">
					<h4>Подзаголовок полезной информации</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim, erat ac pellentesque facilisis, risus tortor hendrerit ligula, in dapibus nisl lacus ut nisl.</p>
				</div>
			</div>

			<footer class="footer" id="footer">
				<p>© 2020 Ресторан "Лучшее Место" </p>
			</footer>
		</div>


		<!-- модал добавления -->
		<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Кухня: добавление</h4>
					</div>
					<form action="/" method="post" id="addForm" class="form-inline">
						<div class="modal-body">
							<input name="type" class="form-control" id="addFormInput">
							<input hidden name="action" value="addType">
							<input hidden name="id" value="">
							<!--button type="submit" class="btn btn-small btn-success">Ok</button-->
							<div class="clearfix">&nbsp;</div><div class="clearfix">&nbsp;</div>
							<h4 class="modal-title" id="myModalLabel">Тэги</h4>
							<hr>
							<newInputs>
								<input type="text" name="tags[]" class="form-control tags" value=""><button class="btn btn-success btn-mini addField">+</button>
							</newInputs>
							<div><small class="text-muted">пустые поля не сохранятся</small></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
			<script>
			$('#addTypeModal').on('shown.bs.modal', function (e) {
				$('[name=type]').focus()
			})
			</script>
		</div>


		<!-- модал редактирования -->
		<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Кухня: редактирование</h4>
					</div>
						<form action="/" method="post" id="editForm" class="form-inline">
							<div class="modal-body">
								<input name="type" class="form-control" id="editFormInput">
								<input hidden name="action" value="editType">
								<input hidden name="id" value="">

								<div class="clearfix">&nbsp;</div><div class="clearfix">&nbsp;</div>
								<h4 class="modal-title" id="myModalLabel">Тэги</h4>
								<hr>
								<newInputs></newInputs>

								<div class="btn btn-success btn-sm addField">Добавить тэг</div>
								<div><small class="text-muted">пустые поля не сохранятся</small></div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
								<button type="submit" class="btn btn-primary">Сохранить</button>
							</div>
						</form>
				</div>

			</div>
			<script>

			</script>
		</div>


	</body>

</html>


<?php
//echo '<pre>';
//print_r($cookingType);
//print_r($tags);
//echo '</pre>';
?>
