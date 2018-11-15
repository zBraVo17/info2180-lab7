{"filter":false,"title":"world.php","tooltip":"/world.php","undoManager":{"mark":72,"position":72,"stack":[[{"start":{"row":0,"column":0},"end":{"row":17,"column":13},"action":"remove","lines":["<?php","","$host = getenv('IP');","$username = getenv('C9_USER');","$password = '';","$dbname = 'world';","","$conn = new PDO(\"mysql:host=$host;dbname=$dbname\", $username, $password);","","$stmt = $conn->query(\"SELECT * FROM countries\");","","$results = $stmt->fetchAll(PDO::FETCH_ASSOC);","","echo '<ul>';","foreach ($results as $row) {","  echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';","}","echo '</ul>';"],"id":2},{"start":{"row":0,"column":0},"end":{"row":22,"column":13},"action":"insert","lines":["<?php","$host = getenv('IP');","$username = getenv('C9_USER');","$password = '';","$dbname = 'world';","$conn = new PDO(\"mysql:host=$host;dbname=$dbname\", $username, $password);","$country = $_GET['country'];","$all = $_GET['all'];","if($all == 'true'){","    if(!empty($country)){","        $stmt = $conn->query(\"SELECT * FROM countries WHERE name NOT LIKE'%$country%'\");","    }else{","         $stmt = $conn->query(\"SELECT * FROM countries \");","    }","}else{","    $stmt = $conn->query(\"SELECT * FROM countries WHERE name LIKE '%$country%'\");","}","$results = $stmt->fetchAll(PDO::FETCH_ASSOC);","echo '<ul>';","foreach ($results as $row) {","  echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';","}","echo '</ul>';"]}],[{"start":{"row":0,"column":0},"end":{"row":22,"column":13},"action":"remove","lines":["<?php","$host = getenv('IP');","$username = getenv('C9_USER');","$password = '';","$dbname = 'world';","$conn = new PDO(\"mysql:host=$host;dbname=$dbname\", $username, $password);","$country = $_GET['country'];","$all = $_GET['all'];","if($all == 'true'){","    if(!empty($country)){","        $stmt = $conn->query(\"SELECT * FROM countries WHERE name NOT LIKE'%$country%'\");","    }else{","         $stmt = $conn->query(\"SELECT * FROM countries \");","    }","}else{","    $stmt = $conn->query(\"SELECT * FROM countries WHERE name LIKE '%$country%'\");","}","$results = $stmt->fetchAll(PDO::FETCH_ASSOC);","echo '<ul>';","foreach ($results as $row) {","  echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';","}","echo '</ul>';"],"id":3},{"start":{"row":0,"column":0},"end":{"row":71,"column":0},"action":"insert","lines":["<?php","ini_set('error_reporting', true);","error_reporting(-1);","","// load db details","require './db.php';","","try {","    // check if GET request contains country query string","    $country = isset($_GET['country']) ? $_GET['country'] : null;","    $all     = isset($_GET['all']) && $_GET['all'] == 'true';","","    // fix ?? characters with charset utf8mb4 for proper encoding","    $conn = new PDO(\"mysql:host=\" . DB_HOST . \";dbname=\" . DB_DATABASE . \";charset=utf8mb4\",","                    DB_USER, DB_PASSWORD);","","    // use exceptions instead of normal errors","    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);","","    // validate","    if ( $all == false && is_null($country) )","        throw new Exception('A valid country is required');","    if ( $all == false && $country == '' )","        throw new Exception('Country cannot be empty');","","    if ( $all ) {","        $stm = $conn->query(\"SELECT c.*, l.* FROM countries c","            LEFT JOIN languages l","            ON c.code = l.country_code","            GROUP BY c.name\");","            ","    }","    else {","        $stm = $conn->prepare(\"SELECT c.*, l.* FROM countries c","            LEFT JOIN languages l","            ON c.code = l.country_code","            WHERE c.name LIKE :country","            GROUP BY c.name\");","        $stm->execute(['country' => \"%$country%\"]);","    }","","    if ( $stm->rowCount() === 0 )","        throw new Exception('No results were found for ' . $country);","","    $results = $stm->fetchAll(PDO::FETCH_ASSOC);","","    echo '<ul>';","","    foreach ($results as $row) {","        echo '<li>';","","        $lang       = is_null($row['language']) ? 'N/A' : $row['language'];","        $population = $row['population'] == 0 ? 'N/A' : number_format($row['population']);","","        echo '<div><strong>' . $row['name'] . '</strong></div>';","        echo '<div>Head of State: ' .$row['head_of_state'] .'</div>';","        echo '<div>Continent: ' . $row['continent'] . '</div>';","        echo '<div>Language: ' . $lang . '</div>';","        echo '<div>Population: ' . $population . '</div>';","","        echo '</li>';","    }","","    echo '</ul>';","}","catch (PDOException $e) {","    echo '<div class=\"error\">Database Error: ' . $e->getMessage() . '</div>';","}","catch (Exception $e) {","    echo '<div class=\"error\">' . $e->getMessage() . '</div>';","}",""]}],[{"start":{"row":0,"column":5},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":4}],[{"start":{"row":1,"column":0},"end":{"row":4,"column":31},"action":"insert","lines":["define('DB_HOST', getenv('IP'));","define('DB_USER', getenv('C9_USER'));","define('DB_PASSWORD', '');","define('DB_DATABASE', 'world');"],"id":5}],[{"start":{"row":4,"column":31},"end":{"row":5,"column":0},"action":"insert","lines":["",""],"id":6}],[{"start":{"row":10,"column":0},"end":{"row":10,"column":1},"action":"insert","lines":["/"],"id":7},{"start":{"row":10,"column":1},"end":{"row":10,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":10,"column":2},"end":{"row":10,"column":3},"action":"insert","lines":[" "],"id":8}],[{"start":{"row":9,"column":0},"end":{"row":10,"column":22},"action":"remove","lines":["// load db details","// require './db.php';"],"id":9},{"start":{"row":8,"column":0},"end":{"row":9,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":67,"column":0},"end":{"row":67,"column":1},"action":"insert","lines":["/"],"id":10},{"start":{"row":67,"column":1},"end":{"row":67,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":68,"column":0},"end":{"row":68,"column":1},"action":"insert","lines":["/"],"id":11},{"start":{"row":68,"column":1},"end":{"row":68,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":69,"column":2},"end":{"row":69,"column":3},"action":"insert","lines":["/"],"id":12},{"start":{"row":69,"column":3},"end":{"row":69,"column":4},"action":"insert","lines":["/"]}],[{"start":{"row":70,"column":0},"end":{"row":70,"column":1},"action":"insert","lines":["/"],"id":13},{"start":{"row":70,"column":1},"end":{"row":70,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":71,"column":0},"end":{"row":71,"column":1},"action":"insert","lines":["/"],"id":14},{"start":{"row":71,"column":1},"end":{"row":71,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":72,"column":1},"end":{"row":72,"column":2},"action":"insert","lines":["/"],"id":15},{"start":{"row":72,"column":2},"end":{"row":72,"column":3},"action":"insert","lines":["/"]}],[{"start":{"row":73,"column":0},"end":{"row":73,"column":1},"action":"insert","lines":["/"],"id":16},{"start":{"row":73,"column":1},"end":{"row":73,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":6,"column":0},"end":{"row":6,"column":1},"action":"insert","lines":["/"],"id":17},{"start":{"row":6,"column":1},"end":{"row":6,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":7,"column":0},"end":{"row":7,"column":1},"action":"insert","lines":["/"],"id":18},{"start":{"row":7,"column":1},"end":{"row":7,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":7,"column":2},"end":{"row":7,"column":3},"action":"insert","lines":[" "],"id":19}],[{"start":{"row":6,"column":2},"end":{"row":6,"column":3},"action":"insert","lines":[" "],"id":20}],[{"start":{"row":74,"column":0},"end":{"row":74,"column":1},"action":"insert","lines":["}"],"id":21}],[{"start":{"row":73,"column":3},"end":{"row":74,"column":0},"action":"remove","lines":["",""],"id":22}],[{"start":{"row":73,"column":3},"end":{"row":74,"column":0},"action":"insert","lines":["",""],"id":23}],[{"start":{"row":74,"column":0},"end":{"row":74,"column":1},"action":"remove","lines":["}"],"id":24},{"start":{"row":73,"column":3},"end":{"row":74,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":73,"column":1},"end":{"row":73,"column":2},"action":"remove","lines":["/"],"id":25},{"start":{"row":73,"column":0},"end":{"row":73,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":72,"column":2},"end":{"row":72,"column":3},"action":"remove","lines":["/"],"id":26},{"start":{"row":72,"column":1},"end":{"row":72,"column":2},"action":"remove","lines":["/"]},{"start":{"row":72,"column":0},"end":{"row":72,"column":1},"action":"remove","lines":[" "]}],[{"start":{"row":71,"column":1},"end":{"row":71,"column":2},"action":"remove","lines":["/"],"id":27},{"start":{"row":71,"column":0},"end":{"row":71,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":70,"column":1},"end":{"row":70,"column":2},"action":"remove","lines":["/"],"id":28},{"start":{"row":70,"column":0},"end":{"row":70,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":69,"column":4},"end":{"row":69,"column":5},"action":"insert","lines":["\\"],"id":29}],[{"start":{"row":69,"column":4},"end":{"row":69,"column":5},"action":"remove","lines":["\\"],"id":30},{"start":{"row":69,"column":3},"end":{"row":69,"column":4},"action":"remove","lines":["/"]},{"start":{"row":69,"column":2},"end":{"row":69,"column":3},"action":"remove","lines":["/"]}],[{"start":{"row":68,"column":1},"end":{"row":68,"column":2},"action":"remove","lines":["/"],"id":31},{"start":{"row":68,"column":0},"end":{"row":68,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":67,"column":1},"end":{"row":67,"column":2},"action":"remove","lines":["/"],"id":32},{"start":{"row":67,"column":0},"end":{"row":67,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":6,"column":0},"end":{"row":7,"column":23},"action":"remove","lines":["// ini_set('error_reporting', true);","// error_reporting(-1);"],"id":33},{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["",""],"id":34},{"start":{"row":4,"column":31},"end":{"row":5,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":16,"column":4},"end":{"row":16,"column":5},"action":"insert","lines":["/"],"id":35},{"start":{"row":16,"column":5},"end":{"row":16,"column":6},"action":"insert","lines":["/"]}],[{"start":{"row":64,"column":0},"end":{"row":64,"column":1},"action":"insert","lines":["/"],"id":36},{"start":{"row":64,"column":1},"end":{"row":64,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":65,"column":2},"end":{"row":65,"column":3},"action":"insert","lines":["/"],"id":37},{"start":{"row":65,"column":3},"end":{"row":65,"column":4},"action":"insert","lines":["/"]}],[{"start":{"row":66,"column":0},"end":{"row":66,"column":1},"action":"insert","lines":["/"],"id":38},{"start":{"row":66,"column":1},"end":{"row":66,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":67,"column":0},"end":{"row":67,"column":1},"action":"insert","lines":["/"],"id":39},{"start":{"row":67,"column":1},"end":{"row":67,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":68,"column":1},"end":{"row":68,"column":2},"action":"insert","lines":["/"],"id":40},{"start":{"row":68,"column":2},"end":{"row":68,"column":3},"action":"insert","lines":["/"]}],[{"start":{"row":69,"column":0},"end":{"row":69,"column":1},"action":"insert","lines":["/"],"id":41},{"start":{"row":69,"column":1},"end":{"row":69,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":69,"column":1},"end":{"row":69,"column":2},"action":"remove","lines":["/"],"id":42},{"start":{"row":69,"column":0},"end":{"row":69,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":68,"column":2},"end":{"row":68,"column":3},"action":"remove","lines":["/"],"id":43},{"start":{"row":68,"column":1},"end":{"row":68,"column":2},"action":"remove","lines":["/"]},{"start":{"row":68,"column":0},"end":{"row":68,"column":1},"action":"remove","lines":[" "]}],[{"start":{"row":68,"column":2},"end":{"row":68,"column":4},"action":"insert","lines":["  "],"id":44}],[{"start":{"row":67,"column":1},"end":{"row":67,"column":2},"action":"remove","lines":["/"],"id":45},{"start":{"row":67,"column":0},"end":{"row":67,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":66,"column":1},"end":{"row":66,"column":2},"action":"remove","lines":["/"],"id":46}],[{"start":{"row":66,"column":1},"end":{"row":66,"column":2},"action":"insert","lines":["\\"],"id":47}],[{"start":{"row":66,"column":1},"end":{"row":66,"column":2},"action":"remove","lines":["\\"],"id":48},{"start":{"row":66,"column":0},"end":{"row":66,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":65,"column":3},"end":{"row":65,"column":4},"action":"remove","lines":["/"],"id":49},{"start":{"row":65,"column":2},"end":{"row":65,"column":3},"action":"remove","lines":["/"]}],[{"start":{"row":64,"column":1},"end":{"row":64,"column":2},"action":"remove","lines":["/"],"id":50},{"start":{"row":64,"column":0},"end":{"row":64,"column":1},"action":"remove","lines":["/"]}],[{"start":{"row":47,"column":32},"end":{"row":48,"column":0},"action":"insert","lines":["",""],"id":51},{"start":{"row":48,"column":0},"end":{"row":48,"column":8},"action":"insert","lines":["        "]},{"start":{"row":48,"column":8},"end":{"row":48,"column":9},"action":"insert","lines":["e"]}],[{"start":{"row":48,"column":8},"end":{"row":48,"column":9},"action":"remove","lines":["e"],"id":52},{"start":{"row":48,"column":8},"end":{"row":48,"column":12},"action":"insert","lines":["echo"]}],[{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"insert","lines":["'"],"id":53},{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"insert","lines":["'"]}],[{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"insert","lines":["["],"id":54},{"start":{"row":48,"column":14},"end":{"row":48,"column":15},"action":"insert","lines":["]"]}],[{"start":{"row":48,"column":16},"end":{"row":48,"column":17},"action":"insert","lines":[";"],"id":55}],[{"start":{"row":48,"column":14},"end":{"row":48,"column":15},"action":"remove","lines":["]"],"id":56},{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"remove","lines":["["]}],[{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"insert","lines":["R"],"id":57},{"start":{"row":48,"column":14},"end":{"row":48,"column":15},"action":"insert","lines":["e"]},{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"insert","lines":["s"]}],[{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"remove","lines":["s"],"id":58}],[{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"insert","lines":["s"],"id":59},{"start":{"row":48,"column":16},"end":{"row":48,"column":17},"action":"insert","lines":["u"]},{"start":{"row":48,"column":17},"end":{"row":48,"column":18},"action":"insert","lines":["l"]},{"start":{"row":48,"column":18},"end":{"row":48,"column":19},"action":"insert","lines":["t"]}],[{"start":{"row":48,"column":19},"end":{"row":48,"column":20},"action":"insert","lines":["s"],"id":60}],[{"start":{"row":48,"column":21},"end":{"row":48,"column":22},"action":"remove","lines":[";"],"id":61},{"start":{"row":48,"column":20},"end":{"row":48,"column":21},"action":"remove","lines":["'"]},{"start":{"row":48,"column":19},"end":{"row":48,"column":20},"action":"remove","lines":["s"]},{"start":{"row":48,"column":18},"end":{"row":48,"column":19},"action":"remove","lines":["t"]},{"start":{"row":48,"column":17},"end":{"row":48,"column":18},"action":"remove","lines":["l"]},{"start":{"row":48,"column":16},"end":{"row":48,"column":17},"action":"remove","lines":["u"]},{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"remove","lines":["s"]},{"start":{"row":48,"column":14},"end":{"row":48,"column":15},"action":"remove","lines":["e"]},{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"remove","lines":["R"]},{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"remove","lines":["'"]}],[{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"insert","lines":[";"],"id":62}],[{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"remove","lines":[";"],"id":63}],[{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"insert","lines":["'"],"id":64},{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"insert","lines":["'"]}],[{"start":{"row":48,"column":13},"end":{"row":48,"column":14},"action":"remove","lines":["'"],"id":65},{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"remove","lines":["'"]}],[{"start":{"row":48,"column":12},"end":{"row":48,"column":13},"action":"insert","lines":[" "],"id":66}],[{"start":{"row":48,"column":13},"end":{"row":48,"column":15},"action":"insert","lines":["\"\""],"id":67}],[{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"insert","lines":[";"],"id":68}],[{"start":{"row":48,"column":14},"end":{"row":48,"column":15},"action":"insert","lines":["<"],"id":69},{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"insert","lines":[">"]},{"start":{"row":48,"column":16},"end":{"row":48,"column":17},"action":"insert","lines":["<"]},{"start":{"row":48,"column":17},"end":{"row":48,"column":18},"action":"insert","lines":[">"]}],[{"start":{"row":48,"column":15},"end":{"row":48,"column":16},"action":"insert","lines":["h"],"id":70},{"start":{"row":48,"column":16},"end":{"row":48,"column":17},"action":"insert","lines":["2"]}],[{"start":{"row":48,"column":19},"end":{"row":48,"column":20},"action":"insert","lines":["/"],"id":71},{"start":{"row":48,"column":20},"end":{"row":48,"column":21},"action":"insert","lines":["h"]},{"start":{"row":48,"column":21},"end":{"row":48,"column":22},"action":"insert","lines":["2"]}],[{"start":{"row":48,"column":18},"end":{"row":48,"column":19},"action":"insert","lines":["R"],"id":72},{"start":{"row":48,"column":19},"end":{"row":48,"column":20},"action":"insert","lines":["e"]},{"start":{"row":48,"column":20},"end":{"row":48,"column":21},"action":"insert","lines":["s"]},{"start":{"row":48,"column":21},"end":{"row":48,"column":22},"action":"insert","lines":["u"]},{"start":{"row":48,"column":22},"end":{"row":48,"column":23},"action":"insert","lines":["t"]},{"start":{"row":48,"column":23},"end":{"row":48,"column":24},"action":"insert","lines":["s"]}],[{"start":{"row":48,"column":22},"end":{"row":48,"column":23},"action":"insert","lines":["l"],"id":73}],[{"start":{"row":48,"column":32},"end":{"row":49,"column":0},"action":"insert","lines":["",""],"id":74},{"start":{"row":49,"column":0},"end":{"row":49,"column":8},"action":"insert","lines":["        "]}]]},"ace":{"folds":[],"scrolltop":712,"scrollleft":0,"selection":{"start":{"row":49,"column":8},"end":{"row":49,"column":8},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":8,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1542252801492,"hash":"bdcade1a82e0f129a774118c9cc9529d44ae960c"}