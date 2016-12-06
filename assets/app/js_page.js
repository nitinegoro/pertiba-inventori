jQuery(function($) {

    $('.modal-page-delete').click( function() {
        var data_id = $(this).data('id');
        var data_content = $(this).data('page');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/page/delete/' + data_id);
    });

  	$('#id-input-file-1 , #id-input-file-2').ace_file_input({
    	no_file:'No selected image ...',
    	btn_choose:'Browse',
    	btn_change:'Update',
    	droppable:false,
    	onchange:true,
    	thumbnail:true,
  	});

	$('#picture').on('keyup', function() 
	{
		$('div#image-preview').html('<img src="'+base_path + 'assets/media/uploads/' + $(this).val() +'" class="img-responsive" id="image-preview">');
	});

});

