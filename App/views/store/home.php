<?php $products = $products ?? [] ?>

<!-- ============================================================
     HOME PAGE — Modern E-Commerce Design
     All PHP variables, loops, and routes preserved.
     Pure HTML/CSS/Bootstrap additions only.
============================================================ -->

<style>
/* ─── Design Tokens ─────────────────────────────────────────── */
:root {
    --primary:    #1a1a2e;
    --accent:     #e94560;
    --accent2:    #0f3460;
    --gold:       #f5a623;
    --light-bg:   #f8f9fc;
    --card-bg:    #ffffff;
    --text-main:  #1a1a2e;
    --text-muted: #6b7280;
    --border:     #e5e7eb;
    --radius:     14px;
    --shadow:     0 4px 24px rgba(26,26,46,.10);
    --shadow-hover: 0 12px 40px rgba(233,69,96,.18);
    --transition: .28s cubic-bezier(.4,0,.2,1);
}

/* ─── Global Resets ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }

/* ─── Hero ──────────────────────────────────────────────────── */
.hero-section {
    position: relative;
    min-height: 92vh;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 45%, #0f3460 100%);
    display: flex;
    align-items: center;
    overflow: hidden;
}
.hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 60% at 70% 50%, rgba(233,69,96,.18) 0%, transparent 70%),
        radial-gradient(ellipse 40% 80% at 20% 80%, rgba(15,52,96,.5) 0%, transparent 60%);
}
.hero-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size: 60px 60px;
}
.hero-content { position: relative; z-index: 2; }
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(233,69,96,.15);
    border: 1px solid rgba(233,69,96,.35);
    color: #e94560;
    padding: 6px 18px;
    border-radius: 100px;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    margin-bottom: 24px;
}
.hero-badge span { width:7px; height:7px; background:#e94560; border-radius:50%; animation: blink 1.4s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
.hero-title {
    font-size: clamp(2.6rem, 6vw, 5rem);
    font-weight: 900;
    line-height: 1.1;
    color: #fff;
    letter-spacing: -.02em;
    margin-bottom: 20px;
}
.hero-title .accent { color: #e94560; }
.hero-sub {
    color: rgba(255,255,255,.72);
    font-size: 1.12rem;
    line-height: 1.75;
    max-width: 520px;
    margin-bottom: 36px;
}
.hero-actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 52px; }
.btn-hero-primary {
    background: #e94560;
    color: #fff;
    border: none;
    padding: 15px 36px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    box-shadow: 0 8px 30px rgba(233,69,96,.4);
}
.btn-hero-primary:hover { background:#c73652; color:#fff; transform:translateY(-2px); box-shadow:0 14px 40px rgba(233,69,96,.5); }
.btn-hero-secondary {
    background: rgba(255,255,255,.08);
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.25);
    padding: 15px 36px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    backdrop-filter: blur(8px);
}
.btn-hero-secondary:hover { background:rgba(255,255,255,.15); color:#fff; transform:translateY(-2px); }
.hero-stats { display: flex; gap: 36px; flex-wrap: wrap; }
.stat-item { text-align: left; }
.stat-number { font-size: 2rem; font-weight: 900; color: #fff; line-height: 1; }
.stat-number span { color: #e94560; }
.stat-label { color: rgba(255,255,255,.55); font-size: .82rem; font-weight: 500; margin-top: 4px; letter-spacing: .04em; }
.hero-visual {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-img-wrap {
    position: relative;
    width: min(420px, 90vw);
    height: min(420px, 90vw);
}
.hero-img-wrap::before {
    content: '';
    position: absolute;
    inset: -20px;
    background: conic-gradient(from 0deg, #e94560, #0f3460, #e94560);
    border-radius: 50%;
    animation: spin 12s linear infinite;
    opacity: .25;
}
@keyframes spin { to { transform: rotate(360deg); } }
.hero-img-inner {
    position: absolute;
    inset: 20px;
    background: linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,.02));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255,255,255,.12);
    backdrop-filter: blur(10px);
    overflow: hidden;
}
.hero-img-inner img { width: 85%; height: 85%; object-fit: contain; filter: drop-shadow(0 20px 40px rgba(233,69,96,.4)); animation: float 4s ease-in-out infinite; }
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-16px)} }

/* ─── Section Commons ────────────────────────────────────────── */
.section-header { text-align: center; margin-bottom: 52px; }
.section-eyebrow {
    display: inline-block;
    color: #e94560;
    font-size: .75rem;
    font-weight: 800;
    letter-spacing: .18em;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.section-title-main {
    font-size: clamp(1.7rem, 3.5vw, 2.5rem);
    font-weight: 900;
    color: var(--text-main);
    line-height: 1.2;
    margin: 0 0 14px;
}
.section-subtitle { color: var(--text-muted); font-size: 1rem; max-width: 560px; margin: 0 auto; }

/* ─── Trust Bar ─────────────────────────────────────────────── */
.trust-bar {
    background: var(--primary);
    padding: 18px 0;
}
.trust-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,.85);
    font-size: .87rem;
    font-weight: 600;
    justify-content: center;
}
.trust-item i { color: #e94560; font-size: 1.1rem; }

/* ─── Categories ────────────────────────────────────────────── */
.categories-section { padding: 80px 0; background: var(--light-bg); }
.cat-card {
    background: #fff;
    border-radius: var(--radius);
    padding: 36px 24px;
    text-align: center;
    border: 1.5px solid var(--border);
    transition: var(--transition);
    cursor: pointer;
    text-decoration: none;
    display: block;
    color: inherit;
}
.cat-card:hover { border-color: #e94560; box-shadow: var(--shadow-hover); transform: translateY(-6px); color: inherit; }
.cat-icon {
    width: 72px; height: 72px;
    background: linear-gradient(135deg, #fff0f3, #fce4ec);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px;
    font-size: 1.8rem;
    transition: var(--transition);
}
.cat-card:hover .cat-icon { background: linear-gradient(135deg, #e94560, #c73652); color: #fff; }
.cat-name { font-weight: 800; font-size: 1rem; color: var(--text-main); margin-bottom: 4px; }
.cat-count { font-size: .8rem; color: var(--text-muted); }

/* ─── Product Cards ─────────────────────────────────────────── */
.products-section { padding: 80px 0; background: #fff; }
.products-section.gray { background: var(--light-bg); }

.prod-card {
    background: var(--card-bg);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1.5px solid var(--border);
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.prod-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-hover); border-color: #e94560; }

.prod-img-wrap {
    position: relative;
    overflow: hidden;
    background: var(--light-bg);
    aspect-ratio: 1 / 1;
}
.prod-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}
.prod-card:hover .prod-img-wrap img { transform: scale(1.07); }

.prod-badge {
    position: absolute;
    top: 12px; left: 12px;
    background: #e94560;
    color: #fff;
    font-size: .7rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 100px;
    letter-spacing: .05em;
    text-transform: uppercase;
}
.prod-overlay {
    position: absolute;
    inset: 0;
    background: rgba(26,26,46,.55);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: var(--transition);
    backdrop-filter: blur(2px);
}
.prod-card:hover .prod-overlay { opacity: 1; }
.overlay-btn {
    background: #fff;
    color: var(--primary);
    border: none;
    padding: 10px 22px;
    border-radius: 50px;
    font-weight: 700;
    font-size: .84rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: var(--transition);
}
.overlay-btn:hover { background: #e94560; color: #fff; }

.prod-body {
    padding: 18px 18px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.prod-name {
    font-weight: 800;
    font-size: .97rem;
    color: var(--text-main);
    margin-bottom: 6px;
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.prod-desc {
    font-size: .8rem;
    color: var(--text-muted);
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
.prod-price-row { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.price-current { font-size: 1.22rem; font-weight: 900; color: #e94560; }
.price-old { font-size: .9rem; color: var(--text-muted); text-decoration: line-through; }
.prod-footer { padding: 0 18px 18px; display: flex; gap: 8px; }
.btn-view-detail {
    flex: 1;
    background: var(--primary);
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: .84rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: var(--transition);
}
.btn-view-detail:hover { background: #e94560; color: #fff; }

/* ─── Section Title + View All ──────────────────────────────── */
.section-top-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 36px;
    gap: 16px;
    flex-wrap: wrap;
}
.view-all-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #e94560;
    font-weight: 700;
    font-size: .9rem;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: var(--transition);
    white-space: nowrap;
}
.view-all-link:hover { color: #c73652; border-color: #c73652; }

/* ─── Why Choose Us ─────────────────────────────────────────── */
.why-section { padding: 90px 0; background: var(--primary); }
.why-card {
    text-align: center;
    padding: 36px 20px;
    border-radius: var(--radius);
    background: rgba(255,255,255,.04);
    border: 1.5px solid rgba(255,255,255,.08);
    transition: var(--transition);
    height: 100%;
}
.why-card:hover { background: rgba(233,69,96,.1); border-color: rgba(233,69,96,.4); transform: translateY(-6px); }
.why-icon {
    width: 72px; height: 72px;
    background: rgba(233,69,96,.15);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.6rem;
    color: #e94560;
    transition: var(--transition);
}
.why-card:hover .why-icon { background: #e94560; color: #fff; }
.why-title { font-weight: 800; font-size: 1.05rem; color: #fff; margin-bottom: 10px; }
.why-text { color: rgba(255,255,255,.55); font-size: .87rem; line-height: 1.7; }

/* ─── Testimonials ──────────────────────────────────────────── */
.testimonials-section { padding: 90px 0; background: var(--light-bg); }
.testi-card {
    background: #fff;
    border-radius: var(--radius);
    padding: 32px 28px;
    border: 1.5px solid var(--border);
    box-shadow: var(--shadow);
    height: 100%;
    transition: var(--transition);
}
.testi-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-4px); }
.testi-stars { color: #f5a623; font-size: 1rem; margin-bottom: 14px; letter-spacing: 2px; }
.testi-text { font-size: .96rem; color: var(--text-muted); line-height: 1.75; margin-bottom: 22px; font-style: italic; }
.testi-author { display: flex; align-items: center; gap: 12px; }
.testi-avatar {
    width: 46px; height: 46px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #e94560, #0f3460);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800;
    color: #fff;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.testi-name { font-weight: 800; font-size: .9rem; color: var(--text-main); }
.testi-role { font-size: .78rem; color: var(--text-muted); }

/* ─── Newsletter ────────────────────────────────────────────── */
.newsletter-section {
    padding: 90px 0;
    background: linear-gradient(135deg, #e94560 0%, #c73652 50%, #0f3460 100%);
    position: relative;
    overflow: hidden;
}
.newsletter-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.newsletter-inner { position: relative; z-index: 1; text-align: center; }
.newsletter-title { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900; color: #fff; margin-bottom: 14px; }
.newsletter-sub { color: rgba(255,255,255,.8); font-size: 1.05rem; margin-bottom: 36px; }
.newsletter-form { display: flex; gap: 10px; max-width: 500px; margin: 0 auto; }
.newsletter-form input {
    flex: 1;
    padding: 15px 22px;
    border-radius: 50px;
    border: 2px solid rgba(255,255,255,.3);
    background: rgba(255,255,255,.15);
    color: #fff;
    font-size: .95rem;
    outline: none;
    backdrop-filter: blur(8px);
    transition: var(--transition);
}
.newsletter-form input::placeholder { color: rgba(255,255,255,.65); }
.newsletter-form input:focus { border-color: rgba(255,255,255,.6); background: rgba(255,255,255,.22); }
.btn-subscribe {
    background: #fff;
    color: #e94560;
    border: none;
    padding: 15px 28px;
    border-radius: 50px;
    font-weight: 800;
    font-size: .95rem;
    cursor: pointer;
    white-space: nowrap;
    transition: var(--transition);
}
.btn-subscribe:hover { background: var(--primary); color: #fff; }

/* ─── Responsive ────────────────────────────────────────────── */
@media (max-width: 768px) {
    .hero-section { min-height: auto; padding: 80px 0 60px; }
    .hero-visual { margin-top: 40px; }
    .hero-img-wrap { width: 280px; height: 280px; }
    .hero-stats { gap: 24px; }
    .newsletter-form { flex-direction: column; border-radius: 14px; padding: 4px; }
    .newsletter-form input, .btn-subscribe { border-radius: 50px; }
    .section-top-row { flex-direction: column; align-items: flex-start; }
}
</style>

<!-- ═══════════════════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════════════════ -->
<section class="hero-section">
    <div class="hero-grid"></div>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-7">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span></span>
                        New Season 2025 Collection
                    </div>
                    <h1 class="hero-title">
                        Shop Smarter,<br>
                        Live <span class="accent">Better.</span>
                    </h1>
                    <p class="hero-sub">
                        Discover thousands of premium products at unbeatable prices.
                        Fast delivery, secure checkout, and 30-day returns guaranteed.
                    </p>
                    <div class="hero-actions">
                        <a href="<?= BASE_URL ?>product/index" class="btn-hero-primary">
                            <i class="fa fa-shopping-bag"></i> Shop Now
                        </a>
                        <a href="<?= BASE_URL ?>page/about" class="btn-hero-secondary">
                            <i class="fa fa-play-circle"></i> Learn More
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number"><?= count($products) ?><span>+</span></div>
                            <div class="stat-label">Products Available</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">10<span>K+</span></div>
                            <div class="stat-label">Happy Customers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24<span>h</span></div>
                            <div class="stat-label">Fast Delivery</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-5">
                <div class="hero-visual">
                    <div class="hero-img-wrap">
                        <div class="hero-img-inner">
                            <img src="<?= BASE_URL ?>assets/store/assets/img/product/1.png" alt="Featured Product">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     TRUST BAR
═══════════════════════════════════════════════════════ -->
<div class="trust-bar">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <i class="fa fa-shield"></i>
                    <span>Secure Checkout</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <i class="fa fa-refresh"></i>
                    <span>Money Back Guarantee</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <i class="fa fa-rocket"></i>
                    <span>Fast Shipping</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <i class="fa fa-headphones"></i>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════
     CATEGORIES SECTION
═══════════════════════════════════════════════════════ -->
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Browse by Category</div>
            <h2 class="section-title-main">Shop by Category</h2>
            <p class="section-subtitle">Find exactly what you're looking for across our curated collections.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-half">
                <a href="<?= BASE_URL ?>product/index" class="cat-card">
                    <div class="cat-icon">📱</div>
                    <div class="cat-name">Electronics</div>
                    <div class="cat-count">Top Picks</div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-half">
                <a href="<?= BASE_URL ?>product/index" class="cat-card">
                    <div class="cat-icon">👕</div>
                    <div class="cat-name">Fashion</div>
                    <div class="cat-count">Trending</div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-half">
                <a href="<?= BASE_URL ?>product/index" class="cat-card">
                    <div class="cat-icon">⌚</div>
                    <div class="cat-name">Accessories</div>
                    <div class="cat-count">New Arrivals</div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-half">
                <a href="<?= BASE_URL ?>product/index" class="cat-card">
                    <div class="cat-icon">🏠</div>
                    <div class="cat-name">Home</div>
                    <div class="cat-count">Best Sellers</div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-half">
                <a href="<?= BASE_URL ?>product/index" class="cat-card">
                    <div class="cat-icon">🎮</div>
                    <div class="cat-name">Gaming</div>
                    <div class="cat-count">Hot Deals</div>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     FEATURED PRODUCTS (first 4)
═══════════════════════════════════════════════════════ -->
<section class="products-section">
    <div class="container">
        <div class="section-top-row">
            <div>
                <div class="section-eyebrow">Handpicked for You</div>
                <h2 class="section-title-main" style="margin:0;">Featured Products</h2>
            </div>
            <a href="<?= BASE_URL ?>product/index" class="view-all-link">
                View All Products <i class="fa fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php foreach (array_slice($products, 0, 4) as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="prod-card">

                    <div class="prod-img-wrap">
                        <img src="<?= !empty($product->getImage()) && !str_starts_with($product->getImage(), 'assets') ? BASE_URL . 'uploads/' . $product->getImage() : BASE_URL . $product->getImage() ?>"
                             alt="<?= htmlspecialchars($product->getName()) ?>"
                             onerror="this.src='<?= BASE_URL ?>assets/store/assets/img/product/details-1.jpg'">

                        <?php if ($product->getDiscount() > 0): ?>
                        <div class="prod-badge">
                            -<?= round($product->getDiscount() * 100) ?>%
                        </div>
                        <?php endif; ?>

                        <div class="prod-overlay">
                            <a href="<?= BASE_URL ?>product/details/<?= $product->getId() ?>" class="overlay-btn">
                                <i class="fa fa-eye"></i> Quick View
                            </a>
                        </div>
                    </div>

                    <div class="prod-body">
                        <div class="prod-name"><?= htmlspecialchars($product->getName()) ?></div>
                        <div class="prod-desc"><?= htmlspecialchars($product->getDescription()) ?></div>
                        <div class="prod-price-row">
                            <span class="price-current">$<?= number_format($product->priceAfterDiscount(), 2) ?></span>
                            <?php if ($product->getDiscount() > 0): ?>
                            <span class="price-old">$<?= number_format($product->getPrice(), 2) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="prod-footer">
                        <a href="<?= BASE_URL ?>product/details/<?= $product->getId() ?>" class="btn-view-detail">
                            <i class="fa fa-shopping-cart"></i> View Details
                        </a>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     WHY CHOOSE US
═══════════════════════════════════════════════════════ -->
<section class="why-section">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow" style="color:#e94560;">Why Drophut?</div>
            <h2 class="section-title-main" style="color:#fff;">Why Thousands Choose Us</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,.55);">
                We deliver more than products — we deliver experiences worth coming back for.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="why-card">
                    <div class="why-icon"><i class="fa fa-truck"></i></div>
                    <div class="why-title">Fast Delivery</div>
                    <div class="why-text">Express shipping to your door. Orders placed before noon ship same day.</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-card">
                    <div class="why-icon"><i class="fa fa-lock"></i></div>
                    <div class="why-title">Secure Payment</div>
                    <div class="why-text">256-bit SSL encryption on every transaction. Your data is always safe.</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-card">
                    <div class="why-icon"><i class="fa fa-star"></i></div>
                    <div class="why-title">Best Quality</div>
                    <div class="why-text">Every product is quality-checked. We partner with trusted brands only.</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-card">
                    <div class="why-icon"><i class="fa fa-headphones"></i></div>
                    <div class="why-title">24/7 Support</div>
                    <div class="why-text">Real people, real help. Our team is available around the clock for you.</div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     ALL PRODUCTS (Trending Grid)
═══════════════════════════════════════════════════════ -->
<section class="products-section gray">
    <div class="container">
        <div class="section-top-row">
            <div>
                <div class="section-eyebrow">All Products</div>
                <h2 class="section-title-main" style="margin:0;">Trending Right Now</h2>
            </div>
            <a href="<?= BASE_URL ?>product/index" class="view-all-link">
                Browse All <i class="fa fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($products as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="prod-card">

                    <div class="prod-img-wrap">
                        <img src="<?= !empty($product->getImage()) && !str_starts_with($product->getImage(), 'assets') ? BASE_URL . 'uploads/' . $product->getImage() : BASE_URL . $product->getImage() ?>"
                             alt="<?= htmlspecialchars($product->getName()) ?>"
                             onerror="this.src='<?= BASE_URL ?>assets/store/assets/img/product/details-1.jpg'">

                        <?php if ($product->getDiscount() > 0): ?>
                        <div class="prod-badge">
                            SALE -<?= round($product->getDiscount() * 100) ?>%
                        </div>
                        <?php endif; ?>

                        <div class="prod-overlay">
                            <a href="<?= BASE_URL ?>product/details/<?= $product->getId() ?>" class="overlay-btn">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="prod-body">
                        <div class="prod-name"><?= htmlspecialchars($product->getName()) ?></div>
                        <div class="prod-desc"><?= htmlspecialchars($product->getDescription()) ?></div>
                        <div class="prod-price-row">
                            <span class="price-current">$<?= number_format($product->priceAfterDiscount(), 2) ?></span>
                            <?php if ($product->getDiscount() > 0): ?>
                            <span class="price-old">$<?= number_format($product->getPrice(), 2) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="prod-footer">
                        <a href="<?= BASE_URL ?>product/details/<?= $product->getId() ?>" class="btn-view-detail">
                            <i class="fa fa-shopping-cart"></i> View Details
                        </a>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════════════════════ -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <div class="section-eyebrow">Customer Reviews</div>
            <h2 class="section-title-main">What Our Customers Say</h2>
            <p class="section-subtitle">Real reviews from real shoppers who love Drophut.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-text">"Absolutely amazing quality! My order arrived in 2 days and the product exceeded my expectations. Will definitely shop here again."</p>
                    <div class="testi-author">
                        <div class="testi-avatar">K</div>
                        <div>
                            <div class="testi-name">Kathy Young</div>
                            <div class="testi-role">CEO of SunPark</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-text">"The customer service is outstanding. Had a small issue with my order and it was resolved within hours. Highly recommended!"</p>
                    <div class="testi-author">
                        <div class="testi-avatar">J</div>
                        <div>
                            <div class="testi-name">John Sullivan</div>
                            <div class="testi-role">Verified Customer</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <div class="testi-stars">★★★★☆</div>
                    <p class="testi-text">"Great selection of products. The prices are fair and the discounts are genuine. My go-to online store for electronics."</p>
                    <div class="testi-author">
                        <div class="testi-avatar">S</div>
                        <div>
                            <div class="testi-name">Sara M.</div>
                            <div class="testi-role">Regular Shopper</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     NEWSLETTER
═══════════════════════════════════════════════════════ -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-inner">
            <h2 class="newsletter-title">Get Exclusive Deals First</h2>
            <p class="newsletter-sub">Subscribe to our newsletter and never miss a sale, new arrival, or special offer.</p>
            <form class="newsletter-form" action="#" method="POST" onsubmit="return false;">
                <input type="email" placeholder="Enter your email address…" autocomplete="off">
                <button type="submit" class="btn-subscribe">
                    <i class="fa fa-paper-plane"></i> Subscribe
                </button>
            </form>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     SHIPPING FEATURES STRIP
═══════════════════════════════════════════════════════ -->
<section class="shipping_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="<?= BASE_URL ?>assets/store/assets/img/about/shipping1.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h2>Free Shipping</h2>
                        <p>Free shipping on all orders over $50</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="<?= BASE_URL ?>assets/store/assets/img/about/shipping2.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h2>Support 24/7</h2>
                        <p>Contact us 24 hours a day</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="<?= BASE_URL ?>assets/store/assets/img/about/shipping3.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h2>100% Money Back</h2>
                        <p>You have 30 days to return</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="<?= BASE_URL ?>assets/store/assets/img/about/shipping4.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h2>Payment Secure</h2>
                        <p>We ensure secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>