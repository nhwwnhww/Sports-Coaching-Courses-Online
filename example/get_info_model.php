<!-- php debug -->
<?php 
    function debug($data) {
        if($data == "-"){
            echo "<script>console.log('---------------' );</script>";
        }
        else{
            echo "<script>console.log('Debug log: " . json_encode($data) . "' );</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $conn = new mysqli("localhost","root","","fia3_website");

        // get sport info model

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sport_list = array();
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                $temp_array = array($sport_id=>array(
                    'sport_name'=>$sport_name,
                    'img_url'=>$img_url,
                    'sport_describe'=>$sport_describe,
                    'sport_max_level'=>$sport_max_level,
                    'sport_book_time'=>$sport_book_time,
                    'sport_max_participate'=>$sport_max_participate));
                array_push($sport_list, $temp_array);
            }
        }

        echo "<table>
        <tr>
            <th>sport_name</th>
            <th>sprot_url</th>
            <th>sport_describe</th>
            <th>sport_max_level</th>
            <th>sport_max_participate</th>
        </tr>";
        
        // debug(sizeof($sport_list));

        for ($i = 0; $i < sizeof($sport_list); $i++){
            $sport_name = $sport_list[$i][$i+1]['sport_name'];
            $sprot_url = $sport_list[$i][$i+1]['img_url'];
            $sport_describe = $sport_list[$i][$i+1]['sport_describe'];
            $sport_max_level = $sport_list[$i][$i+1]['sport_max_level'];
            $sport_max_participate = $sport_list[$i][$i+1]['sport_max_participate'];
            
            echo "<tr>";

            echo "<td>$sport_name</td>";

            echo "<td><img src='$sprot_url'></td>";

            echo "<td>$sport_describe</td>";

            echo "<td>$sport_max_level</td>";

            echo "<td>$sport_max_participate</td>";

            echo "</tr>";
        }
        ;

        echo "</table>";
    ?>
</body>
</html>