# CRM Platform for Children's Programming Courses

This is a Laravel 12 application running on XAMPP (Apache 2.4, PHP 8.2+, MySQL 8) for managing programming courses for children. The platform serves three distinct user roles with separate authentication guards.

## Architecture Overview

### Multi-Guard Authentication System
- **Three separate guards**: `coach`, `student`, and `admin` (defined in `config/auth.php`)
- Each guard has its own Eloquent provider pointing to `Coach`, `Student`, and `Admin` models
- All models extend `Authenticatable` and use table prefix `z_` (e.g., `z_coaches`, `z_students`, `z_admins`)
- Routes are organized by role with middleware: `auth:coach`, `auth:student`, `auth:admin`
- Guest middleware is role-specific: `guest:student` for student registration/login pages

### Database Schema
All tables use `z_` prefix. Core entities:
- **Coaches** (manual accounts) create and manage courses
- **Students** (OAuth or email/password) enroll in courses and submit homework
- **Courses** belong to coaches via `coach_id`, optionally reference `CourseTemplate` via `template_id`
- **Lessons** belong to courses, have one `Homework` each
- **Homework** has many `Submissions` from students
- **Enrollments** (pivot table) manages student-course many-to-many relationship
- Migrations use cascading deletes (`onDelete('cascade')`) for data integrity

### Route Structure
All routes are prefixed by role in `routes/web.php`:
- `/coach/*` - Coach dashboard, course/lesson CRUD, grading submissions
- `/student/*` - Student dashboard, course enrollment, homework submission
- `/admin/*` - Admin dashboard (minimal functionality)
- Google OAuth callback: `student/auth/google/callback`

## Development Workflows

### Local Development (XAMPP)
```bash
# Start XAMPP Apache and MySQL services first
# Application runs at: http://localhost/semestralka/public

# Development commands
npm run dev              # Vite dev server for hot reload
php artisan serve        # Alternative to XAMPP (runs on port 8000)
php artisan migrate      # Run migrations
php artisan db:seed      # Seed test data
```

### Key Artisan Commands
```bash
php artisan migrate:fresh --seed  # Reset database with seed data
php artisan route:list            # View all registered routes
php artisan tinker                # REPL for testing models
```

### Frontend Build
- Vite configured with Tailwind CSS v4 + Bootstrap 5 (CDN in layout)
- Entry point: `resources/css/app.css` and `resources/js/app.js`
- No `@vite` directives used - Bootstrap via CDN in `layouts/app.blade.php`

## Code Conventions

### Controllers
- Named by role + entity: `CoachCourseController`, `StudentLessonController`
- Use explicit guard in auth checks: `$coach = auth('coach')->user()`
- Ownership verification pattern:
  ```php
  if ($course->coach_id !== auth('coach')->id()) {
      abort(403);
  }
  ```

### Models & Relationships
- Eloquent relationships explicitly define foreign keys and tables:
  ```php
  public function courses() {
      return $this->hasMany(Course::class, 'coach_id', 'id');
  }
  ```
- Pivot tables use `withTimestamps()` for `Enrollment` relationship
- Models use `$fillable` (never `$guarded`) for mass assignment

### Blade Views
- Three layout files: `layouts/app.blade.php`, `layouts/coach.blade.php`, `layouts/student.blade.php`
- Flash messages handled in `layouts/app.blade.php` using Bootstrap alerts
- Navbar included via `@include('partials.navbar')`
- Route helpers use named routes: `route('coach.courses.manage', $course)`

### Email Integration
- Uses Resend API (`resend/resend-php` package) configured via `RESEND_API_KEY`
- Mailable classes in `app/Mail/`: `StudentRegistered`, `StudentLogin`
- Email views in `resources/views/emails/`

### OAuth (Google)
- Student-only Google OAuth via Laravel Socialite
- Configuration in `config/services.php` using env vars: `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI`
- `GoogleController` handles redirect and callback
- Students created with `firstOrCreate()` pattern on email match

## Testing & Seeding

### Test Accounts (from seeder)
- **Coach**: `petr.novak@example.com` / `password`
- **Admin**: `admin@example.com` / `password`
- **Students**: Created via registration or Google OAuth

### Seeder Pattern
- `DatabaseSeeder.php` uses direct `DB::table()->insert()` for consistent IDs
- Seeds coaches, course templates, courses, lessons, homework, students, enrollments, and progress

## Common Patterns

### Form Submissions
All forms use `@csrf` directive. PUT/DELETE use method spoofing:
```php
<form method="POST" action="{{ route('coach.courses.update', $course) }}">
    @csrf
    @method('PUT')
```

### File Uploads
- Profile pictures stored in `storage/app/public/profile_pictures`
- Submission files in `storage/app/public/submissions` (max 25MB limit)
- Use `Storage` facade with `public` disk

### Authorization Checks
- Middleware guards protect route groups
- Manual ownership checks in controllers (no Policies implemented)
- Use `abort(403)` for unauthorized access

## Production Notes
- Deployed on Railway: https://crm-platforma-production.up.railway.app/
- Environment variables must include database, mail (Resend), and Google OAuth credentials
- Storage symlink required: `php artisan storage:link`
