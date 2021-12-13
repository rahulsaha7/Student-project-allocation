<div class="recenet-peoject-allocation"style="color:white;">

    <section class="recent_title">

        <h3>Recentl Works</h3>

    </section>

    <section class="recent-list border-right-0 border-left-0 border-bottom-0 border border-primary">

        <table class="table table-bordered table-dark">

            <thead>

            <tr role=row>

                <th>
                    Id 
                </th>
                <th>
                    Student name 
                </th>
                <th>
                    Project Name
                </th>
                <th>
                    Case Study
                </th>
                <th>
                        DepartMent 
                </th>

                <th>
                       Sem 
                </th>

                <th>
                    Project Id
                </th>

            </tr>

            </thead>

            <tbody>

            <?php 
            

if($admin_check ==10){
    $sql2 = "SELECT * from  student";
}
else{
$sql2 = "SELECT * from  student where admin_user = '$admin_user'";
}

$db2 = new database();

$db2->query($sql2);

if($db2->sql_query->rowCount() > 0){
    $result2 = $db2->sql_query->fetchAll(PDO::FETCH_ASSOC);

   

    for ($j=0; $j < $db2->sql_query->rowCount() ; $j++) { 

?>

                <tr>

                    <td>
                        <?php echo $result2[$j]['student_id'];?>
                    </td>
                    <td>
                        <?php echo $result2[$j]['name'];?>
                    </td>
                    <td>
                    <?php echo $result2[$j]['project'];?>
                    </td>
                    <td>
                    <?php echo $result2[$j]['project_case'];?>
                    </td>
                    <td>
                        <?php echo $result2[$j]['department'];?>
                    </td>

                    <td>
                        <?php echo $result2[$j]['sem'];?>
                    </td>
                    
                    <td>
                        <?php echo $result2[$j]['project_id'];?>
                    </td>

                </tr>

                <?php
                        }
                            }
                        else{
                           echo "NO DATA AVILABLE";  
                        }
                        $db2->close_connection();
                    ?>

            </tbody>

        </table>
    </section>


</div>