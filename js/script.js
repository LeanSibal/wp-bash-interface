jQuery(document).ready(function($){
	$('#terminal').keyup(function( e ) {
		if( e.keyCode == 13 ) {
			var curValue = $('#terminal').val();
			var perLine = curValue.split('\n');
			var command = perLine[ perLine.length - 2 ].substr( 2, perLine[ perLine.length - 2 ].length );;
			$.post( ajax_url, {
				action: 'terminal_command',
				command: command
			}, function( response ) {
				$('#terminal').val( curValue + response + '> ' );
			});
		}
	});
});
