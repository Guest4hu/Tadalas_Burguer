<?php

use App\Tadala\Core\Flash;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Criar Conta — Tadallas Hamburgueria</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Ctext y='52' x='6' font-size='52'%3E%F0%9F%8D%94%3C/text%3E%3C/svg%3E">

  <style>
    /* ── Design Tokens ─────────────────────────────── */
    :root {
      --bg-base: #0d0d0d;
      --bg-panel: #141414;
      --bg-card: #1a1a1a;
      --bg-card-hover: #1f1f1f;
      --border-color: rgba(255, 255, 255, 0.07);
      --border-focus: rgba(229, 57, 53, 0.6);

      --accent-red: #e53935;
      --accent-red-hover: #f44336;
      --accent-red-light: rgba(229, 57, 53, 0.12);
      --accent-red-glow: rgba(229, 57, 53, 0.25);
      --accent-gold: #ffb300;

      --text-primary: #f5f5f5;
      --text-secondary: #9e9e9e;
      --text-muted: #616161;

      --shadow-md: 0 4px 24px rgba(0, 0, 0, 0.5);
      --shadow-lg: 0 12px 48px rgba(0, 0, 0, 0.7);
      --shadow-glow: 0 0 48px rgba(229, 57, 53, 0.18);

      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 20px;

      --font-display: 'Syne', sans-serif;
      --font-body: 'DM Sans', sans-serif;

      --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
      color: var(--text-primary);
      font-family: var(--font-body);
      font-size: 15px;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Full-page background with grid ─────────────── */
    body {
      background-color: var(--bg-base);
      background-image:
        linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
      background-size: 48px 48px;
    }

    /* Red glow orbs in background */
    body::before,
    body::after {
      content: '';
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
    }

    body::before {
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.18) 0%, transparent 70%);
      top: -120px;
      left: -120px;
      filter: blur(40px);
    }

    body::after {
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(255, 179, 0, 0.08) 0%, transparent 70%);
      bottom: -100px;
      right: -100px;
      filter: blur(40px);
    }

    /* ── Layout: centered card ──────────────────────── */
    .login-layout {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    /* ── Card ───────────────────────────────────────── */
    .login-form-panel {
      width: 100%;
      max-width: 460px;
      background: var(--bg-panel);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-lg);
      padding: 2.75rem 3rem;
      box-shadow: var(--shadow-lg), 0 0 60px rgba(229, 57, 53, 0.08);
      position: relative;
      overflow: hidden;
    }

    /* Subtle top glow inside card */
    .login-form-panel::before {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(229, 57, 53, 0.1) 0%, transparent 70%);
      pointer-events: none;
    }

    /* Red top border accent */
    .login-form-panel::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--accent-red), var(--accent-gold));
      border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .form-inner {
      position: relative;
      z-index: 1;
      width: 100%;
    }

    /* Brand */
    .brand-logo {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      margin-bottom: 2.75rem;
    }

    .brand-logo a {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      text-decoration: none;
      color: inherit;
    }

    .brand-mark {
      font-size: 1.625rem;
      line-height: 1;
    }

    .brand-name-txt {
      font-family: var(--font-display);
      font-size: 1.375rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--text-primary);
    }

    /* Form heading */
    .form-heading {
      margin-bottom: 0.5rem;
    }

    .form-heading h1 {
      font-family: var(--font-display);
      font-size: 1.75rem;
      font-weight: 700;
      letter-spacing: -0.025em;
      line-height: 1.2;
    }

    .form-heading p {
      margin-top: 0.5rem;
      color: var(--text-secondary);
      font-size: 0.9375rem;
      font-weight: 300;
    }

    /* Divider */
    .divider {
      height: 1px;
      background: var(--border-color);
      margin: 1.75rem 0;
      position: relative;
    }

    .divider[data-label]::before {
      content: attr(data-label);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: var(--bg-panel);
      color: var(--text-muted);
      font-size: 0.8125rem;
      padding: 0 0.75rem;
      letter-spacing: 0.04em;
    }

    /* Fields */
    .field {
      margin-bottom: 1.25rem;
    }

    .field label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text-secondary);
      margin-bottom: 0.5rem;
      letter-spacing: 0.01em;
    }

    .field-inner {
      position: relative;
      display: flex;
      align-items: center;
    }

    .field-icon {
      position: absolute;
      left: 14px;
      width: 18px;
      height: 18px;
      fill: var(--text-muted);
      pointer-events: none;
      transition: var(--transition);
    }

    .field-inner input {
      width: 100%;
      background: var(--bg-card);
      border: 1.5px solid var(--border-color);
      border-radius: var(--radius-sm);
      color: var(--text-primary);
      font-family: var(--font-body);
      font-size: 0.9375rem;
      padding: 0.8125rem 2.75rem 0.8125rem 2.75rem;
      outline: none;
      transition: var(--transition);
      -webkit-appearance: none;
    }

    .field-inner input::placeholder {
      color: var(--text-muted);
    }

    .field-inner input:hover {
      border-color: rgba(255, 255, 255, 0.12);
      background: var(--bg-card-hover);
    }

    .field-inner input:focus {
      border-color: var(--accent-red);
      background: var(--bg-card-hover);
      box-shadow: 0 0 0 3px var(--accent-red-light);
    }

    .field-inner:focus-within .field-icon {
      fill: var(--accent-red);
    }

    /* Eye toggle */
    .btn-eye {
      position: absolute;
      right: 12px;
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      transition: var(--transition);
      border-radius: 4px;
    }

    .btn-eye:hover {
      color: var(--text-secondary);
    }

    .btn-eye svg {
      width: 18px;
      height: 18px;
      fill: currentColor;
      pointer-events: none;
    }

    /* Submit button */
    .btn-submit {
      width: 100%;
      padding: 0.9375rem;
      background: var(--accent-red);
      color: #fff;
      font-family: var(--font-display);
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      border: none;
      border-radius: var(--radius-sm);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: var(--transition);
      box-shadow: 0 4px 20px rgba(229, 57, 53, 0.35);
      margin-top: 0.5rem;
    }

    .btn-submit:hover {
      background: var(--accent-red-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(229, 57, 53, 0.5);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .btn-submit::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, transparent 50%);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .btn-submit:hover::after {
      opacity: 1;
    }

    /* Footer link */
    .login-footer-links {
      text-align: center;
      font-size: 0.875rem;
      color: var(--text-muted);
      margin-top: 1.5rem;
    }

    .login-footer-links a {
      color: var(--accent-red);
      font-weight: 600;
      text-decoration: none;
      margin-left: 0.25rem;
      transition: var(--transition);
    }

    .login-footer-links a:hover {
      color: var(--accent-red-hover);
      text-decoration: underline;
    }

    /* Error state */
    .field-error {
      font-size: 0.8125rem;
      color: #ef9a9a;
      margin-top: 0.375rem;
      display: none;
    }

    .field.has-error .field-inner input {
      border-color: rgba(229, 57, 53, 0.7);
    }

    .field.has-error .field-error {
      display: block;
    }

    /* Loading state on submit */
    .btn-submit.loading {
      opacity: 0.75;
      pointer-events: none;
    }

    .btn-submit .btn-label {
      display: block;
    }

    .btn-submit .btn-spinner {
      display: none;
    }

    .btn-submit.loading .btn-label {
      display: none;
    }

    .btn-submit.loading .btn-spinner {
      display: block;
    }

    /* Spinner */
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .spinner-ring {
      width: 20px;
      height: 20px;
      border: 2.5px solid rgba(255, 255, 255, 0.3);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 0.7s linear infinite;
      margin: 0 auto;
    }

    /* Entrance animations */
    @keyframes fadeSlideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-inner>* {
      animation: fadeSlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .brand-logo {
      animation-delay: 0.05s;
    }

    .form-heading {
      animation-delay: 0.12s;
    }

    .divider {
      animation-delay: 0.18s;
    }

    form {
      animation-delay: 0.22s;
    }

    .login-footer-links {
      animation-delay: 0.28s;
    }

    /* Password strength bar */
    .strength-bar {
      margin-top: 0.5rem;
      height: 3px;
      border-radius: 99px;
      background: var(--border-color);
      overflow: hidden;
    }

    .strength-bar-fill {
      height: 100%;
      width: 0%;
      border-radius: 99px;
      transition: width 0.3s ease, background 0.3s ease;
    }

    .strength-hint {
      font-size: 0.75rem;
      color: var(--text-muted);
      margin-top: 0.3rem;
    }

    /* ── Flash Toast ──────────────────────────────── */
    .toast {
      position: fixed;
      top: 1.25rem;
      right: 1.25rem;
      z-index: 9999;
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      padding: 1rem 1.25rem;
      border-radius: var(--radius-md);
      border: 1px solid transparent;
      max-width: 380px;
      width: calc(100% - 2.5rem);
      box-shadow: var(--shadow-lg);
      animation: toastIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) both;
      font-size: 0.9375rem;
      line-height: 1.4;
    }

    @keyframes toastIn {
      from {
        opacity: 0;
        transform: translateX(30px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes toastOut {
      from {
        opacity: 1;
        transform: translateX(0);
      }

      to {
        opacity: 0;
        transform: translateX(30px);
      }
    }

    .toast.hide {
      animation: toastOut 0.3s cubic-bezier(0.4, 0, 1, 1) forwards;
    }

    .toast--error {
      background: #1f1010;
      border-color: rgba(229, 57, 53, 0.45);
      color: #ffcdd2;
    }

    .toast--success {
      background: #0e1f12;
      border-color: rgba(67, 160, 71, 0.45);
      color: #c8e6c9;
    }

    .toast__icon {
      flex-shrink: 0;
      width: 20px;
      height: 20px;
      margin-top: 1px;
      fill: currentColor;
    }

    .toast--error .toast__icon {
      color: #ef5350;
    }

    .toast--success .toast__icon {
      color: #66bb6a;
    }

    .toast__body {
      flex: 1;
    }

    .toast__close {
      flex-shrink: 0;
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      color: inherit;
      opacity: 0.5;
      transition: opacity 0.2s;
      display: flex;
      align-items: center;
    }

    .toast__close:hover {
      opacity: 1;
    }

    .toast__close svg {
      width: 16px;
      height: 16px;
      fill: currentColor;
    }
  </style>
</head>

<body>
  <?php
  $mensagem = Flash::getAll();
  // var_dump($mensagem);
  // exit;
  if (isset($mensagem) && !empty($mensagem['message'])):
    $flashType    = htmlspecialchars($mensagem['type']    ?? 'info', ENT_QUOTES);
    $flashMessage = htmlspecialchars($mensagem['message'] ?? '',      ENT_QUOTES);
  ?>
    <div class="toast toast--<?php echo $flashType; ?>" id="flash-toast" role="alert" aria-live="assertive">
      <?php if ($flashType === 'error'): ?>
        <svg class="toast__icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
        </svg>
      <?php else: ?>
        <svg class="toast__icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" />
          <path d="M10 16.5v-9l6 4.5-6 4.5z" style="display:none" />
          <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
        </svg>
      <?php endif; ?>
      <span class="toast__body"><?php echo $flashMessage; ?></span>
      <button class="toast__close" aria-label="Fechar notificação" onclick="dismissToast()">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
        </svg>
      </button>
    </div>
  <?php endif; ?>
  <a href="#conteudo" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">Pular para o conteúdo</a>

  <div class="login-layout">

    <!-- ── Centered Card ── -->
    <main class="login-form-panel" id="conteudo">
      <div class="form-inner">

        <div class="brand-logo">
          <a href="index.php" aria-label="Página inicial Tadallas">
            <span class="brand-mark">🍔</span>
            <span class="brand-name-txt">Tadallas</span>
          </a>
        </div>

        <div class="form-heading">
          <h1>Criar nova conta</h1>
          <p>Cadastre-se para acompanhar seus pedidos</p>
        </div>

        <div class="divider"></div>

        <form id="register-form" action="/backend/register" method="POST" novalidate>
          <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect ?? '/carrinho.php', ENT_QUOTES, 'UTF-8'); ?>">

          <!-- Nome -->
          <div class="field" id="field-nome">
            <label for="nome">Nome completo</label>
            <div class="field-inner">
              <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
              </svg>
              <input id="nome" type="text" name="nome" placeholder="Seu nome completo" autocomplete="name" required>
            </div>
            <span class="field-error" role="alert">Por favor, insira seu nome.</span>
          </div>

          <!-- E-mail -->
          <div class="field" id="field-email">
            <label for="email">E-mail</label>
            <div class="field-inner">
              <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
              </svg>
              <input id="email" type="email" name="email" placeholder="seu@email.com" autocomplete="email" required>
            </div>
            <span class="field-error" role="alert">Por favor, insira um e-mail válido.</span>
          </div>

          <!-- Telefone -->
          <div class="field" id="field-telefone">
            <label for="telefone">Telefone / WhatsApp</label>
            <div class="field-inner">
              <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6.62 10.79a15.053 15.053 0 0 0 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
              </svg>
              <input id="telefone" type="tel" name="telefone" placeholder="(11) 91234-5678" autocomplete="tel" inputmode="numeric" required>
            </div>
            <span class="field-error" role="alert">Por favor, insira um telefone válido.</span>
          </div>

          <!-- Senha -->
          <div class="field" id="field-senha">
            <label for="senha">Senha</label>
            <div class="field-inner">
              <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 1C8.676 1 6 3.676 6 7v1H4v15h16V8h-2V7c0-3.324-2.676-6-6-6zm0 2c2.276 0 4 1.724 4 4v1H8V7c0-2.276 1.724-4 4-4zm0 9a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
              </svg>
              <input id="senha" type="password" name="senha" placeholder="••••••••" autocomplete="new-password" required>
              <button type="button" class="btn-eye" aria-label="Mostrar senha" id="toggle-pw">
                <svg id="eye-icon" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                </svg>
              </button>
            </div>
            <div class="strength-bar">
              <div class="strength-bar-fill" id="strength-fill"></div>
            </div>
            <span class="strength-hint" id="strength-hint"></span>
            <span class="field-error" role="alert">A senha deve ter pelo menos 6 caracteres.</span>
          </div>

          <!-- Confirmar Senha -->
          <div class="field" id="field-confirmar">
            <label for="confirmar">Confirmar senha</label>
            <div class="field-inner">
              <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 1C8.676 1 6 3.676 6 7v1H4v15h16V8h-2V7c0-3.324-2.676-6-6-6zm0 2c2.276 0 4 1.724 4 4v1H8V7c0-2.276 1.724-4 4-4zm0 9a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
              </svg>
              <input id="confirmar" type="password" name="confirmar" placeholder="••••••••" autocomplete="new-password" required>
              <button type="button" class="btn-eye" aria-label="Mostrar senha" id="toggle-pw2">
                <svg id="eye-icon2" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                </svg>
              </button>
            </div>
            <span class="field-error" role="alert">As senhas não conferem.</span>
          </div>

          <button type="submit" class="btn-submit" id="btn-submit">
            <span class="btn-label">Criar conta</span>
            <span class="btn-spinner">
              <div class="spinner-ring"></div>
            </span>
          </button>
        </form>

        <div class="divider" data-label="ou"></div>

        <div class="login-footer-links">
          Já tem uma conta?
          <!-- <a href="/backend/login?redirect=<?php //echo urlencode($redirect ?? '/carrinho.php'); 
                                                ?>">Faça o login aqui</a> -->
          <a href="/backend/login">Faça o login aqui</a>
        </div>

      </div>
    </main>

  </div>

  <script>
    // ── Phone mask (Brazil format) ──
    const telefoneInput = document.getElementById('telefone');

    function applyPhoneMask(value) {
      const digits = value.replace(/\D/g, '').slice(0, 11);
      if (digits.length <= 10) {
        return digits
          .replace(/^(\d{2})(\d)/, '($1) $2')
          .replace(/(\d{4})(\d)/, '$1-$2');
      }
      return digits
        .replace(/^(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2');
    }

    telefoneInput.addEventListener('input', (e) => {
      e.target.value = applyPhoneMask(e.target.value);
      document.getElementById('field-telefone').classList.remove('has-error');
    });

    function validatePhone(value) {
      const digits = value.replace(/\D/g, '');
      return digits.length === 10 || digits.length === 11;
    }

    // ── Toggle password visibility (senha) ──
    const eyeOpen = `<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>`;
    const eyeOff = `<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46A11.804 11.804 0 0 0 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78 3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>`;

    function setupEyeToggle(btnId, inputEl, iconEl) {
      document.getElementById(btnId).addEventListener('click', () => {
        const isPassword = inputEl.type === 'password';
        inputEl.type = isPassword ? 'text' : 'password';
        document.getElementById(iconEl).innerHTML = isPassword ? eyeOff : eyeOpen;
        document.getElementById(btnId).setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
      });
    }

    const senhaInput = document.getElementById('senha');
    const confirmarInput = document.getElementById('confirmar');

    setupEyeToggle('toggle-pw', senhaInput, 'eye-icon');
    setupEyeToggle('toggle-pw2', confirmarInput, 'eye-icon2');

    // ── Password strength ──
    // const strengthFill = document.getElementById('strength-fill');
    // const strengthHint = document.getElementById('strength-hint');

    // senhaInput.addEventListener('input', () => {
    //   const val = senhaInput.value;
    //   let score = 0;
    //   if (val.length >= 6)  score++;
    //   if (val.length >= 10) score++;
    //   if (/[A-Z]/.test(val)) score++;
    //   if (/[0-9]/.test(val)) score++;
    //   if (/[^A-Za-z0-9]/.test(val)) score++;

    //   const levels = [
    //     { pct: '0%',   color: 'transparent',  label: '' },
    //     { pct: '25%',  color: '#ef5350',       label: 'Muito fraca' },
    //     { pct: '50%',  color: '#ff9800',       label: 'Fraca' },
    //     { pct: '75%',  color: '#ffb300',       label: 'Média' },
    //     { pct: '90%',  color: '#66bb6a',       label: 'Forte' },
    //     { pct: '100%', color: '#43a047',       label: 'Muito forte' },
    //   ];

    //   const lvl = levels[score] || levels[0];
    //   strengthFill.style.width      = lvl.pct;
    //   strengthFill.style.background = lvl.color;
    //   strengthHint.textContent      = lvl.label;
    //   strengthHint.style.color      = lvl.color;

    //   document.getElementById('field-senha').classList.remove('has-error');
    // });

    // ── Form validation & loading state ──
    const form = document.getElementById('register-form');
    const btnSubmit = document.getElementById('btn-submit');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let valid = true;

      const nomeVal = document.getElementById('nome').value.trim();
      const emailVal = document.getElementById('email').value.trim();
      const senhaVal = senhaInput.value;
      const confirmarVal = confirmarInput.value;

      const fieldNome = document.getElementById('field-nome');
      const fieldEmail = document.getElementById('field-email');
      const fieldSenha = document.getElementById('field-senha');
      const fieldConfirmar = document.getElementById('field-confirmar');

      const telefoneVal = telefoneInput.value;
      const fieldTelefone = document.getElementById('field-telefone');

      // Validate nome
      if (nomeVal.length < 2) {
        fieldNome.classList.add('has-error');
        valid = false;
      } else {
        fieldNome.classList.remove('has-error');
      }

      // Validate email
      const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRe.test(emailVal)) {
        fieldEmail.classList.add('has-error');
        valid = false;
      } else {
        fieldEmail.classList.remove('has-error');
      }

      // Validate telefone
      if (!validatePhone(telefoneVal)) {
        fieldTelefone.classList.add('has-error');
        valid = false;
      } else {
        fieldTelefone.classList.remove('has-error');
      }

      // Validate senha
      if (senhaVal.length < 6) {
        fieldSenha.classList.add('has-error');
        valid = false;
      } else {
        fieldSenha.classList.remove('has-error');
      }

      // Validate confirmar
      if (confirmarVal !== senhaVal || confirmarVal.length === 0) {
        fieldConfirmar.classList.add('has-error');
        valid = false;
      } else {
        fieldConfirmar.classList.remove('has-error');
      }

      if (!valid) return;

      // Show loading
      btnSubmit.classList.add('loading');

      setTimeout(() => {
        btnSubmit.classList.remove('loading');
        form.submit();
      }, 2200);
    });

    // Remove errors on input
    document.getElementById('nome').addEventListener('input', () => {
      document.getElementById('field-nome').classList.remove('has-error');
    });
    document.getElementById('email').addEventListener('input', () => {
      document.getElementById('field-email').classList.remove('has-error');
    });
    confirmarInput.addEventListener('input', () => {
      document.getElementById('field-confirmar').classList.remove('has-error');
    });

    // ── Flash Toast ──
    function dismissToast() {
      const toast = document.getElementById('flash-toast');
      if (!toast) return;
      toast.classList.add('hide');
      toast.addEventListener('animationend', () => toast.remove(), { once: true });
    }

    (function () {
      const toast = document.getElementById('flash-toast');
      if (toast) setTimeout(dismissToast, 5000);
    })();
  </script>
</body>

</html>