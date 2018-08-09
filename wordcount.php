 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assignment part 1
$data = $argv;
$filename =file_get_contents('C:/xampp/htdocs/'.$data[1]);
$words_count = str_word_count($filename,1);
$uniqueData = array_unique($words_count);
$insertData = implode(",",$uniqueData);

$sql1 = "INSERT INTO all_words (words) VALUES ('$insertData')";
$conn->query($sql1);
//echo "Data added Successfully!";

// Assignment part 2
echo "Distinct unique words: ".count($uniqueData)."\n\n";


// Assignment part 3

$watchlist = file_get_contents('C:/xampp/htdocs/watchlist.txt');
$watchlistwords = str_word_count($watchlist,1);
$watchlistData = implode(",",$watchlistwords);

$sql2 = "INSERT INTO watchlist (watchlist_words) VALUES ('$watchlistData')";
$conn->query($sql2);

$sql3 = "SELECT words FROM all_words";
$result1 = $conn->query($sql3);


$sql4 = "SELECT watchlist_words FROM watchlist";
$result2 = $conn->query($sql4);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        $all_words_data = explode(",",$row['words']);
    }
} else {
    echo "0 results";
}

if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $watchlist_words_data = explode(",",$row['watchlist_words']);
    }
} else {
    echo "0 results";
}

$twoDistinctArr_data = array_intersect($all_words_data,$watchlist_words_data);
foreach($twoDistinctArr_data as $val)
{
	echo $val."\n";
}


$conn->close();
?>
