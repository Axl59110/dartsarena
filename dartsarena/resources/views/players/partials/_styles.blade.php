<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=JetBrains+Mono:wght@400;700&display=swap');

    :root {
        --primary-rgb: 215, 60, 50; /* Approximation of oklch(58% 0.24 25) */
    }

    .font-gaming { font-family: 'Archivo Black', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    /* Gaming Card Holographic Effect */
    .holo-card {
        position: relative;
        background: linear-gradient(135deg,
            rgba(255,255,255,0.03) 0%,
            rgba(255,255,255,0.01) 50%,
            rgba(255,255,255,0.03) 100%
        );
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }

    .holo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3),
                    0 0 20px rgba(var(--primary-rgb), 0.2);
        border-color: rgba(var(--primary-rgb), 0.3);
    }

    /* Stat Bar Animation */
    .stat-bar {
        height: 8px;
        background: linear-gradient(90deg,
            var(--primary) 0%,
            rgba(var(--primary-rgb), 0.6) 100%
        );
        border-radius: 4px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(var(--primary-rgb), 0.3);
    }

    /* Rank Badge Glow */
    .rank-badge {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.4); }
        50% { box-shadow: 0 0 30px rgba(var(--primary-rgb), 0.6); }
    }

    /* Tab Active Indicator */
    .tab-active {
        position: relative;
        background: linear-gradient(to top,
            rgba(var(--primary-rgb), 0.1) 0%,
            transparent 100%
        );
    }

    .tab-active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg,
            transparent 0%,
            var(--primary) 50%,
            transparent 100%
        );
        box-shadow: 0 0 10px var(--primary);
    }

    /* XP Bar Style */
    .xp-bar-container {
        background: rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .xp-bar {
        background: linear-gradient(90deg,
            #10b981 0%,
            #3b82f6 50%,
            #8b5cf6 100%
        );
        height: 100%;
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .xp-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(255,255,255,0.3) 50%,
            transparent 100%
        );
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* Trophy Shine */
    .trophy {
        filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5));
        animation: trophy-shine 3s ease-in-out infinite;
    }

    @keyframes trophy-shine {
        0%, 100% { filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5)); }
        50% { filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.8)); }
    }

    /* Match Result Card */
    .match-card {
        background: linear-gradient(135deg,
            rgba(255,255,255,0.02) 0%,
            rgba(255,255,255,0.01) 100%
        );
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .match-card.win {
        border-left-color: #10b981;
    }

    .match-card.loss {
        border-left-color: #ef4444;
    }

    .match-card:hover {
        background: linear-gradient(135deg,
            rgba(255,255,255,0.05) 0%,
            rgba(255,255,255,0.02) 100%
        );
    }

    /* Comparison Meter */
    .comparison-meter {
        position: relative;
        height: 6px;
        background: linear-gradient(90deg,
            #ef4444 0%,
            #fbbf24 50%,
            #10b981 100%
        );
        border-radius: 3px;
    }

    .comparison-indicator {
        position: absolute;
        top: -8px;
        width: 4px;
        height: 22px;
        background: white;
        border-radius: 2px;
        box-shadow: 0 0 8px rgba(255,255,255,0.8);
    }
</style>
