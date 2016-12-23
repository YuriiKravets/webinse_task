<?php require_once 'library/models/DB_adapter.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Webinse</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery/dist/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

</head>
<body>
    <div class="main">
        <table id="users" class="table table-hover">
            <tr>
                <th>First name</th>
                <th>Second name</th>
                <th>Email</th>
                <th>Действие</th>
            </tr>

            <?php

                $db = DB_adapter::getInstance();
                $users = $db->getAllUsers();

                while ($row = $users->fetch_assoc()):?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td id="fn_<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></td>
                        <td id="sn_<?php echo $row['id']; ?>"><?php echo $row['second_name']; ?></td>
                        <td id="email_<?php echo $row['id']; ?>"><?php echo $row['email']; ?></td>
                        <td id="buttons_<?php echo $row['id']; ?>">
                            <button id="edit_<?php echo $row['id']; ?>" class="btn btn-success" onclick="editUser(<?php echo $row['id']; ?>)">Изменить</button>
                            <button id="delete_<?php echo $row['id']; ?>" class="btn btn-danger" onclick="deleteUser(<?php echo $row['id']; ?>)">Удалить</button>
                        </td>
                    </tr>
            <?php endwhile; ?>
        </table>
        </br>

        <button id="showForm" class="btn btn-success">Добаить</button>

        <div id="createForm" >
            
            <form id="form" method="POST" class="form form-horizontal">

                <div class="control-group">
                    <label class="control-label" for="firstName">First Name</label>
                    <div class="controls">
                        <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    </div>
                    <div id="error_fn" class="message"></div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="secondName">Second Name</label>
                    <div class="controls">
                        <input type="text" id="secondName" name="secondName" placeholder="Second Name">
                    </div>
                    <div id="error_sn" class="message"></div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div id="error_email" class="message"></div>
                </div>

                <br/>
                <button id="createButton" type="submit" class="btn btn-success" value="Сохранить">Сохранить</button>
            </form>

            <br/>
            <button id="hideForm" class="btn btn-default">Скрыть</button>
        </div>


    </div>

</body>
</html>