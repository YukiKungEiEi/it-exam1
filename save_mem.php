<?php
include "connect.php";

$id    = $_POST['mem_id'];
$name  = $_POST['mem_name'];
$user  = $_POST['mem_username'];
$pass  = $_POST['mem_password'];
$email = $_POST['mem_email'];

$sql = "UPDATE member SET mem_name='$name', mem_username='$user', mem_password='$pass', mem_email='$email' WHERE mem_id='$id'";
$result = mysqli_query($con,$sql);

if ($result) {
    $msg = "แก้ไขข้อมูลสำเร็จ!";
    $icon = "success";
} else {
    $msg = "แก้ไขข้อมูลไม่สำเร็จ: " . mysqli_error($con);
    $icon = "error";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสมาชิก</title>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* หัวใจลอย */
        .heart {
            position: fixed;
            bottom: 0;
            font-size: 20px;
            pointer-events: none;
            z-index: 9999;
            animation: floatUp 4s linear forwards;
            opacity: 0.8;
        }
        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 0.8; }
            50% { transform: translateY(-120px) scale(1.2); opacity: 0.9; }
            100% { transform: translateY(-250px) scale(1.5); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // ฟังก์ชันสร้างหัวใจลอย
        function createHeart() {
            const heart = document.createElement('div');
            heart.classList.add('heart');
            heart.textContent = '❤';
            heart.style.fontSize = (15 + Math.random()*15) + 'px';
            const colors = ['#ff66a3','#ff80bf','#ff99cc','#ffb3d9','#ff4da6'];
            heart.style.color = colors[Math.floor(Math.random()*colors.length)];
            heart.style.left = Math.random() * (window.innerWidth - 30) + 'px';
            heart.style.animationDuration = (3 + Math.random()*2) + 's';
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 5000);
        }

        // สร้างหัวใจหลายตัว
        for (let i = 0; i < 20; i++) {
            setTimeout(createHeart, i * 100);
        }

        // แสดง popup
        Swal.fire({
            title: '<?php echo $msg; ?>',
            icon: '<?php echo $icon; ?>',
            showConfirmButton: true,
        }).then(() => {
            window.location.href = 'showMem.php';
        });
    </script>
</body>
</html>
