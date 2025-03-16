<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>404 Page Not Found - PocketFrame</title>
                <style>
                    :root {
                    --primary: #4f46e5;
                    --gray: #6b7280;
                    }
                    
                    body {
                    font-family: 'Segoe UI', system-ui, sans-serif;
                    line-height: 1.5;
                    min-height: 100vh;
                    display: grid;
                    place-items: center;
                    text-align: center;
                    background: #f8fafc;
                    color: #1e293b;
                    padding: 1rem;
                    }
                    
                    .container {
                    max-width: 600px;
                    }
                    
                    .error-code {
                    font-size: 5rem;
                    font-weight: 700;
                    color: var(--primary);
                    margin: 0;
                    line-height: 1;
                    }
                    
                    .error-message {
                    font-size: 1.5rem;
                    color: var(--gray);
                    margin: 1rem 0;
                    }
                    
                    .action-button {
                    display: inline-block;
                    margin-top: 2rem;
                    padding: 0.75rem 1.5rem;
                    background: var(--primary);
                    color: white;
                    text-decoration: none;
                    border-radius: 0.375rem;
                    transition: opacity 0.2s;
                    }
                    
                    .action-button:hover {
                    opacity: 0.9;
                    }
                    
                    .error-icon {
                    width: 120px;
                    height: 120px;
                    margin-bottom: 2rem;
                    opacity: 0.9;
                    }
                </style>
            </head>
            
            <body>
                <div class="container">
                    <svg class="error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    
                <h1 class="error-code">404</h1>
                    <p class="error-message">
                        The page you're looking for doesn't exist.
                    </p>
                    <a href="/" class="action-button">
                        ← Return to Homepage
                    </a>
                </div>
            </body>
            
        </html>
        