<?php
include 'db.php';

// Check if a category is selected, else show all articles
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch articles based on category (if selected)
if ($category) {
    $sql = "SELECT * FROM articles WHERE category = '$category' ORDER BY created_at DESC";
} else {
    // Fetch all articles if no category is selected
    $sql = "SELECT * FROM articles ORDER BY created_at DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CNN Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #dc3545;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .nav {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }
        .category {
            background-color: #eee;
            padding: 10px;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
        .news-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .news-article {
            background-color: white;
            padding: 20px;
            margin: 10px;
            width: 30%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .news-article h2 {
            font-size: 20px;
            color: #333;
        }
        .news-article p {
            color: #555;
        }
        .date {
            font-size: 14px;
            color: gray;
        }
        .footer {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to My CNN Clone</h1>
</header>

<div class="container">
    <!-- Navigation Menu with categories -->
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="index.php?category=Politics">Politics</a>
        <a href="index.php?category=Sports">Sports</a>
        <a href="index.php?category=Entertainment">Entertainment</a>
        <a href="index.php?category=Health">Health</a>
        <a href="index.php?category=Technology">Technology</a>
    </div>

    <!-- Category Section -->
    <div class="category">
        <h2>Articles</h2>
        <?php if ($category) { echo "<h3>Category: " . htmlspecialchars($category) . "</h3>"; } ?>
    </div>

    <div class="news-section">
        <?php
        // Fetch and display the articles
        while ($row = $result->fetch_assoc()) {
            echo "<div class='news-article'>";

            // Title and Date
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p class='date'>Published on: " . date('F j, Y', strtotime($row['created_at'])) . "</p>";

            // Content (first 250 characters)
            echo "<p>" . substr($row['content'], 0, 250) . "...</p>"; 
            echo "<a href='article.php?id=" . $row['id'] . "'>Read more</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2025 CNN Clone | All rights reserved</p>
</footer>

</body>
</html>
