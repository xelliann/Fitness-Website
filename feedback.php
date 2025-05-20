<?php
include 'partials/header.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: auth/login.php");
  exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $message = trim($_POST['message']);
  $user_id = $_SESSION['user_id'];

  if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);
    if ($stmt->execute()) {
      $success = "Feedback submitted successfully!";
    } else {
      $error = "Something went wrong. Please try again.";
    }
  } else {
    $error = "Please enter a message.";
  }
}
?>

<div class="feedback-container">
  
  <div class="ex1">
    Submit Feedback
  </div>
    <?php if ($success): ?>
      <div class="success-message"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="error-message"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <textarea name="message" placeholder="Write your feedback..." required rows="6"></textarea>
      <button type="submit">Submit Feedback</button>
    </form>
  </div>
</div>
</body>
</html>
<?php
include 'partials/footer.php';
?>