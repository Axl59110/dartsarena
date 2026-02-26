# BMAD Method v6 - DartsArena

Cette structure contient tous les fichiers BMAD Method v6 pour le projet DartsArena.

## 📂 Structure

```
bmad/
├── README.md                    # Ce fichier
├── config.yaml                  # Configuration projet
├── helpers.md                   # Fonctions helper BMAD
│
├── agents/                      # Agents BMAD (vide - utilise agents globaux)
├── agent-overrides/             # Overrides agents spécifiques projet
│
├── templates/                   # Templates documents BMAD
│   ├── architecture.md
│   ├── bmm-workflow-status.template.yaml
│   ├── prd.md
│   ├── product-brief.md
│   ├── sprint-status.template.yaml
│   └── tech-spec.md
│
├── workflows/                   # Workflows custom projet (vide par défaut)
└── output/                      # Sorties workflows temporaires
```

## 📚 Documentation BMAD Complète

### Workflows Disponibles
Tous les workflows BMAD sont dans `docs/bmad-workflows/`:
- `workflow-init.md` - Initialisation BMAD
- `workflow-status.md` - Statut projet
- `product-brief.md` - Brief produit
- `prd.md` - Product Requirements Document
- `tech-spec.md` - Spécification technique
- `architecture.md` - Architecture système
- `sprint-planning.md` - Planification sprint
- `create-story.md` - Création user story
- `dev-story.md` - Développement story
- `brainstorm.md` - Brainstorming
- `research.md` - Recherche
- `create-ux-design.md` - Design UX
- `solutioning-gate-check.md` - Validation architecture
- `create-agent.md` - Création agent
- `create-workflow.md` - Création workflow

### Agents Spécialisés
Tous les agents BMAD sont dans `docs/bmad-agents/`:

**Core:**
- BMad Master - Orchestrateur principal

**BMM (Method):**
- Business Analyst - Product Brief
- Product Manager - PRD/Tech Spec
- System Architect - Architecture
- Scrum Master - Sprint Planning
- Developer - Dev Story
- UX Designer - UX Design

**CIS (Creative Intelligence):**
- Creative Intelligence - Brainstorm/Research

**BMB (Builder):**
- Builder - Create Agent/Workflow

## 🎯 Utilisation

### Commandes Disponibles
- `/workflow-status` - Voir progression projet
- `/dev-story STORY-XXX` - Développer une story
- `/create-story` - Créer nouvelle story
- `/sprint-planning` - Planifier sprint

### Workflow Dev Story
Le workflow `dev-story.md` contient 10 parties:
1. Understand Requirements
2. Plan Implementation Tasks
3. Set Up Environment
4. Implement - Backend
5. Implement - Frontend
6. Testing (Unit + Integration)
7. Validate Acceptance Criteria
8. Manual Testing & QA
9. Code Quality Review
10. Commit and Update Status

## 📖 Documentation Projet

### Documentation Active
- `docs/CHANGELOG.md` - Historique modifications
- `docs/LEARNINGS.md` - Best practices
- `docs/sprint-status.yaml` - État sprints
- `docs/bmm-workflow-status.yaml` - État workflows
- `docs/stories/` - User stories

### Archives
- `docs/archive/` - Documentation archivée par thème

## ⚙️ Configuration

La configuration projet est dans `bmad/config.yaml`:
- project_name: "DartsArena"
- project_type: "web-app"
- project_level: 1 (Small project, 1-10 stories)

## 🚀 Next Steps

Pour développer une story avec BMAD Method:
1. Vérifier status: `/workflow-status`
2. Lire le workflow: `docs/bmad-workflows/dev-story.md`
3. Suivre les 10 parties du workflow
4. Tester avant de valider
5. Mettre à jour la documentation

---

**Version:** BMAD Method v6.0.0
**Projet:** DartsArena
**Maintenu par:** Claude Code + BMAD Master
