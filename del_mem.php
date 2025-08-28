<?php
include "connect.php";
$id = $_GET['mem_id'];
$sql = "DELETE FROM member WHERE mem_id='$id'";
$result = mysqli_query($con,$sql);

if ($result) {
    $msg = "ลบข้อมูลสำเร็จ!";
    $icon = "success";
} else {
    $msg = "ลบข้อมูลไม่สำเร็จ: " . mysqli_error($con);
    $icon = "error";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ลบสมาชิก</title>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* หัวใจลอยจากล่างขึ้นบน */
        .heart {
            position: fixed;
            bottom: 0;
            font-size: 24px;
            color: #ff80bf; /* โทนชมพูใกล้กับ showMem.php */
            animation: floatUp 4s linear forwards;
            pointer-events: none;
            z-index: 9999;
        }

        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 1; }
            100% { transform: translateY(-300px) scale(1.5); opacity: 0; }
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
            heart.style.left = Math.random() * (window.innerWidth - 30) + 'px';
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 4000); // ลบหัวใจหลัง animation
        }

        // สร้างหัวใจลอย 30 ตัวช้าๆ
        for (let i = 0; i < 30; i++) {
            setTimeout(createHeart, i * 150);
        }

        // แสดง SweetAlert2 popup
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
