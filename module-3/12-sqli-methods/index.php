<?php
require_once dirname(__DIR__, 2) . '/data/connect.php';
$conn = db_connect();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canadian Cities Queries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="container p-3">
    <header class="text-center row justify-content-center my-5">
        <section class="col col-md-10 col-xl-8">
            <h1 class="display-3">Canadian Cities Queries</h1>
            <p class="lead">The answers to all of the following questions are being pulled from the records we currently have stored in our database, one query at a time.</p>
        </section>
    </header>

    <main class="row justify-content-center">
        <section class="col col-md-10 col-lg-8 col-xxl-6">
            <h2 class="display-4">Questions and Answers</h2>

            <!-- Q1 -->
            <h3 class="mt-4">Question 1: Which city has the highest population?</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name, population FROM cities ORDER BY population DESC LIMIT 1");
            if ($row = mysqli_fetch_assoc($result)) {
                echo "<p><strong>{$row['city_name']}</strong> with a population of " . $row['population'] . "</p>";
            }
            ?>

            <!-- Q2 -->
            <h3 class="mt-4">Question 2: What are the names of all of the cities stored in our database, in alphabetical order?</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name FROM cities ORDER BY city_name ASC");
            if (mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['city_name']}</li>";
                }
                echo "</ul>";
            }
            ?>

            <!-- Q3 -->
            <h3 class="mt-4">Question 3: Which cities are located in the province of "QC" (Quebec)?</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name FROM cities WHERE province = 'QC'");
            if (mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['city_name']}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No cities found in QC.</p>";
            }
            ?>

            <!-- Q4 -->
            <h3 class="mt-4">Question 4: Count the number of cities in each province.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT province, COUNT(*) AS city_count FROM cities GROUP BY province ORDER BY province ASC");
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Province</th><th>Number of Cities</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['province']}</td><td>{$row['city_count']}</td></tr>";
                }
                echo "</tbody></table>";
            }
            ?>

            <!-- Q5 -->
            <h3 class="mt-4">Question 5: Retrieve the city names and populations for cities with a population greater than 500,000.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name, population FROM cities WHERE population > 500000 ORDER BY population DESC");
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>City</th><th>Population</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['city_name']}</td><td>" . number_format($row['population']) . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No cities found with a population over 500,000.</p>";
            }
            ?>

            <!-- Q6 -->
            <h3 class="mt-4">Question 6: Sort the cities in alphabetical order by their names.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name FROM cities ORDER BY city_name ASC");
            if (mysqli_num_rows($result) > 0) {
                echo "<ol>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['city_name']}</li>";
                }
                echo "</ol>";
            }
            ?>

            <!-- Q7 -->
            <h3 class="mt-4">Question 7: Calculate the average population of all cities.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT ROUND(AVG(population)) AS avg_population FROM cities");
            if ($row = mysqli_fetch_assoc($result)) {
                echo "<p>The average city population is <strong>" . number_format($row['avg_population']) . "</strong>.</p>";
            }
            ?>

            <!-- Q8 -->
            <h3 class="mt-4">Question 8: Find the city with the smallest population.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name, population FROM cities ORDER BY population ASC LIMIT 1");
            if ($row = mysqli_fetch_assoc($result)) {
                echo "<p><strong>{$row['city_name']}</strong> with a population of " . number_format($row['population']) . "</p>";
            }
            ?>

            <!-- Q9 -->
            <h3 class="mt-4">Question 9: List the cities located in provinces starting with the letter "N".</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name, province FROM cities WHERE province LIKE 'N%' ORDER BY province, city_name");
            if (mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['city_name']} ({$row['province']})</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No cities found in provinces starting with N.</p>";
            }
            ?>

            <!-- Q10 -->
            <h3 class="mt-4">Question 10: Retrieve the city names and populations for cities with populations between 100,000 and 500,000.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT city_name, population FROM cities WHERE population BETWEEN 100000 AND 500000 ORDER BY population DESC");
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>City</th><th>Population</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['city_name']}</td><td>" . number_format($row['population']) . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No cities found in that population range.</p>";
            }
            ?>

            <!-- Q11 -->
            <h3 class="mt-4">Question 11: Retrieve the total population for each province in the "cities" table.</h3>
            <?php
            $result = mysqli_query($conn, "SELECT province, SUM(population) AS total_population FROM cities GROUP BY province ORDER BY total_population DESC");
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Province</th><th>Total Population</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['province']}</td><td>" . number_format($row['total_population']) . "</td></tr>";
                }
                echo "</tbody></table>";
            }
            ?>

        </section>
    </main>
</body>
</html>