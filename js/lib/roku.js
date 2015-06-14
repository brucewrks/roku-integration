(function() {
	var http = require('http'),
		rokuHost = '192.168.1.122';

	module.exports.doRequest = function(uri) {
		var opts = {
			hostname: rokuHost,
			port: 8060,
			path: uri,
			method: 'POST',
			headers: {}
		};

		var req = http.request(opts);
		req.on('error', function() {});
		req.end();
	};
})();
