<h1>Hello this page is comes from sample php app</h1>

<?php
	// Prepend a base path if Predis is not available in your "include_path".
	require (dirname(__DIR__).'/html/vendor/autoload.php');
	Predis\Autoloader::register();
	
	// Prepare env variables
	
	$redisHost = getenv('REDIS_PORT_6379_TCP_ADDR');
	$redisPort = getenv('REDIS_PORT_6379_TCP_PORT');
	
	// Connect to Redis
	$url = "tcp://". $redisHost . ":". $redisPort;
	$redisClient = new Predis\Client($url);
	
	// init test data
	
	$redisClient->set('foo', 'bar');
	echo "The value of <b>foo</b> session key is:  <b>" . $redisClient->get('foo') . "</b><br />";
	
	if ( isset($_GET['sessionId']) ) {
    $sessionId = $_GET['sessionId'];
    
    $result = $redisClient->get($sessionId);
    
    if ($result) {
    	echo($result);
    }
    else if ($result == null){
    	echo("Nothing found with the session id: " . $sessionId);
    }
    
    
	}

?>
