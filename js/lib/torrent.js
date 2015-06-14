(function() {
	var tpb = require('thepiratebay');

	var tor = require('child_process').exec('/usr/bin/env tor');

	module.exports.searchTPB = function(search, cb) {
		tpb.search('Game of Thrones').then(function(results) {
			cb(results);
		});
	};
})();
