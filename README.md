# 🇧🇩 Nirbhoy Bangladesh – Public Safety & Incident Reporting Platform

Nirbhoy Bangladesh is a bilingual public safety and incident reporting platform designed to help citizens report incidents, share evidence, identify wanted individuals, and access important safety information across Bangladesh.

The platform provides a centralized digital system for public reporting, incident documentation, evidence management, and administrative monitoring.

---

## 📌 Project Overview

Nirbhoy Bangladesh aims to create a safer and more connected Bangladesh by providing citizens with an accessible platform for reporting incidents and accessing public safety information.

The platform supports Bangladesh's administrative structure, including:

* Divisions
* Districts
* Upazilas
* Unions
* Wards

The public-facing platform is available in both Bangla and English, with Bangla as the default language.

---

## ✨ Key Features

### 👤 Public Users

* Browse the public safety platform
* Submit incident reports
* View reported incidents
* Search safety information
* View wanted/hot list information
* Upload supporting evidence
* Browse reports by location
* Switch between Bangla and English
* Access public safety information without registration

### 🛡️ Incident Reporting

* Create incident reports
* Report incident details
* Select incident location
* Select administrative area
* Add descriptions
* Upload supporting evidence
* Track report information
* Manage submitted reports

### 🔥 Hot List

* Display important wanted individuals
* View relevant information
* Search hot list entries
* View available identification details
* Manage hot list records through administration

### 📁 Evidence Management

* Upload supporting files
* Store evidence securely
* Associate evidence with reports
* Manage uploaded evidence
* Maintain evidence records

### 👨‍💼 Admin

* Secure admin login
* Admin dashboard
* Manage incident reports
* Manage hot list
* Manage evidence
* Manage locations
* Manage public safety information
* Monitor platform activities
* Manage system data

---

## 🗺️ Administrative Structure

Nirbhoy Bangladesh supports hierarchical location management:

```text
Bangladesh
│
├── Division
│   ├── District
│   │   ├── Upazila
│   │   │   ├── Union
│   │   │   └── Ward
│   │   └── ...
│   └── ...
└── ...
```

---

## 🌐 Language Support

Nirbhoy Bangladesh supports bilingual content:

* 🇧🇩 Bangla
* 🇬🇧 English

Bangla is used as the default language for the public platform.

---

## 🔐 Security

The platform is designed to protect sensitive reporting and administrative information.

### Security Features

* Secure admin authentication
* Role-based access control
* Protected administrative routes
* Input validation
* Secure file handling
* Protected evidence management
* Secure database operations
* Controlled administrative access

---

## 🧩 Main Modules

* Public Home
* Incident Reporting
* Incident Management
* Reports
* Evidence Management
* Hot List
* Location Management
* Division Management
* District Management
* Upazila Management
* Union Management
* Ward Management
* Admin Dashboard
* Bangla/English Language Support

---

## 🏗️ System Architecture

```text
                    ┌─────────────────────┐
                    │      Citizens       │
                    │   Public Platform   │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Frontend       │
                    │  Laravel Blade/UI   │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Backend        │
                    │   Laravel / PHP     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │       MySQL         │
                    │      Database       │
                    └─────────────────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │   Evidence Storage  │
                    │  Reports & Files    │
                    └─────────────────────┘
```

---

## 🛠️ Technologies Used

### Backend

* PHP
* Laravel

### Frontend

* HTML5
* CSS3
* JavaScript
* Blade Template Engine

### Database

* MySQL

### Development Tools

* XAMPP
* Composer
* Git
* GitHub
* Visual Studio Code

---

## 📂 Main Modules

```text
Nirbhoy Bangladesh
│
├── Public Platform
├── Authentication
├── Admin Dashboard
├── Incident Reports
├── Evidence Management
├── Hot List
├── Division Management
├── District Management
├── Upazila Management
├── Union Management
├── Ward Management
└── Bangla / English Support
```

---

## 🔄 Incident Reporting Flow

```text
Citizen
   │
   ▼
Open Nirbhoy Bangladesh
   │
   ▼
Submit Incident Report
   │
   ▼
Add Incident Details
   │
   ▼
Select Location
   │
   ▼
Upload Evidence
   │
   ▼
Submit Report
   │
   ▼
Administrative Review
   │
   ▼
Report Management
```

---

## 📋 Report Information

Incident reports can contain information such as:

* Incident title
* Incident description
* Incident category
* Location
* Administrative area
* Date and time
* Supporting evidence
* Additional information

---

## 🎯 Project Objectives

* Provide citizens with an accessible incident reporting platform
* Digitize public safety reporting
* Centralize incident information
* Improve incident documentation
* Support evidence-based reporting
* Provide organized public safety information
* Support Bangladesh's administrative structure
* Provide bilingual public access
* Improve communication between citizens and administrators

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/rajmukut791/Nirbhoy-Bangladesh.git
```

### 2. Navigate to the Project

```bash
cd "Nirbhoy Bangladesh"
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Configure Environment

Create a `.env` file:

```bash
cp .env.example .env
```

Configure the database:

```env
DB_DATABASE=nirbhoy_bangladesh
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migration

```bash
php artisan migrate
```

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Start the Application

```bash
php artisan serve
```

---

## 📸 Screenshots

```markdown
![Home Page](screenshots/home.png)

![Report Page](screenshots/report.png)

![Hot List](screenshots/hot-list.png)

![Reports](screenshots/reports.png)

![Admin Dashboard](screenshots/admin-dashboard.png)

![Evidence Management](screenshots/evidence.png)
```

---

## 🔮 Future Improvements

* Mobile application
* Real-time emergency alerts
* SMS notifications
* Email notifications
* GPS-based incident reporting
* Interactive safety map
* Real-time incident tracking
* Advanced analytics
* AI-assisted report classification
* Emergency contact integration

---

## 📚 Academic Project

**Project Name:** Nirbhoy Bangladesh
**Project Type:** Public Safety & Incident Reporting Platform
**Technology:** Laravel, PHP & MySQL
**Language:** Bangla & English
**Field:** Computer Science & Engineering

---

## 👨‍💻 Developer

**Raj Mukut**

Computer Science & Engineering
Northern University Bangladesh

### Connect

* GitHub: https://github.com/rajmukut1628
* Facebook: https://facebook.com/rajmukut791
* Email: [rajmukut791@gmail.com](mailto:rajmukut791@gmail.com)

---

## 📄 License

This project was developed for academic and educational purposes.

© 2026 Raj Mukut. All Rights Reserved.
