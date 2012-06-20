/**
 * wrapper function to show the
 * jGrowl notices on the top right.
 * This is used in admin/profile and front-end.
 */
function showResponseForm(data){
	log(data);
    $.jGrowl(data.message, { theme: data.type });
}