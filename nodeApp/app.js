var express = require('express');
var app = express();
var bodyParser = require("body-parser");
var redis = require('redis');

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

var redisHost = process.env.REDIS_PORT_6379_TCP_ADDR
var redisPort = process.env.REDIS_PORT_6379_TCP_PORT

var redisClient = redis.createClient(redisPort, redisHost, {no_ready_check: true});

/*client.auth('password', function (err) {
    if (err) console.error(err);
});
*/

redisClient.on('connect', function() {
    console.log('Connected to Redis');
});

redisClient.on("error", function (err) {
    console.log("Error " + err);
});

app.get('/', function(req, res) { 
	var sessionId = req.query.sessionId //req.cookies.SESSION;
	console.log(sessionId);
	
	redisClient.get("spring:session:sessions:" + sessionId, function(err, reply) {
    // reply is null when the key is missing
    console.log(reply);
	});
	
	res.send("checking the session: " + sessionId);
});

app.listen(3000);
console.log('App is listening at 3000');
