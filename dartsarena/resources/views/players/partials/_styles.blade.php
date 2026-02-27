<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=JetBrains+Mono:wght@400;700&display=swap');

    /* =============================================
       PAGE JOUEUR — Dark Gaming Theme
       Toutes les valeurs sont hardcodées hex/rgb
       pour éviter tout conflit avec le thème global
       ============================================= */

    /* Wrapper principal — isole le dark theme */
    .player-page {
        background-color: #0f172a;
        color: #f1f5f9;
        min-height: 100vh;
    }

    /* Typographie gaming */
    .player-page .font-gaming,
    .player-page h1,
    .player-page h2,
    .player-page h3 {
        font-family: 'Archivo Black', sans-serif;
    }

    .player-page .font-mono {
        font-family: 'JetBrains Mono', monospace;
    }

    /* ---- HERO ---- */
    .player-hero {
        background: linear-gradient(160deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);
        border-bottom: 1px solid #1e293b;
        overflow: hidden;
        position: relative;
    }

    .player-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 40px,
            rgba(255,255,255,0.015) 40px,
            rgba(255,255,255,0.015) 80px
        );
        pointer-events: none;
    }

    /* ---- CARTES ---- */
    .pg-card {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
    }

    /* Hover subtil — sans translateY qui casse le layout */
    .pg-card:hover {
        border-color: #475569;
        background-color: #243347;
    }

    /* Carte joueur gauche dans le hero */
    .player-card-left {
        background: linear-gradient(135deg, #1e293b 0%, #162032 100%);
        border: 1px solid #334155;
        border-radius: 16px;
    }

    /* ---- BADGE RANG ---- */
    .rank-badge {
        background: linear-gradient(90deg, #f59e0b, #ea580c);
        border-radius: 9999px;
        padding: 6px 16px;
        border: 3px solid #0f172a;
        display: inline-block;
    }

    .rank-badge-glow {
        box-shadow: 0 0 16px rgba(245, 158, 11, 0.5);
        animation: badge-pulse 2.5s ease-in-out infinite;
    }

    @keyframes badge-pulse {
        0%, 100% { box-shadow: 0 0 12px rgba(245, 158, 11, 0.4); }
        50%       { box-shadow: 0 0 24px rgba(245, 158, 11, 0.7); }
    }

    /* ---- PHOTO JOUEUR ---- */
    .player-photo-ring {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 3px solid #334155;
        overflow: hidden;
        margin: 0 auto;
        background-color: #0f172a;
        position: relative;
    }

    .player-photo-ring img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Anneau de couleur autour de la photo — statique */
    .player-photo-ring::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        background: conic-gradient(
            #ef4444 0%, #f59e0b 33%, #8b5cf6 66%, #ef4444 100%
        );
        z-index: -1;
    }

    /* ---- SÉPARATEUR ---- */
    .player-divider {
        border-color: #334155;
    }

    /* ---- TABS ---- */
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

    .pg-tab:hover {
        color: #f1f5f9;
        background-color: rgba(255,255,255,0.06);
    }

    .pg-tab.active {
        background-color: #ef4444;
        color: #ffffff;
    }

    /* ---- STAT KPI CARDS ---- */
    .kpi-card {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-radius: 10px;
        padding: 16px;
    }

    .kpi-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 6px;
    }

    .kpi-value {
        font-family: 'Archivo Black', sans-serif;
        font-size: 2rem;
        line-height: 1;
        margin-bottom: 6px;
    }

    /* ---- BARRE DE PROGRESSION ---- */
    .pg-bar-track {
        height: 6px;
        background-color: #0f172a;
        border-radius: 3px;
        overflow: hidden;
    }

    .pg-bar-fill {
        height: 100%;
        border-radius: 3px;
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ---- TABLE DE STATS ---- */
    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #1e293b;
    }

    .stat-row:last-child { border-bottom: none; }

    .stat-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
    }

    .stat-value {
        font-family: 'Archivo Black', sans-serif;
        font-size: 1.5rem;
        color: #f1f5f9;
    }

    /* ---- RECORD CARDS ---- */
    .record-card {
        border-radius: 8px;
        padding: 14px 16px;
        border-left: 3px solid transparent;
    }

    .record-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 4px;
    }

    .record-value {
        font-family: 'Archivo Black', sans-serif;
        font-size: 1.75rem;
        line-height: 1;
    }

    /* ---- MATCH CARDS ---- */
    .match-row {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-left-width: 3px;
        border-radius: 8px;
        padding: 14px 16px;
        transition: background-color 0.15s;
    }

    .match-row:hover { background-color: #243347; }
    .match-row.win  { border-left-color: #10b981; }
    .match-row.loss { border-left-color: #ef4444; }

    .result-badge {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Archivo Black', sans-serif;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
    }

    .result-badge.win  { background-color: #10b981; }
    .result-badge.loss { background-color: #ef4444; }

    /* ---- TROPHY ANIMATION ---- */
    .trophy-glow {
        filter: drop-shadow(0 0 8px rgba(251, 191, 36, 0.5));
        animation: trophy-shine 3s ease-in-out infinite;
    }

    @keyframes trophy-shine {
        0%, 100% { filter: drop-shadow(0 0 8px rgba(251, 191, 36, 0.4)); }
        50%       { filter: drop-shadow(0 0 16px rgba(251, 191, 36, 0.8)); }
    }

    /* ---- NINE DARTERS ---- */
    .nine-darter-card {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.15s;
    }

    .nine-darter-card:hover { border-color: #ef4444; }

    /* ---- EQUIPMENT CARDS ---- */
    .equip-card {
        background-color: #1e293b;
        border: 1px solid #334155;
        border-radius: 10px;
        padding: 16px;
        text-align: center;
        transition: border-color 0.15s;
    }

    .equip-card:hover { border-color: #475569; }

    /* ---- TEXTE ---- */
    .pg-text-primary   { color: #f1f5f9; }
    .pg-text-secondary { color: #94a3b8; }
    .pg-text-muted     { color: #64748b; }
    .pg-text-red       { color: #ef4444; }
    .pg-text-green     { color: #10b981; }
    .pg-text-amber     { color: #f59e0b; }
    .pg-text-purple    { color: #a78bfa; }
    .pg-text-cyan      { color: #22d3ee; }
    .pg-text-blue      { color: #60a5fa; }
    .pg-text-yellow    { color: #facc15; }
</style>
