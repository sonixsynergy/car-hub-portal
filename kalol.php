<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            overflow: hidden;
            position: relative;
        }
        .container {
            position: relative;
            display: inline-block;
        }
        img {
            max-width: 100%;
            height: auto;
            border: 5px solid #EE5100;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-top {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff5733;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }
        .btn-top:hover {
            background-color: #d43f00;
            transform: translateX(-50%) scale(1.1);
        }
        .falling {
            position: fixed;
            top: -50px;
            font-size: 25px;
            opacity: 0.8;
            animation: fall linear infinite;
        }
        @keyframes fall {
            0% { transform: translateY(-50px); opacity: 1; }
            100% { transform: translateY(100vh); opacity: 0; }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.zoom = "80%";

            function createFallingElement() {
                let element = document.createElement("div");
                element.classList.add("falling");

                let symbols = ["🌸", "🌺", "🍂", "❄️", "🌷", "🌻", "🌹", "💮", "🌼", "🏵️", "🍀", "☘️", "🍁"];
                element.innerText = symbols[Math.floor(Math.random() * symbols.length)];

                element.style.left = Math.random() * window.innerWidth + "px";
                element.style.animationDuration = (3 + Math.random() * 3) + "s"; 
                element.style.fontSize = (20 + Math.random() * 20) + "px"; 

                document.body.appendChild(element);

                setTimeout(() => element.remove(), 6000);
            }

            setInterval(createFallingElement, 300);
        });
    </script>
</head>
<body>

<div class="container">
    <button class="btn-top" onclick="window.location.href='contact-us.php'"> Contact Us</button>
    <img src="http://localhost/CRP/CRP/carrental/admin/img/kalolCon.png" alt="Kalol Image">
</div>

</body>
</html>
