<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Elements with CSS Styling</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8387353338047647"
     crossorigin="anonymous"></script> <!-- Google Ads -->
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative; /* 相對定位以便子元素定位 */
            overflow: hidden; /* 隱藏溢出內容 */
        }

        /* Heading Styles */
        h1, h2, h3, h4, h5, h6 {
            color: #fff;
            margin-top: 0;
        }

        /* Paragraph Styles */
        p {
            font-size: 16px;
            line-height: 1.6;
        }

        /* List Styles */
        ul, ol {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 10px;
        }

        /* Button Styles */
        button, input[type="submit"] {
            padding: 10px 20px;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Image Styles */
        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        /* Horizontal Rule Style */
        hr {
            border: 1px solid #fff;
            margin: 20px 0;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }

        /* Blockquote Styles */
        blockquote {
            background-color: #444;
            border-left: 5px solid #3498db;
            padding: 10px;
            margin: 10px 0;
        }

        /* Form Element Styles */
        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #444;
            border: none;
            border-radius: 5px;
            color: #fff;
            box-sizing: border-box;
        }

        /* Link Styles */
        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            color: #2980b9;
        }

        /* Top Menu Styles */
        .top-menu {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)); /* 黑色漸層 */
            padding: 15px;
        }
        .top-menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        .top-menu ul li {
            display: inline;
            margin-right: 20px;
        }
        .top-menu ul li a {
            color: #fff;
            text-decoration: none;
        }

        /* Animation Styles */
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animated {
            animation: slideIn 1s ease-out;
        }

        /* Additional Styles */
        .feature {
            background-color: #444;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .feature h2 {
            margin-top: 0;
        }
        .feature p {
            margin-bottom: 0;
        }

        /* Carousel Styles */
        .carousel {
            display: flex;
            overflow: hidden;
            transition: transform 0.5s ease;
        }
        .slide {
            flex: 0 0 auto;
            min-width: 100%;
            padding: 25px;
            box-sizing: border-box;
        }
        .carousel-control {
            position: absolute;
            top: 50%;
            color: #fff;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5); /* 半透明黑色背景 */
            border: none;
            font-size: 24px;
            z-index: 1;
            padding: 10px;
        }
        .carousel-prev {
            left: 0;
        }
        .carousel-next {
            right: 0;
        }
    </style>
</head>
<body>
    <!-- Top Menu -->
    <div class="top-menu">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>


    <!-- Additional Features -->
    <div class="container animated">
        <h1>歡迎回來！<p>濱江匿名網3.1</p></h1><hr>
        <p>請選擇匿名投稿的回覆模式</p>
        <div class="feature">
            <h2>【NEW!】AI 回覆</h2>
            <p>投稿速度快，只需30秒！但他可能笨笨的......<br><h6>( 採用 Google Gemini 1.5 Pro 模型 )</h6></p><br>
            <button>AI 回覆</button>
        </div>
        <hr><blockquote>未來將增加的新功能</blockquote>
        <div class="feature">
            <h2>小編 回覆</h2>
            <p>投稿速度慢，可能需要3天</p><br>
            <button style="background-color:#ccc;" disabled>小編 回覆</button>
        </div>
        <div class="feature">
            <h2>無 回覆</h2>
            <br>
            <button style="background-color:#ccc;" disabled>無 回覆</button>
        </div>
    </div>
</body>
</html>
