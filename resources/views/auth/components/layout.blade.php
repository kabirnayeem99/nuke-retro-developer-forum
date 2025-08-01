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
            background: #121212;
            /* dark, easy on eyes */
            color: #FFB347;
            /* pastel orange/yellow */
            font-family: monospace, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form {
            min-width: 320px;
            max-width: 420px;
            width: 90%;
            margin-bottom: 10px;
            color: #FFD580;
            /* softer orange text for inputs/labels */
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            background: #1E1E1E;
            /* dark input bg */
            border: 1px solid #FFB347;
            color: #FFD580;
            font-family: monospace, monospace;
            padding: 6px;
        }

        button {
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
            font-family: monospace, monospace;
            cursor: pointer;
            background-color: #FFB347;
            border: none;
            color: #121212;
            font-weight: bold;
        }

        button:hover {
            background-color: #E89C2E;
        }

        .error {
            color: #FF6B6B;
            font-size: 0.8rem;
            margin-top: 2px;
            margin-bottom: 10px;
        }
    </style>
    @stack('styles')
</head>

<body>
    <pre style="font-family: monospace; text-align: center; margin-bottom: 1rem; line-height: 1; color: #FFCBA4;">
 _      _     _  __ _____
/ \  /|/ \ /\/ |/ //  __/
| |\ ||| | |||   / |  \  
| | \||| \_/||   \ |  /_ 
\_/  \|\____/\_|\_\\____\
    </pre>
    @yield('content')
</body>

</html>