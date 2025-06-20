<p align="center">
  <img src="https://cdn-icons-png.flaticon.com/512/7058/7058249.png" width="80" />
</p>

<h1 align="center">🛡️ SHIELD MAP</h1>

<p align="center">
  Sexual Harm Incident & Emergency Location Dashboard
</p>

---

## 🚨 What is SHIELD MAP?

**SHIELD MAP** is a geo-based incident reporting platform focused on identifying, mapping, and tracking **sexual harassment and assault cases** in urban areas.

It allows users to:
- Report incidents by placing markers directly on the map
- Attach descriptions, contact info, and visual proof (image upload)
- See real-time statistics of reports (daily, total, and active points)
- Access a beautiful, dark-mode dashboard with interactive UI

The map is powered by **Leaflet.js** and data is handled using Laravel's backend structure. Designed to be scalable, community-powered, and data-driven.

---

## 🧠 Features

- 🔴 Custom leaflet markers with WKT geometry
- 🖼️ Image preview on incident submission
- 📊 Stats panel with real-time data
- 📍 Latest report log with time-ago formatting
- 🗺️ Map layers with togglable overlays
- 🧾 Built-in form validation & modal entry
- 💾 Laravel + Blade templating + Bootstrap UI

---

## 💻 Tech Stack

| Frontend     | Backend      | Mapping        |
|--------------|--------------|----------------|
| Blade (Laravel) | Laravel 10.x  | LeafletJS       |
| Bootstrap 5  | PHP 8.2+     | WKT + GeoJSON   |
| FontAwesome  | MySQL / SQLite | Leaflet Draw Plugin |

---

## 🚀 Getting Started

```bash
# Clone the repo
git clone https://github.com/yourusername/shield-map.git

# Install dependencies
composer install
npm install && npm run dev

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Launch app
php artisan serve
