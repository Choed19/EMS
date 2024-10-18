<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        .d-none {
            display: none;
        }
        #video {
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
            border: 1px solid #ccc;
            height: 400px;
            object-fit: cover;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .btn-group button {
            margin: 5px;
        }
        #captureBtn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>สแกน QR Code</h2>

        <div class="btn-group" role="group" aria-label="Choose Method">
            <button type="button" class="btn btn-primary" id="scanByCameraBtn">สแกนด้วยกล้อง</button>
            <button type="button" class="btn btn-secondary" id="uploadImageBtn">อัปโหลดรูปภาพ</button>
        </div>

        <!-- ส่วนแสดงกล้อง -->
        <div id="cameraContainer" class="d-none">
            <video id="video" autoplay></video>
            <button type="button" class="btn btn-success" id="captureBtn">ถ่ายภาพ</button>
        </div>

        <!-- ส่วนอัปโหลดรูปภาพ -->
        <div class="mt-3 d-none" id="uploadImageContainer">
            <input type="file" id="qrImageInput" accept="image/*" class="form-control">
        </div>
        <div>
            <h5 style="color: red">*ในส่วนของการสแกนด้วยกล้องยังไม่สามารถทำได้เนื่องจากติดปัญหาด้านความปลอดภัยการละเมิดความเป็นส่วนตัวของผู้ใช้งาน แต่ในส่วนของอัพโหลดรูปภาพสามารถแสดงผลการสแกนได้ตามปกติ</h5>
        </div>
        <div id="result" class="mt-3">
            <h4>ผลลัพธ์:</h4>
            <p id="decodedText">กำลังรอการสแกน...</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scanByCameraBtn = document.getElementById('scanByCameraBtn');
            const uploadImageBtn = document.getElementById('uploadImageBtn');
            const cameraContainer = document.getElementById('cameraContainer');
            const uploadImageContainer = document.getElementById('uploadImageContainer');
            const decodedText = document.getElementById('decodedText');
            const video = document.getElementById('video');
            const captureBtn = document.getElementById('captureBtn');
            const qrImageInput = document.getElementById('qrImageInput');

            let stream = null;

            // ฟังก์ชันหยุดกล้อง
            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                    console.log("กล้องถูกหยุดแล้ว");
                }
            }

            // ฟังก์ชันตรวจสอบว่าเป็น URL หรือไม่
            function isValidURL(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;  
                }
            }

            // ฟังก์ชันส่งภาพไปยัง API สำหรับสแกน QR Code
            async function scanQRCode(imageBlob) {
                decodedText.textContent = "กำลังสแกน QR Code...";
                const formData = new FormData();
                formData.append('file', imageBlob);

                try {
                    const response = await fetch('https://api.qrserver.com/v1/read-qr-code/', {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();
                    if (result && result[0] && result[0].symbol && result[0].symbol[0].data) {
                        const decodedData = result[0].symbol[0].data;
                        decodedText.textContent = decodedData;
                        console.log(`QR Code สแกนสำเร็จ: ${decodedData}`);

                        // เช็คว่าข้อมูลเป็น URL หรือไม่
                        if (isValidURL(decodedData)) {
                            // เปิด URL ในแท็บใหม่
                            window.open(decodedData, '_blank');
                        }
                    } else {
                        decodedText.textContent = "ไม่พบข้อมูลใน QR Code";
                        console.warn("ไม่พบข้อมูลใน QR Code");
                    }
                } catch (error) {
                    decodedText.textContent = "การสแกนล้มเหลว: " + error.message;
                    console.error("การสแกนล้มเหลว: ", error);
                }
            }

            // ปุ่มสแกนด้วยกล้อง
            scanByCameraBtn.addEventListener('click', async function () {
                // ซ่อนการอัปโหลดรูปภาพและแสดงกล้อง
                uploadImageContainer.classList.add('d-none');
                cameraContainer.classList.remove('d-none');
                decodedText.textContent = "กำลังรอการสแกน...";

                // หยุดกล้องที่อาจจะกำลังทำงานอยู่
                stopCamera();

                // ขอเข้าถึงกล้อง
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
                    video.srcObject = stream;
                } catch (error) {
                    console.error("ไม่ได้รับอนุญาตให้ใช้กล้อง: ", error);
                    alert("กรุณาอนุญาตให้ใช้กล้องเพื่อสแกน QR Code");
                }
            });

            // ปุ่มสแกนด้วยการอัปโหลดรูปภาพ
            uploadImageBtn.addEventListener('click', function () {
                // ซ่อนกล้องและแสดงการอัปโหลดรูปภาพ
                cameraContainer.classList.add('d-none');
                uploadImageContainer.classList.remove('d-none');
                decodedText.textContent = "กำลังรอการสแกน...";
                stopCamera();
            });

            // ปุ่มถ่ายภาพจากกล้อง
            captureBtn.addEventListener('click', function () {
                if (!stream) {
                    alert("กล้องยังไม่พร้อมใช้งาน");
                    return;
                }

                // สร้าง Canvas เพื่อจับภาพจากวิดีโอ
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // แปลง Canvas เป็น Blob
                canvas.toBlob(function (blob) {
                    if (blob) {
                        scanQRCode(blob);
                    } else {
                        decodedText.textContent = "ไม่สามารถจับภาพได้";
                        console.error("ไม่สามารถจับภาพได้");
                    }
                }, 'image/png');
            });

            // การอัปโหลดและสแกน QR Code จากรูปภาพ
            qrImageInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (!file) {
                    alert("กรุณาเลือกไฟล์เพื่ออัปโหลด");
                    return;
                }

                scanQRCode(file);
            });

            // หยุดกล้องเมื่อผู้ใช้ออกจากหน้า
            window.addEventListener('beforeunload', function () {
                stopCamera();
            });
        });
    </script>
</body>
</html>
