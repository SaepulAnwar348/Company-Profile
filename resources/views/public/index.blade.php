<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }} - Solusi Perangkat & Layanan Jaringan IT</title>
    <meta name="description" content="Mitra terpercaya untuk pengadaan perangkat IT resmi, instalasi jaringan WiFi skala korporat, kabel LAN & Fiber Optic, hingga pemeliharaan sistem jaringan 24/7.">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --white: #ffffff;
            --bg: #fafbfe;
            --bg-alt: #f3f6fb;
            --surface: #ffffff;
            --surface-2: #f7f9fc;
            --border: #e2e8f0;
            --border-hover: #cbd5e1;
            --dark: #0f1729;
            --dark-2: #1e293b;
            --text: #1e293b;
            --text-2: #334155;
            --text-muted: #64748b;
            --text-dim: #94a3b8;
            --accent: #2563eb;
            --accent-light: #3b82f6;
            --accent-lighter: #60a5fa;
            --accent-bg: #eff6ff;
            --accent-bg-2: rgba(37,99,235,0.06);
            --teal: #0d9488;
            --teal-bg: #f0fdfa;
            --cyan: #0891b2;
            --cyan-bg: #ecfeff;
            --emerald: #059669;
            --emerald-bg: #ecfdf5;
            --gradient-accent: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #0284c7 100%);
            --gradient-text: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #0284c7 100%);
            --gradient-soft: linear-gradient(135deg, #eff6ff 0%, #f0fdfa 50%, #ecfeff 100%);
            --radius-sm: 0.5rem;
            --radius-md: 0.875rem;
            --radius-lg: 1.25rem;
            --radius-xl: 1.75rem;
            --radius-full: 999px;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            margin: 0;
        }

        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        ::selection {
            background: rgba(37,99,235,0.15);
            color: var(--accent);
        }

        /* ════════════════════════════════
           NAVBAR
           ════════════════════════════════ */
        .nav-wrapper {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: transform 0.4s cubic-bezier(.16,1,.3,1), padding 0.3s ease, opacity 0.3s ease;
            transform: translateY(0);
        }

        .nav-wrapper.scrolled {
            padding: 0.5rem 0;
        }

        .nav-wrapper.nav-hidden {
            transform: translateY(-120%);
            pointer-events: none;
        }

        .nav-pill {
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(232,234,242,0.7);
            border-radius: var(--radius-full);
            padding: 0.55rem 0.75rem 0.55rem 1.25rem;
            box-shadow: 0 4px 20px rgba(15,23,41,0.04);
            transition: all 0.4s cubic-bezier(.16,1,.3,1);
        }

        .nav-wrapper.scrolled .nav-pill {
            border-radius: var(--radius-lg);
            box-shadow: 0 8px 32px rgba(15,23,41,0.08), 0 1px 3px rgba(15,23,41,0.04);
            background: rgba(255,255,255,0.92);
        }

        .nav-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }

        .nav-brand img {
            width: 32px; height: 32px;
            border-radius: var(--radius-sm);
            object-fit: contain;
        }

        .nav-link-item {
            color: var(--text-muted) !important;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.4rem 0.8rem !important;
            border-radius: var(--radius-full);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link-item:hover {
            color: var(--accent) !important;
            background: var(--accent-bg-2);
        }

        .nav-link-item.active {
            color: var(--accent) !important;
            font-weight: 600;
            background: var(--accent-bg);
        }

        .btn-cta-nav {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--radius-full);
            padding: 0.5rem 1.15rem;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.25s ease;
            box-shadow: 0 2px 12px rgba(37,99,235,0.2);
        }

        .btn-cta-nav:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.3);
        }

        .nav-toggler {
            width: 36px; height: 36px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--white);
            color: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* ════════════════════════════════
           HERO
           ════════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 8rem 0 5rem;
            background: var(--white);
            position: relative;
            overflow: hidden;
        }

        /* Soft organic blobs */
        .hero-blob-1 {
            position: absolute;
            top: -15%;
            left: -8%;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37,99,235,0.07) 0%, transparent 65%);
            filter: blur(40px);
            animation: blobDrift1 18s ease-in-out infinite alternate;
        }

        .hero-blob-2 {
            position: absolute;
            bottom: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(8,145,178,0.06) 0%, transparent 65%);
            filter: blur(40px);
            animation: blobDrift2 20s ease-in-out infinite alternate;
        }

        .hero-blob-3 {
            position: absolute;
            top: 30%;
            right: 25%;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(29,78,216,0.05) 0%, transparent 65%);
            filter: blur(40px);
            animation: blobDrift1 15s ease-in-out infinite alternate-reverse;
        }

        @keyframes blobDrift1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, 25px) scale(1.08); }
        }
        @keyframes blobDrift2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-35px, -20px) scale(1.05); }
        }

        /* Dot grid pattern */
        .hero-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(37,99,235,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            z-index: 0;
            pointer-events: none;
        }

        .hero-content { position: relative; z-index: 2; }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 1rem 0.35rem 0.5rem;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .hero-pill-dot {
            width: 8px; height: 8px;
            background: var(--emerald);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(5,150,105,0.4);
            animation: dotBlink 2.5s infinite;
        }

        @keyframes dotBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .hero-heading {
            font-size: clamp(2.4rem, 5vw, 3.8rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.03em;
            color: var(--dark);
            margin-bottom: 1.25rem;
        }

        .hero-heading .accent-text {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 1rem;
            line-height: 1.75;
            color: var(--text-muted);
            max-width: 500px;
            margin-bottom: 2rem;
        }

        .hero-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-hero-1 {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--radius-full);
            padding: 0.85rem 1.75rem;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            box-shadow: 0 4px 16px rgba(37,99,235,0.25);
            transition: all 0.3s cubic-bezier(.16,1,.3,1);
            position: relative;
            overflow: hidden;
        }

        .btn-hero-1:hover {
            background: #4338ca;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(37,99,235,0.35);
        }

        .btn-hero-2 {
            background: var(--white);
            color: var(--text);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-full);
            padding: 0.8rem 1.75rem;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.3s ease;
        }

        .btn-hero-2:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-bg);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.08);
        }

        /* Hero Image Card */
        .hero-visual { position: relative; }

        .hero-img-frame {
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--border);
            background: var(--white);
            box-shadow:
                0 20px 60px -15px rgba(15,23,41,0.1),
                0 0 0 1px rgba(255,255,255,0.8) inset;
            position: relative;
            transition: transform 0.5s cubic-bezier(.16,1,.3,1);
        }

        .hero-img-frame:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 70px -15px rgba(15,23,41,0.15);
        }

        .hero-img-frame img {
            width: 100%;
            height: 430px;
            object-fit: cover;
            display: block;
        }

        .hero-img-frame .frame-shine {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, transparent 40%);
            pointer-events: none;
        }

        /* Floating badges */
        .fbadge {
            position: absolute;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 0.8rem 1.1rem;
            box-shadow: 0 10px 30px rgba(15,23,41,0.08);
            z-index: 10;
        }

        .fbadge-1 {
            bottom: -14px;
            left: -28px;
            animation: floatA 5s ease-in-out infinite alternate;
        }

        .fbadge-2 {
            top: 28px;
            right: -22px;
            animation: floatB 6s ease-in-out infinite alternate;
        }

        @keyframes floatA {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }
        @keyframes floatB {
            0% { transform: translateY(0); }
            100% { transform: translateY(-8px); }
        }

        .fbadge-icon {
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .fbadge-val {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--dark);
        }

        .fbadge-label {
            font-size: 0.68rem;
            color: var(--text-dim);
        }

        /* Hero Stats */
        .hero-stats-row {
            display: flex;
            gap: 2.5rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .h-stat .h-stat-num {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
        }

        .h-stat .h-stat-label {
            font-size: 0.72rem;
            color: var(--text-dim);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-top: 0.2rem;
        }

        /* ════════════════════════════════
           SECTIONS COMMON
           ════════════════════════════════ */
        .sec-pad { padding: 6rem 0; }

        .sec-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.6rem;
        }

        .sec-label::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }

        .sec-title {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.7rem, 3vw, 2.3rem);
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -0.02em;
            margin-bottom: 0.6rem;
        }

        .sec-desc {
            font-size: 0.92rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 580px;
        }

        .sec-line {
            border: none;
            height: 1px;
            background: var(--border);
            margin: 0;
        }

        /* ════════════════════════════════
           CARD SYSTEM
           ════════════════════════════════ */
        .pcard {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            transition: all 0.35s cubic-bezier(.16,1,.3,1);
            position: relative;
            overflow: hidden;
        }

        .pcard::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient-accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }

        .pcard:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px -12px rgba(37,99,235,0.1), 0 4px 12px rgba(0,0,0,0.03);
            border-color: var(--border-hover);
        }

        .pcard:hover::after {
            transform: scaleX(1);
        }

        .pcard .card-icon-box {
            width: 48px; height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .pcard:hover .card-icon-box {
            transform: scale(1.08) rotate(-3deg);
        }

        /* ════════════════════════════════
           PROFIL SECTION
           ════════════════════════════════ */
        .profil-sec {
            background: var(--white);
        }

        .vm-card {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .vm-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient-accent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .vm-card:hover {
            border-color: var(--border-hover);
            box-shadow: 0 12px 36px -8px rgba(37,99,235,0.08);
            transform: translateY(-4px);
            background: var(--white);
        }

        .vm-card:hover::before { opacity: 1; }

        /* ════════════════════════════════
           PRODUCT SECTION
           ════════════════════════════════ */
        .product-sec { background: var(--bg-alt); }

        .fpill {
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text-muted);
            border-radius: var(--radius-full);
            padding: 0.4rem 1.1rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .fpill:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-bg);
        }

        .fpill.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 3px 12px rgba(37,99,235,0.2);
        }

        .prod-img {
            height: 210px;
            overflow: hidden;
            background: var(--bg-alt);
            position: relative;
        }

        .prod-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.45s cubic-bezier(.16,1,.3,1);
        }

        .pcard:hover .prod-img img {
            transform: scale(1.06);
        }

        .price-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .link-arrow {
            color: var(--accent);
            font-weight: 600;
            font-size: 0.82rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }

        .link-arrow:hover {
            color: #4338ca;
            gap: 0.5rem;
        }

        /* ════════════════════════════════
           ARTICLE SECTION
           ════════════════════════════════ */
        .article-sec { background: var(--white); }

        .art-img {
            height: 210px;
            overflow: hidden;
            background: var(--bg-alt);
            position: relative;
        }

        .art-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.45s cubic-bezier(.16,1,.3,1);
        }

        .pcard:hover .art-img img {
            transform: scale(1.06);
        }

        .tag-sm {
            display: inline-block;
            background: var(--accent-bg);
            color: var(--accent);
            border-radius: var(--radius-full);
            padding: 0.12rem 0.55rem;
            font-size: 0.68rem;
            font-weight: 600;
        }

        .btn-read {
            color: var(--accent);
            font-weight: 600;
            font-size: 0.82rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .btn-read:hover {
            color: #4338ca;
            gap: 0.5rem;
        }

        /* ════════════════════════════════
           GALLERY
           ════════════════════════════════ */
        .gallery-sec { background: var(--bg-alt); }

        .gal-card {
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: relative;
            height: 250px;
            cursor: pointer;
            border: 1px solid var(--border);
            background: var(--bg-alt);
            transition: all 0.35s ease;
        }

        .gal-card img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(.16,1,.3,1);
        }

        .gal-card:hover {
            box-shadow: 0 16px 40px -10px rgba(37,99,235,0.12);
        }

        .gal-card:hover img {
            transform: scale(1.08);
        }

        .gal-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(15,23,41,0.85) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.25rem;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .gal-card:hover .gal-overlay { opacity: 1; }

        .gal-overlay h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: #fff;
            font-size: 0.92rem;
            margin-bottom: 0.2rem;
        }

        .gal-overlay small {
            color: rgba(255,255,255,0.6);
            font-size: 0.7rem;
        }

        .gal-zoom {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.92);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.1rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: transform 0.3s cubic-bezier(.34,1.56,.64,1);
            z-index: 5;
        }

        .gal-card:hover .gal-zoom {
            transform: translate(-50%, -50%) scale(1);
        }

        /* ════════════════════════════════
           CONTACT
           ════════════════════════════════ */
        .contact-sec { background: var(--white); }

        .contact-box {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(15,23,41,0.06);
        }

        .contact-left {
            background: var(--dark);
            color: #fff;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .contact-left::before {
            content: '';
            position: absolute;
            top: -40%; right: -40%;
            width: 80%; height: 80%;
            background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .ci-item {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .ci-icon {
            width: 42px; height: 42px;
            border-radius: var(--radius-md);
            background: rgba(37,99,235,0.15);
            color: var(--accent-lighter);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .contact-right { padding: 2.5rem; }

        .form-field {
            background: var(--bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: var(--radius-md) !important;
            color: var(--text) !important;
            padding: 0.7rem 0.9rem !important;
            font-size: 0.88rem !important;
            transition: all 0.2s ease !important;
        }

        .form-field:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.08) !important;
            background: var(--white) !important;
        }

        .form-field::placeholder {
            color: var(--text-dim) !important;
        }

        .btn-send {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--radius-full);
            padding: 0.8rem 2rem;
            font-weight: 700;
            font-size: 0.88rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(37,99,235,0.2);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-send:hover {
            background: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(37,99,235,0.3);
        }

        .f-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.35rem;
        }

        /* ════════════════════════════════
           FOOTER
           ════════════════════════════════ */
        .site-footer {
            background: var(--dark);
            color: var(--text-dim);
            padding: 4rem 0 2rem;
        }

        .ft-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .ft-brand img {
            width: 30px; height: 30px;
            border-radius: var(--radius-sm);
        }

        .ft-link {
            color: var(--text-dim);
            text-decoration: none;
            font-size: 0.82rem;
            transition: color 0.2s;
        }

        .ft-link:hover { color: var(--accent-lighter); }

        .ft-social {
            width: 36px; height: 36px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(255,255,255,0.08);
            background: transparent;
            color: var(--text-dim);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ft-social:hover {
            background: rgba(37,99,235,0.12);
            border-color: rgba(37,99,235,0.3);
            color: var(--accent-lighter);
        }

        .partner-chip {
            display: inline-block;
            padding: 0.3rem 0.7rem;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius-sm);
            font-size: 0.72rem;
            font-weight: 600;
            color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.03);
        }

        /* ════════════════════════════════
           BACK TO TOP
           ════════════════════════════════ */
        .btt {
            position: fixed;
            bottom: 28px; right: 28px;
            width: 44px; height: 44px;
            border-radius: var(--radius-md);
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(37,99,235,0.3);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .btt.show { opacity: 1; visibility: visible; }

        .btt:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.4);
            color: #fff;
        }

        /* ════════════════════════════════
           SCROLL REVEAL
           ════════════════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.6s cubic-bezier(.16,1,.3,1);
        }

        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* ════════════════════════════════
           MODALS
           ════════════════════════════════ */
        .modal-content {
            border: 1px solid var(--border) !important;
            background: var(--white) !important;
            color: var(--text) !important;
        }

        .modal-header { border-bottom: 1px solid var(--border) !important; }
        .modal-footer { border-top: 1px solid var(--border) !important; }

        /* ════════════════════════════════
           ALERTS
           ════════════════════════════════ */
        .alert-ok {
            background: var(--emerald-bg);
            border: 1px solid rgba(5,150,105,0.2);
            color: var(--emerald);
            border-radius: var(--radius-lg);
        }

        .alert-err {
            background: #fef2f2;
            border: 1px solid rgba(239,68,68,0.2);
            color: #dc2626;
            border-radius: var(--radius-lg);
        }

        /* ════════════════════════════════
           RESPONSIVE
           ════════════════════════════════ */
        @media (max-width: 991.98px) {
            .hero { padding: 7rem 0 3rem; min-height: auto; }
            .hero-img-frame img { height: 280px; }
            .hero-stats-row { gap: 1.5rem; flex-wrap: wrap; }
            .fbadge { display: none; }
            .nav-pill { border-radius: var(--radius-lg); }
            .sec-pad { padding: 4.5rem 0; }
        }

        @media (max-width: 575.98px) {
            .hero-heading { font-size: 2rem; }
            .hero-stats-row { gap: 1.25rem; }
            .h-stat .h-stat-num { font-size: 1.4rem; }
            .hero-btns { flex-direction: column; }
            .hero-btns a { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    {{-- ══════════════════════════════════════════════
         1. NAVBAR NAVIGASI PUBLIK
         ══════════════════════════════════════════════ --}}
    <div class="nav-wrapper" id="navWrapper">
        <div class="container">
            <nav class="nav-pill d-flex align-items-center justify-content-between">
                {{-- Logo & nama perusahaan --}}
                <a class="nav-brand" href="#beranda">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo">
                    <span>{{ $profil->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}</span>
                </a>

                {{-- Tombol toggle menu pada perangkat mobile --}}
                <button class="nav-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                {{-- Tautan menu navigasi halaman utama --}}
                <div class="collapse d-lg-flex align-items-center gap-3" id="mainNav">
                    <ul class="navbar-nav d-flex flex-row gap-1 mx-auto mb-2 mb-lg-0 list-unstyled">
                        <li><a class="nav-link nav-link-item active" href="#beranda">Beranda</a></li>
                        <li><a class="nav-link nav-link-item" href="#profil">Profil</a></li>
                        <li><a class="nav-link nav-link-item" href="#katalog">Produk & Layanan</a></li>
                        <li><a class="nav-link nav-link-item" href="#artikel">Artikel</a></li>
                        <li><a class="nav-link nav-link-item" href="#galeri">Galeri</a></li>
                    </ul>
                    {{-- Tombol konsultasi cepat langsung menuju form kontak --}}
                    <a href="#kontak" class="btn-cta-nav">
                        <i class="bi bi-lightning-charge-fill"></i>
                        <span>Konsultasi Gratis</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         2. HERO BANNER UTAMA (HEADLINE)
         ══════════════════════════════════════════════ --}}
    <section class="hero" id="beranda">
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>
        <div class="hero-blob-3"></div>
        <div class="hero-dots"></div>

        <div class="container hero-content">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-heading">
                        Solusi Perangkat &
                        <span class="accent-text">Layanan Jaringan</span>
                        Andal untuk Bisnis Anda.
                    </h1>

                    <p class="hero-desc mb-0">
                        Mitra terpercaya untuk pengadaan perangkat IT resmi, instalasi jaringan WiFi skala korporat, kabel LAN & Fiber Optic, hingga pemeliharaan sistem jaringan 24/7.
                    </p>

                    <div class="hero-btns mt-4">
                        <a href="#profil" class="btn-hero-1">
                            <span>Pelajari Lebih Lanjut</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#kontak" class="btn-hero-2">
                            <i class="bi bi-envelope"></i>
                            <span>Kontak Kami</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="hero-img-frame">
                            <img src="{{ asset('img/hero-network.jpg') }}" alt="Infrastruktur Jaringan dan Perangkat IT">
                            <div class="frame-shine"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         3. PROFIL PERUSAHAAN (TENTANG KAMI, VISI & MISI)
         ══════════════════════════════════════════════ --}}
    <hr class="sec-line">
    <section class="sec-pad profil-sec" id="profil">
        <div class="container">
            <div class="text-center mx-auto mb-5 reveal" style="max-width: 780px;">
                <div class="sec-label justify-content-center">PROFIL PERUSAHAAN</div>
                <h2 class="sec-title">Tentang {{ $profil->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}</h2>
                <p class="sec-desc mx-auto" style="max-width: 680px;">
                    {{ $profil->tentang_kami ?? 'PT Solusi Koneksi Anda adalah penyedia solusi infrastruktur IT dan jaringan terintegrasi, melayani pengadaan perangkat digital, instalasi jaringan WiFi & LAN, fiber optic, hingga pemeliharaan sistem IT korporat.' }}
                </p>
            </div>

            <div class="row g-4 reveal">
                {{-- Kartu Visi Perusahaan --}}
                <div class="col-md-6">
                    <div class="vm-card h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon-box" style="background: var(--accent-bg); color: var(--accent);">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </div>
                            <div>
                                <div class="tag-sm mb-1">TUJUAN STRATEGIS</div>
                                <h4 class="font-display fw-bold mb-0 fs-5">Visi Kami</h4>
                            </div>
                        </div>
                        <p class="mb-0" style="line-height: 1.75; color: var(--text-muted); font-size: 0.9rem;">
                            {{ $profil->visi ?? 'Menjadi mitra utama penyedia produk hardware dan layanan infrastruktur jaringan IT terdepan, andal, dan inovatif di Indonesia.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="vm-card h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon-box" style="background: var(--teal-bg); color: var(--teal);">
                                <i class="bi bi-bullseye fs-4"></i>
                            </div>
                            <div>
                                <div class="tag-sm" style="background: var(--teal-bg); color: var(--teal);">KOMITMEN LAYANAN</div>
                                <h4 class="font-display fw-bold mb-0 fs-5 mt-1">Misi Kami</h4>
                            </div>
                        </div>
                        <p class="mb-0" style="line-height: 1.75; color: var(--text-muted); font-size: 0.9rem;">
                            {{ $profil->misi ?? 'Menyediakan perangkat jaringan berkualitas tinggi bergaransi resmi serta menghadirkan layanan instalasi WiFi, integrasi sistem, dan dukungan teknis purna jual 24/7.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
         4. PRODUK & LAYANAN
         ════════════════════════════════ -->
    <hr class="sec-line">
    <section class="sec-pad product-sec" id="katalog">
        <div class="container">
            <div class="mb-5 reveal">
                <div class="sec-label">KATALOG RESMI</div>
                <h2 class="sec-title">Produk & Layanan Unggulan</h2>
                <p class="sec-desc">Pilihan perangkat jaringan berkualitas tinggi serta paket jasa instalasi profesional untuk performa bisnis Anda.</p>
            </div>

            <div class="row g-4" id="productGrid">
                @forelse($produk as $p)
                <div class="col-md-6 col-lg-4 product-card-item reveal">
                    <div class="pcard h-100 d-flex flex-column">
                        <div class="prod-img">
                            @if($p->gambar && (file_exists(public_path('storage/' . $p->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($p->gambar)))
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-center" style="color: var(--accent);">
                                    <i class="bi bi-hdd-network fs-1 mb-1"></i>
                                    <span class="small fw-semibold" style="color: var(--text-dim);">Produk & Layanan IT</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="font-display fw-bold fs-6 mb-2" style="color: var(--dark);">{{ $p->nama_produk }}</h5>
                            <div class="mb-2">
                                <span class="price-text">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex-grow-1 mb-3 small" style="line-height: 1.6; color: var(--text-muted);">
                                {{ $p->deskripsi }}
                            </div>
                            <div class="pt-3 mt-auto" style="border-top: 1px solid var(--border);">
                                <a href="#kontak" onclick="pilihTopik('Pengadaan Perangkat Hardware & Router')" class="link-arrow">
                                    <span>Pesan / Konsultasi</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5" style="color: var(--text-muted);">Belum ada item produk atau layanan di dalam katalog.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         5. ARTIKEL & INFORMASI TEKNOLOGI
         ══════════════════════════════════════════════ --}}
    <hr class="sec-line">
    <section class="sec-pad article-sec" id="artikel">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 reveal">
                <div>
                    <div class="sec-label">EDUKASI & WAWASAN</div>
                    <h2 class="sec-title">Artikel & Informasi Jaringan</h2>
                    <p class="sec-desc">Informasi dan tips seputar optimalisasi jaringan, infrastruktur WiFi, dan keamanan IT.</p>
                </div>
            </div>

            <div class="row g-4">
                {{-- Looping data artikel wawasan IT --}}
                @forelse($artikel as $art)
                <div class="col-md-4 reveal">
                    <div class="pcard h-100 d-flex flex-column">
                        <div class="art-img">
                            @if($art->gambar && (file_exists(public_path('storage/' . $art->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($art->gambar)))
                                <img src="{{ asset('storage/' . $art->gambar) }}" alt="{{ $art->judul }}">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-center" style="color: var(--accent);">
                                    <i class="bi bi-newspaper fs-1 mb-1"></i>
                                    <span class="small fw-semibold" style="color: var(--text-dim);">Artikel IT Network</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center flex-wrap gap-2 small mb-2">
                                <span class="tag-sm">Wawasan</span>
                                <span style="color: var(--text-dim);">•</span>
                                <span class="fw-medium" style="font-size: 0.78rem; color: var(--text-2);">
                                    <i class="bi bi-person-fill me-1" style="color: var(--text-dim);"></i>{{ $art->penulis }}
                                </span>
                                @if($art->created_at)
                                <span style="color: var(--text-dim);">•</span>
                                <span class="fw-normal" style="font-size: 0.76rem; color: var(--text-muted);" title="{{ $art->created_at->format('d/m/Y') }}">
                                    <i class="bi bi-calendar3 me-1" style="color: var(--text-dim);"></i>{{ $art->created_at->translatedFormat('d M Y') }}
                                </span>
                                @endif
                            </div>

                            <h5 class="font-display fw-bold fs-6 mb-2" style="line-height: 1.4; color: var(--dark);">{{ $art->judul }}</h5>

                            <p class="flex-grow-1 mb-3 small" style="line-height: 1.7; color: var(--text-muted);">
                                {{ \Illuminate\Support\Str::limit($art->isi_artikel, 120) }}
                            </p>

                            {{-- Tombol modal membaca lengkap artikel --}}
                            <button type="button" class="btn-read mt-auto" data-bs-toggle="modal" data-bs-target="#artikelModal{{ $art->id_artikel }}">
                                <span>Baca Selengkapnya</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal popup membaca isi lengkap artikel --}}
                <div class="modal fade" id="artikelModal{{ $art->id_artikel }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                            @if($art->gambar && (file_exists(public_path('storage/' . $art->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($art->gambar)))
                                <img src="{{ asset('storage/' . $art->gambar) }}" alt="{{ $art->judul }}" class="w-100" style="max-height: 320px; object-fit: cover;">
                            @endif
                            <div class="modal-header border-0 pb-0 pt-3 px-4">
                                <h5 class="modal-title font-display fw-bold fs-5" style="color: var(--dark);">{{ $art->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="d-flex align-items-center flex-wrap gap-3 small mb-3 pb-2" style="border-bottom: 1px solid var(--border); color: var(--text-muted);">
                                    <span><i class="bi bi-person-circle me-1" style="color: var(--accent);"></i> Penulis: <strong style="color: var(--dark);">{{ $art->penulis }}</strong></span>
                                    @if($art->created_at)
                                    <span><i class="bi bi-calendar3 me-1" style="color: var(--accent);"></i> Tanggal: <strong style="color: var(--dark);">{{ $art->created_at->translatedFormat('d F Y') }}</strong></span>
                                    @endif
                                </div>
                                <div class="small" style="line-height: 1.85; white-space: pre-line; color: var(--text-2); font-size: 0.95rem;">
                                    {{ $art->isi_artikel }}
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                                <button type="button" class="btn btn-sm rounded-pill px-4" style="background: var(--bg-alt); color: var(--text-muted); border: 1px solid var(--border);" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5" style="color: var(--text-muted);">Belum ada artikel yang dipublikasikan.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         6. GALERI KEGIATAN & DOKUMENTASI PROYEK
         ══════════════════════════════════════════════ --}}
    <hr class="sec-line">
    <section class="sec-pad gallery-sec" id="galeri">
        <div class="container">
            <div class="text-center mx-auto mb-5 reveal" style="max-width: 650px;">
                <div class="sec-label justify-content-center">DOKUMENTASI RESMI</div>
                <h2 class="sec-title">Galeri & Dokumentasi Proyek</h2>
                <p class="sec-desc mx-auto">Dokumentasi pengerjaan instalasi WiFi, penarikan kabel fiber optic, rack server, dan operasional tim teknis kami.</p>
            </div>

            <div class="row g-4">
                @forelse($galeri as $gal)
                <div class="col-sm-6 col-md-4 reveal">
                    <div class="gal-card" data-bs-toggle="modal" data-bs-target="#galeriModal{{ $gal->id_galeri }}" title="Klik untuk melihat foto">
                        @if($gal->gambar && (file_exists(public_path('storage/' . $gal->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($gal->gambar)))
                            <img src="{{ asset('storage/' . $gal->gambar) }}" alt="{{ $gal->judul }}">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="color: var(--accent);">
                                <i class="bi bi-camera fs-1 mb-1"></i>
                                <span class="small" style="color: var(--text-dim);">{{ $gal->judul }}</span>
                            </div>
                        @endif
                        <div class="gal-zoom">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                        <div class="gal-overlay">
                            <h6>{{ $gal->judul }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Modal Galeri -->
                <div class="modal fade" id="galeriModal{{ $gal->id_galeri }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="modal-header border-0 pb-0">
                                <h6 class="modal-title fw-bold" style="color: var(--dark);">{{ $gal->judul }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center p-3">
                                @if($gal->gambar && (file_exists(public_path('storage/' . $gal->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($gal->gambar)))
                                    <img src="{{ asset('storage/' . $gal->gambar) }}" alt="{{ $gal->judul }}" class="img-fluid rounded-3" style="max-height: 520px; object-fit: contain;">
                                @endif
                            </div>
                            <div class="modal-footer border-0 pt-0 justify-content-end small" style="color: var(--text-muted);">
                                <button type="button" class="btn btn-sm rounded-pill px-3" style="background: var(--bg-alt); color: var(--text-muted); border: 1px solid var(--border);" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5" style="color: var(--text-muted);">Belum ada aktivitas galeri tersimpan.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         7. KONTAK KAMI & FORMULIR KONSULTASI
         ══════════════════════════════════════════════ --}}
    <hr class="sec-line">
    <section class="sec-pad contact-sec" id="kontak">
        <div class="container">
            <div class="text-center mx-auto mb-5 reveal" style="max-width: 680px;">
                <div class="sec-label justify-content-center">HUBUNGI KAMI</div>
                <h2 class="sec-title">Kontak & Konsultasi Jaringan</h2>
                <p class="sec-desc mx-auto">Siap meningkatkan performa jaringan atau pengadaan perangkat IT di kantor Anda? Konsultasikan kebutuhan Anda bersama tim ahli kami.</p>
            </div>

            {{-- Notifikasi sukses setelah pengunjung kirim pesan --}}
            @if(session('success'))
                <div class="alert alert-ok alert-dismissible fade show p-3 mb-4 mx-auto" style="max-width: 1000px;" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span class="fw-semibold">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="contact-box mx-auto reveal" style="max-width: 1000px;">
                <div class="row g-0">
                    {{-- Sisi Kiri: Informasi kontak perusahaan & peta lokasi --}}
                    <div class="col-lg-5 contact-left">
                        <div style="position: relative; z-index: 1;">
                            <div class="tag-sm mb-3" style="background: rgba(37,99,235,0.15); color: #60a5fa;">HOTLINE 24/7</div>
                            <h4 class="font-display fw-bold fs-5 mb-4 text-white">Informasi Kontak</h4>

                            <div class="ci-item">
                                <div class="ci-icon"><i class="bi bi-geo-alt"></i></div>
                                <div>
                                    <div class="fw-bold small text-white mb-1">Kantor Pusat</div>
                                    <div class="small" style="line-height: 1.6; color: #94a3b8;">{{ $profil->alamat ?? 'Jl. Raya Pajajaran No. 88 F, Bogor Timur, Kota Bogor, Jawa Barat 16153' }}</div>
                                </div>
                            </div>

                            <div class="ci-item">
                                <div class="ci-icon"><i class="bi bi-envelope"></i></div>
                                <div>
                                    <div class="fw-bold small text-white mb-1">Email Resmi</div>
                                    <div class="small"><a href="mailto:{{ $profil->email ?? 'info@solusikoneksi.co.id' }}" class="text-decoration-none" style="color: #60a5fa;">{{ $profil->email ?? 'info@solusikoneksi.co.id' }}</a></div>
                                </div>
                            </div>

                            <div class="ci-item mb-0">
                                <div class="ci-icon"><i class="bi bi-telephone"></i></div>
                                <div>
                                    <div class="fw-bold small text-white mb-1">Telepon Kantor</div>
                                    <div class="small" style="color: #94a3b8;">{{ $profil->no_hp ?? '0251-8321999' }}</div>
                                </div>
                            </div>

                            {{-- Peta Google Maps lokasi kantor --}}
                            <div class="rounded-3 overflow-hidden mt-4" style="height: 130px; border: 1px solid rgba(255,255,255,0.08);">
                                <iframe
                                    src="https://maps.google.com/maps?q={{ urlencode($profil->alamat ?? 'Jl. Raya Pajajaran No. 88 F Kota Bogor') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    width="100%" height="100%"
                                    style="border: 0;"
                                    allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    {{-- Sisi Kanan: Formulir kirim pesan pengunjung ke admin --}}
                    <div class="col-lg-7 contact-right">
                        <h4 class="font-display fw-bold fs-5 mb-1" style="color: var(--dark);">Kirim Pesan / Permintaan Survei</h4>
                        <p class="small mb-4" style="color: var(--text-muted);">Tim teknis kami akan merespons pertanyaan atau permohonan survei lokasi dalam waktu 1×24 jam kerja.</p>

                        {{-- Pesan error validasi form kontak --}}
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-err alert-dismissible fade show py-3 px-4 mb-4">
                                <div class="d-flex align-items-center gap-2 mb-1 fw-bold small">
                                    <i class="bi bi-exclamation-octagon-fill"></i>
                                    <span>Terdapat kesalahan pada formulir:</span>
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Form kirim pesan ke kontak.kirim (method POST) --}}
                        <form action="{{ route('kontak.kirim') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="f-label">Nama Lengkap <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nama_pengirim" class="form-control form-field @error('nama_pengirim') is-invalid @enderror" value="{{ old('nama_pengirim') }}" placeholder="Masukkan nama Anda" required>
                                    @error('nama_pengirim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="f-label">Alamat Email <span style="color: #dc2626;">*</span></label>
                                    <input type="email" name="email_pengirim" class="form-control form-field @error('email_pengirim') is-invalid @enderror" value="{{ old('email_pengirim') }}" placeholder="email@perusahaan.com" required>
                                    @error('email_pengirim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="f-label">Topik Layanan / Kebutuhan <span style="color: #dc2626;">*</span></label>
                                    <select name="subjek" id="subjekSelect" class="form-select form-field @error('subjek') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih topik kebutuhan...</option>
                                        <option value="Pemasangan & Setup Jaringan WiFi" {{ old('subjek') == 'Pemasangan & Setup Jaringan WiFi' ? 'selected' : '' }}>Pemasangan & Setup Jaringan WiFi</option>
                                        <option value="Instalasi Jaringan LAN & Fiber Optic" {{ old('subjek') == 'Instalasi Jaringan LAN & Fiber Optic' ? 'selected' : '' }}>Instalasi Jaringan LAN & Fiber Optic</option>
                                        <option value="Pengadaan Perangkat Hardware & Router" {{ old('subjek') == 'Pengadaan Perangkat Hardware & Router' ? 'selected' : '' }}>Pengadaan Perangkat Hardware & Router</option>
                                        <option value="Paket Maintenance & IT Support" {{ old('subjek') == 'Paket Maintenance & IT Support' ? 'selected' : '' }}>Paket Maintenance & IT Support</option>
                                        <option value="Instalasi CCTV & Keamanan Jaringan" {{ old('subjek') == 'Instalasi CCTV & Keamanan Jaringan' ? 'selected' : '' }}>Instalasi CCTV & Keamanan Jaringan</option>
                                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('subjek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="f-label">Pesan / Detail Kebutuhan <span style="color: #dc2626;">*</span></label>
                                    <textarea name="isi_pesan" rows="4" class="form-control form-field @error('isi_pesan') is-invalid @enderror" placeholder="Jelaskan kebutuhan perangkat, estimasi jumlah titik, atau lokasi survei..." required>{{ old('isi_pesan') }}</textarea>
                                    @error('isi_pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn-send">
                                        <i class="bi bi-send-fill"></i>
                                        <span>KIRIM PESAN SEKARANG</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         8. FOOTER WEBSITE
         ══════════════════════════════════════════════ --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="ft-brand">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo">
                        <span>{{ $profil->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}</span>
                    </div>
                    <p class="small mb-4" style="line-height: 1.7; max-width: 300px; color: #94a3b8;">
                        Penyedia solusi infrastruktur jaringan IT, instalasi WiFi korporat, dan pengadaan perangkat digital terintegrasi dan terpercaya.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $profil->email ?? 'info@solusikoneksi.co.id' }}" class="ft-social" title="Email Kami"><i class="bi bi-envelope"></i></a>
                        <a href="{{ route('login') }}" class="ft-social" title="Login Admin"><i class="bi bi-shield-lock"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <h6 class="font-display fw-bold mb-3 text-white" style="font-size: 0.88rem;">Produk & Layanan</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><i class="bi bi-chevron-right me-1 small" style="color: var(--accent-lighter);"></i> <span style="color: #94a3b8;">Pemasangan WiFi Enterprise</span></li>
                        <li><i class="bi bi-chevron-right me-1 small" style="color: var(--accent-lighter);"></i> <span style="color: #94a3b8;">Instalasi Jaringan LAN & FO</span></li>
                        <li><i class="bi bi-chevron-right me-1 small" style="color: var(--accent-lighter);"></i> <span style="color: #94a3b8;">Router & Switch Managed</span></li>
                        <li><i class="bi bi-chevron-right me-1 small" style="color: var(--accent-lighter);"></i> <span style="color: #94a3b8;">Maintenance IT & CCTV</span></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6">
                    <h6 class="font-display fw-bold mb-3 text-white" style="font-size: 0.88rem;">Tautan Cepat</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="#beranda" class="ft-link">Beranda</a></li>
                        <li><a href="#profil" class="ft-link">Profil</a></li>
                        <li><a href="#katalog" class="ft-link">Produk / Layanan</a></li>
                        <li><a href="#artikel" class="ft-link">Artikel</a></li>
                        <li><a href="#galeri" class="ft-link">Galeri</a></li>
                        <li><a href="#kontak" class="ft-link">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="font-display fw-bold mb-3 text-white" style="font-size: 0.88rem;">Partner & Standar</h6>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="partner-chip">MikroTik MTCNA</span>
                        <span class="partner-chip">Cisco Network</span>
                        <span class="partner-chip">Ubiquiti UniFi</span>
                    </div>
                    <small style="color: #64748b; font-size: 0.72rem;">
                        Didukung oleh teknisi bersertifikasi internasional.
                    </small>
                </div>
            </div>

            <div class="pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 small" style="border-top: 1px solid rgba(255,255,255,0.06); color: #475569;">
                <div>© 2026 {{ $profil->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}. All rights reserved.</div>
                <div class="d-flex gap-4">
                    <a href="#beranda" class="ft-link">Kebijakan Privasi</a>
                    <a href="#beranda" class="ft-link">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Tombol mengambang (Floating button) untuk kembali ke atas halaman --}}
    <a href="#beranda" class="btt" id="backToTop" title="Kembali ke atas">
        <i class="bi bi-arrow-up"></i>
    </a>

    {{-- Script Bootstrap 5 bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script interaktivitas landing page (Scroll navbar, efek animasi reveal, auto-select topik) --}}
    <script>
        // Efek Smart Auto-Hide Navbar & Tombol Back to Top saat scroll
        let lastScrollY = window.scrollY;
        const nav = document.getElementById('navWrapper');
        const btt = document.getElementById('backToTop');
        const mainNav = document.getElementById('mainNav');
        const scrollDelta = 8; // Sensitivitas batas scroll agar transisi halus

        window.addEventListener('scroll', function() {
            const currentScrollY = window.scrollY;

            // Efek mengecilkan padding navbar & menampilkan tombol kembali ke atas
            if (currentScrollY > 50) {
                nav.classList.add('scrolled');
                btt.classList.add('show');
            } else {
                nav.classList.remove('scrolled');
                btt.classList.remove('show');
            }

            // Cek apakah menu mobile sedang terbuka (jika terbuka jangan sembunyikan navbar)
            const isMenuOpen = mainNav && mainNav.classList.contains('show');

            if (!isMenuOpen) {
                if (currentScrollY > 100 && (currentScrollY - lastScrollY > scrollDelta)) {
                    // Scroll ke bawah -> sembunyikan navbar ke atas
                    nav.classList.add('nav-hidden');
                } else if (lastScrollY - currentScrollY > scrollDelta || currentScrollY <= 50) {
                    // Tarik / scroll ke atas -> munculkan kembali navbar
                    nav.classList.remove('nav-hidden');
                }
            }

            lastScrollY = Math.max(0, currentScrollY);
        }, { passive: true });

        // Efek animasi muncul halus (Scroll Reveal) saat elemen masuk viewport
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('revealed'), i * 70);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
        reveals.forEach(el => observer.observe(el));

        // Fungsi memilih topik kebutuhan otomatis pada form kontak saat tombol produk ditekan
        function pilihTopik(topik) {
            const s = document.getElementById('subjekSelect');
            if (s) s.value = topik;
        }
    </script>
</body>
</html>