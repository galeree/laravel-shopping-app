(function() {
	$.validator.setDefaults({
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	        $(element).closest('.form-group').addClass('has-success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	});

	$('.category#createForm').validate({
		rules: {
			name: {
				required: true,
				remote: "/dashboard/category/checkname?type=create",
			},
			description: {
				required: true,
				remote: "/dashboard/category/checkdescription?type=create"
			},
			category_id: "required",
			image: "required"
		},
		messages: {
			name: {
				required: "Name is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different name')

			},
			description: {
				required: "Description is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different description')
			},
			category_id: "Parent is required",
			image: "Image is required"
		}
	});

	$('.product#createForm').validate({
		rules: {
			name: {
				required: true,
				remote: "/dashboard/category/checkname?type=create",
			},
			description: {
				required: true,
				remote: "/dashboard/category/checkdescription?type=create"
			},
			category_id: "required",
			image: "required",
			content: "required"
		},
		messages: {
			name: {
				required: "Name is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different name')

			},
			description: {
				required: "Description is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different description')
			},
			category_id: "Parent is required",
			image: "Image is required",
			content: "Content is required"
		}
	});

	$('.product#editForm').validate({
		rules: {
			name: {
				required: true,
				remote: "/dashboard/category/checkname?type=create",
			},
			description: {
				required: true,
				remote: "/dashboard/category/checkdescription?type=create"
			},
			category_id: "required",
			content: "required"
		},
		messages: {
			name: {
				required: "Name is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different name')

			},
			description: {
				required: "Description is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different description')
			},
			category_id: "Parent is required",
			content: "Content is required"
		}
	});


	$('.category#editForm').validate({
		rules: {
			name: {
				required: true,
				remote: "/dashboard/category/checkname?type=edit",
			},
			description: {
				required: true,
				remote: "/dashboard/category/checkdescription?type=edit"
			},
			category_id: "required",
			property: {
				required: $('#propertychoice').val()==1
			}
		},
		messages: {
			name: {
				required: "Name is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different name')

			},
			description: {
				required: "Description is required",
				remote: jQuery.validator.format('{0} is already in use, please choose a different description')
			},
			category_id: "Parent is required",
			property: {
				required: "Property is required"
			}
		}
	});
})();