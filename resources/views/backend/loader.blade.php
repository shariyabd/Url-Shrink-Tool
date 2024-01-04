<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            background-color: #f4f4f4;
            position: relative;
        }

        .overlay {
            z-index: 9999 !important;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            display: none;
        }

        .loader {
            font-size: 40px;
            color: #3498db;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-left: 2px;
            margin-top: 10px;
            color: #3498db;
            font-size: 25px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="overlay" id="overlay">
        <div class="loader">
            <i class="fas fa-link"></i>
        </div>
        <div class="loading-text">Loading...</div>
    </div>

  
    <script>
        // Show loader initially
        document.getElementById('overlay').style.display = 'flex';

        // Hide loader when window has finished loading
        window.onload = function() {
            document.getElementById('overlay').style.display = 'none';
        };
    </script>
</body>

</html>
