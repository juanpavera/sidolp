function set_ajax_upload(field_id){
	var action 			= 'upload-file.php';
	var field 			= $('#a-' + field_id);
	var field_data		= $('#' + field_id);
	
	var button = $(field), interval;

	new AjaxUpload(button,{
		action: action,
		name: 'attached',
		onSubmit : function(file, ext){
			this.setData({
				attached : field_data.prop('value')
			});
			// cambiar el texto del boton cuando se selecicione la imagen
			button.text('Subiendo');
			// desabilitar el boton
			this.disable();
			
			interval = window.setInterval(function(){
				var text = button.text();
				if (text.length < 11){
					button.text(text + '.');
				} else {
					button.text('Subiendo');
				}
			}, 200);
		},
		onComplete: function(file, response){
			window.clearInterval(interval);
			response = $.parseJSON(response);
			
			if (response.error === 200) {
				field_data.prop('value', response.file);
                button.text('Archivo Subido con Exito');
				// console.log(field_data);
			} else {
                button.text('Adjuntar documentación nuevamente');
				this.enable();
			}
		}
	});
}