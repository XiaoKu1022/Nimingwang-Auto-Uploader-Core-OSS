<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Elements with CSS Styling</title>
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
            border-left: 5px solid #fff;
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

    <!-- Form -->
    <div class="container animated">
        <h1>Welcome to Our Website</h1>
        <p>This is a sample of a dark-themed website template with animations. Feel free to customize it to your needs!</p>
        <form>
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email">
            <textarea placeholder="Message" rows="5"></textarea>
            <input type="submit" value="Submit">
        </form>
        <p>Visit our <a href="#">About Us</a> page to learn more.</p>
    </div>

    <!-- Additional Features -->
    <div class="container animated">
        <div class="feature">
            <h2>Feature 1</h2>
            <p>This is a description of Feature 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="feature">
            <h2>Feature 2</h2>
            <p>This is a description of Feature 2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="feature">
            <h2>Feature 3</h2>
            <p>This is a description of Feature 3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>

    <!-- HTML Elements -->
    <div class="container">
        <!-- Headings -->
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>

        <!-- Paragraph -->
        <p>This is a paragraph of text.</p>

        <!-- Unordered List -->
        <ul>
            <li>List Item 1</li>
            <li>List Item 2</li>
            <li>List Item 3</li>
        </ul>

        <!-- Ordered List -->
        <ol>
            <li>List Item 1</li>
            <li>List Item 2</li>
            <li>List Item 3</li>
        </ol>

        <!-- Button -->
        <button>Button</button>

        <!-- Image -->
        <img src="https://via.placeholder.com/400" alt="Placeholder Image">

        <!-- Horizontal Rule -->
        <hr>

        <!-- Table -->
        <table>
            <tr>
                <th>Header 1</th>
                <th>Header 2</th>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
            </tr>
            <tr>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
        </table>

        <!-- Blockquote -->
        <blockquote>This is a quote.</blockquote>

        <!-- Form Elements -->
        <input type="text" placeholder="Input Text">
        <input type="email" placeholder="Input Email">
        <textarea placeholder="Textarea"></textarea>
        <select>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        </select>

        <!-- Link -->
        <p><a href="#">Link</a></p>
    </div>
</body>
</html>
