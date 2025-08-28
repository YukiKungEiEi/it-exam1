<?php
include "connect.php";

$msg = '';
$icon = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['mem_name'];
    $user  = $_POST['mem_username'];
    $pass  = $_POST['mem_password'];
    $email = $_POST['mem_email'];

    $sql = "INSERT INTO member (mem_name, mem_username, mem_password, mem_email) 
            VALUES ('$name','$user','$pass','$email')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $msg = "เพิ่มสมาชิกสำเร็จ!";
        $icon = "success";
    } else {
        $msg = "เพิ่มสมาชิกไม่สำเร็จ: " . mysqli_error($con);
        $icon = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สมัครสมาชิก</title>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<style>
body {
    font-family: "Segoe UI", Tahoma, sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #ffe6f0, #ffd6eb, #ffcce5);
    min-height: 100vh;
}
h2 { text-align: center; color: #b30059; text-shadow: 2px 2px 5px rgba(0,0,0,0.2); }
.form-box {
    width: 400px; margin: 30px auto; background: #fff; padding: 25px;
    border-radius: 14px; box-shadow: 0 10px 20px rgba(0,0,0,0.25);
}
.form-box label { display:block; margin:12px 0 6px; font-weight:bold; color:#b30059; }
.form-box input {
    width:100%; padding:10px; border:1px solid #ffcce5; border-radius:8px; outline:none;
}
.form-box input:focus { border-color:#ff80bf; box-shadow:0 0 8px rgba(255,128,191,0.5); }
.btn {
    display:inline-block; padding:10px 18px; margin-top:15px; text-decoration:none; color:white;
    background:linear-gradient(45deg, #ff80bf, #ff99cc, #ffb3d9);
    border-radius:8px; box-shadow:0 6px 12px rgba(0,0,0,0.25); transition:all 0.3s ease;
}
.btn:hover { transform:translateY(-3px) scale(1.05); background:linear-gradient(45deg,#ff4da6,#ff80bf,#ffb3d9); }

.heart {
    position: fixed;
    bottom: 0;
    font-size: 20px;
    pointer-events: none;
    z-index: 9999;
    text-shadow: 0 2px 8px rgba(0,0,0,0.4);
    animation: floatUp 4s forwards;
    opacity: 0.9;
}
@keyframes floatUp {
    0% { transform: translateY(0) scale(1) rotate(0deg); opacity: 0.8; }
    25% { transform: translateY(-50px) scale(1.1) rotate(15deg); opacity: 0.9; }
    50% { transform: translateY(-120px) scale(1.2) rotate(-10deg); opacity: 0.85; }
    75% { transform: translateY(-200px) scale(1.3) rotate(20deg); opacity: 0.7; }
    100% { transform: translateY(-300px) scale(1.4) rotate(30deg); opacity: 0; }
}
</style>
</head>
<body>
<h2>สมัครสมาชิก</h2>
<div class="form-box">
    <form method="post" action="">
        <label>ชื่อ-นามสกุล:</label>
        <input type="text" name="mem_name" required>
        <label>ชื่อบัญชี:</label>
        <input type="text" name="mem_username" required>
        <label>รหัสผ่าน:</label>
        <input type="password" name="mem_password" required>
        <label>อีเมล:</label>
        <input type="email" name="mem_email" required>
        <input type="submit" value="ตกลง" class="btn">
        <a href="showMem.php" class="btn">กลับหน้าข้อมูล</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<?php if($msg): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ฟังก์ชันสร้างหัวใจ
    function createHeart() {
        const heart = document.createElement('div');
        heart.classList.add('heart');
        heart.textContent = '❤';
        heart.style.fontSize = (15 + Math.random()*20) + 'px';
        const colors = ['#ff66a3','#ff80bf','#ff99cc','#ffb3d9','#ff4da6'];
        heart.style.color = colors[Math.floor(Math.random()*colors.length)];
        heart.style.left = Math.random() * (window.innerWidth - 30) + 'px';
        heart.style.animationDuration = (3 + Math.random()*2) + 's';
        document.body.appendChild(heart);
        setTimeout(() => heart.remove(), 4000);
    }

    // สร้างหัวใจแบบสุ่มทุก 150ms เป็นเวลา 4 วินาที
    let heartInterval = setInterval(createHeart, 150);
    setTimeout(() => clearInterval(heartInterval), 4000);

    // แสดง SweetAlert2 popup
    Swal.fire({
        title: '<?php echo $msg; ?>',
        icon: '<?php echo $icon ?: "success"; ?>',
        showConfirmButton: true,
        backdrop: `
            rgba(0,0,0,0.2)
            left top
            no-repeat
        `
    }).then(() => {
        window.location.href='showMem.php';
    });
});
</script>
<?php endif; ?>
</body>
</html>
