<?php
$alicetext = file_get_contents("alice.txt");
$word = strtolower($alicetext);
preg_split('/\s+/', $word);
function sortcount($word){
/**
 * call file and count similar strings
 */


$words = str_word_count($word, 1);
$alice = array_count_values($words);

ksort($alice);
echo '<b>Number of Words: '.count($words);
echo '<pre>';
print_r($alice);
echo '</b><pre>';
arsort($alice);

print_r(array_slice($alice, 0 ,30));
}

sortcount($word);

echo "<html>
    <body>
    <table>";
$f = fopen("todo.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
}
fclose($f);
echo "
    </table>
    </body>
    </html>";
?>

<?php
if(isset($_POST['submit'])){

    foreach ($_FILES as $key => $value){
        $image_tmp = $value['tmp_name'];
        $image = $value['name'];
        $image_file = "{$UPLOADDIR}{$image}";

        if(move_uploaded_file($image_tmp,$image_file)){
            echo <<<HERE
        <div style="margin: 0 auto;">
            <img src="{$image_file}" alt="file not found" /></br>
        </div>
HERE;
        }
        else{
            echo "<h3>Error image failed to upload, image too large</h3>";
        }
    }
}
else{
    ?>
<form method='POST' enctype='multipart/form-data' action=''>
    <table>
        <tr>
            <td><input type='file' name='image'></td>
        </tr>
        <tr>
            <td><input name='submit' type='submit' value='Upload'></td>
        </tr>
    </table>
</form>
<?php
}
?>