/** this is the js file for all of the custom interaction with the admin panel */
$(document).ready(function(){
	/** shows the "exact location" option if the user selects 'home based business' */
	$('#homebusiness').change(function(){ if ($(this).val() == '1'){ $('#showonmap-container').fadeIn('fast'); } });
	$('#chamber_member').change(function(){ if ($(this).val() == '1'){ $('#chamber_member_notice').fadeIn('fast'); } });
	/** create jquery filterable select dropdowns */
	var wizard = $("#wizard").wizardPro({useValidation: true});

	/**
	 * this is the step process for the 
	 * user side of the add point form.
	 * This uses wizardPro to move through the 
	 * steps and handle the data. On the third
	 * step it submits the point to the db.
	 */
	$('#addpoint-form-next').click(function(){
		if ($('#addpoint-form-next').attr('data-step') >= 2){
			$('#addpoint-form').find('.placeholder').each(function() {
				if ($(this).val() == $(this).attr('placeholder') ) {
					$(this).val('');
				}
			});
			/** if the value is equal to the placeholder value, zero it out! **/
			$('#addpoint-form').ajaxSubmit({
				dataType: 'json',
				type: 'POST',
				url: '/profile/map/processaddpoint',
				beforeSerialize: function(){

					if ($("#tab2").length > 0){
						tinyMCE.get("tab1").save();
					}
				},
				success: function(data){
					setTimeout(function(){
						$('#step-3 > .column_one').html(data.checkoutMessage);
						$('#addpoint-form-reset').css('display', 'none');
						$('#addpoint-form-next').css('display', 'none');	
					}, 500);
					wizard.openstep('next');
					if (data.level > 1){
						setTimeout(function(){
							window.location.replace(data.paymentLink);
						}, 300);
					}
				}
			});

			return false;
		}else{
			$('#addpoint-form-next').attr('data-step', '2');
			setTimeout( function(){
				$('#addpoint-form-next').attr('value', 'Checkout');
			}, 500);
			wizard.openstep('next');
			
			//set the step to 2
			return false;		
		}
	});


    /**
     * generic ajaxForm
     * 
     * this is generic, checks to see if tinymce exists. 
     * If it does then it processes tinymce prior.
     * 
     */
	$('.form-submit').ajaxForm({
		dataType: 'json',
		type: 'POST',
		beforeSerialize: function(){
			if ($("#tab2").length > 0){
				tinyMCE.get("tab1").save();
			}
		},
		success: function(xhr, d, r, form){
			showResponseForm(xhr);
			if(form.data('reload') != "FALSE" ){
				setTimeout(function(){
					location.reload(true);
				}, 1100);
			}
		}
	});

    /**
     * Ticket ajaxForm
     * 
     * This sends a ticket request in 
     * and shows a message if the submission
     * was successfull. This is only used on
     * the admin backend and profile backend.
     * 
     */
	$('.ticket-submit').ajaxForm({
		dataType: 'json',
		type: 'POST',
		success: function(data){
			$('.ticket-submit').hide();
			var message = '<div class="block-content"><p style="text-align:center;">Your Ticket has been submitted</p></div>';
			$('#submit-a-ticket').append(message);
		}
	});

	/**
	 * sendEmail AjaxForm Submit
	 * 
	 * this form is specific for sending emails from 
	 * the admin panel via /admin/email/*
	 * 
	 */
	
	$('.form-email').submit(function(){
		var categories = $('.serializeElement').serialize();
		var options = {
			dataType: 'json',
			type: 'POST',
			data: {"categoriesList": categories},
			success: showResponseForm
		}
		$(this).ajaxSubmit(options);
		return false
	});

	/**
	 * ajaxForm Submit for status changes
	 * 
	 * this is a ajaxsubmit for status changes of
	 * users, and points.
	 */
	$('.form-status').ajaxForm({
	    dataType: 'json',
	    type: 'POST', 
	    success: function(data, status, xhr, form){
	        if($('#deactivate-point',form).hasClass('status-link-deactivate')){
	            $('#deactivate-point',form).removeClass("status-link-deactivate").addClass("status-link-activate");
	            form.children('.row-status').val(0);
	        }else{
	            $('#deactivate-point',form).removeClass("status-link-activate").addClass("status-link-deactivate");
	            form.children('.row-status').val(1);
	        }

	        /** execute the jGrowl response with the returned message */
	        showResponseForm(data);
	    }
	});

	/**
	 * This is a generic ajax process
	 * for deleting items from a data-table.
	 * It shows a jGrowl notice, and then
	 * deletes the row from the datatable.
	 */
	$('.dataTable-delete').ajaxForm({
		dataType: 'json',
		type: 'POST',
		success: function(data, status, xhr, form){
			showResponseForm(data);
			setTimeout(function(){
				var pos = form.closest("tr").get(0);
				var aPos = oTable.fnGetPosition( pos );
				oTable.fnDeleteRow( aPos );
			}, 400);
		}
	});

	$('.admin-info-button').toggle(function(){
		$(this).next('.admin-info-content').animate({width:200});
		$(this).css('border-top-width', '0');
	}, function(){
		$(this).next('.admin-info-content').animate({width:0});
		$(this).css('border-top-width', '1px');
	})
});