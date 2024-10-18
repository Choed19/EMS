<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Prompt', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('/img/KU_blur.png') no-repeat center center;
            background-size: cover;
        }

        .wrapper {
           
            width: 100%;
            max-width: 420px;
            background: rgba(0, 0, 0, 0.5);
            /* ใช้พื้นหลังโปร่งใสเพื่อเน้นความสวยงาม */
            color: white;
            border-radius: 15px;
            padding: 40px 30px;
            /* ปรับ padding ให้สอดคล้อง */
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            /* เพิ่มเงาให้กับกล่อง */
        }

        .wrapper h1 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
            /* เพิ่ม margin ด้านล่าง */
        }

        .input-box {
     
            position: relative;
            width: 100%;
            height: 50px;
            margin: 15px 0;
            /* ปรับ margin */
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            /* ปรับสี border */
            border-radius: 40px;
            font-size: 16px;
            color: white;
            padding: 15px 45px 15px 20px;
            /* ปรับ padding */
            transition: border-color 0.3s ease;
            /* เพิ่ม transition */
        }

        .input-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            /* ทำให้ placeholder ดูนุ่มนวลขึ้น */
        }

        .input-box input:focus {
            border-color: #b9ff90;
            /* เปลี่ยนสี border ตอน focus */
        }

        .input-box i {
            
            position: absolute;
            right: 20px;
            top: 30%;
            transform: translate(-50%);
            font-size: 20px;
            color: #b9ff90;
            /* เปลี่ยนสี icon */
        }

        .btn {
            width: 100%;
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            color: #000;
            /* เปลี่ยนสีตัวอักษรให้เข้มขึ้น */
            font-size: 16px;
            font-weight: 600;
            background: #b9ff90;
            /* เปลี่ยนสีพื้นหลัง */
            transition: background 0.3s ease, transform 0.2s ease;
            /* เพิ่ม transition */
        }

        .btn:hover {
            transform: translateY(-2px);
            /* เพิ่มเอฟเฟกต์ยกขึ้นเมื่อ hover */
            background: #9fe688;
            /* เปลี่ยนสีพื้นหลังตอน hover */
        }

        .btn:active {
            transform: translateY(0);
            /* คืนสถานะตอน active */
        }

        .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0;
        }

        .register-link p a {
            color: #b9ff90;
            /* เปลี่ยนสีลิงค์ให้ดูเด่น */
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .wrapper {
                padding: 40px 30px;
            }

            .wrapper h1 {
                font-size: 28px;
            }

            .input-box input {
                font-size: 14px;
            }

            .btn {
                height: 40px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .wrapper {
                padding: 30px 20px;
            }

            .wrapper h1 {
                font-size: 24px;
            }

            .input-box input {
                font-size: 12px;
            }

            .btn {
                height: 35px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h1>สร้างบัญชี</h1>

            <div class="input-box">
                <i class='bx bxs-user'></i>
                <div class="col-md-6">
                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                        name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus
                        placeholder="ชื่อ">

                    @error('fname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <div class="col-md-6">
                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                        name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus
                        placeholder="นามสกุล">

                    @error('lname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="input-box">
                <i class='bx bxs-envelope'></i>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="อีเมล">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="input-box">
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="รหัสผ่าน">
                    <i class='bx bxs-lock-alt'></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="input-box">
                <input id="cnfrm-password" type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน"
                    required autocomplete="new-password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">
                ยืนยัน
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
</body>

</html>
