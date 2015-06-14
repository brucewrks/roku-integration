(function() {
	var ffmpeg = require('ffmpeg'),
		fs = require('fs');

	var processing = [];

	module.exports.transcode = function(filePath, newPath, cb) {
		var process = new ffmpeg(filePath);

		process.then(function(video) {
			video.setVideoCodec('h264');
			video.setAudioCodec('mp3');
			video.addCommand('-f', 'mp4');

			var time = new Date().getTime();
			var tempPath = '/tmp/' + time + '.mp4';

			processing.push(newPath);
			console.log('Currently procesing ' + newPath);

			video.save(tempPath, function(error, file) {
				if(error) console.log('There was an error: ' + error);
				else fs.renameSync(tempPath, newPath);

				processing.splice(processing.indexOf(newPath), 1);

				console.log('Finished processing ' + newPath);

				var timeNow = new Date().getTime();
				console.log('Took: ' + (timeNow - time / 1000) + ' seconds');
			});
		});
	};

	module.exports.getProcessing = function() {
		return processing;
	};
})();
