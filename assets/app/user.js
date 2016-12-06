/*!
*
* @category user module
* @author Vicky Nitinegoro 
* 
*/

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
});

$('#password').pwstrength({
        ui: { showVerdictsInsideProgressBar: true }
 });