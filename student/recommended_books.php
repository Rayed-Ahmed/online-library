<?php
require_once __DIR__ . '/../includes/functions.php';
check_role('student');

$recommendations = get_teacher_recommendations($conn);

include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <h2>Recommended Books by Teachers</h2>

    <?php if (!empty($recommendations)): ?>
        <?php foreach ($recommendations as $teacher => $books): ?>
            <h3><?php echo htmlspecialchars($teacher); ?></h3>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Book Title</th>
                    <th>Reason</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($book['reason']); ?></td>
                        <td><?php echo htmlspecialchars(explode(' ', $book['created_at'])[0]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No recommendations yet.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
