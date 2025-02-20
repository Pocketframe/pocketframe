<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>403 Forbidden - Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            stroke: #4f46e5;
        }

        .error-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            stroke: #4f46e5;
        }

        .error-code {
            font-size: 4rem;
            font-weight: 700;
            color: #4f46e5;
            margin: 0;
        }

        .error-message {
            font-size: 1.25rem;
            color: #6b7280;
            margin: 1rem 0 2rem;
        }

        .action-button {
            display: inline-block;
            background: #4f46e5;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: background 0.3s ease;
        }

        .action-button:hover {
            background: #4338ca;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Padlock Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-lock">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
            <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
        </svg>

        <h1 class="error-code">403</h1>
        <p class="error-message">
            Forbidden: You don't have permission to access this page.
        </p>
        <a href="/" class="action-button">← Return to Homepage</a>
    </div>
</body>

</html>