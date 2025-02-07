<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocketframe - Modern PHP Framework</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --bg: #fafafa;
            --text: #2d3748;
            --primary: #4f46e5;
            --secondary: #7c3aed;
            --accent: #f3f4f6;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Navigation */
        nav {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-secondary {
            background: white;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            padding: 8rem 0 4rem;
            text-align: center;
            background: linear-gradient(165deg, white 0%, var(--accent) 100%);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Terminal */
        .terminal {
            background: #1e293b;
            border-radius: 1rem;
            padding: 2rem;
            margin: 3rem auto;
            max-width: 800px;
            text-align: left;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .terminal-header {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .terminal-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .red {
            background: #ef4444;
        }

        .yellow {
            background: #f59e0b;
        }

        .green {
            background: #10b981;
        }

        .terminal code {
            color: #e5e7eb;
            font-family: 'Monaco', monospace;
            font-size: 0.9rem;
        }

        /* Features */
        .features {
            padding: 6rem 0;
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            padding: 2rem;
            border-radius: 1rem;
            background: white;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
        }

        /* Code Example */
        .code-example {
            padding: 6rem 0;
            background: var(--accent);
        }

        .code-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--text);
        }



        .code-block {
            background: #1e293b;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .code-block pre {
            margin: 0;
            color: #e5e7eb;
            font-family: 'Monaco', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
        }

        /* Footer */
        footer {
            background: white;
            padding: 1rem 0;
            border-top: 1px solid var(--border);
            text-align: center;
            margin-top: 10rem;
        }

        footer p {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .nav-content {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="container">
            <div class="nav-content">
                <a href="/" class="logo">Pocketframe</a>
                <div class="nav-links">
                    <a href="#docs" class="btn btn-secondary">Documentation</a>
                    <a href="#start" class="btn btn-primary">Get Started →</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1>Build Fast.<br>Ship Simple.</h1>
            <p>A lightweight, modern PHP framework designed for developers who value simplicity and performance</p>

            <div class="terminal">
                <div class="terminal-header">
                    <div class="terminal-dot red"></div>
                    <div class="terminal-dot yellow"></div>
                    <div class="terminal-dot green"></div>
                </div>
                <code>$ composer create-project pocketframe/application demo-app --stability dev </code>
            </div>

            <div class="nav-links">
                <a href="#getting-started" class="btn btn-primary">
                    <i class="fas fa-terminal"></i> Get Started
                </a>
                <a href="https://github.com/Pocketframe/pocketframe-application" class="btn btn-secondary">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </div>
        </div>
    </section>

    <!-- <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Lightweight Core</h3>
                    <p>Under 50KB initial footprint with zero bloat. Blazing fast performance for your applications.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3>Modern Architecture</h3>
                    <p>Built on PSR standards with dependency injection and a flexible middleware pipeline.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Full Stack Ready</h3>
                    <p>Everything you need including routing, ORM, authentication, and template engine.</p>
                </div>
            </div>
        </div>
    </section> -->

    <section class="code-section">
        <div class="container">
            <h2 class="code-title">Simple by Design</h2>
            <div class="code-block">
                <pre><code style="font-family: 'JetBrains Mono', 'Fira Code', monospace;"><span style="color: #6b7280">// routes/web.php</span>
<span style="color: #60a5fa">$route</span><span style="color: #94a3b8">-></span><span style="color: #60a5fa">get</span><span style="color: #94a3b8">(</span><span style="color: #a5f3fc">'/'</span><span style="color: #94a3b8">, </span><span style="color: #a5f3fc">'HomeController@index'</span><span style="color: #94a3b8">);</span>

<span style="color: #6b7280">// controller</span>

<span style="color: #60a5fa">class</span> <span style="color: #a5f3fc">HomeController</span>
<span style="color: #94a3b8">{</span>
    <span style="color: #60a5fa">public function</span> <span style="color: #a5f3fc">index</span><span style="color: #94a3b8">()</span>
    <span style="color: #94a3b8">{</span>
        <span style="color: #60a5fa">return</span> <span style="color: #60a5fa">Response</span><span style="color: #94a3b8">::</span><span style="color: #60a5fa">view</span><span style="color: #94a3b8">(</span><span style="color: #a5f3fc">'welcome'</span><span style="color: #94a3b8">, [</span>
            <span style="color: #a5f3fc">'title'</span> <span style="color: #94a3b8">=></span> <span style="color: #a5f3fc">'Welcome'</span><span style="color: #94a3b8">,</span>
            <span style="color: #a5f3fc">'message'</span> <span style="color: #94a3b8">=></span> <span style="color: #a5f3fc">'Hello from the framework!'</span>
        <span style="color: #94a3b8">]);</span>
    <span style="color: #94a3b8">}</span>
<span style="color: #94a3b8">}</span></code></pre>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>© 2024 PocketFrame. Open source under MIT license.</p>
            <div class="footer-links">
                <!-- <a href="#docs" class="btn btn-secondary">Documentation</a>
                <a href="#examples" class="btn btn-secondary">Examples</a>
                <a href="#community" class="btn btn-secondary">Community</a> -->
            </div>
        </div>
    </footer>
</body>

</html>