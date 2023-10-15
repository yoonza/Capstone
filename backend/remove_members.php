<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>회원 정보 삭제</title>
</head>
<body>
    <h1>회원 정보 삭제</h1>
    <form method="post" action="delete_member.php">
        <label for="username_to_delete">삭제할 회원의 아이디:</label>
        <input type="text" id="username_to_delete" name="username_to_delete" required>
        <input type="submit" value="삭제">
    </form>
</body>
</html>
