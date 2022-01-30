<?php
$errors="";

$host="localhost";
$user="root";
$pass="";
$dbname="todo";

$link=mysqli_connect($host,$user,$pass,$dbname);
$conn=mysqli_select_db($link,$dbname);

if(isset($_POST['submit'])){
    $task=$_POST['task'];
    if(empty($task)){
        $errors="you must fill the task";
    }else{
        mysqli_query($link,"insert into task(task) values('$task')");
    header('location:index.php');

    }

    
}
if (isset($_GET['del_task'])) {
    $id=$_GET['del_task'];
    mysqli_query($link,"delete from task where id =$id");
    header('location:index.php');
}
$select=mysqli_query($link,"select * from task "); 




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
    <h1>salman</h1>
    <form action="index.php"method="post">
    <?php if(isset($errors)){?>
              <p><?php echo $errors;?></p>
            <?php }?>
        
        <input type="text"name="task">
        <button type="submit"name="submit">add task</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while  ($row= mysqli_fetch_array($select)){ ?>

            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['task'];?></td>
                <td>
                    <a href="index.php ?del_task=<?php echo$row['id'];?>">X</a>
                </td>
            </tr>
            <?php $i++; }?>
            
        </tbody>
    </table>
</body>
</html>