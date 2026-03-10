<?php
require_once dirname(__DIR__, 2) . '/data/connect.php';
$conn = db_connect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h2>Search our Cities</h2>
    <div>
        <form action="<? htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="mb-3">
                <label for="search" class="form-label">Search</label>
                <input type="search" name="search" id="search">
            </div>
            <input type="submit" name="submit" value="Search" class="btn btn-warning">
        </form>
    </div>

    <?php 
    if(isset($_GET['submit'])){
        $search = isset($_GET['search'])? trim($_GET['search']) : "";
        if(strlen(($search)<2)){
            echo "<p>Please enter atleast two characters.</p>";
        }else {
            // $pattern = "%?%";
            $pattern = "CONCAT('%', ?, '%')";
            $sql = "SELECT * from cities WHERE
            city_name LIKE $pattern or province LIKE $pattern or trivia LIKE $pattern";

            // echo $sql;

            if($statement = $conn->prepare($sql)) {
                $statement->bind_param("sss", $search, $search, $search);
                $statement->execute();
                $result = $statement->get_result();

                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        $city_name = $row['city_name'];
                        $province = $row['province'];
                        $trivia = $row['trivia'];

                        echo "<p>$city_name, $province - $trivia</p>";
                    }
                }else {
                    echo "<p>Sorry no results found for $search</p>";
                }
            }
        }
    } ?>
</body>

</html>