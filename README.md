# CRM Platform for Children's Programming Courses

A comprehensive web application for managing programming courses designed specifically for children. The platform connects coaches, students, and administrators in an intuitive learning management system.

## 🌐 Live Demo

**Production URL**: [https://crm-platforma-production.up.railway.app/](https://crm-platforma-production.up.railway.app/)

## 🔑 Test Accounts

| Role    | Email                    | Password   |
|---------|--------------------------|------------|
| Coach   | petr.novak@example.com   | password   |
| Admin   | admin@example.com        | password   |
| Student | Register with email or use Google OAuth |

## 🚀 Features

### For Students
- **Multiple Authentication Methods**: Email/password registration or Google OAuth login
- **Course Discovery**: Browse and enroll in available programming courses
- **Homework Submission**: Submit assignments with text descriptions and file attachments (up to 25MB)
- **Progress Tracking**: Monitor learning progress across enrolled courses
- **Profile Management**: Update profile picture, change password, and manage account

### For Coaches
- **Course Management**: Create, edit, and delete programming courses
- **Lesson Planning**: Organize courses into structured lessons with detailed descriptions
- **Homework Assignment**: Set assignments with opening dates and deadlines
- **Submission Review**: View and grade student homework submissions (grades 1-5)
- **Student Enrollment**: Manage which students are enrolled in courses
- **Profile Customization**: Update personal information and profile picture

### For Admins
- **Dashboard Access**: Overview of platform activity
- **User Management**: Administrative oversight of coaches and students

## 🛠️ Technology Stack

- **Framework**: Laravel 12.x
- **PHP Version**: 8.2+
- **Database**: MySQL 8 (InnoDB engine, utf8mb4 charset)
- **Web Server**: Apache 2.4 (with mod_rewrite)
- **Frontend**: 
  - Vite 6.x for asset bundling
  - Tailwind CSS v4
  - Bootstrap 5.3 (CDN)
  - Vanilla JavaScript
- **Authentication**: Laravel multi-guard authentication system
- **OAuth**: Laravel Socialite (Google provider)
- **Email**: Resend API for transactional emails

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+
- XAMPP (recommended for local development) or similar Apache/MySQL stack

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/ikoronka/crm-platforma.git
cd crm-platforma
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Configure Email (Resend API)

Add your Resend API key to `.env`:

```env
RESEND_API_KEY=your_resend_api_key_here
```

### 6. Configure Google OAuth (Optional)

For Google authentication, add these credentials to `.env`:

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/semestralka/public/student/auth/google/callback
```

### 7. Run Migrations and Seeders

```bash
# Run database migrations
php artisan migrate

# Seed the database with test data
php artisan db:seed
```

### 8. Create Storage Symlink

```bash
php artisan storage:link
```

### 9. Start Development Server

**Option A: Using XAMPP**
- Start Apache and MySQL services in XAMPP
- Access the application at: `http://localhost/semestralka/public`

**Option B: Using Laravel's Built-in Server**
```bash
# Start the Laravel development server
php artisan serve

# In another terminal, start Vite for hot module replacement
npm run dev
```
- Access the application at: `http://localhost:8000`

## 🏗️ Architecture

### Multi-Guard Authentication

The application uses Laravel's multi-guard authentication to support three distinct user types:

- **Coach Guard** (`auth:coach`) - For course instructors
- **Student Guard** (`auth:student`) - For enrolled students  
- **Admin Guard** (`auth:admin`) - For platform administrators

Each guard has its own Eloquent provider and session management, defined in `config/auth.php`.

### Database Structure

All tables use the `z_` prefix convention:

- `z_coaches` - Coach accounts and profiles
- `z_students` - Student accounts and profiles
- `z_admins` - Administrator accounts
- `z_courses` - Programming courses
- `z_course_templates` - Reusable course templates
- `z_lessons` - Individual lessons within courses
- `z_homework` - Homework assignments for lessons
- `z_submissions` - Student homework submissions
- `z_enrollments` - Student-course relationships (pivot table)
- `z_progress` - Student progress tracking

Foreign key relationships use cascading deletes to maintain referential integrity.

### Route Organization

Routes are organized by user role with corresponding prefixes:

- `/coach/*` - Coach-specific routes (course management, grading)
- `/student/*` - Student-specific routes (enrollment, submissions)
- `/admin/*` - Admin-specific routes (dashboard, oversight)
- `/` - Public landing page

## 🧪 Development Workflows

### Useful Artisan Commands

```bash
# Reset database with fresh data
php artisan migrate:fresh --seed

# View all registered routes
php artisan route:list

# Access Laravel REPL (Tinker)
php artisan tinker

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Code Conventions

**Controllers**: Named by role and entity (e.g., `CoachCourseController`, `StudentLessonController`)

**Models**: Use explicit relationship definitions with foreign keys:
```php
public function courses() {
    return $this->hasMany(Course::class, 'coach_id', 'id');
}
```

**Views**: Three main layouts (`layouts/app.blade.php`, `layouts/coach.blade.php`, `layouts/student.blade.php`)

**Authorization**: Manual ownership checks in controllers:
```php
if ($course->coach_id !== auth('coach')->id()) {
    abort(403);
}
```

## 📁 Project Structure

```
app/
├── Http/Controllers/     # Controllers organized by role
├── Mail/                 # Mailable classes for email
└── Models/               # Eloquent models with relationships

config/
├── auth.php             # Multi-guard authentication config
└── services.php         # Third-party service configuration

database/
├── migrations/          # Database schema migrations
└── seeders/             # Test data seeders

resources/
├── views/               # Blade templates
│   ├── coach/          # Coach-specific views
│   ├── student/        # Student-specific views
│   ├── admin/          # Admin-specific views
│   ├── layouts/        # Layout templates
│   └── partials/       # Reusable components
├── css/                 # Stylesheets
└── js/                  # JavaScript files

routes/
├── web.php              # All web routes
└── coach.php            # Additional coach routes (legacy)
```

## 🚢 Deployment

The application is deployed on Railway. For production deployment:

1. Set all required environment variables (database, Resend API, Google OAuth)
2. Run migrations: `php artisan migrate --force`
3. Run seeders if needed: `php artisan db:seed --force`
4. Create storage symlink: `php artisan storage:link`
5. Build frontend assets: `npm run build`

## 📝 License

This project is open-source and available under the MIT License.

---

# CRM Platforma pro dětské programovací kurzy

Komplexní webová aplikace pro správu programovacích kurzů navržená speciálně pro děti. Platforma propojuje lektory, studenty a administrátory v intuitivním systému pro řízení výuky.

## 🌐 Demo aplikace

**Produkční URL**: [https://crm-platforma-production.up.railway.app/](https://crm-platforma-production.up.railway.app/)

## 🔑 Testovací účty

| Role    | E-mail                   | Heslo      |
|---------|--------------------------|------------|
| Kouč    | petr.novak@example.com   | password   |
| Admin   | admin@example.com        | password   |
| Student | Registrace e-mailem nebo přes Google OAuth |

## 🚀 Funkce

### Pro studenty
- **Více způsobů přihlášení**: Registrace e-mailem/heslem nebo přihlášení přes Google OAuth
- **Hledání kurzů**: Procházení a zápis do dostupných programovacích kurzů
- **Odevzdávání úkolů**: Odevzdání domácích úkolů s textovým popisem a přílohami (až 25 MB)
- **Sledování pokroku**: Monitoring výuky napříč zapsanými kurzy
- **Správa profilu**: Aktualizace profilové fotky, změna hesla a správa účtu

### Pro lektory (kouče)
- **Správa kurzů**: Vytváření, úprava a mazání programovacích kurzů
- **Plánování lekcí**: Organizace kurzů do strukturovaných lekcí s detailními popisy
- **Zadávání úkolů**: Nastavení domácích úkolů s datem otevření a termínem odevzdání
- **Kontrola odevzdání**: Prohlížení a hodnocení studentských odevzdání (známky 1-5)
- **Správa zápisů**: Řízení, kteří studenti jsou zapsáni do kurzů
- **Úprava profilu**: Aktualizace osobních údajů a profilové fotky

### Pro administrátory
- **Přístup k dashboardu**: Přehled aktivit na platformě
- **Správa uživatelů**: Administrativní dohled nad lektory a studenty

## 🛠️ Technologický stack

- **Framework**: Laravel 12.x
- **Verze PHP**: 8.2+
- **Databáze**: MySQL 8 (InnoDB engine, utf8mb4 charset)
- **Webový server**: Apache 2.4 (s mod_rewrite)
- **Frontend**: 
  - Vite 6.x pro bundling assetů
  - Tailwind CSS v4
  - Bootstrap 5.3 (CDN)
  - Vanilla JavaScript
- **Autentizace**: Laravel multi-guard autentizační systém
- **OAuth**: Laravel Socialite (Google provider)
- **E-mail**: Resend API pro transakční e-maily

## 📋 Požadavky

- PHP 8.2 nebo vyšší
- Composer
- Node.js 18+ a npm
- MySQL 8.0+
- XAMPP (doporučeno pro lokální vývoj) nebo podobný Apache/MySQL stack

## ⚙️ Instalace

### 1. Klonování repozitáře

```bash
git clone https://github.com/ikoronka/crm-platforma.git
cd crm-platforma
```

### 2. Instalace závislostí

```bash
# Instalace PHP závislostí
composer install

# Instalace Node.js závislostí
npm install
```

### 3. Konfigurace prostředí

```bash
# Zkopírování ukázkového souboru prostředí
cp .env.example .env

# Vygenerování aplikačního klíče
php artisan key:generate
```

### 4. Konfigurace databáze

Upravte soubor `.env` s vašimi databázovými přihlašovacími údaji:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nazev_vasi_databaze
DB_USERNAME=vase_databazove_jmeno
DB_PASSWORD=vase_databazove_heslo
```

### 5. Konfigurace e-mailu (Resend API)

Přidejte váš Resend API klíč do `.env`:

```env
RESEND_API_KEY=vas_resend_api_klic
```

### 6. Konfigurace Google OAuth (volitelné)

Pro Google autentizaci přidejte tyto přihlašovací údaje do `.env`:

```env
GOOGLE_CLIENT_ID=vas_google_client_id
GOOGLE_CLIENT_SECRET=vas_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/semestralka/public/student/auth/google/callback
```

### 7. Spuštění migrací a seedů

```bash
# Spuštění databázových migrací
php artisan migrate

# Naplnění databáze testovacími daty
php artisan db:seed
```

### 8. Vytvoření symlinku pro storage

```bash
php artisan storage:link
```

### 9. Spuštění vývojového serveru

**Možnost A: Použití XAMPP**
- Spusťte Apache a MySQL služby v XAMPP
- Přístup k aplikaci na: `http://localhost/semestralka/public`

**Možnost B: Použití vestavěného Laravel serveru**
```bash
# Spuštění Laravel vývojového serveru
php artisan serve

# V dalším terminálu spusťte Vite pro hot module replacement
npm run dev
```
- Přístup k aplikaci na: `http://localhost:8000`

## 🏗️ Architektura

### Multi-Guard autentizace

Aplikace používá Laravel multi-guard autentizaci pro podporu tří odlišných typů uživatelů:

- **Coach Guard** (`auth:coach`) - Pro lektory kurzů
- **Student Guard** (`auth:student`) - Pro zapsané studenty  
- **Admin Guard** (`auth:admin`) - Pro administrátory platformy

Každý guard má svůj vlastní Eloquent provider a správu session, definované v `config/auth.php`.

### Struktura databáze

Všechny tabulky používají prefix `z_`:

- `z_coaches` - Účty a profily koučů
- `z_students` - Účty a profily studentů
- `z_admins` - Účty administrátorů
- `z_courses` - Programovací kurzy
- `z_course_templates` - Opakovaně použitelné šablony kurzů
- `z_lessons` - Jednotlivé lekce v rámci kurzů
- `z_homework` - Domácí úkoly k lekcím
- `z_submissions` - Odevzdání úkolů studenty
- `z_enrollments` - Vztahy student-kurz (pivot tabulka)
- `z_progress` - Sledování pokroku studentů

Vztahy cizích klíčů používají kaskádové mazání pro zachování referenční integrity.

### Organizace routování

Routy jsou organizovány podle role uživatele s odpovídajícími prefixy:

- `/coach/*` - Routy specifické pro kouče (správa kurzů, hodnocení)
- `/student/*` - Routy specifické pro studenty (zápis, odevzdání)
- `/admin/*` - Routy specifické pro adminy (dashboard, dohled)
- `/` - Veřejná úvodní stránka

## 🧪 Vývojové workflow

### Užitečné Artisan příkazy

```bash
# Reset databáze s čerstvými daty
php artisan migrate:fresh --seed

# Zobrazení všech registrovaných rout
php artisan route:list

# Přístup k Laravel REPL (Tinker)
php artisan tinker

# Vyčištění aplikační cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Konvence kódu

**Controllery**: Pojmenovány podle role a entity (např. `CoachCourseController`, `StudentLessonController`)

**Modely**: Používají explicitní definice vztahů s cizími klíči:
```php
public function courses() {
    return $this->hasMany(Course::class, 'coach_id', 'id');
}
```

**Pohledy**: Tři hlavní layouty (`layouts/app.blade.php`, `layouts/coach.blade.php`, `layouts/student.blade.php`)

**Autorizace**: Manuální kontroly vlastnictví v controllerech:
```php
if ($course->coach_id !== auth('coach')->id()) {
    abort(403);
}
```

## 📁 Struktura projektu

```
app/
├── Http/Controllers/     # Controllery organizované podle role
├── Mail/                 # Mailable třídy pro e-maily
└── Models/               # Eloquent modely se vztahy

config/
├── auth.php             # Konfigurace multi-guard autentizace
└── services.php         # Konfigurace služeb třetích stran

database/
├── migrations/          # Migrace databázového schématu
└── seeders/             # Seedery testovacích dat

resources/
├── views/               # Blade šablony
│   ├── coach/          # Pohledy specifické pro kouče
│   ├── student/        # Pohledy specifické pro studenty
│   ├── admin/          # Pohledy specifické pro adminy
│   ├── layouts/        # Šablony layoutů
│   └── partials/       # Znovupoužitelné komponenty
├── css/                 # Styly
└── js/                  # JavaScript soubory

routes/
├── web.php              # Všechny webové routy
└── coach.php            # Další routy pro kouče (legacy)
```

## 🚢 Nasazení

Aplikace je nasazena na Railway. Pro produkční nasazení:

1. Nastavte všechny požadované proměnné prostředí (databáze, Resend API, Google OAuth)
2. Spusťte migrace: `php artisan migrate --force`
3. Spusťte seedery pokud je potřeba: `php artisan db:seed --force`
4. Vytvořte symlink pro storage: `php artisan storage:link`
5. Sestavte frontend assety: `npm run build`

## 📝 Licence

Tento projekt je open-source a dostupný pod licencí MIT.
