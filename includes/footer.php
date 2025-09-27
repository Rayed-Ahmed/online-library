<?php

?>
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Online Library System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
<?php

if (isset($conn)) {
    $conn->close();
}
?> 