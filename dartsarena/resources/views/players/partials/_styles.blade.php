<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=JetBrains+Mono:wght@400;700&display=swap');

    /* =============================================
       PAGE JOUEUR — Dark Gaming Theme (HERO)
       + Light Dashboard Theme (ONGLETS V2)
       Valeurs hex hardcodées — pas de dépendance
       aux variables Tailwind/CSS du thème global
       ============================================= */

    /* Wrapper principal — isole le dark theme */
    .player-page {
        background-color: #0f172a;
        color: #f1f5f9;
        min-height: 100vh;
    }

    /* =============================================
       SYSTÈME PARTAGÉ ONGLETS V2
       Fond #f1f5f9 — dark cards pour mise en avant
       ============================================= */

    .pg-tabs-content {
        background-color: #f1f5f9;
        border-radius: 12px;
        padding: 28px;
    }
    @media (max-width: 640px) {
        .pg-tabs-content { padding: 16px; }
    }

    /* Dark card — blocs mis en avant, graphiques */
    .pg-dark-card {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }
    .pg-dark-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, #ef4444, #f59e0b);
    }

    /* Light card — contenu standard sur fond blanc */
    .pg-light-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    /* Titre de section */
    .pg-section-title {
        font-family: 'Inter Tight Variable', 'Inter Tight', -apple-system, sans-serif;
        font-weight: 700;
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }
    .pg-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }
    .pg-dark-card .pg-section-title { color: #475569; }
    .pg-dark-card .pg-section-title::after { background: #1e293b; }

    /* Texte de corps */
    .pg-body-text {
        font-family: 'Inter Variable', 'Inter', -apple-system, sans-serif;
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.85;
    }

    /* Grand chiffre impact */
    .pg-impact-num {
        font-family: 'Inter Tight Variable', 'Inter Tight', -apple-system, sans-serif;
        font-weight: 900;
        line-height: 1;
        letter-spacing: -0.03em;
    }

    /* Label technique mono */
    .pg-mono-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    /* Barre de progression */
    .pg-bar-track {
        height: 4px;
        background-color: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
    }
    .pg-bar-fill {
        height: 100%;
        border-radius: 2px;
        background: linear-gradient(90deg, #ef4444, #f59e0b);
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .pg-dark-card .pg-bar-track { background-color: #1e293b; }

    /* Helpers couleur */
    .pg-text-red  { color: #ef4444; }
    .pg-text-gold { color: #f59e0b; }
    .pg-text-muted { color: #94a3b8; }

    /* Grilles responsive */
    @media (min-width: 768px) {
        .pg-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .pg-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        .pg-grid-4 { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 12px; }
    }
    @media (max-width: 767px) {
        .pg-grid-2, .pg-grid-3, .pg-grid-4 {
            display: flex; flex-direction: column; gap: 12px;
        }
    }

    /* =============================================
       TABS NAVIGATION (fond dark — inchangé)
       ============================================= */

    .player-hero { position: relative; }

    .pg-tabs-wrapper {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
        padding: 6px;
        overflow-x: auto;
        display: flex;
        gap: 4px;
        scrollbar-width: none;
    }
    .pg-tabs-wrapper::-webkit-scrollbar { display: none; }

    .pg-tab {
        padding: 10px 20px;
        border-radius: 8px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        background: transparent;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: color 0.15s, background-color 0.15s;
    }
    .pg-tab:hover { color: #f1f5f9; background-color: rgba(255,255,255,0.06); }
    .pg-tab.active { background-color: #ef4444; color: #ffffff; }

    /* =============================================
       MATCH ROWS
       ============================================= */

    .match-row {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-left-width: 3px;
        border-radius: 8px;
        padding: 14px 16px;
        transition: background-color 0.15s, box-shadow 0.15s;
    }
    .match-row:hover { background-color: #f8fafc; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .match-row.win  { border-left-color: #ef4444; }
    .match-row.loss { border-left-color: #94a3b8; }

    .result-badge {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
        font-weight: 900;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
    }
    .result-badge.win  { background-color: #ef4444; }
    .result-badge.loss { background-color: #94a3b8; }

    /* =============================================
       NINE DARTER + EQUIPMENT
       ============================================= */

    .nine-darter-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .nine-darter-card:hover {
        border-color: #f59e0b;
        box-shadow: 0 4px 12px rgba(245,158,11,0.15);
    }

    .equip-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .equip-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    /* =============================================
       TROPHY ANIMATION
       ============================================= */

    .trophy-glow {
        filter: drop-shadow(0 0 8px rgba(245,158,11,0.5));
        animation: trophy-shine 3s ease-in-out infinite;
    }
    @keyframes trophy-shine {
        0%, 100% { filter: drop-shadow(0 0 8px rgba(245,158,11,0.4)); }
        50%       { filter: drop-shadow(0 0 16px rgba(245,158,11,0.8)); }
    }
</style>
