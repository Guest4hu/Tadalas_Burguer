<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tadallas Burguer - Acesso</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    :root {
      --bg: #121212;
      --card: #1c1c1c;
      --text: #f5f5f5;
      --muted: #cfcfcf;
      --accent: #e63946;
      --accent-strong: #d62839;
      --border: #2a2a2a;
      --gold: #ffd60a;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: radial-gradient(1200px 600px at 20% -10%, rgba(230,57,70,.22), transparent 60%),
                  radial-gradient(1000px 500px at 120% 20%, rgba(255,214,10,.18), transparent 55%),
                  var(--bg);
      color: var(--text);
      font-family: "Inter", "Segoe UI", Arial, sans-serif;
    }
    .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 32px 16px; }
    .auth-card {
      width: 100%;
      max-width: 460px;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0)) , var(--card);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 20px;
      padding: 28px;
      box-shadow: 0 30px 60px rgba(0,0,0,0.55);
      backdrop-filter: blur(6px);
    }
    .auth-card h1, .auth-card h2 { margin: 0 0 12px; letter-spacing: .2px; }
    .auth-card a { color: var(--muted); }
    .auth-card .w3-input {
      background: #141414;
      color: var(--text);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 10px;
    }
    .auth-card .w3-input::placeholder { color: var(--muted); }
    .auth-card .w3-button { background: linear-gradient(135deg, var(--accent), var(--accent-strong)); color: #fff; border-radius: 12px; }
    .auth-card .w3-button:hover { filter: brightness(1.05); }
    .auth-subtle { color: var(--muted); font-size: 14px; margin-bottom: 12px; }
    .brand { display: inline-flex; align-items: center; gap: 10px; font-weight: 700; margin-bottom: 18px; }
    .brand-badge { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 12px; background: rgba(255,255,255,0.06); color: var(--gold); }
    .divider { height: 1px; background: rgba(255,255,255,0.06); margin: 14px 0; }
  </style>
</head>
<body>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="brand">
        <span class="brand-badge"><i class="fa fa-cutlery" aria-hidden="true"></i></span>
        Tadallas Burguer
      </div>
      <div class="divider"></div>
