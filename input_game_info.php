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

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sport_list = array();
            $sport_id_list = array();
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
                array_push($sport_id_list,$sport_id);
            }
        }

        echo "<table>
        <tr>
            <th>sport_id</th>
        </tr>";

            debug($sport_list);

            foreach($sport_id_list as $id){
                echo '<tr>';
                echo "<td>".$sport_list['1']['1']."</td>";
                echo '<tr>';
            }
        echo "</table>";
    ?>
</body>
</html>