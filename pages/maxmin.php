<!-- Naoki -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For admin</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>">
        <label for="stuName">Student Name</label>
        <input type="text" name="stuName">
        <button type="submit">Chose</button>
    </form>
    <table>
        <tr>
            <th>Course name</th>
            <th>Teacher name</th>
            <th>Maximum number of student</th>
            <th>Minimum number of student</th>
        </tr>
    </table>
<?php
    // from here take the data from database and show it
?>
</body>