# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Essential Commands
- `composer dev` - Start full development environment (server, queue, logs, vite)
- `php artisan serve` - Start Laravel development server
- `npm run dev` - Start Vite development server for assets
- `npm run build` - Build production assets

### Testing
- `php artisan test` - Run all tests (uses Pest testing framework)
- `php artisan test --filter=ExampleTest` - Run specific test

### Code Quality
- `vendor/bin/pint` - Format PHP code (Laravel Pint)
- `php artisan ide-helper:generate` - Generate IDE helper files

### Database
- `php artisan migrate` - Run database migrations
- `php artisan db:seed` - Seed database with sample data
- `php artisan migrate:fresh --seed` - Fresh migration with seeding

## Architecture Overview

### CRM Entity Relationships
The application follows a hierarchical CRM structure:

```
User (with roles: admin, sales_manager, sales_person)
├── Companies (belongs to user, soft deleted)
    ├── Contacts (belongs to company and user, soft deleted)
    └── Deals (belongs to company, optionally to contact, soft deleted)
└── Activities (belongs to user, can relate to company, contact, or deal)
```

### Key Model Relationships
- **User**: Has roles with specific permissions (admin/sales_manager/sales_person)
- **Company**: Owned by user, contains contacts and deals
- **Contact**: Belongs to company and user, has full_name accessor
- **Deal**: Has predefined statuses (prospecting → closed_won/closed_lost), belongs to company
- **Activity**: Universal activity tracking for all CRM entities

### Authentication & Authorization
- Uses Laravel Breeze for authentication
- Role-based access control via User model constants
- Japanese language interface elements

### Database
- SQLite database in `database/database.sqlite`
- All CRM models use soft deletes
- IDE helper annotations are auto-generated

### Frontend Stack
- Blade templates with Tailwind CSS
- Alpine.js for JavaScript interactions
- Vite for asset compilation
- Japanese language UI

### Routing Structure
- Resource controllers for all CRM entities
- API endpoints for dynamic data loading (company contacts/deals)
- Authentication middleware protecting all CRM routes

## Development Notes

### Model Conventions
- All CRM models use `HasFactory` and `SoftDeletes` traits
- IDE helper annotations are comprehensive and should be maintained
- User model includes role checking methods and query scopes

### Testing
- Uses Pest PHP testing framework
- Tests located in `tests/Feature/` and `tests/Unit/`
- Authentication tests included

### Code Style
- Laravel Pint handles code formatting
- PHPDoc blocks are extensively used
- Japanese comments in routes file