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
h2 {
    text-align: center;
    color: #b30059;
    text-shadow: 3px 3px 10px rgba(0,0,0,0.3);
    font-size: 2.2em;
    margin-bottom: 30px;
}
.form-box {
    width: 420px;
    margin: 0 auto;
    background: linear-gradient(145deg, #fff, #ffe6f0);
    padding: 40px 30px; /* เพิ่ม padding ด้านซ้าย-ขวา */
    border-radius: 20px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.25), inset 0 0 20px rgba(255,192,203,0.2);
    transition: transform 0.3s ease;
    box-sizing: border-box; /* ให้ padding รวมอยู่ใน width */
}
.form-box:hover {
    transform: scale(1.02);
}
.form-box label {
    display: block;
    margin: 15px 0 8px; /* เว้นระยะบน-ล่าง */
    font-weight: bold;
    color: #b30059;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}
.form-box input {
    width: 100%; /* กว้างเต็ม form */
    max-width: 100%; /* ป้องกัน overflow */
    padding: 12px;
    border: 1px solid #ffcce5;
    border-radius: 10px;
    outline: none;
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    box-sizing: border-box; /* ให้ padding ไม่ล้นออก */
}
.form-box input:focus {
    border-color:#ff66a3;
    box-shadow: 0 0 12px rgba(255,102,163,0.5), inset 0 1px 3px rgba(0,0,0,0.1);
}
.btn {
    display: inline-block;
    padding: 14px 22px; /* เพิ่มขนาดปุ่มให้ใหญ่ขึ้น */
    margin-top: 20px; /* เว้นระยะจาก input */
    text-decoration: none;
    color: white;
    background: linear-gradient(45deg, #ff80bf, #ff99cc, #ffb3d9);
    border-radius: 12px;
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
    font-weight: bold;
    letter-spacing: 0.5px;
    transition: all 0.4s ease;
}
.btn:hover {
    transform: translateY(-3px) scale(1.08);
    background: linear-gradient(45deg,#ff4da6,#ff80bf,#ffb3d9);
    box-shadow: 0 12px 20px rgba(0,0,0,0.35);
}

/* หัวใจลอย */
.heart {
    position: fixed;
    bottom: 0;
    font-size: 20px;
    pointer-events: none;
    z-index: 9999;
    text-shadow: 0 4px 12px rgba(0,0,0,0.4);
    animation: floatUp 4s forwards;
    opacity: 0.9;
}
@keyframes floatUp {
    0% { transform: translateY(0) scale(1) rotate(0deg); opacity: 0.8; }
    25% { transform: translateY(-60px) scale(1.1) rotate(15deg); opacity: 0.9; }
    50% { transform: translateY(-140px) scale(1.2) rotate(-10deg); opacity: 0.85; }
    75% { transform: translateY(-220px) scale(1.3) rotate(20deg); opacity: 0.7; }
    100% { transform: translateY(-320px) scale(1.4) rotate(30deg); opacity: 0; }
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
    // ฟังก์ชันสร้างหัวใจลอย
    function createHeart() {
        const heart = document.createElement('div');
        heart.classList.add('heart');
        heart.textContent = '❤';
        heart.style.fontSize = (18 + Math.random()*25) + 'px';
        const colors = ['#ff66a3','#ff80bf','#ff99cc','#ffb3d9','#ff4da6'];
        heart.style.color = colors[Math.floor(Math.random()*colors.length)];
        heart.style.left = Math.random() * (window.innerWidth - 40) + 'px';
        heart.style.animationDuration = (3 + Math.random()*2) + 's';
        heart.style.transform = `rotate(${Math.random()*360}deg)`;
        document.body.appendChild(heart);
        setTimeout(() => heart.remove(), 4000);
    }

    // สร้างหัวใจทุก 120ms เป็นเวลา 4 วินาที
    let heartInterval = setInterval(createHeart, 120);
    setTimeout(() => clearInterval(heartInterval), 4000);

    // SweetAlert2 popup แบบสวย
    Swal.fire({
        title: '<?php echo $msg; ?>',
        icon: '<?php echo $icon ?: "success"; ?>',
        showConfirmButton: true,
        backdrop: `
            rgba(0,0,0,0.2)
            left top
            no-repeat
        `,
        showClass: {
            popup: 'swal2-show swal2-animate__animated swal2-animate__fadeInDown'
        },
        hideClass: {
            popup: 'swal2-hide swal2-animate__animated swal2-animate__fadeOutUp'
        }
    }).then(() => {
        window.location.href='showMem.php';
    });
});
</script>
<?php endif; ?>
</body>
</html>
