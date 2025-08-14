<?php 
//app/views/forgot_password.php
include 'header.php'; ?>

<div class="grid-container">
    <div class="grid-left">
        <h1>Forgot Password</h1>
        <?php if (!empty($message)): ?>
            <div style="color:green;"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit" name="request_reset">Request Password Reset</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/tai-password-strength@1.1.3/lib/password-strength.js"></script>
<script>
  const passwordInput = document.querySelector('input[name="req_password"]');
  const strengthIndicator = document.createElement('div');
  passwordInput.parentNode.appendChild(strengthIndicator);

  passwordInput.addEventListener('input', () => {
      const result = taiPasswordStrength(passwordInput.value);
      strengthIndicator.textContent = 'Strength: ' + result.strength;
  });
</script>
