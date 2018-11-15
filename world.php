<?php
define('DB_HOST', getenv('IP'));
define('DB_USER', getenv('C9_USER'));
define('DB_PASSWORD', '');
define('DB_DATABASE', 'world');

try {
    // check if GET request contains country query string
    $country = isset($_GET['country']) ? $_GET['country'] : null;
    $all     = isset($_GET['all']) && $_GET['all'] == 'true';

    // fix ?? characters with charset utf8mb4 for proper encoding
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=utf8mb4",
                    DB_USER, DB_PASSWORD);

    // use exceptions instead of normal errors
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // validate
    if ( $all == false && is_null($country) )
        throw new Exception('A valid country is required');
    if ( $all == false && $country == '' )
        throw new Exception('Country cannot be empty');

    if ( $all ) {
        $stm = $conn->query("SELECT c.*, l.* FROM countries c
            LEFT JOIN languages l
            ON c.code = l.country_code
            GROUP BY c.name");
            
    }
    else {
        $stm = $conn->prepare("SELECT c.*, l.* FROM countries c
            LEFT JOIN languages l
            ON c.code = l.country_code
            WHERE c.name LIKE :country
            GROUP BY c.name");
        $stm->execute(['country' => "%$country%"]);
    }

    if ( $stm->rowCount() === 0 )
        throw new Exception('No results were found for ' . $country);

    $results = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo '<ul>';

    foreach ($results as $row) {
        echo "<h2>Results</h2>";
        
        echo '<li>';

        $lang       = is_null($row['language']) ? 'N/A' : $row['language'];
        $population = $row['population'] == 0 ? 'N/A' : number_format($row['population']);

        echo '<div><strong>' . $row['name'] . '</strong></div>';
        echo '<div>Head of State: ' .$row['head_of_state'] .'</div>';
        echo '<div>Continent: ' . $row['continent'] . '</div>';
        echo '<div>Language: ' . $lang . '</div>';
        echo '<div>Population: ' . $population . '</div>';

        echo '</li>';
    }

    echo '</ul>';
}
catch (PDOException $e) {
    echo '<div class="error">Database Error: ' . $e->getMessage() . '</div>';
}
catch (Exception $e) {
    echo '<div class="error">' . $e->getMessage() . '</div>';
}