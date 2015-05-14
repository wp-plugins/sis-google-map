(function() {
	tinymce.PluginManager.add('sis_google_map_mce_button', function( editor, url ) {
		editor.addButton( 'sis_google_map_mce_button', {

            title : 'Add Google Map',
			image : url + '/icon.png',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Google Map Shortcode',
					body: 
					[
						{
							type: 'textbox',
							name: 'lat',
							label: 'Latitude',
							value: ''
						},
						{
							type: 'textbox',
							name: 'long',
							label: 'Longitude',
							value: ''
						},
						{
							type: 'textbox',
							name: 'width',
							label: 'Width',
							value: '100%'
						},
						{
							type: 'textbox',
							name: 'height',
							label: 'Height',
							value: '350px'
						},
						{
							type: 'textbox',
							name: 'zoom',
							label: 'Zoom Level',
							value: '15'
						},
						{
							type: 'listbox',
							name: 'style',
							label: 'Map Style',
								'values': 
								[
									{text: 'None', value: 'none'},
									{text: 'Grayscale', value: 'greyscale'},
									{text: 'Subtle Grayscale', value: 'subtle_grayscale'},
									{text: 'Bright Bubbly', value: 'bright_bubbly'},
									{text: 'Mixed', value: 'mixed'},
									{text: 'Pale Dawn', value: 'pale_dawn'}
								]
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[sis_google_map lat="' + e.data.lat + '" long="' + e.data.long + '" width="' + e.data.width + '" height="' + e.data.height + '" zoom="' + e.data.zoom + '" style="' + e.data.style + '"]');
						}
					}
				);
			}

		});
	});
})();