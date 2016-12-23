<?php
require_once 'library/models/DB_adapter.php';
$db = DB_adapter::getInstance();
if(isset($_POST['action'])){
    if($_POST['action'] == 'create'){
        $firstName = $_POST['firstName'];
        $secondName = $_POST['secondName'];
        $email = $_POST['email'];
        $res = $db->createNewUser($firstName, $secondName, $email);
        $nextId = $res;
        
        $result = "<tr id='$nextId'><td id='fn_$nextId'><?php echo $firstName ?></td><td><?php echo $secondName ?></td><td><?php echo $email ?></td>";
        echo    "<tr id='$nextId'><td id='fn_$nextId'>$firstName</td><td id='sn_$nextId'>$secondName</td><td id='email_$nextId'>$email</td>
                 <td><button id='edit_$nextId' class='btn btn-success' onclick='editUser($nextId)' value='$nextId'>Изменить</button>
                 <button id='delete_$nextId' class='btn btn-danger' onclick='deleteUser($nextId)'>Удалить</button></td>";

    }else if($_POST['action'] == 'delete'){
        $id = $_POST['id'];
        $res = $db->deleteUser($id);
    }else if($_POST['action'] == 'save'){
        $id = $_POST['id'];
        $newFN = $_POST['newFN'];
        $newSN = $_POST['newSN'];
        $newEmail = $_POST['newEmail'];
        $res = $db->updateUser($id, $newFN, $newSN, $newEmail);
        echo $res;
    }
}