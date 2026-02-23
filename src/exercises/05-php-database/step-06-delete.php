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
    <title>Exercise 6: DELETE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-06-delete.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 6: DELETE Operations</h1>

        <h2>Task</h2>
        <p>Create a temporary book and then delete it.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Insert a new temporary book</li>
            <li>Display the book's ID</li>
            <li>Delete the book using a prepared statement</li>
            <li>Verify the deletion by trying to fetch it again</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. INSERT a temporary book
            // 2. Get the new ID
            // 3. Display "Created book with ID: X"
            // 4. DELETE FROM books WHERE id = :id
            // 5. Check rowCount()
            // 6. Try to fetch the book again to verify deletion


        try {
            $insertStmt = $db->prepare("
                INSERT INTO books (title, author, publisher_id, year, description)
                VALUES (:title, :author, :publisher_id, :year, :description)
            ");

            $insertStmt->execute([
                'title' => 'Temporary Book',
                'author' => 'Test Author',
                'publisher_id' => 1,
                'year' => 2024,
                'description' => 'This book will be deleted shortly.'
            ]);

            if ($insertStmt->rowCount() !== 1) {
                throw new Exception("Failed to create temporary book.");
            }

            $tempBookId = $db->lastInsertId();
            echo "Created temporary book with ID: " . $tempBookId . "<br><br>";

            $deleteStmt = $db->prepare("DELETE FROM books WHERE id = :id");
            $deleteStmt->execute(['id' => $tempBookId]);

            if ($deleteStmt->rowCount() === 1) {
                echo "Deleted 1 record successfully.<br><br>";
            } else {
                echo "No record deleted.<br><br>";
            }


            $checkStmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $checkStmt->execute(['id' => $tempBookId]);
            $deletedBook = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$deletedBook) {
                echo "Verification successful: Book no longer exists.";
            } else {
                echo "Deletion failed: Book still exists.";
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

            ?>
        </div>
    </div>
</body>
</html>

