<?php
// Make sure an ID was passed
if(isset($_GET['parent_id'])) {
// Get the ID
    $parent_id = intval($_GET['parent_id']);
 
    // Make sure the ID is in fact a valid ID
    if($parent_id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $dbLink = new mysqli('127.0.0.1', 'root', '', 'hi');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
         
        // Query for a list of all existing files
        $sql = "SELECT `id`, `name`, `mime`, `size`, `created` FROM `file` WHERE `parent_id`= {$parent_id}";
        //$sql = 'SELECT `id`, `name`, `mime`, `size`, `created` FROM `file`';
        $result = $dbLink->query($sql);
         
        // Check if it was successfull
        if($result) {
            // Make sure there are some files in there
            if($result->num_rows == 0) {
                echo '<p>There are no files in the database</p>';
            }
            else {
                // Print the top of a table
                echo '<table width="100%">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Created</b></td>
                            <td><b>&nbsp;</b></td>
                        </tr>';
         
                // Print each file
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row['name']}</td>
                            <td>{$row['created']}</td>
                            <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                        </tr>";
                }
         
                // Close table
                echo '</table>';
            }
         
            // Free the result
            $result->free();
        }
        else
        {
            echo 'Error! SQL query failed:';
            echo "<pre>{$dbLink->error}</pre>";
        }
         
        // Close the mysql connection
        $dbLink->close();
        }
}
else {
    echo 'Error! Parent ID was not passed.';
}
?>