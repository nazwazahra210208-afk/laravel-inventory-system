<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory Management System</title>
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #0b0f19 !important;
            color: #f3f4f6 !important;
        }
    </style>
</head>
<body style="background-color: #0b0f19 !important; color: #f3f4f6 !important; margin: 0; padding: 0;">
    <div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; background-color: #0b0f19 !important;">
        <div style="width: 100%; max-width: 480px; background-color: #111827 !important; border: 1px solid #1f2937 !important; border-radius: 1.5rem; padding: 40px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);">
            {{ $slot }}
        </div>
    </div>
</body>
</html>