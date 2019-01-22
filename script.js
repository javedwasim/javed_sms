$(document).ready(function(){
	$(document.body).on('click', '#guardian_info', function(){
		if($('#guardian_info').prop('checked')){
			$('#guardian_info_section').show();
		} else {
			$('#guardian_info_section').hide();
		}
	});

	$('.datepicker').datepicker({
		defaultDate: new Date(),

	});

	$('#mobile_phone').intlTelInput({
		defaultCountry: "auto",
		preferredCountries: ["ng"]
	});

	$('#phone').intlTelInput({
		defaultCountry: "auto",
		preferredCountries: ["ng"]
	});
	$("#student-table").DataTable({

	});

    $("a.dropdown-toggle").trigger('click');

});

function get_students(func_call) {
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'students/'+func_call,
		cache: false,
		success: function(response) {
		    if(response.student_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.student_html);
				$('#mobile_phone').intlTelInput({
					defaultCountry: "auto",
					preferredCountries: ["ng"]
				});
				$('#phone').intlTelInput({
					defaultCountry: "auto",
					preferredCountries: ["ng"]
				});
				$('#guardian').DataTable({});
				$('.datepicker').datepicker({
					defaultDate: new Date(),

				});
				$('#title').html('Add Student | ISMS');

			}
		}
	});
}
///////////////// sohaib's script ////////////////



function employee_add(func_call) {
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'employee/'+func_call,
		cache: false,
		success: function(response) {
			if(response.employee_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.employee_html);
				$('#emp-phone').intlTelInput({
					defaultCountry: "auto",
					preferredCountries: ["ng"]
				});
				$('#emp-mb-phone').intlTelInput({
					defaultCountry: "auto",
					preferredCountries: ["ng"]
				});
				$('#emp-dob').datepicker({
			        format: 'dd-mm-yyyy'
			    });
				$('#emp-doj').datepicker({
			        format: 'dd-mm-yyyy'
			    });
			    $('#title').html('Add Employee | ISMS');
			}
		}
	});
}

function guardian_listings(func_call) {
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'guardians/'+func_call,
		cache: false,
		success: function(response) {
			if(response.guardian_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.guardian_html);
				$('#guardian-table').DataTable();
			    //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			      checkboxClass: 'icheckbox_minimal-blue',
			      radioClass   : 'iradio_minimal-blue'
			    });
			    //Red color scheme for iCheck
			    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			      checkboxClass: 'icheckbox_minimal-red',
			      radioClass   : 'iradio_minimal-red'
			    });
			    //Flat red color scheme for iCheck
			    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			      checkboxClass: 'icheckbox_flat-green',
			      radioClass   : 'iradio_flat-green'
			    });
			     $('.select2').select2({
			     	placeholder: "Show more fields"
			     });
			     $('#title').html('Guardian Listing | ISMS');

			}
		}
	});
}

function attendance_register(func_call){
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'attendance/'+func_call,
		cache: false,
		success: function(response) {
			if(response.reports_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.register_html);
			    $('#title').html('Register | ISMS');
			}
		}
	});
}

function attendance_reports(func_call){
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'attendance/'+func_call,
		cache: false,
		success: function(response) {
			if(response.reports_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.reports_html);
			    $('.daterange').daterangepicker();
			    $('.report-table').DataTable();
			    $('#title').html('Reports | ISMS');
			}
		}
	});
}

function student_categories(func_call){
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'student_setting/'+func_call,
		cache: false,
		success: function(response) {
			if(response.student_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.student_html);
			    $('.datatables').DataTable();
			    $('#title').html('Student Categories | ISMS');
			}
		}
	});
}


$(document.body).on('click', '.get-report', function(){
    var base_url = $('#base').val();
	  $.ajax({
		url: base_url+'attendance/student_report_page',
		cache: false,
		success: function(response) {
			if(response.reports_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.reports_html);
			    $('.report-table').DataTable();
			    $('#title').html('Student Report | ISMS');
			}
		}
	});
	});

/////////////////////////////////////////////////

function profile_fields(func_call) {
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'students/'+func_call,
		cache: false,
		success: function(response) {
			if(response.student_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.student_html);
				$('#title').html('Students Fields | ISMS');
			}
		}
	});
}



$(document.body).on('click', '#save_employee', function(){
    $.ajax({
        url: $('#employee_form').attr('data-action'),
        type: 'post',
        data: $('#employee_form').serialize(),
        cache: false,
        success: function(response) {
            $('#employee_error').hide();
            $('#employee_success').hide();
            if (response.success) {
                $('#employee_success').show().html(response.message);
                $('#employee_form')[0].reset();
            } else {
                $('#employee_error').show().html(response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '#student_fields', function(){
	$.ajax({
		url: $('#form_fields').attr('data-action'),
		type: 'post',
		data: $('#form_fields').serialize(),
		cache: false,
		success: function(response) {
			if (response.success) {
                toastr["success"](response.message);
			} else {
                toastr["error"](response.message);
			}
		}
	});

	return false;
});

function students_listing(func_call) {
    var base_url = $('#base').val();
	$.ajax({
		url: base_url+'students/'+func_call,
		cache: false,
		success: function(response) {
			if(response.student_html != ''){
				$('.content-wrapper').remove();
				$('#content-wrapper').append(response.student_html);
				$('.select2').select2();
				var sttable = $("#student-b-table").DataTable({
                    dom:            "Bfrtip",
                    scrollX:        true,
                    scrollCollapse: true,
                    paging:         true,
                    buttons:        [ 'colvis' ],
			    });
			    $(".buttons-colvis").html('Fields to Show');
			    //sttable.columns( [ 1, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16 ] ).visible( false, false );
                sttable.columns( [ 1, 4, 5, 6, 8,10,11,12,13,14,15,16 ] ).visible( false, true );
			     $(function () {
			        $(".show-more").click(function () {
			            if ($(this).is(":checked")) {
			                $(".filter-toggle").show();
			            } else {
			                $(".filter-toggle").hide();
			            }
			        });
			    });
				$('#title').html('Student Listing | ISMS');
			} 
		}
	});
}

function loadEditForm(url){
    $.ajax({
        url: url,
        cache: false,
        success: function(response) {
            if(response.student_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.student_html);
                $('#guardian').DataTable({

              });
            } else {
                $('#student_error').show().html(response.message);
            }
        }
    });
    return false;

}

$(document.body).on('click', '#update_employee', function(){
    $.ajax({
        url: $('#employee_form').attr('data-action'),
        type: 'post',
        data: $('#employee_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.employee_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('#employee_success').show().html(response.message);
                $('#employee_listing_table').DataTable();
                $('.select2').select2();
                //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			      checkboxClass: 'icheckbox_minimal-blue',
			      radioClass   : 'iradio_minimal-blue'
			    });
			    //Red color scheme for iCheck
			    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			      checkboxClass: 'icheckbox_minimal-red',
			      radioClass   : 'iradio_minimal-red'
			    });
			    //Flat red color scheme for iCheck
			    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			      checkboxClass: 'icheckbox_flat-green',
			      radioClass   : 'iradio_flat-green'
			    });
            } else {
                $('#employee_error').show().html(response.message);
            }

        }
    });
    return false;
});


function student_filters(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'students/student_filters',
        data: $('#student_form_filters').serialize(),
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.student_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.student_html);
                $('#student-table').DataTable();
                var sttable = $("#student-b-table").DataTable({
                    dom: 'Bfrtip',
                    buttons: ['colvis']
                });
                //sttable.columns( [ 1, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16 ] ).visible( false, false );
                sttable.columns( [ 1, 4, 5, 6, 8,10,11,12,13,14,15,16 ] ).visible( false, true );
                $('#title').html('Student Listing | ISMS');
            }
        }
    });

    return false;
}

$(document.body).on('click', '#save_cat', function(){
    $.ajax({
        url: $('#category_form').attr('data-action'),
        type: 'post',
        data: $('#category_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.student_html);
                $('.datatables').DataTable();
                $('#category_form')[0].reset();
                $( ".modal-backdrop" ).remove();
                $('#setting_category_model').modal('hide');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});



$(document.body).on('click', '#update_cat', function(){
    $.ajax({
        url: $('#update_category_form').attr('data-action'),
        type: 'post',
        data: $('#update_category_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.student_html);
                $('.datatables').DataTable();
                $('#updateCategoryForm').modal('hide');
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

function save_category(id,value) {
    $('#category_id').val(id);
    $('#category_value').val(value);
    var url = $('#data_action').val();
    $('#updateCategoryForm').modal('show');


}

$(document.body).on('click', '.delete-student_cate', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#student_error').hide();
                $('#student_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.student_html);
                    $('.datatables').DataTable();
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function employee_categories(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'employee_setting/'+func_call,
        cache: false,
        success: function(response) {
            if(response.employee_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $('#title').html('Employee Categories | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_employee_category', function(){
    $.ajax({
        url: $('#employee_cat_form').attr('data-action'),
        type: 'post',
        data: $('#employee_cat_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $('#title').html('Employee Department | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#employee_category_add').modal('hide');
                toastr['success'](response.message);
                $('#employee_cat_form')[0].reset();
            } else {
                toastr['error'](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-employee-category', function(){
	$('#category_id').val($(this).attr('data-value'));
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            $('#employee_category_edit_form').empty();
            $('#employee_category_edit_form').append(response.employee_html);
            $('#employee_category_update').modal('show');
        }
    });
    return false;

});

$(document.body).on('click', '#update_employee_category', function(){
    $.ajax({
        url: $('#employee_cat_update').attr('data-action'),
        type: 'post',
        data: $('#employee_cat_update').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                toastr['success'](response.message);
            } else {
                toastr['error'](response.message);
            }
            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.employee_html);
            $('.datatables').DataTable();
            $('#title').html('Employee Categories | ISMS');
            $( ".modal-backdrop" ).remove();
            $('#employee_category_update').modal('hide');
        }
    });

    return false;
});

$(document.body).on('click', '.delete-employee-category', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#employee_error').hide();
                $('#employee_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.employee_html);
                    $('.datatables').DataTable();
                    $('#title').html('Employee Categories | ISMS');
                    toastr['error'](response.message);
                } else {
                    toastr['error'](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#save_employee_department', function(){
    $.ajax({
        url: $('#employee_department_form').attr('data-action'),
        type: 'post',
        data: $('#employee_department_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $( ".modal-backdrop" ).remove();
                $('#employee_department_add').modal('hide');
                $('#employee_department_form')[0].reset();
                toastr['success'](response.message);

            } else {
                toastr['error'](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-employee-department', function(){
    $('#department_id').val($(this).attr('data-href'));
    $('#department_name_update').val($(this).attr('data-value'));
    $('#department_abbreviation').val($(this).attr('data-abbreviation'));
    $('#employee_department_update').modal('show');
    return false;

});

$(document.body).on('click', '#update_employee_department', function(){
    $.ajax({
        url: $('#employee_department_update_form').attr('data-action'),
        type: 'post',
        data: $('#employee_department_update_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $('#title').html('Employee Department | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#employee_department_update').modal('hide');
                toastr['success'](response.message);
            } else {
                toastr['error'](response.message);
            }

        }
    });

    return false;
});


$(document.body).on('click', '.delete-employee-department', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#employee_error').hide();
                $('#employee_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.employee_html);
                    $('.datatables').DataTable();
                    $('#title').html('Employee Department | ISMS');
                    toastr['error'](response.message);
                } else {
                    toastr['error'](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#save_employee_position', function(){
    $.ajax({
        url: $('#employee_position_form').attr('data-action'),
        type: 'post',
        data: $('#employee_position_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $( ".modal-backdrop" ).remove();
                $('#employee_position_add').modal('hide');
                $('#employee_position_form')[0].reset();
                toastr['success'](response.message);
            } else {
                toastr['error'](response.message);
            }

        }
    });

    return false;
});


$(document.body).on('click', '.edit-employee-position', function(){
    $('#position_id').val($(this).attr('data-href'));
    $('#position_name_update').val($(this).attr('data-value'));
    $('#position_abbreviation').val($(this).attr('data-abbreviation'));
    $('#employee_position_update').modal('show');
    return false;

});


$(document.body).on('click', '#update_employee_position', function(){
    $.ajax({
        url: $('#employee_position_update_form').attr('data-action'),
        type: 'post',
        data: $('#employee_position_update_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('.datatables').DataTable();
                $('#title').html('Employee Categories | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#employee_position_update').modal('hide');
                toastr['success'](response.message);
            } else {
                toastr['error'](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.delete-employee-position', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#employee_error').hide();
                $('#employee_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.employee_html);
                    $('.datatables').DataTable();
                    $('#title').html('Employee Categories | ISMS');
                    toastr['error'](response.message);
                } else {
                    toastr['error'](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


function get_classes(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'general_setting/'+func_call,
        cache: false,
        success: function(response) {
            if(response.classes_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.classes_html);
                $('.datatables').DataTable();
                $('#title').html('Classes | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_class', function(){
    $.ajax({
        url: $('#class_form').attr('data-action'),
        type: 'post',
        data: $('#class_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#class_form')[0].reset();
                $('#class_add').modal('hide');
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.classes_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.edit-class', function(){
	var enable = $(this).attr('data-enale')
    $('#class_id').val($(this).attr('data-href'));
    $('#class_name').val($(this).attr('data-value'));
    $('#class_code').val($(this).attr('data-abbreviation'));

    if(enable == 1){
        $('#is_enabled').prop('checked', true);
    }
    $('#class_update').modal('show');
    return false;

});

$(document.body).on('click', '#update_class', function(){
    $.ajax({
        url: $('#class_update_form').attr('data-action'),
        type: 'post',
        data: $('#class_update_form').serialize(),
        cache: false,
        success: function(response) {
            $('#class_error').hide();
            $('#class_success').hide();
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.classes_html);
                $( ".modal-backdrop" ).remove();
                $('#class_update_form')[0].reset();
                $('#class_update').modal('hide');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-class', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#class_error').hide();
                $('#class_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.classes_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.delete-setting-subject', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#class_error').hide();
                $('#class_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.setting_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});



function subject_names(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'general_setting/'+func_call,
        cache: false,
        success: function(response) {
            if(response.setting_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.setting_html);
                $('#title').html('Subject Names | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_setting_subject', function(){
    $.ajax({
        url: $('#subject_form').attr('data-action'),
        type: 'post',
        data: $('#subject_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.setting_html);
                toastr["success"](response.message);
                $('#subject_form')[0].reset();
                $('#modalLoginForm').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-subject', function(){
    $('#subject_id').val($(this).attr('data-href'));
    $('#subject_name').val($(this).attr('data-value'));
    $('#subject_code').val($(this).attr('data-abbreviation'));
    $('#subject_update').modal('show');
    return false;

});

$(document.body).on('click', '#update_subject', function(){
    $.ajax({
        url: $('#subject_update_form').attr('data-action'),
        type: 'post',
        data: $('#subject_update_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.setting_html);
                $('.datatables').DataTable();
                $('#title').html('Classes | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#subject_update').modal('hide');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-subject', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#subject_error').hide();
                $('#subject_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.setting_html);
                    $('#class_success').show().html(response.message);
                } else {
                    $('#class_error').show().html(response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


$(document.body).on('click', '#save_institution', function(){
    $.ajax({
        url: $('#institution_form').attr('data-action'),
        type: 'post',
        data: $('#institution_form').serialize(),
        cache: false,
        success: function(response) {
            $('#institution_error').hide();
            $('#institution_success').hide();
            if (response.success) {
                $('#institution_success').show().html(response.message);
                $('#institution_form')[0].reset();
            } else {
                $('#institution_error').show().html(response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '#save_session', function(){
    $.ajax({
        url: $('#session_form').attr('data-action'),
        type: 'post',
        data: $('#session_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.session_html);
                $('#title').html('Session | ISMS');
                $('.datatables').DataTable();
                $( ".modal-backdrop" ).remove();
                $('#session_add').modal('hide');
                $('#session_form')[0].reset();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-session', function(){
    $('#session_id').val($(this).attr('data-href'));
    $('#first_term_start').val($(this).attr('data-first-term-start'));
    $('#first_term_end').val($(this).attr('data-first-term-end'));
    $('#second_term_start').val($(this).attr('data-second-term-start'));
    $('#second_term_end').val($(this).attr('data-second-term-end'));
    $('#third_term_start').val($(this).attr('data-third-term-start'));
    $('#third_term_end').val($(this).attr('data-third-term-end'));
    $('#name').val($(this).attr('data-value'));
    $('#session_edit').modal('show');
    return false;

});

$(document.body).on('click', '#update_session', function(){
    $.ajax({
        url: $('#session_update_form').attr('data-action'),
        type: 'post',
        data: $('#session_update_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.session_html);
                $('#title').html('Classes | ISMS');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
            $('.datatables').DataTable();
            $( ".modal-backdrop" ).remove();
            $('#session_edit').modal('hide');

        }
    });
    return false;
});

$(document.body).on('click', '.delete-session', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.session_html);
                    $('.datatables').DataTable();
                    $( ".modal-backdrop" ).remove();
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function institution_bank_acc(func_call){
    $.ajax({
        url: '/isms/finance/'+func_call,
        cache: false,
        success: function(response) {
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('.datatables').DataTable({
                    "scrollX": true
                });
                $('#title').html('Institution Bank Accounts | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_account', function(){
    $.ajax({
        url: $('#institution_bank_account_form').attr('data-action'),
        type: 'post',
        data: $('#institution_bank_account_form').serialize(),
        cache: false,
        success: function(response) {
            $('#account_error').hide();
            $('#account_success').hide();
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('#account_success').show().html(response.message);
                $('.datatables').DataTable();
                $('#title').html('Session | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#institute_account').modal('hide');
            } else {
                $('#account_error').show().html(response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-account', function(){
    $('#account_id').val($(this).attr('data-href'));
    $('#account_name').val($(this).attr('account-name'));
    $('#account_number').val($(this).attr('account-number'));
    $('#upadate_institute_account').modal('show');
    return false;

});

$(document.body).on('click', '#update_account', function(){
    $.ajax({
        url: $('#institution_bank_account_update_form').attr('data-action'),
        type: 'post',
        data: $('#institution_bank_account_update_form').serialize(),
        cache: false,
        success: function(response) {
            $('#account_error').hide();
            $('#account_success').hide();
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('#account_success').show().html(response.message);
                $('.datatables').DataTable();
                $('#title').html('Classes | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#upadate_institute_account').modal('hide');
            } else {
                $('#account_error').show().html(response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-account', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#account_error').hide();
                $('#account_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.finance_html);
                    $('#account_success').show().html(response.message);
                } else {
                    $('#account_error').show().html(response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function fee_types(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'finance/'+func_call,
        cache: false,
        success: function(response) {
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('.datatables').DataTable({
                    "scrollX": true
                });
                $('#title').html('Fee Type | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_fee', function(){
    $.ajax({
        url: $('#add_fee_form').attr('data-action'),
        type: 'post',
        data: $('#add_fee_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                toastr["success"]("Fee save successfully!");
                $('.datatables').DataTable();
                $('#title').html('Session | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#add_fee').modal('hide');
                $('#add_fee_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.edit-fee', function(){
    $('#fee_id').val($(this).attr('data-href'));
    $('#fee_name').val($(this).attr('data-name'));
    $('#fee_description').val($(this).attr('data-description'));
    $('#edit_fee').modal('show');
    return false;

});

$(document.body).on('click', '#update_fee', function(){
    $.ajax({
        url: $('#update_fee_form').attr('data-action'),
        type: 'post',
        data: $('#update_fee_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                toastr["success"]("Fee updated successfully!");
                $('.datatables').DataTable();
                $('#title').html('Fees | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#edit_fee').modal('hide');
            } else {
                toastr["error"](response.message);
                $('#edit_fee').modal('hide');
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-fee', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.finance_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#save_payment', function(){
    $.ajax({
        url: $('#add_payment_form').attr('data-action'),
        type: 'post',
        data: $('#add_payment_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                toastr["success"](response.message);
                $('.datatables').DataTable();
                $('#title').html('Session | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#add_payment').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-payment', function(){
    $('#is_incoming').prop('checked', false);
    var incoming = $(this).attr('data-incoming')
    $('#payment_id').val($(this).attr('data-href'));
    $('#payment_name').val($(this).attr('data-name'));
    $('#payment_description').val($(this).attr('data-description'));
    if(incoming == 1){
        $('#is_incoming').prop('checked', true);
    }
    $('#edit_payment').modal('show');
    return false;
});

$(document.body).on('click', '#update_payment', function(){
    $.ajax({
        url: $('#update_payment_form').attr('data-action'),
        type: 'post',
        data: $('#update_payment_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                toastr["success"](response.message);
                $('.datatables').DataTable();
                $('#title').html('Fees | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#edit_payment').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-payment', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.finance_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }
    return false;
});

function assessment_category(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'assessment/'+func_call,
        cache: false,
        success: function(response) {
            if(response.assessment_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.assessment_html);
                $('.datatables').DataTable({
                    "scrollX": true
                });
                $('#title').html('Assessment Categories Type | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_assessment_category', function(){
    $.ajax({
        url: $('#add_assessment_category_form').attr('data-action'),
        type: 'post',
        data: $('#add_assessment_category_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.assessment_html);
                $('.datatables').DataTable();
                $('#title').html('Assessment Categories | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#add_assessment_category').modal('hide');
                toastr["success"](response.message);
                $('#add_assessment_category_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-assessment-category', function(){
    $('#assessment_category_id').val($(this).attr('data-href'));
    $('#assessment_category_name').val($(this).attr('data-name'));
    $('#assessment_category_abbreviation').val($(this).attr('data-abbreviation'));
    $('#update_assessment_category').modal('show');
    return false;
});

$(document.body).on('click', '#update_assessment', function(){
    $.ajax({
        url: $('#update_assessment_category_form').attr('data-action'),
        type: 'post',
        data: $('#update_assessment_category_form').serialize(),
        cache: false,
        success: function(response) {

            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.assessment_html);
            $('.datatables').DataTable();
            $('#title').html('Assessment Categories | ISMS');
            $( ".modal-backdrop" ).remove();
            $('#update_assessment_category').modal('hide');
            if(response.success){
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-assessment-category', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.assessment_html);
                    $('.datatables').DataTable();
                    $('#title').html('Assessment Categories | ISMS');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#save-transection', function(){
    $.ajax({
        url: $('#new-transaction-categories-form').attr('data-action'),
        type: 'post',
        data: $('#new-transaction-categories-form').serialize(),
        cache: false,
        success: function(response) {
            $('#transaction_error').hide();
            $('#transaction_success').hide();
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('#transaction_success').show().html(response.message);
                $('.datatables').DataTable();
                $('#title').html('Transaction Categories | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#new-transaction-categories').modal('hide');
            } else {
                $('#transaction_error').show().html(response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-trans-cat', function(){
    $('#trans_id').val($(this).attr('data-href'));
    $('#edit_transaction_name').val($(this).attr('name'));
    $('#edit_transaction_description').val($(this).attr('description'));
    $('#edit-transaction-categories').modal('show');
    return false;

});

$(document.body).on('click', '#update-transaction-categories', function(){
    $.ajax({
        url: $('#update-transaction-categories-form').attr('data-action'),
        type: 'post',
        data: $('#update-transaction-categories-form').serialize(),
        cache: false,
        success: function(response) {
            $('#transaction_error').hide();
            $('#transaction_success').hide();
            if(response.finance_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.finance_html);
                $('#transaction_success').show().html(response.message);
                $('.datatables').DataTable();
                $('#title').html('Transaction Categories | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#edit-transaction-categories').modal('hide');
            } else {
                $('#transaction_error').show().html(response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-trans-cat', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#transaction_error').hide();
                $('#transaction_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.finance_html);
                    toastr["error"]("Deleted successfully!");
                } else {
                    toastr["error"]("There is an error while deleting!");
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function grade_scales(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'grade_scale/'+func_call,
        cache: false,
        success: function(response) {
            if(response.scale_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('#title').html('Grading Scales | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_scale', function(){
    $.ajax({
        url: $('#grade_scale_add_form').attr('data-action'),
        type: 'post',
        data: $('#grade_scale_add_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('.datatables').DataTable();
                $('#title').html('Grade Scales | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#add_scale').modal('hide');
                toastr["success"](response.message);
                $('#grade_scale_add_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }


        }
    });

    return false;
});

$(document.body).on('click', '.edit_grade_scale', function(){
    var scale_id = $(this).attr('data-href');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'grade_scale/edit_scale/'+scale_id,
        cache: false,
        success: function(response) {
            $('.edit-modal-body').empty();
            $('.edit-modal-body').append(response.scale_html);
            $('#edit_scale').modal('show');
        }
    });
    return false;
});

$(document.body).on('click', '#update_scale', function(){
    $.ajax({
        url: $('#grade_scale_update_form').attr('data-action'),
        type: 'post',
        data: $('#grade_scale_update_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                toastr["success"](response.message);
                $('#title').html('Grade Scales | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#edit_scale').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-grade-scale', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.scale_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


$(document.body).on('click', '.grade_scale_level', function(){
    var scale_id = $(this).attr('data-href');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'grade_scale/grade_scales_level/'+scale_id,
        cache: false,
        success: function(response) {
            if (response.scale_html != '') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('#title').html('Grade Scale Levels | ISMS');
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#save_scale_level', function(){
    $.ajax({
        url: $('#grade_scale_level_add_form').attr('data-action'),
        type: 'post',
        data: $('#grade_scale_level_add_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $( ".modal-backdrop" ).remove();
                $('#add_scale_level').modal('hide');
                $('#grade_scale_level_add_form')[0].reset();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit_grade_scale_level', function(){
    $('#grade_scale_level_edit_form')[0].reset();
    $('#level_id').val($(this).attr('data-href'));
    $('#scale_id').val($(this).attr('data-scale-id'));
    $('#level_name').val($(this).attr('data-name'));
    $('#min_percentage').val($(this).attr('data-percent'));
    $('#level_remarks').val($(this).attr('data-remaks'));
    $('#edit_scale_level').modal('show');
});

$(document.body).on('click', '#update_scale_level', function(){
    $.ajax({
        url: $('#grade_scale_level_edit_form').attr('data-action'),
        type: 'post',
        data: $('#grade_scale_level_edit_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                toastr["success"](response.message);
                $('#title').html('Grade Scales | ISMS');
                $( ".modal-backdrop" ).remove();
                $('#edit_scale_level').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.delete-grade-scale-level', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.scale_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.retire-grade-scale', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

function domains(func_call){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'domains/'+func_call,
        cache: false,
        success: function(response) {
            if(response.domain_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.domain_html);
                $('#title').html('Grading Scales | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_domain_indicator', function(){
    $.ajax({
        url: $('#add_domain_indicator_form').attr('data-action'),
        type: 'post',
        data: $('#add_domain_indicator_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.domain_indicator_table').empty();
                $('.domain_indicator_table').append(response.indicator_html);
                $('#add_domain_group_indicator').modal('hide');
                $('#add_domain_indicator_form')[0].reset();
                $('#account-table').DataTable();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-domain-group-indicator', function(){
     $('#edit_domain_indicator_form')[0].reset();
     $('#indicator_id').val($(this).attr('data-href'));
     $('#indicator_name').val($(this).attr('data-name'));
     $('#indicator_code').val($(this).attr('data-code'));
     $('#indicator_description').val($(this).attr('data-description'));
     $('#domain_id').val($(this).attr('data-domain-id'));
    $('#edit_domain_group_indicator').modal('show');
});

$(document.body).on('click', '#update_domain_indicator', function(){
    $.ajax({
        url: $('#edit_domain_indicator_form').attr('data-action'),
        type: 'post',
        data: $('#edit_domain_indicator_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.domain_indicator_table').empty();
                $('.domain_indicator_table').append(response.indicator_html);
                $('#edit_domain_group_indicator').modal('hide');
                $('#account-table').DataTable();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.delete-domain-group-indicator', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'post',
            data : { delete_id : $(this).attr('data-delete-id'), domain_id : $(this).attr('data-domain-id') },
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.domain_indicator_table').empty();
                    $('.domain_indicator_table').append(response.indicator_html);
                    $('#account-table').DataTable();
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.delete-domain-group', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'get',
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.domain_html);
                    $('.datatables').DataTable();
                    $('#title').html('Learning Domain | ISMS');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.assign-guardian', function(){
    $('#assign_guardian_form')[0].reset();
    $('#student_id').val($(this).attr('data-student-id'));
    $('#guardian_id').val($(this).attr('data-guardian-id'));
    $('#assign_guardian').modal('show');
    return false;

});

$(document.body).on('click', '#assign_student_guardian', function(){
    $.ajax({
        url: $('#assign_guardian_form').attr('data-action'),
        type: 'post',
        data: $('#assign_guardian_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('#guardian_table').empty();
                $('#guardian_table').append(response.guardian_html);
                $('#assign_guardian').modal('hide');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '#save_student_guardian', function(){
    $.ajax({
        url: $('#create_guardian_form').attr('data-action'),
        type: 'post',
        data: $('#create_guardian_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.guardian_html != ''){
                $('#guardian_table').empty();
                $('#guardian_table').append(response.guardian_html);
                $('#myModal').modal('hide');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.unassign-guardian', function(){
    if (confirm('Are you sure to unassin this guardian?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'post',
            data : { guardian_id : $(this).attr('data-guardian-id'), student_id : $(this).attr('data-student-id') },
            cache: false,
            success: function(response) {
                if(response.guardian_html != ''){
                    $('#guardian_table').empty();
                    $('#guardian_table').append(response.guardian_html);
                    toastr["success"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


function employee_listing(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'employee/'+func_call,
        cache: false,
        success: function(response) {
            if(response.employee_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.employee_html);
                $('#example1').DataTable();
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass   : 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass   : 'iradio_flat-green'
                });
                $('.select2').select2({
                    placeholder: "Show more fields"
                });
                $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy'
                });
                $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy'
                });
                $('#title').html('Employee Listing | ISMS');
            }
        }
    });
}


function get_batches(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'batches/'+func_call,
        cache: false,
        success: function(response) {
            if(response.batch_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.batch_html);

                $('.select2').select2({
                    placeholder: "Show more fields"
                });
                $('#title').html('Batches | ISMS');

            }
        }
    });
}

$(document.body).on('click', '#save_batch', function(){
    $.ajax({
        url: $('#batch_form').attr('data-action'),
        type: 'post',
        data: $('#batch_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.batch_html);
                $('#new_batch').modal('hide');
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '.edit-batch', function(){

    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            $('.modal-body').empty();
            $('.modal-body').append(response.batch_html);
            $('#new_batch').modal('show');
        }
    });
    return false;
});

$(document.body).on('click', '.delete-batch', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'post',
            data : { delete_id : $(this).attr('data-delete-id'), domain_id : $(this).attr('data-domain-id') },
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.batch_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#assign_employee', function(){
    $.ajax({
        url: $('#assign_employee_form').attr('data-action'),
        type: 'post',
        data: $('#assign_employee_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.batch_html);
                $('#myModal').modal('hide');
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});


function get_subjects(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/'+func_call,
        cache: false,
        success: function(response) {
            if(response.subject_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subject_html);
                $('#title').html('Subjects | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#save_subject', function(){
    $.ajax({
        url: $('#batch_form').attr('data-action'),
        type: 'post',
        data: $('#batch_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subject_html);
                $('#new_subject').modal('hide');
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});


$(document.body).on('click', '.delete_subject_detail', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'post',
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.subject_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


$(".update_check").change(function() {
    var subject_id = $(this).attr('data-subject-id');
    var data_update = $(this).attr('data-update');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/update_publish_grade',
    	type: 'post',
        data : { subject_detail_id : subject_id, data_update:data_update },
    	cache: false,
        success: function(response) {
        if (response.success) {
            toastr["success"](response.message);
        } else {
            toastr["error"](response.message);
        }
    }
	});

});

function get_calendar(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'calendar/'+func_call,
        cache: false,
        success: function(response) {
            if(response.calendar_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.calendar_html);
                $('#title').html('Events | ISMS');
            }
        }
    });
}

function get_events(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'calendar/'+func_call,
        cache: false,
        success: function(response) {
            if(response.calendar_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.calendar_html);
                $('#title').html('Events | ISMS');
            }
        }
    });
}

$(document.body).on('click', '.delete-event', function(){
        if (confirm('Are you sure to delete this record?')) {
            $.ajax({
                url: $(this).attr('data-href'),
                type: 'post',
                data : { event_id : $(this).attr('data-event-id')},
                cache: false,
                success: function(response) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.calendar_html);
                    toastr["error"](response.message);
                }
            });
        } else {
            return false;
        }

        return false;
});

function get_sms(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'sms/'+func_call,
        cache: false,
        success: function(response) {
            if(response.sms_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.sms_html);
                $('#title').html('SMS | ISMS');
            }
        }
    });
}

$(document.body).on('click', '#send_message', function(){
    $.ajax({
        url: $('#sms_form').attr('data-action'),
        type: 'post',
        data: $('#sms_form').serialize(),
        cache: false,
        success: function(response) {
            console.log(response);
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.sms_html);
                $('#title').html('SMS | ISMS');
                toastr["success"](response.message);
            }else{
                toastr["error"](response.message);
			}
        }
    });

    return false;
});

$(document.body).on('click', '.add-sms', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        cache: false,
        success: function(response) {
            if (response.sms_html!=='') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.sms_html);
                $('#title').html('SMS | Add Message');
            } else {
                toastr["error"]('Unable to load view');
            }
        }
    });

    return false;
});

$(document.body).on('click', '.sms_view', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        data: {sms_id:$(this).attr('data-sms-id')},
        cache: false,
        success: function(response) {
            if (response.sms_html!=='') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.sms_html);
                $('#title').html('SMS | View Message');
            } else {
                toastr["error"]('Unable to load view');
            }
        }
    });

    return false;
});

function get_fee_management(func_call) {
    $('#payment_id').val('');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'fee_management/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Fee Management');
            }
        }
    });
}

function get_income_expanse(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'fee_management/'+func_call,
        cache: false,
        success: function(response) {
            if(response.classes_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.classes_html);
                $('#title').html('SMS | Fee Management');
            }
        }
    });
}


$(document.body).on('change', '.select-student', function(){
    var url = $(this).attr('data-action');
    var student_id = $(this).attr('data-student-id');
    if($(this).prop("checked") == true){
        var flag = 'select';
    }else{
        var flag = 'deselect';
    }
    $.ajax({
        url: url,
        type: 'post',
        data: {flag:flag,student_id:student_id},
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
});

$(document.body).on('click', '#view_register', function(){

    $.ajax({
        url: $('#view_register_form').attr('data-action'),
        type: 'post',
        data: $('#view_register_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.student-content-wrapper').empty();
                $('.student-content-wrapper').append(response.register_html);
                $('#title').html('Register | Attendance');
            }else{
                toastr["error"](response.message);
			}
        }
    });

    return false;
});

$(document.body).on('click', '.st-radio-btn', function(){
	var student_id = $(this).attr('id');
	var batch_no = $(this).attr('data-student-batch');
	var attendance_status = $(this).attr('data-attendance-status');
	var url = $(this).attr('data-action');
	var attendance_date = $('#attendance_date').val();
    $.ajax({
        url:url,
        type: 'post',
        data: {user_id:student_id,batch_id:batch_no,status:attendance_status,attendance_date:attendance_date},
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

});

$(document.body).on('click', '.emp-radio-btn', function(){
    var student_id = $(this).attr('id');
    var batch_no = $(this).attr('data-student-batch');
    var attendance_status = $(this).attr('data-attendance-status');
    var url = $(this).attr('data-action');
    var attendance_date = $('#emp_attendance_date').val();
    $.ajax({
        url:url,
        type: 'post',
        data: {user_id:student_id,batch_id:batch_no,status:attendance_status,attendance_date:attendance_date},
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

});

$(document.body).on('click', '#view_emp_register', function(){
    $.ajax({
        url: $('#view_employee_form').attr('data-action'),
        type: 'post',
        data: $('#view_employee_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.teacher-content-wrapper').empty();
                $('.teacher-content-wrapper').append(response.register_html);
                $('#title').html('Register | Attendance');
            }else{
                toastr["error"](response.message);
			}
        }
    });
    return false;
});

$(document.body).on('click', '#st_attendance_report_btn', function(){
    $.ajax({
        url: $('#st_attendance_report_form').attr('data-action'),
        type: 'post',
        data: $('#st_attendance_report_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.register_html != ''){
                $('.st-attendance-wrapper').empty();
                $('.st-attendance-wrapper').append(response.register_html);
                $('#title').html('Register | Attendance Report');
            }
        }
    });
    return false;
});


$(document.body).on('click', '#emp_attendance_report_btn', function(){
    $.ajax({
        url: $('#emp_attendance_report_form').attr('data-action'),
        type: 'post',
        data: $('#emp_attendance_report_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.register_html != ''){
                $('.emp-attendance-wrapper').empty();
                $('.emp-attendance-wrapper').append(response.register_html);
                $('#title').html('Register | Attendance Report');
            }
        }
    });
    return false;
});

$(document.body).on('click', '.edit-fee-payment-btn', function(){
    var payment_id = $(this).attr('data-payment-id');
    var batch_no = $(this).attr('data-batch-no');
    var title = $(this).attr('data-title');
    var description = $(this).attr('data-description');
    var amount = $(this).attr('data-amount');
    var amount_paid = $(this).attr('data-amount-paid');
    var status = $(this).attr('data-status');
    var student_id = $(this).attr('data-student-id');
    var student_name = $(this).attr('data-student-name');
    var fee_date = $(this).attr('data-fee');
    var method = $(this).attr('data-method');
    var fee_type_id = $(this).attr('data-fee-type');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'fee_management/edit_payment_view',
        data:{payment_id:payment_id,batch_no:batch_no,title:title,description:description,
            amount:amount,amount_paid:amount_paid,status:status,student_id:student_id,
			student_name:student_name,fee_date:fee_date,method:method,fee_type_id:fee_type_id},
        type: 'post',
        cache: false,
        success: function(response) {
            $('#edit_payment').empty();
            $('#edit_payment').append(response.payment_html);
            $('#fee_payment').modal('show');
        }
    });
    return false;
});

$(document.body).on('click', '#add_fee_payment_btn', function(){
    $.ajax({
        url: $('#add_fee_payment_form').attr('data-action'),
        type: 'post',
        data: $('#add_fee_payment_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                toastr["success"](response.message);
                $('#add_fee_payment_form')[0].reset();
            }else{
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '#update_fee_payment_btn', function(){
    $.ajax({
        url: $('#update_fee_payment_form').attr('data-action'),
        type: 'post',
        data: $('#update_fee_payment_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.classes_html);
                $('#fee_payment').modal('hide');
                $('#title').html('SMS | Fee Management');
                toastr["success"](response.message);
                $('#update_fee_payment_form')[0].reset();
            }
            else{
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

function get_manage_subjects(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.classes_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subjects_html);
                $('#title').html('SMS | Manage Subjects ');
            }
        }
    });
}

$(document.body).on('click', '#save_exam_subject', function(){
    $.ajax({
        url: $('#subject_form').attr('data-action'),
        type: 'post',
        data: $('#subject_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subjects_html);
                $('#title').html('SMS | Manage Subjects ');
                $('#subject_add').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#subject_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.edit-exam-subject', function(){
    var course_id = $(this).attr('data_course_id');
    var subject_id = $(this).attr('data_subject_id');
    $.ajax({
        url: $(this).attr('data-action'),
        type: 'post',
        data: {subject_id:subject_id,course_id:course_id},
        cache: false,
        success: function(response) {
            $('#edit_subject_container').empty();
            $('#edit_subject_container').append(response.result_html);
            $('#subject_edit').modal('show');
        }
    });
    return false;

});


$(document.body).on('click', '.delete-exam-subject', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.subjects_html);
                    $('#title').html('SMS | Manage Subjects ');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function get_exam(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Exam ');
            }
        }
    });
}

function load_course_subjects(id) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/get_course_subjects/'+id,
        cache: false,
        success: function(response) {
            $('#subject_id_1').prop("disabled", false); // Element(s) are now enabled.
            $('#subject_id_1').empty();
            $('#subject_id_1').append(response);
        }
    });

}

$(document.body).on('click', '#save_exam', function(){
    $.ajax({
        url: $('#exam_form').attr('data-action'),
        type: 'post',
        data: $('#exam_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {

                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Exam ');

                $('#exam_add').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#exam_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-exam', function(){
    var course_id = $(this).attr('data_course_id');
    var subject_id = $(this).attr('data_subject_id');
    var exam_id = $(this).attr('data_exam_id');

    $.ajax({
        url: $(this).attr('data-action'),
        type: 'post',
        data: {exam_id:exam_id,subject_id:subject_id,course_id:course_id},
        cache: false,
        success: function(response) {
            $('#edit_form_container').empty();
            $('#edit_form_container').append(response.result_html);
            $('#edit_exam').modal('show');
        }
    });
    return false;

});

$(document.body).on('click', '#update_exam', function(){
    $.ajax({
        url: $('#edit_exam_form').attr('data-action'),
        type: 'post',
        data: $('#edit_exam_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {

                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Exam ');

                $('#edit_exam').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#exam_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.delete-exam', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.result_html);
                    $('#title').html('SMS | Manage Subjects ');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

function get_question(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Exam ');
            }
        }
    });
}

$(document.body).on('click', '#save_question', function(){
    $.ajax({
        url: $('#exam_question_form').attr('data-action'),
        type: 'post',
        data: $('#exam_question_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Question & Answer ');

                $('#exam_question').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#exam_question_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.edit-exam-question', function(){
    $.ajax({
        url: $(this).attr('data-action'),
        type: 'get',
        cache: false,
        success: function(response) {
            $('#exam_question_container').empty();
            $('#exam_question_container').append(response.result_html);
            $('#edit_exam_question').modal('show');
            $('#exam_question_form')[0].reset();
        }
    });
    return false;

});

$(document.body).on('click', '#update_question', function(){
    $.ajax({
        url: $('#exam_edit_question_form').attr('data-action'),
        type: 'post',
        data: $('#exam_edit_question_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Question & Answer ');

                $('#edit_exam_question').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#exam_edit_question_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '.delete-exam-question', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.result_html);
                    $('#title').html('SMS | Manage Subjects ');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#update_exam_subject', function(){
    $.ajax({
        url: $('#subject_edit_form').attr('data-action'),
        type: 'post',
        data: $('#subject_edit_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subjects_html);
                $('#title').html('SMS | Manage Subjects ');
                $('#subject_edit').modal('hide');
                $( ".modal-backdrop" ).remove();

                toastr["success"](response.message);
                $('#subject_edit_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

function student_exam(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Exam');
            }
        }
    });
}

$(document.body).on('click', '#student_exam_result', function(){
    $.ajax({
        url: $('#student_exam_form').attr('data-action'),
        type: 'post',
        data: $('#student_exam_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});


function exam_result(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Exam');
            }
        }
    });
}

$(document.body).on('click', '#student_result_summary', function(){
    $.ajax({
        url: $('#student_result_form').attr('data-action'),
        type: 'post',
        data: $('#student_result_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('#result_container').empty();
                $('#result_container').append(response.result_html);
                $('#title').html('SMS | Student Result');
            }else{
                toastr["error"](response.message);
			}
        }
    });

    return false;
});

$(document.body).on('click', '#select_exam_questions', function(){
    $.ajax({
        url: $('#get_exam_question').attr('data-action'),
        type: 'post',
        data: $('#get_exam_question').serialize(),
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#exam_question_container').empty();
                $('#exam_question_container').append(response.result_html);
                $('#title').html('SMS | Student Exam');
            }
        }
    });

    return false;
});

function get_payment(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'online_test/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Exam');
            }
        }
    });
}

$(document.body).on('click', '.delete-income', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.classes_html);
                    $('#class_success').show().html(response.message);
                    toastr["error"](response.message);
                } else {
                    $('#class_error').show().html(response.message);
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.delete-income-fee', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#class_error').hide();
                $('#class_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.classes_html);
                    $('#class_success').show().html(response.message);
                    toastr["error"](response.message);
                } else {
                    $('#class_error').show().html(response.message);
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.student-guardian', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            if(response.guardian_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.guardian_html);
                $('#title').html('Guardian Listing | ISMS');

            }
        }
    });
});

$(document.body).on('click', '.delete-guardian', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.guardian_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#search-btn', function(){
    var base_url = $('#base').val();
    if($('#query').val()==''){
    	var menu = 'all'
	}else{
        var menu = $('#query').val();
	}

    $.ajax({
        url: base_url + "dashboard/get_menus_search/"+menu,
        type:'get',
        cache: false,
        success: function(response) {
            $('.mt-2').empty();
            $('.mt-2').append(response.sidebar_html);
        }
    });
});

$(document.body).on('click', '.delete-student_cat', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#student_error').hide();
                $('#student_success').hide();
                if(response.student_html != ''){
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.student_html);
                    $('.datatables').DataTable();
                    $('#title').html('Student Categories | ISMS');

                    $( ".modal-backdrop" ).remove();
                } else {
                    $('#student_error').show().html(response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});


/////////////////////// filter fiels show hide //////////////////////////////////
$(document.body).on('click', '.show-more', function(){
    if ($(this).is(":checked")) {
        $(".filter-toggle").show();
    } else {
        $(".filter-toggle").hide();
    }
});

$(document.body).on('click', '#list_itmes_employee_add', function(){
    employee_add('employee_add');
});


$(document.body).on('click', '.delete-student', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                $('#student_error').hide();
                $('#student_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.student_html);
                    $('#student-table').DataTable();
                    var sttable = $("#student-b-table").DataTable({
                        dom: 'Bfrtip',
                        scrollX: true,
                        buttons: [
                            'colvis'
                        ]
                    });
                    //sttable.columns( [ 1, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16 ] ).visible( false, false );
                    sttable.columns( [ 1, 4, 5, 6, 8,10,11,12,13,14,15,16 ] ).visible( false, true );
                    $('#title').html('Student Listing | ISMS');
                } else {
                    $('#student_error').show().html(response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.std_profile', function(){
    var std_id = $(this).attr('data-student-id');
    $('#std_id').val(std_id);
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.student_html);
            $('#title').html('SMS | Student Profile');
        }
    });
});


function get_student_profile(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'students/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Profile');
            }
        }
    });
}

$(document.body).on('click', '.emp_profile', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.employee_html);
            $('#title').html('SMS | Employees Profile');
        }
    });
});

function batch_filter(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/batch_subject',
        data: $('#batch_subject_form').serialize(),
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.subject_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.subject_html);
                $('#title').html('Batch | ISMS');
            }
        }
    });

    return false;
}

$(document.body).on('click', '#change_password', function () {
    $.ajax({
        url: $('#change_pwd').attr('data-action'),
        type: 'post',
        data: $('#change_pwd').serialize(),
        cache: false,
        success: function (response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#myModal').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

function get_guardian_profile(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'guardians/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Profile');
            }
        }
    });
}

$(document.body).on('click', '.delete-assessment', function () {
    var assessment_id = $(this).attr('data-assessment-id');
    var subject_detail_id = $(this).attr('data-subject-detail-id');
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            type: 'post',
            data: {subject_detail_id: subject_detail_id, assessment_id: assessment_id},
            success: function (response) {
                if (response.success) {
                    $('#subject_assessment').empty();
                    $('#subject_assessment').append(response.subject_html);
                    $(".modal-backdrop").remove();
                    $('#new_assessment').modal('hide');
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#save_assessment', function () {
    $.ajax({
        url: $('#subject_assessment_form').attr('data-action'),
        type: 'post',
        data: $('#subject_assessment_form').serialize(),
        cache: false,
        success: function (response) {
            if (response.success) {
                $('#subject_assessment').empty();
                $('#subject_assessment').append(response.subject_html);
                $(".modal-backdrop").remove();
                $('#new_assessment').modal('hide');
                toastr["success"](response.message);
                $('#subject_assessment_form')[0].reset();
            } else {
                toastr["error"](response.message);
            }

        }
    });

    return false;
});

$(document.body).on('click', '#student_fee_search', function(){
    $.ajax({
        url: $('#student_fee_form').attr('data-action'),
        type: 'post',
        data: $('#student_fee_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Manage Fee');
            }else{
                toastr["error"](response.message);
			}
        }
    });

    return false;
});

$(document.body).on('click', '#create_pdf', function(){
   var batch_no = $('#batch_no').val();
   var fee_from = $('#fee_from').val();
   var fee_to 	= $('#fee_to').val();
   var fee_status = $('#fee_status').val();
   var fee_paid = $('#fee_paid').val();
   var fee_paid_filter = $('#fee_paid_filter').val();

    $('#pdf_batch_no').val(batch_no);
    $('#pdf_fee_from').val(fee_from);
    $('#pdf_fee_to').val(fee_to);
    $('#pdf_fee_status').val(fee_status);
    $('#pdf_fee_paid').val(fee_paid);
    $('#pdf_fee_paid_filter').val(fee_paid_filter);

    $("#create_student_fee_pdf_form").submit();
});

$(document.body).on('click', '#save_calendar_event', function(){
    $.ajax({
        url: $('#calendar_event_form').attr('data-action'),
        type: 'post',
        data: $('#calendar_event_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.calendar_html);
                $('#title').html('Events | ISMS');
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '#add_fee_btn', function(){
    $.ajax({
        url: $('#fee_management_form').attr('data-action'),
        type: 'post',
        data: $('#fee_management_form').serialize(),
        cache: false,
        success: function(response) {
			if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $( ".modal-backdrop" ).remove();
                $('#fee_management_form')[0].reset();
                toastr["success"](response.message);
            }else{
                toastr["error"](response.message);
			}
        }
    });

    return false;
});

function get_student_fees(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'students/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Student Profile');
            }
        }
    });
}

$(document.body).on('click', '.fee-payment-btn', function(){
	var id =$(this).attr('data-value');
	var user_id =$(this).attr('user-id');
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        data: {id:id,user_id:user_id},
        cache: false,
        success: function(response) {
            if(response.success){
                $('#paid_fee_container').empty();
                $('#paid_fee_container').append(response.result_html);
                $('#exampleModal').modal('show');
            }else{
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '#fee_pay_btn', function(){
    $.ajax({
        url: $('#fee_paid_form').attr('data-action'),
        type: 'post',
        data: $('#fee_paid_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
                $('#title').html('SMS | Manage Fee ');
            }else if(response.error){
                toastr["error"](response.message);
            }else{
                toastr["error"]('Please enter amount equal to due balance');
			}
        }
    });

    return false;
});

$(document.body).on('click', '.edit-fee-management-btn', function(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'fee_management/edit_payment_view',
        data:{payment_id:payment_id,batch_no:batch_no,title:title,description:description,
            amount:amount,amount_paid:amount_paid,status:status,student_id:student_id,
            student_name:student_name,fee_date:fee_date,method:method,fee_type_id:fee_type_id},
        type: 'post',
        cache: false,
        success: function(response) {
            $('#edit_payment').empty();
            $('#edit_payment').append(response.payment_html);
            $('#fee_payment').modal('show');
        }
    });
    return false;
});


$(document.body).on('click', '.disabled', function(){
    toastr["error"]('You are not authorized for this action!');
    return false;
});

function get_class_set(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'general_setting/'+func_call,
        cache: false,
        success: function(response) {
            if(response.classes_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('.datatables').DataTable();
                $('#title').html('Class Set | ISMS');
            }
        }
    });
}

$(document.body).on('click', '.edit-domain', function(){
    var base_url = $('#base').val();
    var session = $(this).attr('data-session');
    var course_id = $(this).attr('data-course-id');
    $.ajax({
        url: base_url+'general_setting/get_learning_domains',
        data:{session:session,course_id:course_id},
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.domain_modal_content').empty();
                $('.domain_modal_content').append(response.result_html);
                $('#domain_edit_modal').modal('show');
            }
        }
    });
    return false;

});

$(document.body).on('click', '#save_class_set_domain', function(){
    $.ajax({
        url: $('#class_set_form').attr('data-action'),
        type: 'post',
        data: $('#class_set_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#class_set_form')[0].reset();
                $('#domain_edit_modal').modal('hide');
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

function get_report_card(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'reportcard/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Report Card');
            }
        }
    });
}

$(document.body).on('click', '#save_report_card_group', function(){
    $.ajax({
        url: $('#report_card_group_form').attr('data-action'),
        type: 'post',
        data: $('#report_card_group_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Report Card');

                $('#report_card_group_form')[0].reset();
                $('#report_card_modal').modal('hide');
                $( ".modal-backdrop" ).remove();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.edit-card-group', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#report_form_container').empty();
                $('#report_form_container').append(response.result_html);
                $('#report_card_modal').modal('show');
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});


$(document.body).on('click', '.delete-card-group', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.result_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '#class_set_students', function(){
	var class_set_id = $(this).attr('data-class-set-id');
	var term_id = $(this).attr('data-term');
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        data : { class_set_id : class_set_id, term_id:term_id },
        cache: false,
        success: function(response) {
            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.result_html);
        }
    });
    return false;
});



$(document.body).on('click', '.std-subject-report', function(){
    var student_id = $(this).attr('data-href');
    var term_id = $(this).attr('data-term-id');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'reportcard/get_student_subjects_report',
        data: {student_id:student_id,term_id:term_id},
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#std_subjects_report_container').empty();
                $('#std_subjects_report_container').append(response.student_info);
                $('#std_subjects_report_container').append(response.result_html);
            }
        }
    });
    return false;
});

$(document.body).on('click', '.delete-employee', function () {
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function (response) {
                $('#student_error').hide();
                $('#student_success').hide();
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.employee_html);
                    $('#student_success').show().html(response.message);
                } else {
                    $('#student_error').show().html(response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('click', '.delete-fee-group', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.result_html);
                    toastr['error'](response.message);
                } else {
                    toastr['error'](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});

$(document.body).on('change', '#term', function(){
    var subject_detail_id = $('#subject_detail_id').val();
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/get_term_scores',
        type: 'post',
        data : $('#scoresheet-filter').serialize(),
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.table-responsive').empty();
                $('.table-responsive').append(response.result_html);
            } else {
                toastr["error"]('seem to be an error.');
            }
        }
    });

});

$(document.body).on('click', '#save_report_comment', function(){
    $.ajax({
        url: $('#report_comment_form').attr('data-action'),
        type: 'post',
        data: $('#report_comment_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
                if(response.comment_by == 'principal'){
                    $('#comment-field-1').empty();
                    $('#comment-field-1').append(response.result_html);
                }else{
                    $('#comment-field-3').empty();
                    $('#comment-field-3').append(response.result_html);
                }

                $('#report_comment_form')[0].reset();
                $('#add_report_comment').modal('hide');
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#student_report_btn', function(){
    $("#student_report_form").submit();
});

$(document.body).on('click', '.edit-fee-group', function(){
    $.ajax({
        url: $(this).attr('data-action'),
        type: 'get',
        cache: false,
        success: function(response) {
            $('#fee_group_form_container').empty();
            $('#fee_group_form_container').append(response.result_html);
            $('#exampleModal').modal('show');
        }
    });
    return false;
});


$(document.body).on('click', '#update_fee_btn', function(){
    $.ajax({
        url: $('#fee_management_form').attr('data-action'),
        type: 'post',
        data: $('#fee_management_form').serialize(),
        cache: false,
        success: function(response) {
            if(response.success){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('#exampleModal').modal('hide');
                $( ".modal-backdrop" ).remove();
                $('#fee_management_form')[0].reset();
                toastr["success"](response.message);

            } else {
                toastr["error"](response.message);
                $('#edit_fee').modal('hide');
            }

        }
    });
    return false;
});


$(document.body).on('click', '#fee_group_filter', function(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'fee_management/fee_management',
        data: $('#fee_group_filter_form').serialize(),
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            }
        }
    });
    return false;
});


$(document.body).on('click', '#class_set_grd', function(){
    var class_set_id = $(this).attr('data-class-set-id');
    var term_id = $(this).attr('data-term');
    var user_name = $(this).attr('data-user-name');
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        data : { class_set_id : class_set_id, term_id:term_id,user_name:user_name },
        cache: false,
        success: function(response) {
            $('.content-wrapper').remove();
            $('#content-wrapper').append(response.result_html);
        }
    });
    return false;
});

function get_student_assessment(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Assessment');
            }
        }
    });
}

$(document.body).on('click', '#subj_filter', function(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/student_assessments',
        data: $('#assessment_filter_form').serialize(),
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            }
        }
    });
    return false;
});


function get_student_subject_assessment(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | Subject Assessment');
            }
        }
    });
}


function get_lga_origin(func_call) {
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'general_setting/'+func_call,
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('#content-wrapper').empty();
                $('#content-wrapper').append(response.result_html);
                $('#title').html('SMS | LGA Origins');
            }
        }
    });
}



$(document.body).on('click', '#assessment_filter', function(){
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'subjects/student_subject_assessment',
        data: $('#sbj_asses_filter_form').serialize(),
        type: 'post',
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#save_student_grade', function(){
    $.ajax({
        url: $('#student_behavioural_score_form').attr('data-action'),
        type: 'post',
        data: $('#student_behavioural_score_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});


$(document.body).on('click', '#batch_detail_view', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'get',
        cache: false,
        success: function(response) {
            if (response.result_html != '') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#sbj_detail_view', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'get',
        cache: false,
        success: function(response) {
            if (response.result_html != '') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '.edit_assessment', function () {
    var url = $(this).attr('data-href');
    $.ajax({
        url: url,
        cache: false,
        success: function (response) {
            $('.edit_assessment_modal').empty();
            $('.edit_assessment_modal').append(response.subject_html);
            $('#new_assessment').modal('show');
        }
    });
    return false;
});
$(document.body).on('submit', '#student_form', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('data-action'),
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
            $("#err").fadeOut();
        },
        success: function(response)
        {
            if(response.success)
            {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                toastr["success"](response.message);
            }
            else
            {
                toastr["error"](response.message);
            }
        },
        error: function(e)
        {
            toastr["error"]('seem to be an error');
        }
    });

    return false;
});

$(document.body).on('click', '#student_edit_btn', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            if(response.student_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.student_html);
            } else {
                toastr["error"]('seem to be an error');
            }
        }
    });
    return false;
});

$(document.body).on('submit', '#student_update_form', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('data-action'),
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
            $("#err").fadeOut();
        },
        success: function(response)
        {
            if(response.success)
            {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                toastr["success"](response.message);
            }
            else
            {
                toastr["error"](response.message);
            }
        },
        error: function(e)
        {
            toastr["error"]('seem to be an error');
        }
    });

    return false;
});

$(document.body).on('submit', '#employee_form', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('data-action'),
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
            $("#err").fadeOut();
        },
        success: function(response)
        {
            if(response.success)
            {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                toastr["success"](response.message);
            }
            else
            {
                toastr["error"](response.message);
            }
        },
        error: function(e)
        {
            toastr["error"]('seem to be an error');
        }
    });

    return false;
});

$(document.body).on('click', '#employee_edit_btn', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        cache: false,
        success: function(response) {
            if(response.result_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"]('seem to be an error');
            }
        }
    });
    return false;
});

$(document.body).on('click', '.edit_subject', function(){
    var subject_id = $(this).attr('data-href');
    $.ajax({
        url: '/isms/subjects/edit/'+subject_id,
        cache: false,
        success: function(response) {
            $('.edit_subject_body').empty();
            $('.edit_subject_body').append(response.subject_html);
            $('#new_subject').modal('show');
        }
    });
    return false;
});


$(document.body).on('click', '.add-calendar-eveent', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'post',
        cache: false,
        success: function(response) {
            if (response.add_event_html!=='') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.add_event_html);
            } else {
                toastr["warning"]('Unable to load view');
            }
        }
    });

    return false;
});

$(document.body).on('click', '#save_elective_group', function(){
    $.ajax({
        url: $('#elective_subject_form').attr('data-action'),
        type: 'post',
        data: $('#elective_subject_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('#new_group').modal('hide');
                $( ".modal-backdrop" ).remove();
                $('#elective_subject_form')[0].reset();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#add_domain_group', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'get',
        cache: false,
        success: function(response) {
            if (response.result_html!='') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"]('Seems to an error.');
            }
        }
    });
    return false;
});

$(document.body).on('click', '#save_domain_group', function(){
    $.ajax({
        url: $('#domain_group_form').attr('data-action'),
        type: 'post',
        data: $('#domain_group_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
                $('.datatables').DataTable();
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#edit_domain_group', function(){
    $.ajax({
        url: $(this).attr('data-href'),
        type: 'get',
        cache: false,
        success: function(response) {
            if (response.result_html!='') {
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"]('Seem to be an error.');
            }
        }
    });
    return false;
});

$(document.body).on('click', '#add_domain_indicator_btn', function(){
    var base_url = $('#base').val();
    var domain_id = $(this).attr('data-href');
    $.ajax({
        url: base_url+'domains/add_domain_indicator_view',
        data:{domain_id:domain_id},
        type: 'post',
        cache: false,
        success: function(response) {
            if (response.result_html!='') {
                $('#indicator_form_container').empty();
                $('#indicator_form_container').append(response.result_html);
                $('#add_domain_group_indicator').modal('show');
            } else {
                toastr["error"]('Seems to an error.');
            }
        }
    });
    return false;
});

$(document.body).on('click', '#list_itmes_add_student', function(){
    get_students($(this).attr('data-func-call'));
});

$(document.body).on('click', '#add_sbj_assessment', function () {
    var base_url = $('#base').val();
    var sbj_detail_id = $(this).attr('data-href');
    $.ajax({
        url: base_url+'subjects/add_subject_assessment_view',
        data:{sbj_detail_id:sbj_detail_id},
        type:'post',
        cache: false,
        success: function (response) {
            $('.edit_assessment_modal').empty();
            $('.edit_assessment_modal').append(response.result_html);
            $('#new_assessment').modal('show');
        }
    });
    return false;
});

$(document.body).on('submit', '#employee_privileg_form', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('data-action'),
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
            $("#err").fadeOut();
        },
        success: function(response)
        {
            if(response.success)
            {
                toastr["success"](response.message);
            }
            else
            {
                toastr["error"](response.message);
            }
        },
        error: function(e)
        {
            toastr["error"]('seem to be an error');
        }
    });

    return false;
});

$(document.body).on('click', '#transfer_batch_btn', function(){
    $.ajax({
        url: $('#transfer_batch_form').attr('data-action'),
        type: 'post',
        data: $('#transfer_batch_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('change', '.grade_scale', function(){
    var grade_scale_status = $('#grade_scale_status').val();
    var grade_scale_type = $('#grade_scale_type').val();
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'grade_scale/grade_scales',
        type: 'post',
        data : { grade_scale_status : grade_scale_status, grade_scale_type:grade_scale_type },
        cache: false,
        success: function(response) {
            if(response.scale_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('#title').html('Grading Scales | ISMS');
            }
        }
    });
});

$(document.body).on('click', '#admin_st_password', function () {
    $.ajax({
        url: $('#change_pwd').attr('data-action'),
        type: 'post',
        data: $('#change_pwd').serialize(),
        cache: false,
        success: function (response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#adminChangePwd').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '.grade_scale_levels', function () {
    $.ajax({
        url: $(this).attr('data-action'),
        type: 'get',
        cache: false,
        success: function (response) {
            if(response.scale_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('#title').html('Grading Scales | ISMS');
            }else{
                toastr['error']('seem to be an error');
            }

        }
    });
    return false;
});

$(document.body).on('click', '#grade_scale_back_btn', function(){
    var func_call = $(this).attr('data-func-call');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'grade_scale/'+func_call,
        cache: false,
        success: function(response) {
            if(response.scale_html != ''){
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.scale_html);
                $('#title').html('Grading Scales | ISMS');
            }
        }
    });
    return false;
});

$(document.body).on('change', '.student_batch_select', function(){
    var base_url = $('#base').val();
    var batch_id = $('.student_batch_select').val();
    if($(this).prop("checked") == true){
        var flag = 'select';
    }else{
        var flag = 'deselect';
    }
    $.ajax({
        url: base_url+'attendance/get_batch_attendance_year',
        type: 'post',
        data: {flag:flag,batch_id:batch_id},
        cache: false,
        success: function(response) {
            if (response.result_html!='') {
                $('#attendance_year').empty();
                $('#attendance_year').append(response.result_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });
});

$(document.body).on('change', '.student_batch_selects', function(){
    var base_url = $('#base').val();
    var batch_id = $('.student_batch_selects').val();
    if($(this).prop("checked") == true){
        var flag = 'select';
    }else{
        var flag = 'deselect';
    }
    $.ajax({
        url: base_url+'attendance/get_batch_attendance_year',
        type: 'post',
        data: {flag:flag,batch_id:batch_id},
        cache: false,
        success: function(response) {
            if (response.result_html!='') {
                $('#attendance_years').empty();
                $('#attendance_years').append(response.result_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });
});

$(document.body).on('click', '.btn-light', function(){
    $.ajax({
        url: $(this).attr('data-action'),
        type: 'post',
        cache: false,
        success: function(response) {
            if (response.success) {
                $('#assign_employee_form')[0].reset();
                $('.assign_employee').empty();
                $('.assign_employee').append(response.subject_html);
                $('#assign_employee_modal').modal('show');
            } else {
                toastr["error"](response.message);
            }
        }
    });
    return false;
});

$(document.body).on('click', '#change_st_password', function () {
    $.ajax({
        url: $('#change_pwd').attr('data-action'),
        type: 'post',
        data: $('#change_pwd').serialize(),
        cache: false,
        success: function (response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#myModal').modal('hide');
            } else {
                toastr["error"](response.message);
            }

        }
    });
    return false;
});

$(document.body).on('click', '#save_origin', function(){
    $.ajax({
        url: $('#origin_form').attr('data-action'),
        type: 'post',
        data: $('#origin_form').serialize(),
        cache: false,
        success: function(response) {
            if (response.success) {
                toastr["success"](response.message);
                $('#origin_form')[0].reset();
                $('#origin_add').modal('hide');
                $('.content-wrapper').remove();
                $('#content-wrapper').append(response.result_html);
            } else {
                toastr["error"](response.message);
            }
        }
    });

    return false;
});

$(document.body).on('click', '.edit-origin', function(){
    var origin_id = $(this).attr('data-value');
    var base_url = $('#base').val();
    $.ajax({
        url: base_url+'general_setting/edit_origin/'+origin_id,
        cache: false,
        success: function(response) {
            $('.edit-modal-body').empty();
            $('.edit-modal-body').append(response.result_html);
            $('#origin_add').modal('show');
        }
    });
    return false;
});

$(document.body).on('click', '.delete-origin', function(){
    if (confirm('Are you sure to delete this record?')) {
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(response) {
                if (response.success) {
                    $('.content-wrapper').remove();
                    $('#content-wrapper').append(response.result_html);
                    toastr["error"](response.message);
                } else {
                    toastr["error"](response.message);
                }
            }
        });
    } else {
        return false;
    }

    return false;
});