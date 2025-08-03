<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') | Nuke</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #111111;
            color: #f2c57c;
            font-family: monospace, monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        header {
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        main {
            max-width: 640px;
            width: 100%;
        }

        a {
            color: #ffe28a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            background: none;
            border: 1px solid #f2c57c;
            color: #f2c57c;
            padding: 4px 10px;
            cursor: pointer;
            font-family: monospace;
            font-size: 1rem;
        }

        button:hover {
            background-color: #222;
        }

        ol>li {
            margin-bottom: 0.75rem;
        }

        ol.threads-list {
            padding-left: 1.25rem;
        }

        ol.threads-list>li {
            margin-bottom: 0.5rem;
        }

        .pagination {
            list-style: none;
            display: flex;
            gap: 1rem;
            padding: 0;
            justify-content: center;
            font-family: monospace;
            margin-top: 1rem;
        }

        .pagination li {
            display: inline;
        }

        .pagination li.disabled span {
            color: #666;
            cursor: default;
        }

        .pagination li a {
            color: #f2c57c;
            text-decoration: none;
            border: 1px solid #f2c57c;
            padding: 4px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination li a:hover {
            background-color: #222;
        }
    </style>
    @stack('styles')
</head>

<body>

    <header>
        <pre style="color: #ffc77b; line-height: 1;">
 _      _     _  __ _____
/ \  /|/ \ /\/ |/ //  __/
| |\ ||| | |||   / |  \  
| | \||| \_/||   \ |  /_ 
\_/  \|\____/\_|\_\\____\
        </pre>
        <p style="margin-top: 0;">A Retro Forum for Developers</p>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>