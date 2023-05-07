<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

$emp_id = $_SESSION['id'];
//print_r($emp_id);die;

$sql = "SELECT * FROM presence WHERE id_emp = '$emp_id'";
$res = $db->query($sql);
$attendences = [];
while ($row = $res->fetch_object()) {
    $attendences[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Presence</strong></a>
    <hr>
    <a href="./give-attendance.php" class="btn btn-primary">s'enregistrer</a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>No</th>
            
            <th>Date </th>
            <!--<th>Out Time</th>-->


        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($attendences as $attendence) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    
                    <td><?php echo $attendence->date ?></td>
                    <!--<td><?php //echo $attendence->outTime ?></td>-->

                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>