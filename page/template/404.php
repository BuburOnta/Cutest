<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h3>PAGE NOT FOUND!</h3>
        <span>Sorry, but the page you are looking for has not been found on our server.</span>
        <button onclick="redirect('?page=login')">Return Home</button>
    </div>

    <style>
        @import url(assets/css/font.css);
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f4f2ff;
        }
        .container {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            width: 600px;
            background-color: #fff;
            text-align: center;

            font-family: "Inter", sans-serif;
        }
        .container h1 {
            color: red;
            font-size: 9rem;
            font-weight: normal;
        }
        .container h3 {
            color: #415F9D;
            margin: 10px 0 15px 0;
        }
        .container span {
            display: block;
        }
        .container button {
            font-family: inherit;
            margin: 65px 0 20px 0;

            color: #fff;
            background-color: #415F9D;
            font-weight: 600;
            outline: none;
            border: none;
            padding: 10px 15px;
        }
        .container button:hover {
            background-color: #333;
        }
    </style>
    <script src="assets/js/redirect.js"></script>
</body>
</html>