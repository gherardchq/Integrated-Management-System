$(function() {
	$('[data-category]').on('click', editCategoryModal);
});

function editCategoryModal(){
	//id
	var category_id = $(this).data('category');
	$('#category_id').val(category_id);

	//name
	var name = $(this).parent().prev().text();
	$('#category_name').val(category_name);

	//show
	$('#modalEditCategory').modal('show');
}