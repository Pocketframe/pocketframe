<!DOCTYPE html>
<html>

<head>
    <title>Internal 500 Server Error</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            line-height: 1.5;
            padding: 2rem;
            text-align: center;
        }

        .error-container {
            max-width: auto;
            margin: 2rem auto;
        }

        .error-message {
            background-color: rgb(247, 214, 214);
            color: rgb(233, 15, 15);
            padding: 0.5rem;
        }

        .error-code {
            color: #dc2626;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .error-trace {
            text-align: left;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            padding: 0.5rem;
        }

        .error-trace-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">Internal 500 Server Error</div>
        <h1>Something went wrong</h1>

        <?php if ('debug'): ?>
            <div class="error-details">
                <h3 class="error-message"><?= $error->getMessage() ?></h3>
                <p><small><?= $error->getFile() ?>:<?= $error->getLine() ?></small></p>
                <div class="error-trace">
                    <div class="error-trace-title">Stack Trace</div>
                    <pre><?= $error->getTraceAsString() ?></pre>
                </div>
            </div>
        <?php else: ?>
            <p>Our team has been notified. Please try again later.</p>
        <?php endif; ?>
    </div>
</body>

</html>