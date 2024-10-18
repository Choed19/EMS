<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Entry Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Item Entry Form</h1>
    <form action="/submit" method="post" enctype="multipart/form-data">
        <label for="itemType">ชนิดของสิ่งของ:</label>
        <input type="text" id="itemType" name="itemType" required>

        <label for="serialNumber">หมายเลขซีเรียล:</label>
        <input type="text" id="serialNumber" name="serialNumber" required>

        <label for="itemName">ชื่อสิ่งของ:</label>
        <input type="text" id="itemName" name="itemName" required>

        <label for="price">ราคา:</label>
        <input type="number" id="price" name="price" required>

        <label for="location">สถานที่:</label>
        <input type="text" id="location" name="location" required>

        <label for="importDate">วันที่นำเข้า:</label>
        <input type="date" id="importDate" name="importDate" required>

        <label for="status">สถานะสิ่งของ:</label>
        <select id="status" name="status" required>
            <option value="available">available</option>
            <option value="unavailable">unavailable</option>
            <option value="reserved">reserved</option>
        </select>

        <label for="company">บริษัทที่จำหน่าย:</label>
        <input type="text" id="company" name="company" required>

        <label for="image">อัพโหลดรูปภาพ:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemType = $_POST['itemType'];
    $serialNumber = $_POST['serialNumber'];
    $itemName = $_POST['itemName'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $importDate = $_POST['importDate'];
    $status = $_POST['status'];
    $company = $_POST['company'];

    // จัดการการอัพโหลดรูปภาพ
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าไฟล์เป็นรูปภาพจริงหรือไม่
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // ตรวจสอบว่าไฟล์มีอยู่แล้วหรือไม่
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // จำกัดขนาดไฟล์
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // จำกัดประเภทไฟล์
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // ตรวจสอบว่า $uploadOk เป็น 0 หรือไม่เพื่อตรวจสอบข้อผิดพลาด
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // ถ้าไม่มีข้อผิดพลาด ให้อัพโหลดไฟล์
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
            // เชื่อมต่อฐานข้อมูล
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "database";

            // สร้างการเชื่อมต่อ
            $conn = new mysqli($servername, $username, $password, $dbname);

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // เพิ่มข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO items (itemType, serialNumber, itemName, price, location, importDate, status, company, image)
            VALUES ('$itemType', '$serialNumber', '$itemName', '$price', '$location', '$importDate', '$status', '$company', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
