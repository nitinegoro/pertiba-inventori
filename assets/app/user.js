/*!
*
* @user user module
* @author Vicky Nitinegoro 
* 
*/

jQuery(function($) {

    // set delete one
    $('.open-user-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/user/delete/' + data_id);
        return false;
    });

    // set delete multiple
    $('.open-delete-multiple').click( function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) {
            $('#modal-delete-multiple').modal('show');
        }
        return false;
    });

    // get form update divisi
    $('.open-modal-divisi').click( function() {
        var data_id = $(this).data('id');
        var data_name = $(this).data('name');
        $('#form-update-divisi').attr('action', base_url + '/user/updatedivisi/' + data_id);
        $('#modal-update-divisi').modal('show');
        $('#divisi').val(data_name);
        return false;
    });

    // modal delete divisi one
    $('.open-divisi-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete-divisi').modal('show');
        $('#button-delete').attr('href', base_url + '/user/deletedivisi/' + data_id);
        return false;
    });

    // modal delete divisi selected
    $('.open-divisi-delete-all').click( function() {
        var data_id = $(this).data('id');
        if( $('input[type=checkbox]').is(':checked') != '' ) {
            $('#modal-delete-divisi-all').modal('show');
        }
        return false;
    });
});


$(document).ready(function() {
    $('#create_user').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {  
                    notEmpty: { },
                   	remote: {
                        message: 'Username sudah digunakan.',
                        type: 'POST',
                        url: base_url + '/user/getusername/',
                        delay: 1000
                    }
                },

            },
            password: {
                validators: {
                    identical: {
                        field: 'pass_again',
                        message: 'Masukkan password dengan benar.'
                    },
                    stringLength: {
                        min: 6,
                        message: 'Minimal 6 Karakter.'
                    }
                }
            },
            pass_again: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Masukkan password dengan benar.'
                    }
                }
            }
        }
    });
    $('#account_setting').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {  
                    notEmpty: { },
                },

            },
            password: {
                validators: {
                    identical: {
                        field: 'pass_again',
                        message: 'Masukkan password dengan benar.'
                    },
                    stringLength: {
                        min: 6,
                        message: 'Minimal 6 Karakter.'
                    }
                }
            },
            pass_again: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Masukkan password dengan benar.'
                    }
                }
            },
            old_pass: {
                validators: {
                    notEmpty: {},
                    remote: {
                        message: 'Password Lama tidak cocok.',
                        type: 'POST',
                        url: base_url + '/user/authpass/',
                        delay: 1000
                    }
                }
            }
        }
    });
});

$('#password').pwstrength({
    ui: { showVerdictsInsideProgressBar: true }
});

