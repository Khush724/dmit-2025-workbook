<h3 class="h6">Our Most Popular Dog</h3>
<?php
$sql = "SELECT breed, pooch_id, image_file FROM dogs ORDER BY popularity DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) :
    $row = mysqli_fetch_assoc($result);
    extract($row); ?>
    <div class="card p-3">
        <a href="breed.php?pooch=<?= $pooch_id ?>">
            <img class="img-fluid" src="images/thumbs100/<?= $image_file; ?>" alt="image of <?= $breed; ?>">
            <p><?= $breed; ?></p>
        </a>
    </div>
<?php endif ?>

<h3 class="h6">Random Dogs</h3>
<?php
$random_sql = "SELECT breed, pooch_id FROM dogs ORDER BY RAND() LIMIT 2";
$random_result = mysqli_query($conn, $random_sql);

if (mysqli_num_rows($random_result) > 0) :
    while ($row = mysqli_fetch_assoc($random_result)) : ?>
        <?php extract($row);  ?>

        <p><?= $breed ?> <a href="breed.php?pooch=<?= $pooch_id; ?>">More info...</a></p>

    <?php endwhile;  ?>
<?php endif; ?>

<h3 class="h6">Random dog from Large Dogs</h3>

<?php

$random_sql = "SELECT breed, pooch_id FROM dogs WHERE size = 'large' ORDER BY RAND() LIMIT 1";
$random_result = mysqli_query($conn, $random_sql);

if (mysqli_num_rows($random_result) > 0) :
    while ($row = mysqli_fetch_assoc($random_result)) : ?>
        <?php extract($row);  ?>

        <p><?= $breed ?> <a href="breed.php?pooch=<?= $pooch_id; ?>">More info...</a></p>

    <?php endwhile;  ?>
<?php endif; ?>


<h3 class="h6">Alphabetical Listing</h3>
<?php

$random_sql = "SELECT breed, pooch_id, LEFT(breed, 1) AS first_char
                FROM dogs
                WHERE UPPER(breed)
                BETWEEN 'A' AND 'Z'
                ORDER BY breed";
$random_result = mysqli_query($conn, $random_sql);
$current_char = '';

if (mysqli_num_rows($random_result) > 0) :
    while ($row = mysqli_fetch_assoc($random_result)) : ?>
        <?php extract($row);  ?>
        <?php if ($first_char != $current_char) {
            $current_char = $first_char;
            echo "<p><b>$current_char</b></p>";
        } ?>

        <p><?= $breed ?> <a href="breed.php?pooch=<?= $pooch_id; ?>">More info...</a></p>

    <?php endwhile;  ?>
<?php endif; ?>

<h3 class="h6">Alphabetical A - Z links only</h3>
<?php
$current_char = '';
$random_result->data_seek(0);

if (mysqli_num_rows($random_result) > 0) :
    while ($row = mysqli_fetch_assoc($random_result)) : ?>
        <?php extract($row);  ?>
        <?php
        if ($first_char != $current_char) :
            $current_char = $first_char;
        ?>
            <a href="index.php?displayBy=breed&displayValue=<?= $current_char ?>%">
                <?= $current_char; ?>
            </a> |

        <?php endif ?>
    <?php endwhile;  ?>
<?php endif; ?>