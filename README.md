<p align="center">
    <a href="https://laravel.com" target="_blank">
        <h1>DevBlog</h1>
    </a>
</p>

<!--Badges-->
<p align="center">
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform">
        <img src="https://img.shields.io/github/stars/moshoubash/BloggingPlatform?style=social" alt="Stars">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform/issues">
        <img src="https://img.shields.io/github/issues/moshoubash/BloggingPlatform" alt="Issues">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform/pulls">
        <img src="https://img.shields.io/github/issues-pr/moshoubash/BloggingPlatform" alt="Pull Requests">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform/commits/main">
        <img src="https://img.shields.io/github/last-commit/moshoubash/BloggingPlatform" alt="Last Commit">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform/blob/main/LICENSE">
        <img src="https://img.shields.io/github/license/moshoubash/BloggingPlatform" alt="License">
    </a>
    <a href="https://github.com/moshoubash/BloggingPlatform">
        <img src="https://img.shields.io/badge/Built%20With-Laravel%2011-red.svg" alt="Laravel 11">
    </a>
    <a href="https://tailwindcss.com">
        <img src="https://img.shields.io/badge/Styled%20With-Tailwind%20CSS-38B2AC.svg" alt="Tailwind CSS">
    </a>
    <a href="#">
        <img src="https://img.shields.io/badge/PHP-8.3-blue.svg" alt="PHP Version">
    </a>
</p>

# DevBlog
A modern, feature-rich blogging platform built with **Laravel 11**, **PHP**, and **Tailwind CSS**. Designed for bloggers and content creators, it supports user-generated content, premium subscriptions, and powerful admin controls.

## ✨ Features

- 🔐 **User registration and authentication**
- ⚙️ **Highly Customizable**
- 🛡️ **Security Focused CMS**
- 🌙 **Dark Mode & Mobile Friendly**
- ✍️ **Smart Markdown Editor**
- 💬 **Users & Comments**
- 🔍 **Semantic and data-rich SEO-minded HTML**
- 🔒 **Premium Content for Premium Users**
- ➕ **Ability to Follow Users**
- 🔔 **Likes, Comments, and also Following Notifications**
- 🤖 **Tags Generated Automatically using AI**
- 📋 **Admin dashboard for content moderation**
- 👀 **View counts and featured articles**
- 📊 **Users can see Their Stats**
- 📝 **Users can Edit their Profiles**
- 🔖 **Users can add Bookmarks to posts**

## Tech Stack (TALL)
- [TailwindCSS 3](https://tailwindcss.com/) (MIT)
- [AlpineJS 3](https://alpinejs.dev/) (MIT)
- [Laravel 11](https://laravel.com/) (MIT)
- [Livewire 2](https://laravel-livewire.com/) (MIT)

## Get Started

### Prerequisites

- PHP 8.3+
- Composer
- Node.js and npm
- MySQL or PostgreSQL

### Quick Install

```bash
git clone https://github.com/moshoubash/BloggingPlatform.git
cd BloggingPlatform
composer install
npm install && npm run prod
cp .env.example .env
php artisan migrate
php artisan db:seed --class=DemoSeeder
php artisan key:generate
php artisan storage:link
composer require rubix/ml
composer require stripe/stripe-php
composer require phpoffice/phpspreadsheet
php artisan admin:create
php artisan serve
```
### (Note) You need to add Stripe and Google data into .env file