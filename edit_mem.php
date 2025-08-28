<?php
include "connect.php";
$id = $_GET['mem_id'];
$sql = "SELECT * FROM member WHERE mem_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูล</title>
    <style>
        body{font-family:"Segoe UI",Tahoma,sans-serif;background:linear-gradient(135deg,#ffe6f0,#ffd6eb,#ffcce5);min-height:100vh;padding:20px;}
        h2{text-align:center;color:#b30059;text-shadow:2px 2px 5px rgba(0,0,0,0.2);}
        .form-box{width:400px;margin:30px auto;background:#fff;padding:25px;border-radius:14px;box-shadow:0 10px 20px rgba(0,0,0,0.25);}
        .form-box label{display:block;margin:12px 0 6px;font-weight:bold;color:#b30059;}
        .form-box input{width:100%;padding:10px;border:1px solid #ffcce5;border-radius:8px;outline:none;}
        .btn{display:inline-block;padding:10px 18px;margin-top:15px;text-decoration:none;color:white;background:linear-gradient(45deg,#ff80bf,#ff99cc,#ffb3d9);border-radius:8px;box-shadow:0 6px 12px rgba(0,0,0,0.25);transition:.3s}
        .btn:hover{transform:translateY(-3px) scale(1.05);background:linear-gradient(45deg,#ff4da6,#ff80bf,#ffb3d9);}
    </style>
</head>
<body>
    <h2>แก้ไขข้อมูลสมาชิก</h2>
    <div class="form-box">
        <form action="save_mem.php" method="post">
            <input type="hidden" name="mem_id" value="<?php echo $row['mem_id']; ?>">
            <label>ชื่อ-นามสกุล:</label>
            <input type="text" name="mem_name" value="<?php echo $row['mem_name']; ?>" required>
            <label>ชื่อบัญชี:</label>
            <input type="text" name="mem_username" value="<?php echo $row['mem_username']; ?>" required>
            <label>รหัสผ่าน:</label>
            <input type="text" name="mem_password" value="<?php echo $row['mem_password']; ?>" required>
            <label>อีเมล:</label>
            <input type="email" name="mem_email" value="<?php echo $row['mem_email']; ?>" required>
            <input type="submit" value="บันทึก" class="btn">
            <a href="showMem.php" class="btn">กลับหน้าข้อมูล</a>
        </form>
    </div>
</body>
</html>
