# 🎓 Mini Réseau Social Universitaire

Un réseau social moderne conçu pour les étudiants, permettant de partager des actualités, interagir et se connecter avec d'autres étudiants de l'université.

## ✨ Fonctionnalités

- ✅ **Authentification sécurisée** - Inscription et connexion avec hashage bcrypt
- ✅ **Profil personnalisé** - Photo de profil et biographie
- ✅ **Flux d'actualités** - Affichage des posts des utilisateurs
- ✅ **Publication de posts** - Partager du contenu textuel
- ✅ **Système de likes** - Réagir aux publications
- ✅ **Compteurs** - Likes et commentaires par post
- ✅ **Design moderne** - Interface 3 colonnes épurée

## 📋 Prérequis

- PHP 7.4+
- MySQL 5.7+
- Serveur web (Apache, Nginx, ou PHP Server)

## 🚀 Installation Rapide

### 1. Configurer la base de données

```bash
mysql -u root -p < database.sql
```

### 2. Configurer db.php

Éditez `db.php` :
```php
$host = 'localhost';
$db_name = 'reseau_social_univ';
$user = 'root';
$password = ''; // Votre mot de passe
```

### 3. Créer les dossiers

```bash
mkdir -p uploads/profiles
mkdir -p uploads/posts
```

### 4. Lancer le serveur

```bash
php -S localhost:8000
```

Accédez à : `http://localhost:8000/login.php`

## 🔐 Comptes de Test

| Email | Mot de passe |
|-------|-------------|
| alice@university.edu | password123 |
| bob@university.edu | password123 |
| carol@university.edu | password123 |

## 📁 Structure du Projet

```
.
├── db.php                    # Configuration BD
├── header.php               # En-tête
├── footer.php               # Pied de page
├── login.php                # Connexion
├── register.php             # Inscription
├── index.php                # Fil d'actualité
├── post.php                 # Création posts
├── like.php                 # Système likes
├── edit_profile.php         # Édition profil
├── upload_profile_pic.php   # Upload photo
├── logout.php               # Déconnexion
├── style.css                # Styles
├── database.sql             # Schéma BD
└── uploads/                 # Dossier uploads
    ├── profiles/            # Photos profil
    └── posts/               # Images posts
```

## 🎨 Palette Couleurs

- **Primaire** : #2563eb (Bleu académique)
- **Secondaire** : #64748b (Gris)
- **Arrière-plan** : #f8fafc
- **Cartes** : #ffffff

## 🔄 Améliorations Futures

- [ ] Commentaires complets
- [ ] Messages directs
- [ ] Notifications temps réel
- [ ] Recherche utilisateurs
- [ ] Groupes par filière

## 📝 Licence

MIT