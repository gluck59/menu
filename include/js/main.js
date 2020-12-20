$(document).ready(function () {
	$('.editType').on('click', function (e) {
		$('#editFormInput').val(e.target.innerText);
		$('[name=id]').val(e.target.id);
	});


	var modal = $('.modal');
	modal.keypress(function(event) {
		if(event.keyCode == 13) {
			event.stopPropagation();
			event.preventDefault();
			var newInput = addInput();

			$("#"+$(this).prop('id')+" newInputs").append(newInput);
			$(newInput).focus();
		}
	});



	// модал редактирования
	$('#editTypeModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var typeid = button.data('typeid');
		var typename = button.data('typename');

		$("#editForm newInputs").html('');
		$('[cooking_id='+typeid+']').each(function() {
			$("#editForm newInputs").append('<input type="text" name="tags[]" class="form-control" value="'+$(this).text()+'">');
		})

	$('.addField').on('click', function (event) {
		event.stopPropagation();
		event.preventDefault();

		var newInput = addInput();
		$("#editForm newInputs").append(newInput);
		$(newInput).focus();
	});

		$('#editTypeModal [name=type]').val(typename);
		$('#editTypeModal [name=id]').val(typeid);
	});




	// модал добавления
	$('#addTypeModal').on('show.bs.modal', function () {
		$('.addField').on('click', function (event) {
			event.stopPropagation();
			event.preventDefault();

			var newInput;
			newInput = document.createElement("input");
			newInput.name="tags[]";
			newInput.className ="form-control";

			$("#addForm newInputs").append(newInput);
			$(newInput).focus();
		});
	});


}) // ready

function addInput() {
	var newInput;
	newInput = document.createElement("input");
	newInput.name="tags[]";
	newInput.className ="form-control";
	return newInput;
}
