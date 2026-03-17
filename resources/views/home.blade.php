<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RareCare — Rare Disease Management Platform</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@300;400;500&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0a0f1a;
      --surface: #0f1825;
      --surface2: #162033;
      --surface3: #1c2a40;
      --border: #1e2d45;
      --accent: #00c8a8;
      --accent2: #3b82f6;
      --accent3: #f59e0b;
      --danger: #ef4444;
      --text: #e2eaf4;
      --text-muted: #6b8aaa;
      --text-dim: #3d5470;
      --radius: 10px;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Instrument Sans', sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* GRID BACKGROUND */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image:
        linear-gradient(var(--border) 1px, transparent 1px),
        linear-gradient(90deg, var(--border) 1px, transparent 1px);
      background-size: 48px 48px;
      opacity: 0.3;
      pointer-events: none;
      z-index: 0;
    }

    /* GLOW BLOBS */
    .blob {
      position: fixed;
      border-radius: 50%;
      filter: blur(120px);
      opacity: 0.08;
      pointer-events: none;
      z-index: 0;
    }

    .blob-1 {
      width: 600px;
      height: 600px;
      background: var(--accent);
      top: -200px;
      left: -100px;
    }

    .blob-2 {
      width: 500px;
      height: 500px;
      background: var(--accent2);
      bottom: -100px;
      right: -100px;
    }

    /* LAYOUT */
    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
      position: relative;
      z-index: 1;
    }

    /* NAV */
    nav {
      position: sticky;
      top: 0;
      z-index: 100;
      background: rgba(10, 15, 26, 0.85);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
    }

    .nav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 64px;
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .logo-text {
      font-family: 'DM Serif Display', serif;
      font-size: 22px;
      color: var(--text);
      letter-spacing: -0.5px;
    }

    .logo-text span {
      color: var(--accent);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }

    .nav-links a {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.2s;
      cursor: pointer;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--text);
      background: var(--surface2);
    }

    .nav-links a.active {
      color: var(--accent);
    }

    .nav-badge {
      background: var(--accent);
      color: #000;
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      font-weight: 500;
      padding: 2px 6px;
      border-radius: 99px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 8px 18px;
      border: none;
      border-radius: var(--radius);
      font-family: 'Instrument Sans', sans-serif;
      font-size: 13.5px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
    }

    .btn-primary {
      background: var(--accent);
      color: #000;
    }

    .btn-primary:hover {
      background: #00e0bc;
      transform: translateY(-1px);
      box-shadow: 0 4px 20px rgba(0, 200, 168, 0.3);
    }

    .btn-outline {
      background: transparent;
      color: var(--text);
      border: 1px solid var(--border);
    }

    .btn-outline:hover {
      background: var(--surface2);
      border-color: var(--text-dim);
    }

    .btn-ghost {
      background: transparent;
      color: var(--text-muted);
      border: 1px solid transparent;
    }

    .btn-ghost:hover {
      background: var(--surface2);
      color: var(--text);
    }

    .btn-danger {
      background: rgba(239, 68, 68, 0.1);
      color: var(--danger);
      border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-danger:hover {
      background: rgba(239, 68, 68, 0.2);
    }

    .btn-sm {
      padding: 5px 12px;
      font-size: 12.5px;
    }

    .btn-icon {
      width: 32px;
      height: 32px;
      padding: 0;
      justify-content: center;
      border-radius: 6px;
    }

    /* HERO */
    .hero {
      padding: 80px 0 60px;
      text-align: center;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 200, 168, 0.08);
      border: 1px solid rgba(0, 200, 168, 0.2);
      color: var(--accent);
      font-family: 'DM Mono', monospace;
      font-size: 12px;
      padding: 5px 14px;
      border-radius: 99px;
      margin-bottom: 28px;
      letter-spacing: 0.5px;
    }

    .hero-badge::before {
      content: '';
      width: 6px;
      height: 6px;
      background: var(--accent);
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: 0.5;
        transform: scale(0.8);
      }
    }

    .hero h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(42px, 6vw, 72px);
      line-height: 1.05;
      letter-spacing: -1.5px;
      margin-bottom: 20px;
      color: var(--text);
    }

    .hero h1 em {
      font-style: italic;
      color: var(--accent);
    }

    .hero p {
      max-width: 540px;
      margin: 0 auto 36px;
      color: var(--text-muted);
      font-size: 17px;
      line-height: 1.7;
    }

    .hero-actions {
      display: flex;
      gap: 12px;
      justify-content: center;
      flex-wrap: wrap;
    }

    /* STATS STRIP */
    .stats-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
      margin-bottom: 60px;
      background: var(--surface);
    }

    .stat-item {
      padding: 24px 28px;
      border-right: 1px solid var(--border);
      position: relative;
    }

    .stat-item:last-child {
      border-right: none;
    }

    .stat-value {
      font-family: 'DM Serif Display', serif;
      font-size: 32px;
      color: var(--text);
      line-height: 1;
      margin-bottom: 4px;
    }

    .stat-value span {
      color: var(--accent);
    }

    .stat-label {
      font-size: 12.5px;
      color: var(--text-muted);
      font-family: 'DM Mono', monospace;
    }

    /* MAIN CONTENT */
    .main-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 24px;
      margin-bottom: 60px;
    }

    /* SIDEBAR */
    .sidebar {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .sidebar-section {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
    }

    .sidebar-title {
      padding: 14px 16px;
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--text-dim);
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 1px solid var(--border);
      background: var(--surface2);
    }

    .sidebar-menu {
      list-style: none;
      padding: 8px;
    }

    .sidebar-menu li a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      border-radius: 6px;
      transition: all 0.15s;
      cursor: pointer;
    }

    .sidebar-menu li a:hover {
      background: var(--surface2);
      color: var(--text);
    }

    .sidebar-menu li a.active {
      background: rgba(0, 200, 168, 0.1);
      color: var(--accent);
    }

    .sidebar-menu li a .menu-icon {
      font-size: 15px;
      width: 20px;
      text-align: center;
    }

    .sidebar-count {
      margin-left: auto;
      background: var(--surface3);
      color: var(--text-muted);
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      padding: 1px 7px;
      border-radius: 99px;
    }

    /* PATIENT PANEL */
    .panel {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
    }

    .panel-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      background: var(--surface2);
      flex-wrap: wrap;
      gap: 12px;
    }

    .panel-title {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .panel-title h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 20px;
      letter-spacing: -0.3px;
    }

    .panel-title .tag {
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      padding: 3px 9px;
      border-radius: 99px;
      background: rgba(0, 200, 168, 0.1);
      color: var(--accent);
      border: 1px solid rgba(0, 200, 168, 0.2);
    }

    .panel-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    /* SEARCH BAR */
    .search-bar {
      display: flex;
      gap: 10px;
      padding: 14px 20px;
      border-bottom: 1px solid var(--border);
      background: var(--surface);
      flex-wrap: wrap;
    }

    .search-input-wrap {
      flex: 1;
      min-width: 200px;
      position: relative;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-dim);
      font-size: 14px;
    }

    .input {
      width: 100%;
      background: var(--surface2);
      border: 1px solid var(--border);
      color: var(--text);
      font-family: 'Instrument Sans', sans-serif;
      font-size: 13.5px;
      padding: 9px 14px;
      border-radius: 8px;
      outline: none;
      transition: border-color 0.2s;
    }

    .input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(0, 200, 168, 0.1);
    }

    .input::placeholder {
      color: var(--text-dim);
    }

    .search-input-wrap .input {
      padding-left: 36px;
    }

    .select {
      background: var(--surface2);
      border: 1px solid var(--border);
      color: var(--text);
      font-family: 'Instrument Sans', sans-serif;
      font-size: 13px;
      padding: 9px 14px;
      border-radius: 8px;
      outline: none;
      cursor: pointer;
    }

    .select:focus {
      border-color: var(--accent);
    }

    /* TABLE */
    .table-wrap {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: var(--surface2);
    }

    thead th {
      padding: 11px 16px;
      text-align: left;
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--text-dim);
      text-transform: uppercase;
      letter-spacing: 0.8px;
      font-weight: 400;
      white-space: nowrap;
      border-bottom: 1px solid var(--border);
    }

    thead th:first-child {
      padding-left: 20px;
    }

    tbody tr {
      border-bottom: 1px solid rgba(30, 45, 69, 0.5);
      transition: background 0.15s;
      cursor: pointer;
    }

    tbody tr:hover {
      background: var(--surface2);
    }

    tbody tr:last-child {
      border-bottom: none;
    }

    td {
      padding: 14px 16px;
      font-size: 13.5px;
      vertical-align: middle;
    }

    td:first-child {
      padding-left: 20px;
    }

    /* PATIENT AVATAR */
    .patient-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 13px;
      flex-shrink: 0;
    }

    .av-teal {
      background: rgba(0, 200, 168, 0.15);
      color: var(--accent);
    }

    .av-blue {
      background: rgba(59, 130, 246, 0.15);
      color: var(--accent2);
    }

    .av-amber {
      background: rgba(245, 158, 11, 0.15);
      color: var(--accent3);
    }

    .av-rose {
      background: rgba(244, 63, 94, 0.15);
      color: #f43f5e;
    }

    .av-purple {
      background: rgba(168, 85, 247, 0.15);
      color: #a855f7;
    }

    .av-indigo {
      background: rgba(99, 102, 241, 0.15);
      color: #6366f1;
    }

    .patient-name {
      font-weight: 600;
      font-size: 14px;
      color: var(--text);
    }

    .patient-id {
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--text-dim);
      margin-top: 1px;
    }

    /* BADGES */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 9px;
      border-radius: 99px;
      font-size: 12px;
      font-weight: 500;
      white-space: nowrap;
    }

    .badge-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
    }

    .badge-active {
      background: rgba(0, 200, 168, 0.1);
      color: var(--accent);
      border: 1px solid rgba(0, 200, 168, 0.2);
    }

    .badge-active .badge-dot {
      background: var(--accent);
    }

    .badge-inactive {
      background: rgba(107, 138, 170, 0.1);
      color: var(--text-muted);
      border: 1px solid rgba(107, 138, 170, 0.15);
    }

    .badge-inactive .badge-dot {
      background: var(--text-muted);
    }

    .badge-critical {
      background: rgba(239, 68, 68, 0.1);
      color: var(--danger);
      border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .badge-critical .badge-dot {
      background: var(--danger);
      animation: pulse 1.5s infinite;
    }

    .badge-warning {
      background: rgba(245, 158, 11, 0.1);
      color: var(--accent3);
      border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-warning .badge-dot {
      background: var(--accent3);
    }

    /* SEVERITY */
    .severity {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .severity-bar {
      display: flex;
      gap: 2px;
    }

    .sev-block {
      width: 8px;
      height: 14px;
      border-radius: 2px;
      background: var(--surface3);
    }

    .sev-block.filled-teal {
      background: var(--accent);
    }

    .sev-block.filled-amber {
      background: var(--accent3);
    }

    .sev-block.filled-red {
      background: var(--danger);
    }

    .severity-label {
      font-size: 12.5px;
      color: var(--text-muted);
    }

    /* ROW ACTIONS */
    .row-actions {
      display: flex;
      gap: 4px;
      opacity: 0;
      transition: opacity 0.15s;
    }

    tbody tr:hover .row-actions {
      opacity: 1;
    }

    /* PAGINATION */
    .pagination {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 20px;
      border-top: 1px solid var(--border);
      font-size: 13px;
      color: var(--text-muted);
      background: var(--surface2);
      flex-wrap: wrap;
      gap: 10px;
    }

    .page-buttons {
      display: flex;
      gap: 4px;
    }

    .page-btn {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--border);
      border-radius: 6px;
      background: var(--surface);
      color: var(--text-muted);
      font-size: 13px;
      font-family: 'DM Mono', monospace;
      cursor: pointer;
      transition: all 0.15s;
    }

    .page-btn:hover {
      background: var(--surface3);
      color: var(--text);
      border-color: var(--text-dim);
    }

    .page-btn.active {
      background: var(--accent);
      color: #000;
      border-color: var(--accent);
      font-weight: 600;
    }

    /* MODAL */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(6px);
      z-index: 200;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.open {
      display: flex;
    }

    .modal {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 14px;
      width: 100%;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      animation: modal-in 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modal-in {
      from {
        opacity: 0;
        transform: scale(0.94) translateY(20px);
      }

      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 24px;
      border-bottom: 1px solid var(--border);
    }

    .modal-header h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 22px;
      letter-spacing: -0.3px;
    }

    .modal-close {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--surface2);
      border: 1px solid var(--border);
      color: var(--text-muted);
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.15s;
    }

    .modal-close:hover {
      background: var(--surface3);
      color: var(--text);
    }

    .modal-body {
      padding: 24px;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      padding: 16px 24px;
      border-top: 1px solid var(--border);
      background: var(--surface2);
    }

    /* FORM */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-group.full {
      grid-column: 1 / -1;
    }

    .form-label {
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--text-dim);
      text-transform: uppercase;
      letter-spacing: 0.7px;
    }

    textarea.input {
      resize: vertical;
      min-height: 80px;
    }

    /* DETAIL MODAL */
    .detail-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .detail-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .detail-item.full {
      grid-column: 1 / -1;
    }

    .detail-label {
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--text-dim);
      text-transform: uppercase;
      letter-spacing: 0.7px;
    }

    .detail-value {
      font-size: 14px;
      color: var(--text);
      font-weight: 500;
    }

    .detail-divider {
      border: none;
      border-top: 1px solid var(--border);
      margin: 16px 0;
      grid-column: 1 / -1;
    }

    /* DELETE MODAL */
    .delete-icon {
      width: 56px;
      height: 56px;
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin: 0 auto 16px;
    }

    .delete-body {
      text-align: center;
      padding: 28px 24px;
    }

    .delete-body h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 20px;
      margin-bottom: 8px;
    }

    .delete-body p {
      color: var(--text-muted);
      font-size: 14px;
      line-height: 1.6;
    }

    /* TOAST */
    .toast-container {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 300;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .toast {
      display: flex;
      align-items: center;
      gap: 12px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 13.5px;
      max-width: 320px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
      animation: toast-in 0.3s ease;
    }

    @keyframes toast-in {
      from {
        opacity: 0;
        transform: translateX(20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .toast-icon {
      font-size: 18px;
      flex-shrink: 0;
    }

    .toast-success {
      border-left: 3px solid var(--accent);
    }

    .toast-error {
      border-left: 3px solid var(--danger);
    }

    /* EMPTY STATE */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--text-muted);
    }

    .empty-icon {
      font-size: 40px;
      margin-bottom: 12px;
      opacity: 0.4;
    }

    .empty-state h4 {
      font-size: 16px;
      margin-bottom: 6px;
      color: var(--text);
    }

    .empty-state p {
      font-size: 13.5px;
    }

    /* FOOTER */
    footer {
      border-top: 1px solid var(--border);
      padding: 24px 0;
      margin-top: 40px;
      position: relative;
      z-index: 1;
    }

    .footer-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }

    .footer-text {
      font-size: 13px;
      color: var(--text-muted);
    }

    .footer-links {
      display: flex;
      gap: 20px;
    }

    .footer-links a {
      font-size: 13px;
      color: var(--text-dim);
      text-decoration: none;
      transition: color 0.15s;
    }

    .footer-links a:hover {
      color: var(--text-muted);
    }

    /* ====== AI CHAT WIDGET ====== */
    .chat-fab {
      position: fixed;
      bottom: 28px;
      right: 28px;
      z-index: 400;
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      box-shadow: 0 4px 24px rgba(0, 200, 168, 0.35);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .chat-fab:hover {
      transform: scale(1.08);
      box-shadow: 0 6px 32px rgba(0, 200, 168, 0.5);
    }

    .chat-fab .fab-badge {
      position: absolute;
      top: -2px;
      right: -2px;
      width: 16px;
      height: 16px;
      background: var(--danger);
      border-radius: 50%;
      border: 2px solid var(--bg);
      display: none;
    }

    .chat-fab .fab-badge.show {
      display: block;
    }

    .chat-window {
      position: fixed;
      bottom: 92px;
      right: 28px;
      z-index: 400;
      width: 360px;
      max-height: 520px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.5);
      transform: scale(0.92) translateY(16px);
      opacity: 0;
      pointer-events: none;
      transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s;
    }

    .chat-window.open {
      transform: scale(1) translateY(0);
      opacity: 1;
      pointer-events: all;
    }

    .chat-win-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 16px;
      background: var(--surface2);
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }

    .chat-win-title {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .chat-ai-avatar {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .chat-ai-name {
      font-weight: 600;
      font-size: 14px;
      color: var(--text);
    }

    .chat-ai-status {
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      color: var(--accent);
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .chat-ai-status::before {
      content: '';
      width: 5px;
      height: 5px;
      background: var(--accent);
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    .chat-win-close {
      width: 28px;
      height: 28px;
      background: var(--surface3);
      border: 1px solid var(--border);
      border-radius: 6px;
      color: var(--text-muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      transition: all 0.15s;
    }

    .chat-win-close:hover {
      background: var(--border);
      color: var(--text);
    }

    .chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
    }

    .chat-messages::-webkit-scrollbar {
      width: 4px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 2px;
    }

    .chat-msg {
      display: flex;
      flex-direction: column;
      max-width: 85%;
      gap: 4px;
      animation: msg-in 0.2s ease;
    }

    @keyframes msg-in {
      from {
        opacity: 0;
        transform: translateY(6px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .chat-msg.user {
      align-self: flex-end;
      align-items: flex-end;
    }

    .chat-msg.ai {
      align-self: flex-start;
      align-items: flex-start;
    }

    .chat-bubble {
      padding: 9px 13px;
      border-radius: 12px;
      font-size: 13.5px;
      line-height: 1.55;
      word-break: break-word;
    }

    .chat-msg.user .chat-bubble {
      background: linear-gradient(135deg, var(--accent), #00a88c);
      color: #001a15;
      border-bottom-right-radius: 3px;
      font-weight: 500;
    }

    .chat-msg.ai .chat-bubble {
      background: var(--surface2);
      color: var(--text);
      border: 1px solid var(--border);
      border-bottom-left-radius: 3px;
    }

    .chat-time {
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      color: var(--text-dim);
      padding: 0 2px;
    }

    .chat-typing {
      display: none;
      align-self: flex-start;
      align-items: flex-start;
      gap: 4px;
      flex-direction: column;
    }

    .chat-typing.show {
      display: flex;
    }

    .typing-bubble {
      background: var(--surface2);
      border: 1px solid var(--border);
      border-radius: 12px;
      border-bottom-left-radius: 3px;
      padding: 10px 14px;
      display: flex;
      gap: 5px;
      align-items: center;
    }

    .typing-dot {
      width: 6px;
      height: 6px;
      background: var(--text-dim);
      border-radius: 50%;
      animation: typing-bounce 1.2s infinite;
    }

    .typing-dot:nth-child(2) {
      animation-delay: 0.2s;
    }

    .typing-dot:nth-child(3) {
      animation-delay: 0.4s;
    }

    @keyframes typing-bounce {

      0%,
      60%,
      100% {
        transform: translateY(0);
        opacity: 0.4;
      }

      30% {
        transform: translateY(-5px);
        opacity: 1;
      }
    }

    .chat-input-area {
      padding: 12px;
      border-top: 1px solid var(--border);
      background: var(--surface2);
      display: flex;
      gap: 8px;
      align-items: flex-end;
      flex-shrink: 0;
    }

    .chat-input-area .input {
      flex: 1;
      resize: none;
      min-height: 38px;
      max-height: 100px;
      padding: 9px 12px;
      font-size: 13.5px;
      border-radius: 8px;
      background: var(--surface);
      font-family: 'Instrument Sans', sans-serif;
      line-height: 1.4;
    }

    .chat-send-btn {
      width: 38px;
      height: 38px;
      border-radius: 8px;
      background: var(--accent);
      border: none;
      color: #000;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: all 0.15s;
    }

    .chat-send-btn:hover {
      background: #00e0bc;
      transform: scale(1.05);
    }

    .chat-send-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
    }

    .chat-suggestions {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      padding: 10px 12px 0;
    }

    .chat-suggestion {
      background: var(--surface3);
      border: 1px solid var(--border);
      color: var(--text-muted);
      font-size: 11.5px;
      padding: 4px 10px;
      border-radius: 99px;
      cursor: pointer;
      font-family: 'Instrument Sans', sans-serif;
      transition: all 0.15s;
      white-space: nowrap;
    }

    .chat-suggestion:hover {
      background: rgba(0, 200, 168, 0.1);
      color: var(--accent);
      border-color: rgba(0, 200, 168, 0.3);
    }

    @media (max-width: 480px) {
      .chat-window {
        width: calc(100vw - 32px);
        right: 16px;
        bottom: 80px;
      }

      .chat-fab {
        right: 16px;
        bottom: 16px;
      }
    }

    /* ====== END AI CHAT WIDGET ====== */

    /* RESPONSIVE */
    @media (max-width: 900px) {
      .main-layout {
        grid-template-columns: 1fr;
      }

      .sidebar {
        display: none;
      }

      .stats-strip {
        grid-template-columns: repeat(2, 1fr);
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .detail-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 600px) {
      .stats-strip {
        grid-template-columns: 1fr 1fr;
      }

      .hero h1 {
        font-size: 36px;
      }

      .container {
        padding: 0 16px;
      }

      .nav-inner {
        padding: 0 16px;
      }

      .nav-links {
        display: none;
      }
    }
  </style>
</head>

<body>

  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- NAV -->
  <nav>
    <div class="nav-inner">
      <a class="logo" href="#">
        <div class="logo-icon">⚕</div>
        <span class="logo-text">Rare<span>Care</span></span>
      </a>
      <ul class="nav-links">
        <li><a class="active" onclick="showSection('patients')">🧬 Patients</a></li>
        <li><a onclick="showSection('records')">🗂 Dossiers</a></li>
        <li><a onclick="showSection('diseases')">🔬 Maladies</a></li>
        <li><a onclick="showSection('reports')">📊 Rapports</a></li>
        <li><a href="#">📡 API <span class="nav-badge">v1</span></a></li>
      </ul>
      <button class="btn btn-primary" onclick="openModal('createModal')">
        <span>+</span> Nouveau Patient
      </button>
    </div>
  </nav>

  <!-- MAIN -->
  <main>
    <div class="container">

      <!-- HERO -->
      <section class="hero">
        <div class="hero-badge">PLATEFORME ACTIVE · 847 PATIENTS SUIVIS</div>
        <h1>Gestion <em>intelligente</em><br>des maladies rares</h1>
        <p>Centralisez le suivi des patients, partagez les données cliniques et générez des rapports médicaux en quelques secondes.</p>
        <div class="hero-actions">
          <button class="btn btn-primary" onclick="openModal('createModal')">➕ Enregistrer un Patient</button>
          <button class="btn btn-outline">📄 Voir la documentation API</button>
        </div>
      </section>

      <!-- STATS -->
      <div class="stats-strip">
        <div class="stat-item">
          <div class="stat-value" id="totalCount">8<span>47</span></div>
          <div class="stat-label">// total_patients</div>
        </div>
        <div class="stat-item">
          <div class="stat-value">2<span>14</span></div>
          <div class="stat-label">// maladies_distinctes</div>
        </div>
        <div class="stat-item">
          <div class="stat-value" style="color:var(--accent3)"><span>12</span></div>
          <div class="stat-label">// cas_critiques</div>
        </div>
        <div class="stat-item">
          <div class="stat-value">3<span>2</span></div>
          <div class="stat-label">// rapports_ce_mois</div>
        </div>
      </div>

      <!-- LAYOUT -->
      <div class="main-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
          <div class="sidebar-section">
            <div class="sidebar-title">// navigation</div>
            <ul class="sidebar-menu">
              <li><a class="active" onclick="showSection('patients')"><span class="menu-icon">🧬</span> Tous les Patients <span class="sidebar-count" id="sidebarCount">6</span></a></li>
              <li><a onclick="filterBy('active')"><span class="menu-icon">✅</span> Actifs <span class="sidebar-count">4</span></a></li>
              <li><a onclick="filterBy('critical')"><span class="menu-icon">🚨</span> Critiques <span class="sidebar-count">1</span></a></li>
              <li><a onclick="filterBy('inactive')"><span class="menu-icon">⏸</span> Inactifs <span class="sidebar-count">1</span></a></li>
            </ul>
          </div>
          <div class="sidebar-section">
            <div class="sidebar-title">// maladies fréquentes</div>
            <ul class="sidebar-menu">
              <li><a><span class="menu-icon">🔵</span> Gaucher <span class="sidebar-count">3</span></a></li>
              <li><a><span class="menu-icon">🟣</span> Fabry <span class="sidebar-count">2</span></a></li>
              <li><a><span class="menu-icon">🟡</span> Pompe <span class="sidebar-count">1</span></a></li>
            </ul>
          </div>
          <div class="sidebar-section">
            <div class="sidebar-title">// actions rapides</div>
            <ul class="sidebar-menu">
              <li><a><span class="menu-icon">📤</span> Exporter CSV</a></li>
              <li><a><span class="menu-icon">📄</span> Générer Rapport PDF</a></li>
              <li><a><span class="menu-icon">🔗</span> API Swagger UI</a></li>
            </ul>
          </div>
        </aside>

        <!-- PATIENT TABLE PANEL -->
        <div class="panel">
          <div class="panel-header">
            <div class="panel-title">
              <h2>Patients</h2>
              <span class="tag" id="panelTag">ALL</span>
            </div>
            <div class="panel-actions">
              <button class="btn btn-ghost btn-sm">⬇ Exporter</button>
              <button class="btn btn-primary btn-sm" onclick="openModal('createModal')">+ Nouveau</button>
            </div>
          </div>

          <!-- SEARCH -->
          <div class="search-bar">
            <div class="search-input-wrap">
              <span class="search-icon">🔍</span>
              <input class="input" type="text" placeholder="Rechercher par nom, ID, maladie…" id="searchInput" oninput="filterTable()">
            </div>
            <select class="select" id="statusFilter" onchange="filterTable()">
              <option value="">Tous les statuts</option>
              <option value="Actif">Actif</option>
              <option value="Critique">Critique</option>
              <option value="Surveillance">Surveillance</option>
              <option value="Inactif">Inactif</option>
            </select>
            <select class="select" id="diseaseFilter" onchange="filterTable()">
              <option value="">Toutes maladies</option>
              <option value="Gaucher">Gaucher</option>
              <option value="Fabry">Fabry</option>
              <option value="Pompe">Pompe</option>
              <option value="Wilson">Wilson</option>
            </select>
          </div>

          <!-- TABLE -->
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Patient</th>
                  <th>Âge</th>
                  <th>Maladie</th>
                  <th>Statut</th>
                  <th>Sévérité</th>
                  <th>Dernière visite</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="patientTable">
                <!-- Rows injected by JS -->
              </tbody>
            </table>
            <div id="emptyState" class="empty-state" style="display:none">
              <div class="empty-icon">🔬</div>
              <h4>Aucun patient trouvé</h4>
              <p>Ajustez vos filtres ou enregistrez un nouveau patient.</p>
            </div>
          </div>

          <!-- PAGINATION -->
          <div class="pagination">
            <span id="pageInfo">Affichage 1–6 sur 6 patients</span>
            <div class="page-buttons">
              <button class="page-btn">‹</button>
              <button class="page-btn active">1</button>
              <button class="page-btn">2</button>
              <button class="page-btn">3</button>
              <button class="page-btn">›</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <span class="footer-text">© 2025 RareCare HealthTech — Plateforme REST API v1.0</span>
      <div class="footer-links">
        <a href="#">Swagger Docs</a>
        <a href="#">Docker Hub</a>
        <a href="#">GitHub</a>
        <a href="#">RGPD</a>
      </div>
    </div>
  </footer>

  <!-- ===================== MODALS ===================== -->

  <!-- CREATE / EDIT MODAL -->
  <div class="modal-overlay" id="createModal">
    <div class="modal">
      <div class="modal-header">
        <h3 id="modalTitle">Nouveau Patient</h3>
        <button class="modal-close" onclick="closeModal('createModal')">✕</button>
      </div>
      <div class="modal-body">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">// Prénom</label>
            <input class="input" id="f-prenom" type="text" placeholder="ex: Marie">
          </div>
          <div class="form-group">
            <label class="form-label">// Nom</label>
            <input class="input" id="f-nom" type="text" placeholder="ex: Dupont">
          </div>
          <div class="form-group">
            <label class="form-label">// Date de naissance</label>
            <input class="input" id="f-dob" type="date">
          </div>
          <div class="form-group">
            <label class="form-label">// Genre</label>
            <select class="input select" id="f-genre">
              <option value="">Sélectionner</option>
              <option>Homme</option>
              <option>Femme</option>
              <option>Autre</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">// Maladie rare</label>
            <select class="input select" id="f-maladie">
              <option value="">Sélectionner</option>
              <option>Gaucher</option>
              <option>Fabry</option>
              <option>Pompe</option>
              <option>Wilson</option>
              <option>Autre</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">// Statut</label>
            <select class="input select" id="f-status">
              <option>Actif</option>
              <option>Surveillance</option>
              <option>Critique</option>
              <option>Inactif</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">// Sévérité (1–5)</label>
            <input class="input" id="f-severite" type="number" min="1" max="5" placeholder="ex: 3">
          </div>
          <div class="form-group">
            <label class="form-label">// Médecin référent</label>
            <input class="input" id="f-medecin" type="text" placeholder="ex: Dr. Benali">
          </div>
          <div class="form-group full">
            <label class="form-label">// Notes cliniques</label>
            <textarea class="input" id="f-notes" placeholder="Observations, symptômes, traitements en cours…"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-ghost" onclick="closeModal('createModal')">Annuler</button>
        <button class="btn btn-primary" onclick="savePatient()">💾 Enregistrer</button>
      </div>
    </div>
  </div>

  <!-- VIEW MODAL -->
  <div class="modal-overlay" id="viewModal">
    <div class="modal">
      <div class="modal-header">
        <h3>Dossier Patient</h3>
        <button class="modal-close" onclick="closeModal('viewModal')">✕</button>
      </div>
      <div class="modal-body">
        <div class="detail-grid" id="viewContent"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-ghost" onclick="closeModal('viewModal')">Fermer</button>
        <button class="btn btn-outline" onclick="exportPDF()">📄 Générer PDF</button>
        <button class="btn btn-primary" id="editFromView">✏️ Modifier</button>
      </div>
    </div>
  </div>

  <!-- DELETE MODAL -->
  <div class="modal-overlay" id="deleteModal">
    <div class="modal" style="max-width:420px">
      <div class="delete-body">
        <div class="delete-icon">🗑</div>
        <h3>Supprimer ce patient?</h3>
        <p id="deleteMsg">Cette action est irréversible. Toutes les données associées à ce dossier seront supprimées.</p>
      </div>
      <div class="modal-footer" style="justify-content:center">
        <button class="btn btn-ghost" onclick="closeModal('deleteModal')">Annuler</button>
        <button class="btn btn-danger" id="confirmDelete">🗑 Supprimer définitivement</button>
      </div>
    </div>
  </div>

  <!-- TOAST CONTAINER -->
  <div class="toast-container" id="toastContainer"></div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('open');
      if (id === 'createModal') {
        resetForm();
        editingId = null;
      }
    }


    function exportPDF() {
      closeModal('viewModal');
      showToast('success', '📄 Rapport PDF généré avec succès !');
    }

    function showToast(type, msg) {
      const container = document.getElementById('toastContainer');
      const t = document.createElement('div');
      t.className = `toast toast-${type}`;
      t.innerHTML = `<span class="toast-icon">${type === 'success' ? '✅' : '❌'}</span><span>${msg}</span>`;
      container.appendChild(t);
      setTimeout(() => t.remove(), 3500);
    }

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
      overlay.addEventListener('click', e => {
        if (e.target === overlay) overlay.classList.remove('open');
      });
    });

    function showSection(s) {
      document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
      event.target.classList.add('active');
    }

    // Init
    renderTable();
  </script>

  <!-- ===================== AI CHAT WIDGET ===================== -->

  <!-- FAB Button -->
  <button class="chat-fab" id="chatFab" onclick="toggleChat()" title="Chat with AI">
    <span id="fabIcon">🤖</span>
    <span class="fab-badge" id="fabBadge"></span>
  </button>

  <!-- Chat Window -->
  <div class="chat-window" id="chatWindow">
    <div class="chat-win-header">
      <div class="chat-win-title">
        <div class="chat-ai-avatar">🤖</div>
        <div>
          <div class="chat-ai-name">RareCare AI</div>
          <div class="chat-ai-status">En ligne</div>
        </div>
      </div>
      <button class="chat-win-close" onclick="toggleChat()">✕</button>
    </div>

    <div class="chat-suggestions" id="chatSuggestions">
      <button class="chat-suggestion" onclick="useSuggestion(this)">Résumer un dossier</button>
      <button class="chat-suggestion" onclick="useSuggestion(this)">Symptômes Gaucher</button>
      <button class="chat-suggestion" onclick="useSuggestion(this)">Traitements disponibles</button>
    </div>

    <div class="chat-messages" id="chatMessages">
      <div class="chat-msg ai">
        <div class="chat-bubble">Bonjour ! Je suis l'assistant IA de RareCare. Je peux vous aider à analyser des dossiers médicaux, identifier des symptômes ou générer des résumés cliniques. Comment puis-je vous aider ?</div>
        <span class="chat-time" id="welcomeTime"></span>
      </div>
    </div>

    <div class="chat-typing" id="chatTyping">
      <div class="typing-bubble">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    </div>

    <div class="chat-input-area">
      <textarea class="input" id="chatInput" placeholder="Posez une question médicale…" rows="1"
        onkeydown="handleChatKey(event)" oninput="autoResize(this)"></textarea>
      <button class="chat-send-btn" id="chatSendBtn" onclick="sendChatMessage()">➤</button>
    </div>
  </div>

  <script>
    let chatOpen = false;

    document.getElementById('welcomeTime').textContent = nowTime();

    function nowTime() {
      return new Date().toLocaleTimeString('fr-FR', {
        hour: '2-digit',
        minute: '2-digit'
      });
    }

    function toggleChat() {
      chatOpen = !chatOpen;

      const win = document.getElementById('chatWindow');
      const icon = document.getElementById('fabIcon');
      const badge = document.getElementById('fabBadge');

      win.classList.toggle('open', chatOpen);
      icon.textContent = chatOpen ? '✕' : '🤖';

      badge.classList.remove('show');

      if (chatOpen) {
        setTimeout(() => {
          document.getElementById('chatInput').focus();
        }, 300);
      }
    }

    function handleChatKey(e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        sendChatMessage();
      }
    }

    function autoResize(el) {
      el.style.height = "auto";
      el.style.height = Math.min(el.scrollHeight, 100) + "px";
    }

    function useSuggestion(btn) {
      const text = btn.textContent;

      document.getElementById("chatInput").value = text;
      document.getElementById("chatSuggestions").style.display = "none";

      sendChatMessage();
    }

    function appendMessage(role, text) {

      const container = document.getElementById("chatMessages");

      const div = document.createElement("div");
      div.className = "chat-msg " + role;

      div.innerHTML = `
    <div class="chat-bubble">${text}</div>
    <span class="chat-time">${nowTime()}</span>
  `;

      container.appendChild(div);
      container.scrollTop = container.scrollHeight;
    }

    function setTyping(show) {

      const typing = document.getElementById("chatTyping");
      const btn = document.getElementById("chatSendBtn");

      typing.classList.toggle("show", show);
      btn.disabled = show;

      const container = document.getElementById("chatMessages");
      container.scrollTop = container.scrollHeight;
    }

    function sendChatMessage() {

      const input = document.getElementById("chatInput");
      const message = input.value.trim();

      if (!message) return;

      document.getElementById("chatSuggestions").style.display = "none";

      appendMessage("user", escapeHtml(message));

      input.value = "";
      input.style.height = "auto";

      setTyping(true);

      fetch("/chatgpt", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            message: message
          })
        })
        .then(res => res.json())
        .then(data => {

          setTyping(false);

          const reply = data.reply || data.message || data;

          appendMessage("ai", escapeHtml(reply));

          if (!chatOpen) {
            document.getElementById("fabBadge").classList.add("show");
          }

        })
        .catch(err => {

          setTyping(false);

          appendMessage("ai", "⚠️ Erreur : " + err.message);

        });

    }

    function escapeHtml(str) {
      return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\n/g, "<br>");
    }
  </script>


</body>

</html>