<?php
include "connect.php";
$name  = $_POST['mem_name'];
$user  = $_POST['mem_username'];
$pass  = $_POST['mem_password'];
$email = $_POST['mem_email'];
$sql = "INSERT INTO member(mem_name,mem_username,mem_password,mem_email)
        VALUES('$name','$user','$pass','$email')";
$result = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>บันทึกสมาชิก</title>
<style>
body {
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:linear-gradient(135deg,#ffe6f0,#ffd6eb,#ffcce5);
    min-height:100vh; display:flex; justify-content:center; align-items:center;
    overflow:hidden;
}

/* Modal */
.modal {
    background:#fff; padding:30px; border-radius:16px; box-shadow:0 15px 30px rgba(0,0,0,0.25);
    text-align:center; width:400px; position:relative; animation:popup 0.5s ease;
}
@keyframes popup {
    0% { transform: scale(0); opacity:0; }
    100% { transform: scale(1); opacity:1; }
}

/* Buttons */
.btn {
    display:inline-block; padding:10px 18px; margin:15px 5px; text-decoration:none;
    color:white; background:linear-gradient(45deg,#ff80bf,#ff99cc,#ffb3d9);
    border-radius:10px; box-shadow:0 6px 12px rgba(0,0,0,0.25); transition:.3s;
}
.btn:hover { transform:translateY(-3px) scale(1.05); background:linear-gradient(45deg,#ff4da6,#ff80bf,#ffb3d9); }

/* Heart animation */
.heart {
    position: absolute;
    width: 20px; height: 20px;
    background:red;
    transform: rotate(-45deg);
    animation: float 4s linear infinite;
}
.heart::before, .heart::after {
    content:""; position:absolute; width:20px; height:20px; background:red; border-radius:50%;
}
.heart::before { top:-10px; left:0; }
.heart::after { left:10px; top:0; }
@keyframes float {
    0% { transform: translate(0,0) rotate(-45deg); opacity:1; }
    100% { transform: translate(calc(var(--x,0)*1px), -300px) rotate(-45deg); opacity:0; }
}
</style>
</head>
<body>
<div class="modal">
    <h2>ผลการบันทึกข้อมูล</h2>
    <?php if($result){ ?>
        <p style="color:green; font-size:18px;">บันทึกข้อมูลสำเร็จ!</p>
    <?php } else { ?>
        <p style="color:red; font-size:16px;">บันทึกข้อมูลไม่สำเร็จ<br><?php echo mysqli_error($con); ?></p>
    <?php } ?>
    <a href="formRegist.php" class="btn">เพิ่มใหม่</a>
    <a href="showMem.php" class="btn">กลับหน้าข้อมูล</a>
</div>

<script>
// สร้างหัวใจลอย
function createHeart() {
    const heart = document.createElement('div');
    heart.classList.add('heart');
    heart.style.left = Math.random() * window.innerWidth + 'px';
    heart.style.setProperty('--x', (Math.random() * 100 - 50));
    document.body.appendChild(heart);
    setTimeout(() => heart.remove(), 4000);
}

// ลอยหัวใจทุก 300ms
setInterval(createHeart, 300);
</script>
</body>
</html>
