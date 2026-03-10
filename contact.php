<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

$TO_EMAIL   = 'mariasaif3072005@gmail.com';        
$SMTP_USER  = 'mariasaif3072005@gmail.com';        
$SMTP_PASS = 'nblyijowlrozkagw';  

$successMsg = "";
$errorMsg   = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name    = trim($_POST['name'] ?? '');
  $email   = trim($_POST['email'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if ($name === '' || $email === '' || $message === '') {
    $errorMsg = "❌ الرجاء تعبئة جميع الحقول.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = "❌ صيغة البريد الإلكتروني غير صحيحة.";
  } else {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = $SMTP_USER;
      $mail->Password   = $SMTP_PASS;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->CharSet = 'UTF-8';
      $mail->isHTML(false);

      $mail->setFrom($SMTP_USER, 'AI Port Master');
      $mail->addAddress($TO_EMAIL);
      $mail->addReplyTo($email, $name);

      $mail->Subject = 'AI Port Master — رسالة جديدة (Contact)';
      $mail->Body =
        "الاسم: $name\n" .
        "البريد: $email\n\n" .
        "الرسالة:\n$message\n\n" .
        "التاريخ: " . date("Y-m-d H:i:s");

      $mail->send();
      $successMsg = "✅ تم إرسال رسالتك بنجاح! بنرد عليك قريبًا.";
    } catch (Exception $e) {
      $errorMsg = "❌ فشل الإرسال: " . $mail->ErrorInfo; 
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AI Port Master • تواصل معنا</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    html { scroll-behavior: smooth; }
    body { direction: rtl; }

    .bg-anim{
      background: radial-gradient(1200px 600px at 20% 10%, rgba(0,229,255,0.14), transparent 60%),
                  radial-gradient(900px 500px at 80% 20%, rgba(106,56,251,0.16), transparent 55%),
                  linear-gradient(180deg, #07121E 0%, #05070C 60%, #000 100%);
    }
    .glass{
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.10);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
    }
    .neon{
      box-shadow:
        0 0 0 1px rgba(0,229,255,0.15),
        0 0 30px rgba(0,229,255,0.10),
        0 0 60px rgba(106,56,251,0.10);
    }
  </style>
</head>

<body class="text-white bg-black">

  <header class="fixed top-0 w-full z-50">
    <nav class="mx-auto max-w-6xl px-4">
      <div class="mt-4 glass neon rounded-2xl px-5 py-3 flex items-center justify-between">
        <a href="index.html" class="flex items-center gap-3">
          <div class="h-9 w-9 rounded-xl bg-cyan-500/15 border border-cyan-300/20 flex items-center justify-center">
            <span class="text-cyan-300 font-bold">AI</span>
          </div>
          <div>
            <div class="font-extrabold tracking-wide">AI Port Master</div>
            <div class="text-xs text-gray-400 -mt-0.5">تواصل معنا</div>
          </div>
        </a>

        <div class="hidden md:flex items-center gap-7 text-sm text-gray-200">
          <a href="index.html#features" class="hover:text-cyan-300 transition">المميزات</a>
          <a href="dashboard.html" class="hover:text-cyan-300 transition">لوحة التحكم</a>
          <a href="how.html" class="hover:text-cyan-300 transition">كيف يعمل</a>
          <a href="contact.php" class="text-cyan-300 transition">تواصل معنا</a>
          <a href="incident.html" class="hover:text-cyan-300 transition">البلاغات الذكية</a>
          <a href="shift.html" class="hover:text-cyan-300 transition">تخطيط الشفتات</a>
          <a href="energy.html" class="hover:text-cyan-300 transition">محسن الطاقة</a>
          <a href="training.html" class="hover:text-cyan-300 transition">التدريب الذكي</a>
          <a href="maintenance.html" class="hover transition">الصيانة التنبؤية</a>
    
        </div>

        <div class="flex items-center gap-2">
          <a href="dashboard.html" class="px-4 py-2 rounded-xl glass border border-white/10 hover:border-cyan-300/30 hover:text-cyan-200 transition text-sm">
            عرض الديمو
          </a>
        </div>
      </div>
    </nav>
  </header>

  <main class="bg-anim min-h-screen pt-28">
    <div class="mx-auto max-w-6xl px-4 py-10">

      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold">
          تواصل <span class="text-cyan-300">معنا</span>
        </h1>
        <p class="mt-4 text-gray-300 max-w-2xl mx-auto">
          اترك بياناتك وسنتواصل معك بخصوص تجربة المنصة أو مناقشة التكامل مع أنظمة الميناء.
        </p>
      </div>

      <div class="mt-10 max-w-xl mx-auto glass neon rounded-3xl p-7">
        <?php if ($successMsg): ?>
          <div class="mb-4 text-emerald-300 font-semibold text-center"><?= htmlspecialchars($successMsg) ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
          <div class="mb-4 text-rose-300 font-semibold text-center"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form method="POST" class="grid gap-4">
          <input name="name" required
            class="w-full px-4 py-3 rounded-2xl bg-white/5 border border-white/10 outline-none focus:border-cyan-300/40"
            placeholder="الاسم الكامل" />

          <input name="email" type="email" required
            class="w-full px-4 py-3 rounded-2xl bg-white/5 border border-white/10 outline-none focus:border-cyan-300/40"
            placeholder="البريد الإلكتروني" />

          <textarea name="message" rows="4" required
            class="w-full px-4 py-3 rounded-2xl bg-white/5 border border-white/10 outline-none focus:border-cyan-300/40"
            placeholder="رسالتك (طلب تجربة، استفسار، اقتراح...)"></textarea>

          <button type="submit"
            class="mt-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-cyan-400 to-violet-500 text-black font-semibold hover:opacity-90 transition">
            إرسال الطلب
          </button>

          <div class="mt-4 text-xs text-gray-400 text-center">
            * صفحة عرض توضيحية (Demo) — يتم الإرسال عبر البريد الإلكتروني.
          </div>
        </form>
      </div>

      <footer class="py-10 text-center text-gray-500">
        <p class="text-lg">جاهزون لتحويل الموانئ إلى أنظمة ذكية</p>
        <p class="mt-3">© 2025 AI Port Master</p>
      </footer>

    </div>
  </main>
<script src="assets/js/public-chat-widget.js"></script>
</body>
</html>
