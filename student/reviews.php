<?php
require_once __DIR__ . '/../includes/functions.php';
check_role('student');


if (!isset($_GET['book_id']) || empty($_GET['book_id'])) {
    header("Location: browse_books.php");
    exit();
}

$book_id = (int) $_GET['book_id'];


$book = get_book_by_id($conn, $book_id);
if (!$book) {
    echo "<p>Book not found.</p>";
    exit();
}


$reviews = get_book_reviews($conn, $book_id);

include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <h2>Reviews for "<?php echo htmlspecialchars($book['title']); ?>"</h2>

    <?php if (!empty($reviews)): ?>
        <table>
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?php echo htmlspecialchars($review['teacher_name']); ?></td>
                    <td>
                        <span class="status approved"><?php echo htmlspecialchars($review['rating']); ?> / 5</span>
                    </td>
                    <td><?php echo htmlspecialchars($review['review_text']); ?></td>
                    <td><?php echo htmlspecialchars(explode(' ', $review['created_at'])[0]); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reviews for this book yet.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
