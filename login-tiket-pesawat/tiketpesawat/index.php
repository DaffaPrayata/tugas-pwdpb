<?php
include 'koneksi.php';
session_start();

$loginMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email)) {
        $loginMessage = 'Harap masukkan email Anda';
    } elseif (empty($password)) {
        $loginMessage = 'Harap masukkan kata sandi';
    } else {

        // contoh login sederhana
        $_SESSION['email'] = $email;

        header("Location: tiket.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travelok Login</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap');
    * { box-sizing: border-box; margin: 0; padding: 0; }

    .wrap {
      min-height: 100vh;
      display: flex;
      font-family: 'DM Sans', sans-serif;
      position: relative;
      overflow: hidden;
    }

    .bg-scene {
      position: absolute; inset: 0;
      background: linear-gradient(180deg,
        #0d1b3e 0%,
        #1a2f5e 18%,
        #2a4a8a 32%,
        #4a7abf 44%,
        #6fa0d8 52%,
        #b8d4ef 60%,
        #ddeaf8 66%,
        #f0f7ff 70%,
        #e8f4ff 75%,
        #c8dff0 80%,
        #a0c5e0 85%,
        #6a9fbf 90%,
        #3a6f9a 95%,
        #1a4a6e 100%
      );
    }

    .sun {
      position: absolute;
      width: 180px; height: 180px;
      border-radius: 50%;
      background: radial-gradient(circle, #fff8e0 0%, #ffd966 30%, #ffaa20 60%, transparent 75%);
      top: 62%; left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.85;
    }

    .sun-rays {
      position: absolute;
      width: 420px; height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,220,100,0.25) 0%, transparent 65%);
      top: 62%; left: 50%;
      transform: translate(-50%, -50%);
    }

    .clouds-layer {
      position: absolute; inset: 0; pointer-events: none;
    }

    .stars {
      position: absolute; top: 0; left: 0; right: 0; height: 40%;
      pointer-events: none;
    }

    .star {
      position: absolute;
      width: 2px; height: 2px;
      background: white;
      border-radius: 50%;
      animation: twinkle 3s infinite alternate;
    }

    @keyframes twinkle { from { opacity: 0.2; } to { opacity: 0.9; } }

    .plane-wrap {
      position: absolute;
      top: 28%;
      left: 55%;
      transform: translateX(-50%);
      animation: flyacross 18s linear infinite;
      pointer-events: none;
    }

    @keyframes flyacross {
      0%   { left: -10%; top: 35%; opacity: 0; }
      5%   { opacity: 1; }
      50%  { top: 22%; }
      95%  { opacity: 1; }
      100% { left: 110%; top: 14%; opacity: 0; }
    }

    .contrail {
      position: absolute;
      right: 100%;
      top: 50%;
      width: 180px; height: 3px;
      background: linear-gradient(to left, rgba(255,255,255,0.6), transparent);
      transform: translateY(-50%);
      border-radius: 2px;
    }

    .ocean {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 22%;
      background: linear-gradient(180deg, #1a4a6e, #0d2a45);
      border-radius: 50% 50% 0 0 / 20px 20px 0 0;
    }

    .ocean-shimmer {
      position: absolute;
      top: 20%; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), rgba(255,220,100,0.4), rgba(255,255,255,0.25), transparent);
      border-radius: 2px;
    }

    .login-panel {
      position: relative;
      z-index: 10;
      margin: auto;
      width: 420px;
      background: rgba(8, 18, 40, 0.62);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 0.5px solid rgba(255,255,255,0.18);
      border-radius: 20px;
      padding: 44px 40px;
      box-shadow: 0 32px 80px rgba(0,0,0,0.4);
    }

    .brand {
      display: flex; align-items: center; gap: 11px;
      margin-bottom: 28px;
    }

    .brand-icon {
      width: 38px;
      height: 38px;
      background: linear-gradient(135deg, #e8c97d, #fff9ee);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(232, 201, 125, 0.25);
      border: 1px solid rgba(232, 201, 125, 0.4);
      backdrop-filter: blur(10px);
    }

    .brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 20px; font-weight: 700;
      color: #f0e8d0; letter-spacing: 1.5px;
    }

    .form-title {
      font-family: 'Playfair Display', serif;
      font-size: 28px; font-weight: 700;
      color: #fff;
      margin-bottom: 6px;
    }

    .form-sub {
      font-size: 13px; font-weight: 300;
      color: rgba(255,255,255,0.45);
      margin-bottom: 32px;
    }

    .field-group { margin-bottom: 16px; }

    .field-label {
      display: block;
      font-size: 11px; font-weight: 500;
      letter-spacing: 0.8px; text-transform: uppercase;
      color: rgba(255,255,255,0.4);
      margin-bottom: 7px;
    }

    .field-wrap { position: relative; }

    .field-input {
      width: 100%;
      padding: 13px 16px 13px 44px;
      background: rgba(255,255,255,0.07);
      border: 0.5px solid rgba(255,255,255,0.14);
      border-radius: 10px;
      font-size: 14px; color: #fff;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color 0.2s, background 0.2s;
    }

    .field-input::placeholder { color: rgba(255,255,255,0.25); }

    .field-input:focus {
      border-color: rgba(232,201,125,0.55);
      background: rgba(255,255,255,0.11);
    }

    .fi { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none; }

    .eye-btn {
      position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
      background: none; border: none; cursor: pointer;
      font-size: 13px; color: rgba(255,255,255,0.3);
      transition: color 0.2s; padding: 0;
    }
    .eye-btn:hover { color: rgba(255,255,255,0.7); }

    .options-row {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 26px;
    }

    .check-label {
      display: flex; align-items: center; gap: 8px;
      font-size: 13px; color: rgba(255,255,255,0.45); cursor: pointer;
    }
    .check-label input { accent-color: #e8c97d; cursor: pointer; }

    .forgot { font-size: 13px; color: #e8c97d; text-decoration: none; opacity: 0.8; }
    .forgot:hover { opacity: 1; }

    .submit-btn {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, #e8c97d, #c8953a);
      border: none; border-radius: 10px;
      font-size: 14px; font-weight: 500;
      color: #0a0f1e;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      transition: opacity 0.2s, transform 0.1s;
      letter-spacing: 0.4px;
    }
    .submit-btn:hover { opacity: 0.9; }
    .submit-btn:active { transform: scale(0.99); }

    .sep { display: flex; align-items: center; gap: 10px; margin: 20px 0; }
    .sep-line { flex: 1; height: 0.5px; background: rgba(255,255,255,0.1); }
    .sep-txt { font-size: 12px; color: rgba(255,255,255,0.22); }

    .social-row { display: flex; gap: 10px; }

    .soc-btn {
      flex: 1; padding: 11px;
      background: rgba(255,255,255,0.06);
      border: 0.5px solid rgba(255,255,255,0.1);
      border-radius: 10px;
      font-size: 13px; color: rgba(255,255,255,0.55);
      font-family: 'DM Sans', sans-serif; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 7px;
      transition: background 0.2s;
    }
    .soc-btn:hover { background: rgba(255,255,255,0.11); color: rgba(255,255,255,0.85); }

    .signup-row { text-align: center; margin-top: 22px; font-size: 13px; color: rgba(255,255,255,0.3); }
    .signup-row a { color: #e8c97d; text-decoration: none; font-weight: 500; }

    .toast {
      position: fixed; top: 22px; right: 22px; z-index: 999;
      background: rgba(15,28,55,0.95);
      border: 0.5px solid rgba(232,201,125,0.3);
      border-radius: 10px; padding: 13px 18px;
      font-size: 13px; color: #f0e8d0;
      opacity: 0; transform: translateY(-8px);
      transition: all 0.28s; pointer-events: none;
    }
    .toast.show { opacity: 1; transform: translateY(0); }
  </style>
</head>
<body>

<div class="wrap">
  <div class="bg-scene"></div>
  <div class="stars" id="stars"></div>
  <div class="sun-rays"></div>
  <div class="sun"></div>

  <svg class="clouds-layer" viewBox="0 0 1200 700" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
    <g opacity="0.55">
      <ellipse cx="120" cy="110" rx="100" ry="30" fill="white"/>
      <ellipse cx="160" cy="95" rx="70" ry="26" fill="white"/>
      <ellipse cx="80" cy="105" rx="55" ry="20" fill="white"/>
    </g>
    <g opacity="0.45">
      <ellipse cx="980" cy="130" rx="110" ry="28" fill="white"/>
      <ellipse cx="1030" cy="112" rx="80" ry="24" fill="white"/>
      <ellipse cx="940" cy="126" rx="60" ry="18" fill="white"/>
    </g>
    <g opacity="0.3">
      <ellipse cx="500" cy="70" rx="90" ry="22" fill="white"/>
      <ellipse cx="540" cy="57" rx="60" ry="18" fill="white"/>
    </g>
    <g opacity="0.75">
      <ellipse cx="200" cy="440" rx="180" ry="42" fill="white"/>
      <ellipse cx="280" cy="415" rx="130" ry="35" fill="white"/>
      <ellipse cx="120" cy="430" rx="90" ry="28" fill="white"/>
    </g>
    <g opacity="0.65">
      <ellipse cx="1000" cy="430" rx="170" ry="38" fill="white"/>
      <ellipse cx="1060" cy="408" rx="110" ry="30" fill="white"/>
      <ellipse cx="920" cy="425" rx="80" ry="25" fill="white"/>
    </g>
    <g opacity="0.55">
      <ellipse cx="600" cy="455" rx="160" ry="36" fill="rgba(255,240,200,0.9)"/>
      <ellipse cx="650" cy="432" rx="110" ry="28" fill="rgba(255,240,200,0.9)"/>
    </g>
  </svg>

  <div class="plane-wrap">
    <div class="contrail"></div>
    <svg width="70" height="32" viewBox="0 0 70 32" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M8 16 Q30 10 62 14 Q66 15 66 16 Q66 17 62 18 Q30 22 8 16Z" fill="white" opacity="0.95"/>
      <path d="M62 14 Q70 15 70 16 Q70 17 62 18Z" fill="#dde8f5"/>
      <path d="M28 15 L18 4 L14 4 L22 15Z" fill="white" opacity="0.9"/>
      <path d="M28 17 L18 28 L14 28 L22 17Z" fill="#eaf0f8" opacity="0.85"/>
      <path d="M12 15 L6 7 L4 8 L10 16Z" fill="white" opacity="0.8"/>
      <path d="M12 17 L6 23 L4 22 L10 16Z" fill="#eaf0f8" opacity="0.75"/>
      <ellipse cx="24" cy="14" rx="5" ry="2.5" fill="#c8d8ea" opacity="0.9"/>
      <ellipse cx="24" cy="18" rx="5" ry="2.5" fill="#b8ccde" opacity="0.85"/>
      <circle cx="50" cy="15" r="1.4" fill="#b8d0e8" opacity="0.7"/>
      <circle cx="44" cy="15" r="1.4" fill="#b8d0e8" opacity="0.7"/>
      <circle cx="38" cy="15.2" r="1.3" fill="#b8d0e8" opacity="0.6"/>
    </svg>
  </div>

  <div class="ocean">
    <div class="ocean-shimmer"></div>
  </div>

  <div class="login-panel">
    <div class="brand">
      <div class="brand-icon">
        <img src="airplane.png" alt="Travelok" width="20" height="20" />
      </div>
      <span class="brand-name">Travelok</span>
    </div>

    <div class="form-title">Selamat datang</div>
    <div class="form-sub">Masuk dan mulai perjalananmu</div>

    <form method="POST">
      <div class="field-group">
        <label class="field-label">Alamat Email</label>
        <div class="field-wrap">
          <span class="fi">📧</span>
          <input class="field-input" type="email" name="email" placeholder="nama@email.com" required />
        </div>
      </div>

      <div class="field-group">
        <label class="field-label">Kata Sandi</label>
        <div class="field-wrap">
          <span class="fi">🔒</span>
          <input class="field-input" type="password" id="pass-in" name="password" placeholder="Masukkan kata sandi" required style="padding-right:42px" />
          <button type="button" class="eye-btn" id="eye-btn" onclick="togglePass()">👁</button>
        </div>
      </div>

      <div class="options-row">
        <label class="check-label">
          <input type="checkbox" name="remember" /> Ingat saya
        </label>
        <a href="#" class="forgot">Lupa kata sandi?</a>
      </div>

      <button type="submit" class="submit-btn">Masuk ke Akun</button>
    </form>

    <div class="sep">
      <div class="sep-line"></div>
      <span class="sep-txt">atau lanjutkan dengan</span>
      <div class="sep-line"></div>
    </div>

    <div class="social-row">
      <button type="button" class="soc-btn" onclick="showToast('Masuk dengan Google')">
        <svg width="14" height="14" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Google
      </button>
      <button type="button" class="soc-btn" onclick="showToast('Masuk dengan Apple')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
        Apple
      </button>
    </div>

    <div class="signup-row">
      Belum punya akun? <a href="#" onclick="showToast('Arahkan ke halaman daftar')">Daftar sekarang</a>
    </div>
  </div>
</div>

<?php if ($loginMessage): ?>
  <div class="toast show" id="toast"><?php echo htmlspecialchars($loginMessage); ?></div>
<?php else: ?>
  <div class="toast" id="toast"></div>
<?php endif; ?>

<script>
  var stars = document.getElementById('stars');
  for (var i = 0; i < 60; i++) {
    var s = document.createElement('div');
    s.className = 'star';
    s.style.left = Math.random() * 100 + '%';
    s.style.top = Math.random() * 100 + '%';
    s.style.animationDelay = Math.random() * 4 + 's';
    s.style.opacity = Math.random() * 0.6 + 0.1;
    var sz = Math.random() < 0.3 ? '3px' : '2px';
    s.style.width = sz; s.style.height = sz;
    stars.appendChild(s);
  }

  var passVis = false;
  function togglePass() {
    passVis = !passVis;
    document.getElementById('pass-in').type = passVis ? 'text' : 'password';
    document.getElementById('eye-btn').style.color = passVis ? 'rgba(255,255,255,0.75)' : 'rgba(255,255,255,0.3)';
  }

  var tt;
  function showToast(msg) {
    var t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(tt);
    tt = setTimeout(function() { t.classList.remove('show'); }, 2800);
  }

  <?php if ($loginMessage): ?>
    setTimeout(function() {
      document.getElementById('toast').classList.remove('show');
    }, 2800);
  <?php endif; ?>
</script>

</body>
</html>