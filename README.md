# 🛒 SmartShop AI - Intelligent E-commerce Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/AlpineJS-3.x-8BC0D0.svg" alt="AlpineJS">
  <img src="https://img.shields.io/badge/PHPStan-Level%206-9C27B0.svg" alt="PHPStan Level">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

<p align="center">
  <strong>🚀 Modern E-commerce with AI-Powered Recommendations</strong><br>
  Built with Laravel, Tailwind CSS, and Alpine.js
</p>

---

## 📋 Table of Contents

- [🚀 Overview](#-overview)
- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [📁 Project Structure](#-project-structure)
- [🚀 Quick Start](#-quick-start)
- [🎯 Key Features](#-key-features)
- [🔧 Configuration](#-configuration)
- [📊 Performance](#-performance)
- [🎨 UI Components](#-ui-components)
- [🔒 Security](#-security)
- [📈 Scalability](#-scalability)
- [📝 License](#-license)
- [📞 Support](#-support)

---

## 🚀 Overview

**SmartShop AI** is a cutting-edge e-commerce platform that combines modern web technologies with artificial intelligence to deliver an exceptional shopping experience. Built on Laravel's robust foundation, it features intelligent product recommendations, seamless cart management, and a beautiful, responsive interface.

### 🎯 **Why SmartShop AI?**
- **🤖 AI-Driven**: Smart recommendations based on user behavior
- **⚡ Performance**: Redis caching and optimized queries
- **🎨 Modern UI**: Tailwind CSS with Alpine.js interactions
- **🏗️ Clean Architecture**: Repository pattern with service layers
- **🔒 Secure**: Built-in security features and validation

---

## ✨ Features

### 🛍️ **Core E-commerce Features**
- **📦 Product Catalog**: Advanced search and filtering capabilities
- **🛒 Smart Cart**: Real-time updates with session persistence
- **🔍 Product Details**: Rich product information with image galleries
- **💳 Checkout Process**: Streamlined order processing
- **👤 Guest Shopping**: No registration required

### 🤖 **AI-Powered Intelligence**
- **🧠 Smart Recommendations**: ML-driven product suggestions
- **📊 Personalized Experience**: Tailored recommendations per user
- **📈 Trending Products**: Algorithm-based discovery
- **🔄 View History Tracking**: Intelligent session management

### 🎨 **Modern UI/UX**
- **📱 Responsive Design**: Mobile-first approach
- **🌙 Dark Mode**: Beautiful theme switching
- **⚡ Interactive Components**: Alpine.js powered interactions
- **♿ Accessibility**: WCAG compliant design

### 🏗️ **Enterprise Architecture**
- **🔧 Clean Architecture**: Repository pattern with service layer
- **📦 DTO Pattern**: Type-safe data transfer objects
- **🔄 Pipeline Pattern**: Modular request processing
- **⚡ Caching Strategy**: Redis-based performance optimization

---

## 🛠️ Tech Stack

### **Backend Technologies**
| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.x | PHP Framework |
| **PHP** | 8.2+ | Programming Language |
| **SQLite** | Latest | Database (configurable) |
| **Redis** | Latest | Caching & Sessions |
| **Laravel Breeze** | 2.3 | Authentication |

### **Frontend Technologies**
| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 3.x | Utility-first CSS |
| **Alpine.js** | 3.x | Lightweight JavaScript |
| **Vite** | 7.x | Modern build tool |
| **Blade** | Latest | Server-side templating |

### **Development Tools**
| Tool | Purpose | Level |
|------|---------|-------|
| **PHPStan** | Static Analysis | Level 6 |
| **Laravel Pint** | Code Formatting | PSR-12 |
| **Laravel Debugbar** | Development Debugging | - |
| **Pest** | Testing Framework | - |

---

## 📁 Project Structure

```
smartshop-ai/
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/          # 🎮 Application controllers
│   │   ├── 📁 DataToObjects/        # 📦 DTOs for data transfer
│   │   ├── 📁 PipeLines/           # 🔄 Request processing pipelines
│   │   └── 📁 Requests/             # ✅ Form validation
│   ├── 📁 Models/                   # 🗃️ Eloquent models
│   ├── 📁 Repositories/            # 🏪 Repository pattern
│   │   ├── 📁 Contracts/           # 📋 Repository interfaces
│   │   └── 📁 Eloquents/            # 🔧 Repository implementations
│   └── 📁 Services/                 # ⚙️ Business logic services
├── 📁 resources/
│   ├── 📁 views/                   # 🎨 Blade templates
│   │   ├── 📁 components/          # 🧩 Reusable components
│   │   └── 📁 layouts/             # 📐 Layout templates
│   ├── 📁 css/                     # 🎨 Stylesheets
│   └── 📁 js/                      # ⚡ JavaScript files
├── 📁 routes/                      # 🛣️ Application routes
├── 📁 database/                    # 🗄️ Migrations & seeders
└── 📁 public/                      # 🌐 Public assets
```

---

## 🚀 Quick Start

### **Prerequisites**
- ✅ PHP 8.2 or higher
- ✅ Composer
- ✅ Node.js & NPM
- ✅ Redis (optional, for caching)

### **Installation**

1. **📥 Clone the repository**
   ```bash
   git clone https://github.com/Coder0010/smartshop-ai mostafakamel-smartshop-ai
   cd mostafakamel-smartshop-ai
   ```

2. **📦 Install dependencies for local development**
   ```bash
   set COMPOSER=composer.local.json && composer run setup-local-env
   ```
   📄 **Output**: [View Setup Log →](docs/setup-output.txt)

### **🔧 Available Development Commands**
📋 **Full Command List**: [View →](composer.local.json)
```bash
# Clear caches
set COMPOSER=composer.local.json && composer run optimize
```
```bash
# Refresh the backend setup
set COMPOSER=composer.local.json && composer run setup-backend-local
```
```bash
# Refresh the frontend setup
set COMPOSER=composer.local.json && composer run setup-frontend-local
```
```bash
# Refresh database
set COMPOSER=composer.local.json && composer run wipe-db
```

---

#### **Code Quality & Analysis**
```bash
# Code formatting & Static analysis
set COMPOSER=composer.local.json && composer run phpstan
```
📄 **Output**: [View PHPStan Log →](docs/phpstan-output.txt)

#### **Development Workflow**
```bash
# Start development environment
php artisan serve
```

---

## 🎯 Key Features

### **🤖 AI-Powered Recommendations**
The platform uses intelligent algorithms to suggest products based on:
- 👀 **User viewing history**
- 🏷️ **Product categories**

### **🛒 Advanced Cart Management**
- **💾 Session-based cart**: No registration required
- **⚡ Real-time updates**: Instant quantity changes
- **🔄 Persistent storage**: Cart survives browser sessions
- **🎯 Alpine.js integration**: Smooth user interactions

### **🔄 Product Pipeline**
Advanced request processing pipeline for:
- 📊 **Tracking viewed products**
- 💾 **Storing session data**
- 🤖 **Loading recommendations**
- ⚡ **Caching results**

---

## 🔧 Configuration

### **Environment Variables**
```env
# 🗄️ Database Configuration
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# ⚡ Cache Configuration
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# 🚀 Application Configuration
APP_NAME="SmartShop AI"
APP_ENV=local
APP_DEBUG=true
```

### **Repository Configuration**
The project uses a repository pattern with automatic binding:
```php
// config/repositories.php
App\Repositories\Contracts\ProductRepositoryContract::class => 
    App\Repositories\Eloquents\ProductRepositoryEloquent::class,
```

---

## 📊 Performance Features

- **⚡ Redis Caching**: Fast data retrieval with intelligent caching
- **🖼️ Image Optimization**: Optimized product images with lazy loading
- **📱 Lazy Loading**: Efficient resource loading
- **🗄️ Database Optimization**: Indexed queries and query optimization
- **🔄 Session Management**: Efficient session handling

---

## 🎨 UI Components

### **Available Components**
- `<x-guest-layout>` - Main guest layout with navigation
- `<x-guest.products.single-product>` - Product card component
- `<x-guest.products.recommanded.home-page>` - Home page recommendation card
- `<x-guest.products.recommanded.show-product>` - Product page recommendation

### **Styling Features**
- **🎨 Tailwind CSS**: Utility-first styling approach
- **📱 Responsive**: Mobile-first design philosophy
- **♿ Accessibility**: WCAG compliant components
- **🌙 Dark Mode**: Automatic theme switching

---

## 🔒 Security Features

- **🛡️ CSRF Protection**: All forms protected against CSRF attacks
- **✅ Input Validation**: Comprehensive request validation
- **🔐 SQL Injection Prevention**: Eloquent ORM protection
- **🚫 XSS Protection**: Blade template escaping
- **🔑 Authentication**: Laravel Breeze integration

---

## 📈 Scalability

**🏗️ Built with [Starter Core Kit](https://github.com/Coder0010/starter-core-kit/) Package of my own for Laravel**

- **🏪 Repository Pattern**: Easy to swap implementations
- **⚙️ Service Layer**: Business logic separation
- **⚡ Caching Strategy**: Redis-based performance optimization
- **🗄️ Database Optimization**: Efficient queries and indexing
- **🔄 Pipeline Architecture**: Modular and scalable request processing

---

## 📝 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- **🚀 Laravel Framework** - The amazing PHP framework
- **🎨 Tailwind CSS** - Beautiful utility-first CSS
- **⚡ Alpine.js** - Lightweight JavaScript framework
- **🔐 Laravel Breeze** - Authentication scaffolding
- **🏗️ Starter Core Kit** - Development foundation

---

## 📞 Support

For support, email **mostafakamel000@gmail.com** or create an issue in the repository.

---

<p align="center">
  <strong>Made with ❤️ using Laravel & Tailwind CSS</strong><br>
  <em>Building the future of e-commerce with AI</em>
</p>
