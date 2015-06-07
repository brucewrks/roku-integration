(function($) {
	$(document).ready(function() {
		$('a').click(function(e) {
			if(!$(this).data('play')) return;
			e.preventDefault();

			$.get($(this).attr('href'));
			alert('Attempting to play on Roku...');
		});
	});
})(jQuery);
