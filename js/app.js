(function() {
	var http = require('http');

	var ffmpeg = require(__dirname + '/lib/transcode.js'),
			roku = require(__dirname + '/lib/roku.js'),
			torrent = require(__dirname + '/lib/torrent.js');

	// Private Roku Implementation Server
	var server = http.createServer(function(req, res) {
		res.writeHead(200, {'Content-Type': 'text/plain'});

		if(req.url === '/favicon.ico') return res.end();

		if(req.url.match(/^\/play\?url=/)) { // Play video on Roku
			var url = req.url.split('=')[1].split('&')[0],
					name = req.url.split('=')[2],
					videoFormat = 'mp4';

			roku.doRequest('/launch/15985?t=v&u=' + url + '&videoName=' + name + '&videoFormat=' + videoFormat);
			res.end();
		} else if(req.url.match(/^\/search?q=/)) { // Search The Pirate Bay
			var q = decodeURIComponent(req.url.split('=')[1]);

			torrent.searchTPB(q, function(json) {
				res.end(json);
			});
		} else if(req.url.match(/^\/download?q=/)) {
			var q = decodeURIComponent(req.url.split('=')[1]);

			console.log(q);
		}
	});

	// Reencoding
	var queue = [],
		processing = false;

	var addToQueue = function() {
		// Add file to queue.
	};

	var processQueue = function() {
		if(!queue.length || processing === false) return;

		processing = true;

		ffmpeg.transcode(nextVideo, '/tmp/' + nextVideo, function() {
			var nextVideo = queue[0];
			queue = queue.slice(1);

			processing = false;
		});
	};

	//setInterval(processQueue, 2000);

	//ffmpeg.transcode('/users/bruce/movies/fate.mkv', '/users/bruce/movies/fate.mp4');


	// ffmpeg -i fate.mkv -qscale 1 -acodec libfaac -vcodec mpeg4 fate-stay.m4v
	// See: https://trac.ffmpeg.org/wiki/HowToBurnSubtitlesIntoVideo
	//      https://trac.ffmpeg.org/wiki/Creating%20multiple%20outputs
	//      http://andrebluehs.net/blog/converting-avi-to-mp4-with-ffmpeg/

	// Reset
	  server.listen(1337);

})();
