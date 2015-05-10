function show_new_content()
{
	if($('.new_content_form').css('display')=='block')
		$('.new_content_form').css('display', 'none');
	else
		$('.new_content_form').css('display', 'block');		
}

function show_new_invoice()
{
	if($('.new_invoice_form').css('display')=='block')
		$('.new_invoice_form').css('display', 'none');
	else
		$('.new_invoice_form').css('display', 'block');		
}


CKEDITOR.replace( 'data', {
	toolbar: [
		[ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ],																	
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]
} );


