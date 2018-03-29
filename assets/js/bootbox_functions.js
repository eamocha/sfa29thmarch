function update_users()
{ 	$('#userEditForm').on('submit', function(e) { 
            // Save the form data via an Ajax request
            e.preventDefault();
            var $form = $(e.target),
                id = $form.find('[name="id"]').val();
				
           // The url and method might be different in your application
            $.ajax({
                url: 'read.php?mode=update_user_record',
                 type: 'POST', dataType:'json',
				data: $form.serialize(), 
				success: function(response){
					 // Get the cells
                var $button = $('a[data-id="' + response.user_id + '"]'),
                    $tr     = $button.closest('tr'),
                    $cells  = $tr.find('td');

                // Update the cell data
                $cells
                    .eq(1).html(response.full_name).end()
                    .eq(2).html(response.email).end()
                    .eq(3).html(response.mobile).end()
					.eq(4).html(response.role).end()
					.eq(5).html(response.region).end()
					.eq(6).html(response.bu_id).end()
					//.eq(7).html(response.region).end();

                // Hide the dialog
                $form.parents('.bootbox').modal('hide');
                // You can inform the user that the data is updated successfully
                // by highlighting the row or showing a message box
                bootbox.alert(' '+response.full_name+' profile been updated');
					
					}
            })
        });///end

    $('.editUserButton').on('click', function() {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $.ajax({
            url: 'read.php?mode=fetch_user_for_editing&uid='+id,
            type: 'GET',
			dataType:'json'
        }).success(function(data) {
            // Populate the form fields with the data returned from server
            $("#userEditForm")
		 
			    .find('[name="user_id"]').val(data.user_id).end()
                .find('[name="full_name1"]').val(data.full_name).end()
                .find('[name="email1"]').val(data.email).end()
                .find('[name="tel1"]').val(data.mobile).end()
				.find('[name="desc1"]').val(data.description).end()
				//.find('region1').val(response.region).end()
				
				//.find('[name="role1"]').val(response.role).end()
				//.find('[name="bu_id1"]').val(response.bu_id).end()

            // Show the dialog
            bootbox.dialog({
                    title: 'Edit the user profile',
                    message: $('#userEditForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#userEditForm')
                        .show()                             // Show the form
                    //    .formValidation('resetForm'); // Reset form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the  form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#userEditForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });
	
	///
	}
	/******************************************************areas
	***/
	function update_Area()
{ 	$('#updateAreaForm').on('submit', function(e) { 
            // Save the form data via an Ajax request
            e.preventDefault();
            var $form = $(e.target),
                id = $form.find('[name="id"]').val();
				
           // The url and method might be different in your application
            $.ajax({
                url: 'read.php?mode=update_area_record',
                 type: 'POST', dataType:'json',
				data: $form.serialize(), 
				success: function(response){
					 // Get the cells
                var $button = $('a[data-id="' + response.area_id + '"]'),
                    $tr     = $button.closest('tr'),
                    $cells  = $tr.find('td');

                // Update the cell data
                $cells
                    .eq(1).html(response.name).end()
                  ///  .eq(2).html(response.email).end()
                    //.eq(3).html(response.mobile).end()
					//.eq(4).html(response.role).end()
					////.eq(5).html(response.region).end()
					//.eq(6).html(response.bu_id).end()
					//.eq(7).html(response.region).end();

                // Hide the dialog
                $form.parents('.bootbox').modal('hide');
                // You can inform the user that the data is updated successfully
                // by highlighting the row or showing a message box
                bootbox.alert(' '+response.area_name+' profile been updated');
					
					}
            })
        });///end

    $('.editAreaButton').on('click', function() {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $.ajax({
            url: 'read.php?mode=fetch_area_for_editing&uid='+id,
            type: 'GET',
			dataType:'json'
        }).success(function(data) {
            // Populate the form fields with the data returned from server
            $("#EditareaForm")
	
			    .find('[name="name"]').val(data.area_name).end()
                .find('[name="incharge"]').val(data.incharge).end()
              .find('[name="description"]').val(data.description).end()
            //   .find('name="region"]').val(response.region_id).end()
				
				//.find('[name="role1"]').val(response.role).end()
				//.find('[name="bu_id1"]').val(response.bu_id).end()

            // Show the dialog
            bootbox.dialog({
                    title: 'Update area profile',
                    message: $('#EditareaForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#EditareaForm')
                        .show()                             // Show the form
                    //    .formValidation('resetForm'); // Reset form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the  form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#EditareaForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });
	
	///
	}