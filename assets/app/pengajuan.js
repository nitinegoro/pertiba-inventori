jQuery(function($) {
	$('#form_buat_pengajuan').formValidation({
	    icon: {
	        valid: 'fa fa-ok',
	        invalid: 'fa fa-remove',
	        validating: 'fa fa-refresh'
	    },
	});			

	$('.date-picker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd ',
		todayHighlight: true
	});

	$('#category').change( function() {
		var parent = $(this).val();
		get_child_category(parent);
	});

	$('.input-daterange').datepicker({
		autoclose:true,
		format: 'yyyy-mm-dd',
	});

	// set status approve one
    $('.open-modal-terima').click( function() {
        var data_id = $(this).data('id');
        $('#modal-pengajuan-terima-one').modal('show');
        $('a#button-yes').attr('href', base_url + '/pengajuan/set_status/' + data_id + '/approve');
        return false;
    });

    // set status pending one
    $('.open-modal-tunda').click( function() {
        var data_id = $(this).data('id');
        $('#modal-pengajuan-tunda-one').modal('show');
        $('a#button-yes').attr('href', base_url + '/pengajuan/set_status/' + data_id + '/pending');
        return false;
    });

    // delete one
    $('.open-modal-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-pengajuan-delete-one').modal('show');
        $('a#button-yes').attr('href', base_url + '/pengajuan/delete/' + data_id);
        return false;
    });

    // button terima checked all pengajuan
    $('.open-modal-terima-all').click( function() {
    	if( $('input[type=checkbox]').is(':checked') != '' ) {
       		$('#modal-pengajuan-terima-all').modal('show');
       	} 
       	return false;
    });

    // button terima checked all pengajuan
    $('.open-modal-tunda-all').click( function() {
    	if( $('input[type=checkbox]').is(':checked') != '' ) {
       		$('#modal-pengajuan-tunda-all').modal('show');
       	} 
       	return false;
    });

    // button terima checked all pengajuan
    $('.open-modal-delete-all').click( function() {
    	if( $('input[type=checkbox]').is(':checked') != '' ) {
       		$('#modal-pengajuan-delete-all').modal('show');
       	} 
       	return false;
    });

    // delete one
    $('.open-modal-delete-item').click( function() {
        var data_id = $(this).data('id');
        var data_ajuan = $(this).data('ajuan');
        $('#block-item-' + data_id).addClass('shake');
        $('#modal-hapus-item').modal('show');
        $('#btn-cancel').click( function() {
        	$('#block-item-' + data_id).removeClass('shake');
        });
        $('a#button-yes').attr('href', base_url + '/pengajuan/delete_barang/' + data_id + '/' + data_ajuan);
        return false;
    });
});

/*$.gritter.add({
	title: 'Tidak ada data yang dipilih!',
	text: 'Pilih terlebih dahulu untuk mengubah status.',
	time: '3000',
	class_name: 'gritter gritter-warning gritter-light'
});
return false;*/

var value_parent = $('#category').val();

if(Boolean(value_parent))
{
	$('#sub_category').attr('disabled', false);
	get_child_category(value_parent);
} else {
	$('#sub_category').attr('disabled', true);
}

function get_child_category(parent) 
{
    $.ajax({
        url: base_url + 'inventori/get_category_child/' + parent,
        dataType:'json',
        beforeSend: function() {
        	Pace.start();
        },
        success:function(response) 
        {
        	Pace.stop();
        	if(response['response']) {
        		$('#sub_category').attr('disabled', false);
	            $('#sub_category').html('<option value="">~ PILIH ~</option>');
	            var child = '';
	            $.each(response['results'], function(key, value)
	            {
	            	var selected = ( $('#category').data('id') == value['child_id']) ? 'selected' : '';
	                child = '<option value="'+value['child_id']+'" ' + selected +'>'+value['name']+'</option>';
	                child = child + '';
	                $('#sub_category').append(child);
	            });
	        } else {
	        	$('#sub_category').attr('disabled', true);
	        }
        },
        error:function(){
            $('#sub_category').attr('disabled', true);
        }
    });
}

function get_child_category_add(parent, selector, selected = 0) 
{
    $.ajax({
        url: base_url + 'inventori/get_category_child/' + parent,
        dataType:'json',
        beforeSend: function() {
        	Pace.start();
        },
        success:function(response) 
        {
        	Pace.stop();
        	if(response['response']) {
        		$(selector).attr('disabled', false);
	            $(selector).html('<option value="">~ PILIH ~</option>');
	            var child = '';
	            $.each(response['results'], function(key, value)
	            {
	            	var sel = ( selected == value['child_id']) ? 'selected' : '';
	                child = '<option value="'+value['child_id']+'" ' + sel +'>'+value['name']+'</option>';
	                child = child + '';
	                $(selector).append(child);
	            });
	        } else {
	        	$(selector).attr('disabled', true);
	        }
        },
        error:function(){
            $(selector).attr('disabled', true);
        }
    });
}

$(document).ready(function() {
    // Initialize the date picker for the original due date field

    $('#form_buat_pengajuan')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

            }
        })

        // Add button click handler
        .on('click', '.addButton', function() {
	        var index = $(this).data('index');
	        if (!index) {
	            index = 0;
	            $(this).data('index', 0);
	        }
	        index++;
	        $(this).data('index', index); 

	        var template     = $(this).attr('data-template'),
	            $templateEle = $('#' + template + 'Template'),
	            $row         = $templateEle
	            				.clone()
	            				.removeAttr('id')
	            				.insertBefore($templateEle)
	            				.attr('data-form-index', index)
	            				.removeClass('hide');
	       	console.log(index);
	       		$row
	       			.find('[name="category-hide"]').attr('id',  'category-' +index ).attr('name', 'category[' + index + '].category').end()
        			.find('[name="sub_category-hide"]').attr('id',  'sub-' +index ).attr('name', 'sub_category[' + index + ']').end()
					.find('[name="name-hide"]').attr('name', 'name[' + index + ']').end()
					.find('[name="nominal-hide"]').attr('name', 'nominal[' + index + ']').end()
					.find('[name="serial_number-hide"]').attr('name', 'serial_number[' + index + ']').end()
					.find('[name="vendor-hide"]').attr('name', 'vendor[' + index + ']').end()
					.find('[name="quantity-hide"]').attr('name', 'quantity[' + index + ']').end()
					.find('[name="deskripsi-hide"]').attr('name', 'deskripsi[' + index + ']').end();
			

			$('#category-' +index).change( function() {
				get_child_category_add($(this).val(), '#sub-' +index );
			});

	        $row.on('click', '.removeButton', function(e) {
	            $('#form_buat_pengajuan').formValidation('removeField');
	            $row.remove();
	        });
        })
});

var jumlah = $('#form_buat_pengajuan').data('item') -1;
var i = 0;
var text = {};
while (i <= jumlah) {
    text[i] += i;
    i++;
}

$.each(text, function(key)
{
	$("#category-"+key).change( function() {
		var parent = $(this).val();
		get_child_category_add(parent,'#sub-' +key);
	});
	if(Boolean($('#category-' +key).val()))
	{
		var selected = $("#category-"+key).data('id');

		get_child_category_add($('#category-' +key).val(),'#sub-' +key, selected);
		$('#sub-' +key).attr('disabled', false);
	} else {
		$('#sub-' +key).attr('disabled', true);
	}
});

