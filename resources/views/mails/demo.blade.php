<!DOCTYPE html>
<html>
<head>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Hola {{ $mensaje  }}!</h2>
        </div>
        <div class="content">
             
        </div>
        <div class="footer">
            <p>Este es un email enviado desde la API de Laravel.</p>
        </div>
    </div>
</body>
</html>