<?php 
//app/views/flash_messages.php
if (!empty($_SESSION['flash_message'])): ?>
    <?php
        $type = $_SESSION['flash_message']['type'] ?? 'info';
        $text = $_SESSION['flash_message']['text'] ?? '';
        // Remove message so it doesn't show again
        unset($_SESSION['flash_message']);
    ?>
    <div class="flash-message flash-<?= htmlspecialchars($type) ?>" data-duration="5000">
        <?= htmlspecialchars($text) ?>
        <span class="countdown"></span>
    </div>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const messages = document.querySelectorAll('.flash-message');

    messages.forEach(msg => {
        let duration = parseInt(msg.getAttribute('data-duration')) || 10000;
        let countdownSpan = msg.querySelector('.countdown');

        // Initialize countdown
        let timeLeft = duration / 1000;
        countdownSpan.textContent = ` (${timeLeft}s)`;

        // Update countdown every second
        const interval = setInterval(() => {
            timeLeft -= 1;
            if (timeLeft > 0) {
                countdownSpan.textContent = ` (${timeLeft}s)`;
            } else {
                countdownSpan.textContent = '';
                clearInterval(interval);
            }
        }, 1000);

        // Remove message after duration
        setTimeout(() => {
            msg.remove();
        }, duration);
    });
});
</script>
