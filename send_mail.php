<?php

// send_mail.php
header('Content-Type: application/json; charset=UTF-8');

// ----- PHPMailer manual includes (no Composer) -----
define('PHPMAILER_SRC', __DIR__ . '/src/');
require_once PHPMAILER_SRC . 'Exception.php';
require_once PHPMAILER_SRC . 'PHPMailer.php';
require_once PHPMAILER_SRC . 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ----- Helpers -----
function json_ok(array $extra = []) { echo json_encode(['ok'=>true] + $extra); exit; }
function json_fail($msg, $code=400){ http_response_code($code); echo json_encode(['ok'=>false,'message'=>$msg]); exit; }
function clean($v){ return trim((string)$v); }
function valid_email($v){ return (bool)filter_var($v, FILTER_VALIDATE_EMAIL); }
function valid_phone($v){ return (bool)preg_match('/^[0-9+\s\-\(\)]{7,20}$/', $v); }

// ----- Only POST -----
if ($_SERVER['REQUEST_METHOD'] !== 'POST') json_fail('Method not allowed', 405);

// ----- Accept FormData or JSON -----
$input = $_POST ?: (json_decode(file_get_contents('php://input'), true) ?: []);

// ----- Retrieve + sanitize -----
$name     = clean($input['name'] ?? '');
$email    = clean($input['email'] ?? '');
$phone    = clean($input['phone'] ?? '');
$subject  = clean($input['subject'] ?? 'New Contact Message from Website'); //  Subject from frontend (fallback if empty)
$message  = clean($input['message'] ?? '');
$honeypot = clean($input['website'] ?? '');

// ----- Basic validation -----
if ($honeypot !== '') json_fail('Spam detected.', 422);
if ($name==='' || $email==='' || $phone==='' || $message==='') {
    json_fail('Please provide name, email, phone, subject, and message.', 422);
}
if (!valid_email($email))  json_fail('Please provide a valid email address.', 422);
if (!valid_phone($phone))  json_fail('Please provide a valid phone number.', 422);

// ----- Build email content -----
$bodyHtml = <<<HTML
<h2>New Contact Message</h2>
<p><strong>Name:</strong> {$name}</p>
<p><strong>Email:</strong> {$email}</p>
<p><strong>Phone:</strong> {$phone}</p>
<p><strong>Subject:</strong> {$subject}</p>
<hr>
<p style="white-space:pre-wrap;">{$message}</p>
HTML;

// ✅ DEFINE YOUR DESTINATION (this was missing)
$TO_EMAIL = 'info@jamiafaizulquran.com';
$TO_NAME  = 'Asadullah Shah • Jamia faiz ul quran';

// Guard against empty/invalid address
if (!filter_var($TO_EMAIL, FILTER_VALIDATE_EMAIL)) {
  json_fail('Server misconfigured: invalid destination email.', 500);
}

// ----- Send (NO SMTP; use server's local mailer) -----
$mail = new PHPMailer(true);
try {
  $mail->isMail(); // or $mail->isSendmail();

  $mail->CharSet = 'UTF-8';

  // From should be your domain mailbox
  $mail->setFrom('info@jamiafaizulquran.com', 'Website Contact');
  $mail->Sender = 'info@jamiafaizulquran.com'; // Return-Path

  // To (your inbox)
  $mail->addAddress($TO_EMAIL, $TO_NAME);

  // Let you reply to the visitor
  $mail->addReplyTo($email, $name);

  // Content
  $mail->isHTML(true);
  $mail->Subject = $subject; // ✅ subject from frontend
  $mail->Body    = $bodyHtml;
  $mail->AltBody = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\n\n{$message}";

  $mail->send();
  json_ok(['message' => 'Message sent. Thank you!']);
} catch (Exception $e) {
  json_fail('Mailer Error: ' . $mail->ErrorInfo, 500);
}
