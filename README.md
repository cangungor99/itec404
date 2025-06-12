# 🎓 Digital Club Management System (DCMS)

A Laravel-based web platform designed for university clubs to manage memberships, events, resources, and communication in a structured and role-based environment.

## 📌 Features

### 🧑‍🤝‍🧑 Role-Based Access
- **Student**: Join clubs, access resources, post in forums.
- **Leader**: Approve content, manage club resources and events.
- **Manager (Advisor/Teacher)**: Full control over club activities and permissions.
- **Admin**: System-wide access and user management.

### 📁 Club Resources
- Upload and manage files, images, and notes.
- Role-based permissions on resource visibility and edit access.
- AJAX-powered dynamic filtering and searching.

### 💬 Forum System
- Students can create posts for their clubs.
- Leader approval required for visibility.
- Nested comments with attachment support.

### 📢 Notification System
- Real-time notification view for each role.
- Read/unread tracking.
- Admin panel for sending global messages.

### 💬 Real-time Chat
- **One-on-one messaging** between users.
- **Group chat** for club-specific discussions.
- Read status tracking and organized by tab.

### 📊 Admin Dashboard
- Manage all clubs, users, and resources.
- View system-wide statistics and activity.

## ⚙️ Tech Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Blade, Tailwind CSS, Livewire/AJAX
- **Database**: MySQL / SQLite (for testing)
- **Authentication**: Laravel Breeze (customized)
- **Chat & Notification**: Laravel Events, Broadcast (Pusher optional)

## 🚀 Installation

```bash
git clone https://github.com/cangungor99/itec404
cd itec404/laravel

# Install dependencies
composer install
npm install && npm run dev

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure your DB credentials in .env
php artisan migrate --seed

# Optional: storage link
php artisan storage:link

# Start the server
php artisan serve

The Reset 