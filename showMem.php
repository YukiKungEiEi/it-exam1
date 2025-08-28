<?php
include "connect.php";
$sql = "SELECT * FROM member";
$result = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลสมาชิก</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #ffe6f0, #ffd6eb, #ffcce5);
            min-height: 100vh;
            overflow-x: hidden;
        }
        h2 {
            text-align: center;
            color: #b30059;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .btn-back {
            display: block;
            width: fit-content;
            margin: 0 auto 20px auto;
            padding: 10px 18px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            background: linear-gradient(45deg, #ff80bf, #ff99cc, #ffb3d9);
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            transform: translateY(-3px) scale(1.05);
            background: linear-gradient(45deg, #ff4da6, #ff80bf, #ffb3d9);
            box-shadow: 0 10px 18px rgba(0,0,0,0.35);
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 85%;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.25);
            transition: 0.3s;
        }
        table:hover {
            transform: scale(1.01);
            box-shadow: 0 14px 28px rgba(0,0,0,0.35);
        }
        th, td {
            padding: 14px 16px;
            text-align: center;
        }
        tr:nth-child(even) {
            background: #fff0f7;
        }
        tr:hover {
            background: #ffd6eb;
            transition: 0.2s;
        }
        th {
            background: linear-gradient(45deg, #ff66a3, #ff80bf);
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .action-btn {
            text-decoration: none;
            color: white;
            background: linear-gradient(45deg, #ff6699, #ff99cc);
            padding: 6px 12px;
            border-radius: 6px;
            margin: 0 3px;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0,0,0,0.25);
            transition: all 0.25s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(45deg, #ff3385, #ff80b3);
            box-shadow: 0 6px 12px rgba(0,0,0,0.35);
        }

        /* หัวใจลอย */
        .heart {
            position: fixed;
            bottom: 0;
            font-size: 20px;
            pointer-events: none;
            z-index: 9999;
            animation: floatUp 5s linear forwards;
            opacity: 0.8;
        }

        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 0.8; }
            50% { transform: translateY(-150px) scale(1.2); opacity: 0.9; }
            100% { transform: translateY(-350px) scale(1.5); opacity: 0; }
        }
    </style>
</head>
<body>
    <h2>ข้อมูลสมาชิก</h2>
    <a href="formRegist.php" class="btn-back">+ เพิ่มสมาชิกใหม่</a>
    <table>
        <tr>
            <th>ลำดับที่</th>
            <th>ชื่อ-สกุล</th>
            <th>ยูสเซอร์เนม</th>
            <th>รหัสผ่าน</th>
            <th>อีเมล</th>
            <th>การจัดการ</th>
        </tr>
        <?php
        $i=1;
        while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['mem_name']; ?></td>
            <td><?php echo $row['mem_username']; ?></td>
            <td><?php echo $row['mem_password']; ?></td>
            <td><?php echo $row['mem_email']; ?></td>
            <td>
                <a href="edit_mem.php?mem_id=<?php echo $row['mem_id']; ?>" class="action-btn">แก้ไข</a>
                <a href="del_mem.php?mem_id=<?php echo $row['mem_id']; ?>" class="action-btn" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </table>

    <script>
        // ฟังก์ชันสร้างหัวใจลอย
        function createHeart() {
            const heart = document.createElement('div');
            heart.classList.add('heart');
            heart.textContent = '❤';
            // ขนาดหัวใจสุ่ม
            heart.style.fontSize = (15 + Math.random()*15) + 'px';
            // สีชมพูสุ่มใกล้โทน showMem.php
            const colors = ['#ff66a3','#ff80bf','#ff99cc','#ffb3d9','#ff4da6'];
            heart.style.color = colors[Math.floor(Math.random()*colors.length)];
            // ตำแหน่งแนวนอนสุ่ม
            heart.style.left = Math.random() * (window.innerWidth - 30) + 'px';
            // ความเร็ว animation สุ่ม
            heart.style.animationDuration = (4 + Math.random()*3) + 's';
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 7000);
        }

        // สร้างหัวใจหลายตัวอย่างต่อเนื่อง
        setInterval(createHeart, 300);
    </script>
</body>
</html>
