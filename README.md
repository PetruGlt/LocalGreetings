# SportIS — Local Greetings

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL%20%2F%20MariaDB-10.11%2B-4479A1?style=flat&logo=mariadb&logoColor=white)](https://mariadb.org/)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat&logo=docker&logoColor=white)](https://www.docker.com/)
[![Leaflet](https://img.shields.io/badge/Leaflet-OpenStreetMap-199900?style=flat&logo=leaflet&logoColor=white)](https://leafletjs.com/)
[![Architecture](https://img.shields.io/badge/Architecture-Custom%20MVC-orange?style=flat)](./public/docs/C4_SPORTIS.pdf)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](./LICENSE)

> A modern full-stack PHP web application engineered to connect sports enthusiasts in Iași. The platform enables users to discover 350+ sports fields and courts via an interactive OpenStreetMap interface, organize and participate in community sports events, build friendships, and consume sports news and custom RSS event feeds.

---

## Table of Contents

- [Live Demo](#live-demo)
- [About the Project](#about-the-project)
- [Key Features](#key-features)
- [Demo Accounts](#demo-accounts)
- [Launching the app using Docker](#launching-the-app-using-docker)
- [Configuration & Environment Variables](#configuration--environment-variables)
- [Project Structure](#project-structure)
- [Documentation & Media](#documentation--media)

---

## Live Demo

The application is deployed and live at: **[https://localgreetings.onrender.com](https://localgreetings.onrender.com)**

> **Disclaimer:** The application is hosted on a free cloud container instance (Render). If the service has been inactive, please allow approximately **30–50 seconds** for the initial spin-up on first load. Subsequent requests and navigation will be instantaneous.

---

## About the Project

**SportIS** solves the friction of finding recreational sports venues and teammates in local communities. Built on a clean, dependency-free **MVC architecture in vanilla PHP 8**, it bridges geographic facility discovery with social networking:

- **Court Discovery**: Real coordinates from OpenStreetMap of 350+ football pitches, tennis courts, basketball venues, and parks across Iași.
- **Event Coordination**: Real-time event creation, multi-tag filtering, capacity tracking, and participation management.
- **Social Graph**: Mutual friend requests, duration tracking, and activity profiles.
- **Content Syndication**: External news aggregation and standards-compliant RSS 2.0 generation with SMTP notifications via PHPMailer.

---

## Key Features

### 1. Interactive Court Finder (Leaflet.js + OpenStreetMap)
- Interactive map centered on Iași with custom markers for every sports ground.
- Court metadata popups (surface type, sport category, court name).
- Direct actions from map pins: view existing events or open modal to schedule a new match.
- Smooth fly-to camera animations when selecting an event card from the list.

### 2. Event Management & Capacity Control
- **Filters & Search**: Multi-criteria search by event name, tag selection, start or end dates, and number of participants.
- **Business Constraints**: Enforces maximum match duration of 6 hours and prevents registrations once capacity is reached.
- **Event Lifecycle**: Creators can edit event details, update schedules, or delete events with cascade cleanup.
- **One-Click Participation**: Join or cancel participation with asynchronous AJAX updates.

### 3. Social Network & Profiles
- **Friendship Lifecycle**: Send requests, accept incoming requests, and remove connections.
- **Friendship Duration**: Displays how long users have been friends (calculated in days).
- **Discovery**: Recommends 5 random non-friend community members and supports keyword search.
- **Profile Hub**: Displays user registration details, list of attended events, created matches, and friends list.

### 4. News & RSS Syndication
- **Sports News Aggregator**: Real-time XML parsing and feed aggregation from Romanian sports outlets (Digi24, Observator) via PHP `DOMDocument` and `XPath`.
- **Custom RSS 2.0 Generator**: Dynamically generates valid XML RSS feeds (`/rss/feed`) filterable by specific court ID and sport tag.
- **Automated Mailer**: Dispatches event summaries via SMTP using PHPMailer.

### 5. Role-Based Access Control & Admin Panel
- **Role Verification**: Middleware checks ensuring only administrators access management features.
- **User Moderation**: Search user base, suspend/ban problematic accounts, or restore access.
- **Tag Management**: Dynamically register new sport tags (e.g. `#fotbal`, `#tenis`) or remove obsolete ones.
- **Event Moderation**: Global oversight to remove spam or obsolete events.

---

- **Backend**: PHP 8.2 (Vanilla MVC, zero bloated third-party frameworks).
- **Database**: MySQL 8.0 / MariaDB 10.11 with `utf8mb4` encoding.
- **Security**:
  - Prepared statements with parameterized queries across all database operations.
  - Strong password hashing via `password_hash()` (Bcrypt).
  - Cross-site script mitigation with `htmlspecialchars()`.
  - Session protection and role verification (`is_admin`, `is_banned`).
- **Frontend**: Vanilla HTML5, Custom CSS3, Leaflet.js, OpenStreetMap.
- **Containerization**: Docker & Docker Compose with multi-stage build.

---

## Demo Accounts

The database comes pre-seeded with test accounts ready for demonstration:

| Role | Email | Password | Access Privileges |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@admin` | `admin1` | Full administrative control (Users, Events, Tags moderation) |
| **Standard User** | `user@user` | `user123` | Social features, Event creation, Participation, Profile |

> Open user registration is also available directly on the `/login/register` page.

---

## Launching the app using Docker

Run the entire application (Apache PHP 8.2 + MariaDB 10.11 pre-seeded with all 350+ sports grounds and sample events) in one command:

### 1. Prerequisites
- [Docker](https://docs.docker.com/get-docker/) & [Docker Compose](https://docs.docker.com/compose/) installed and running.

### 2. Clone and Start
```bash
git clone https://github.com/PetruGlt/LocalGreetings.git
cd LocalGreetings

# Build and start services in detached mode
docker compose up -d --build
```

### 3. Open Application
- Web Application: **[http://localhost:8080](http://localhost:8080)**
- Database (MariaDB): `localhost:3307` (User: `sportis_user`, Password: `sportis_pass`, Database: `sportis`)

### 4. Stop Containers
```bash
docker compose down
```

---

## Configuration & Environment Variables

Environment settings are loaded via `app/core/Config.php`. System environment variables (Docker / Cloud) take precedence over a local `.env` file:

| Variable | Default Value | Description |
| :--- | :--- | :--- |
| `APP_URL` | Auto-detected | Base URL of the application without trailing slash |
| `MYSQL_SERVER` | `127.0.0.1` | Database hostname or container service name (`db`) |
| `MYSQL_PORT` | `3306` | MySQL / MariaDB connection port |
| `MYSQL_DB` | `sportis` | Name of the database schema |
| `MYSQL_USER` | `root` | Database username |
| `MYSQL_PASSWORD` | `""` | Database password |
| `MAIL_ADDRESS` | `""` | (Optional) Gmail SMTP address for RSS notifications |
| `MAIL_PASSWORD` | `""` | (Optional) Gmail App Password for SMTP dispatch |

---

## Project Structure

```
LocalGreetings/
├── app/
│   ├── controllers/         # Application controllers
│   │   ├── admin.php        # User, event, and tag moderation
│   │   ├── event.php        # Event CRUD, participation, filtering
│   │   ├── home.php         # Main map page, profile, news, doc views
│   │   ├── login.php        # Authentication and registration
│   │   ├── rss.php          # RSS feed generation and email dispatch
│   │   └── social.php       # Friends, friend requests, user discovery
│   ├── core/                # MVC Kernel
│   │   ├── App.php          # Request router and URL dispatcher
│   │   ├── Config.php       # Environment configuration manager
│   │   └── Controller.php   # Base controller with view and redirect helpers
│   ├── models/              # Business logic and entity models
│   │   ├── EventModel.php   # Events, participants, and query filters
│   │   ├── News.php         # External sports RSS fetcher via DOM/XPath
│   │   ├── RSSMailer.php    # PHPMailer SMTP client
│   │   ├── Tag.php          # Sports tags management
│   │   └── User.php         # User accounts and social graph queries
│   ├── services/            # Services layer
│   │   ├── DatabaseService.php # MySQLi wrapper with prepared statements
│   │   ├── LoginService.php    # Auth verification
│   │   └── RegisterUserService.php # Account creation validation
│   ├── sql/                 # Legacy SQL dumps
│   └── views/               # PHP Templates and Partials
│       ├── admin/           # Admin panel views
│       ├── docs/            # Scholarly HTML specifications
│       ├── event/           # Event view, edit, and court event lists
│       ├── home/            # Main map dashboard, profile, news feed
│       ├── login/           # Login and registration pages
│       ├── partials/        # Reusable navbars, modals, and error banners
│       └── social/          # Friends list and pending requests
├── docker/
│   └── init.sql             # Consolidated clean database schema & seeds
├── public/                  # Public web root (DocumentRoot)
│   ├── css/                 # Stylesheets (MainStyle.css, loginStyle.css)
│   ├── docs/                # Architecture diagrams (C4_SPORTIS.pdf)
│   ├── images/              # Assets and UI background graphics
│   ├── js/                  # Client-side JavaScript (Leaflet map, event logic)
│   ├── .htaccess            # Apache mod_rewrite rules
│   ├── index.php            # Application entry point
│   └── scriptLocatii.php    # OpenStreetMap Overpass API court seeder
├── .env.example             # Environment template
├── docker-compose.yml       # Multi-container orchestration (App + MariaDB)
├── Dockerfile               # Production container definition
├── index.php                # Root fallback forwarder
├── .htaccess                # Root directory rewrite forwarder
└── README.md                # Project documentation
```

---

## Documentation & Media

- 📐 **Architecture Diagram**: [C4 Diagram PDF Document](./public/docs/C4_SPORTIS.pdf)
- 📖 **Functional Specifications (EN)**: Accessible at `/home/viewDocEn` or [View English Doc](./app/views/docs/descriptionEn.php)
- 📖 **Specificații Funcționale (RO)**: Accessible at `/home/viewDocRo` or [Vezi Documentație Română](./app/views/docs/descriptionRo.php)
- 🎥 **Video Walkthrough Demo**: [Watch on YouTube](https://www.youtube.com/watch?v=x-aB86FheFA)


