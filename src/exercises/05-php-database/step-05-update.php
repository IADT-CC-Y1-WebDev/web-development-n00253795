<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 5: UPDATE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-05-update.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 5: UPDATE Operations</h1>

        <h2>Task</h2>
        <p>Update an existing book's description.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>First, display the current details of book ID 1</li>
            <li>Update the description to include a timestamp</li>
            <li>Check <code>rowCount()</code> to verify the update worked</li>
            <li>Display the updated book details</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Fetch and display book ID 1
            // 2. Prepare: UPDATE books SET description = :description WHERE id = :id
            // 3. Execute with new description + timestamp
            // 4. Check rowCount()
            // 5. Fetch and display updated book 

            try {

                $selectStmt = $db->prepare("SELECT * FROM books WHERE id = :id");
                $selectStmt->execute(['id' => 1]);
                $book = $selectStmt->fetch(PDO::FETCH_ASSOC);

                if (!$book) {
                    throw new Exception("Book with ID 1 not found.");
                }

                echo "<h3>Current Book Details:</h3>";
                echo "Title: " . $book['title'] . "<br>";
                echo "Author: " . $book['author'] . "<br>";
                echo "Year: " . $book['year'] . "<br>";
                echo "Description: " . $book['description'] . "<br><br>";

                $newDescription = $book['description'] . 
                    " (Updated: " . date('Y-m-d H:i:s') . ")";

                $updateStmt = $db->prepare("
                    UPDATE books
                    SET description = :description
                    WHERE id = :id
                ");

                $updateStmt->execute([
                    'description' => $newDescription,
                    'id' => 1
                ]);

                if ($updateStmt->rowCount() === 0) {
                    throw new Exception("No rows updated - book may not exist.");
                }

                echo "<h3>Update Successful!</h3>";
                echo "Rows affected: " . $updateStmt->rowCount() . "<br><br>";

                $selectStmt->execute(['id' => 1]);
                $updatedBook = $selectStmt->fetch(PDO::FETCH_ASSOC);

                echo "<h3>Updated Book Details:</h3>";
                echo "Title: " . $updatedBook['title'] . "<br>";
                echo "Author: " . $updatedBook['author'] . "<br>";
                echo "Year: " . $updatedBook['year'] . "<br>";
                echo "Description: " . $updatedBook['description'] . "<br>";

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            ?>
        </div>
    </div>
</body>
</html>
