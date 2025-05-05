<?php function isStrongPassword($password) {
// Minimum 8 characters, at least 1 uppercase, 1 lowercase, 1 number, and 1 special character
$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

return preg_match($pattern, $password);
}
?>