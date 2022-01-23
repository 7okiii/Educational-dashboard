<div>
    <h3>Mark page</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']."teachers"?>"
  <label for="course">Course:</label><br>
  <input type="text" id="course" name="course" value="Math"><br>
  
  <input type="submit" value="Submit">
  </form>
  
  <style>
table, th, td {
  border:1px solid black;
}
</style>
<h4>Course 1</h4>

<table style="width:100%">
  <tr>
    <th>Student name</th>
    <th>Marks</th>
    <th>Comments</th>
  </tr>
  <tr>
    <td>Alfreds </td>
    <td>80</td>
    <td>Dedicated and hard working student</td>
  </tr>
  <tr>
    <td>Benzeo</td>
    <td>90</td>
    <td>Have great understanding in course</td>
  </tr>
</table>

<p>Course marks and comments for students.</p>



<?php
//each teacher has different above form
//depending on value, directs to different table in db


?>

    </div>







