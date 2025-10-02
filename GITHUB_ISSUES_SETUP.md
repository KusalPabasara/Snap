# 🚀 GitHub Issues Setup Guide

This guide will help you create all 15 project issues on GitHub automatically.

## 📋 Quick Start (Recommended)

### Step 1: Install GitHub CLI

Open PowerShell as Administrator and run:

```powershell
winget install --id GitHub.cli
```

**Close and reopen your terminal** after installation.

### Step 2: Login to GitHub

```powershell
gh auth login
```

Follow the prompts:
1. Choose: **GitHub.com**
2. Choose: **HTTPS**
3. Choose: **Login with a web browser**
4. Copy the one-time code
5. Press Enter to open browser
6. Paste code and authorize

### Step 3: Run the Script

```powershell
cd C:\Users\mymem\Documents\Snap
.\create-issues.ps1
```

**That's it!** All 15 issues will be created automatically.

---

## 📊 Issues to be Created

### 🔴 High Priority (3 issues)

1. **[CRITICAL] PostGIS Extension Not Installed**
   - Label: `priority: critical`, `database`, `geolocation`
   - Problem: No spatial indexing for location queries
   - Solution: Install PostGIS, update migrations

2. **[CRITICAL] Authentication System Missing**
   - Label: `priority: critical`, `authentication`, `security`
   - Problem: No user login/registration
   - Solution: Install Laravel Breeze

3. **[CRITICAL] No Sample Data / Database Seeding**
   - Label: `priority: critical`, `database`, `testing`
   - Problem: Empty database
   - Solution: Create seeders with realistic data

### 🟡 Medium Priority (4 issues)

4. **Image Upload & AI Recognition Not Implemented**
   - Label: `priority: medium`, `AI/ML`, `feature`
   - Solution: Integrate Google Cloud Vision or AWS Rekognition

5. **Search Results Need Pagination Styling**
   - Label: `priority: medium`, `UI/UX`, `design`
   - Solution: Style with DaisyUI components

6. **Missing Shop & Category Detail Pages**
   - Label: `priority: medium`, `views`, `UI/UX`
   - Solution: Create show.blade.php views

7. **Geolocation Permission Not Requested**
   - Label: `priority: medium`, `geolocation`, `JavaScript`
   - Solution: Add browser geolocation API

### 🔵 Enhancements (8 issues)

8. **Admin Dashboard Missing**
   - Label: `priority: low`, `admin`, `enhancement`
   - Suggestion: Use Laravel Filament

9. **Payment Gateway Integration**
   - Label: `priority: low`, `payments`, `enhancement`
   - Suggestion: PayHere (Sri Lanka) or Stripe

10. **Email Notifications System**
    - Label: `priority: low`, `notifications`, `enhancement`
    - Suggestion: Mailgun or SendGrid

11. **Mobile App (Flutter/React Native)**
    - Label: `priority: low`, `mobile`, `enhancement`
    - Future feature for iOS/Android

12. **Full-Text Search Engine (Meilisearch)**
    - Label: `priority: low`, `search`, `enhancement`
    - Replace SQL LIKE with fast search

13. **Product Reviews & Ratings System**
    - Label: `priority: low`, `reviews`, `enhancement`
    - 5-star ratings and reviews

14. **Favorites/Wishlist Functionality**
    - Label: `priority: low`, `feature`, `enhancement`
    - UI for existing database table

15. **API Documentation (Swagger/OpenAPI)**
    - Label: `priority: low`, `documentation`, `enhancement`
    - Auto-generate API docs

---

## ✅ Verification

After running the script, verify at:

**https://github.com/KusalPabasara/Snap/issues**

You should see:
- 15 new issues
- Proper labels and priorities
- Detailed descriptions with solutions
- Ready to work on step-by-step

---

## 🛠️ Alternative: Manual Creation

If you prefer to create issues manually or the script doesn't work:

### Option 1: Use the Web Interface

1. Visit: https://github.com/KusalPabasara/Snap/issues/new
2. Copy content from: http://127.0.0.1:8000/issues
3. Create each issue one by one

### Option 2: Use gh CLI Commands Directly

Open `create-github-issues.md` and copy/paste the `gh issue create` commands one at a time.

---

## 📝 Issue Template

Each issue includes:

- **Title**: Clear, descriptive name with priority tag
- **Problem**: What's wrong or missing
- **Solution**: Step-by-step fix
- **Impact**: Why it matters
- **Labels**: For easy filtering and organization

---

## 🎯 Recommended Order to Fix

Based on the issues page at `/issues`, work in this order:

1. **#3** - Create database seeders (testing foundation)
2. **#2** - Install Laravel Breeze (authentication)
3. **#6** - Create detail views (complete UI)
4. **#1** - Install PostGIS (geolocation foundation)
5. **#7** - Implement geolocation (nearby search)
6. **#5** - Style pagination (polish)
7. **#4** - Add AI image search (unique feature)
8. Then work on enhancements as needed

---

## 🚨 Troubleshooting

### GitHub CLI not found

**Solution:**
```powershell
# Reinstall
winget uninstall GitHub.cli
winget install --id GitHub.cli

# Restart terminal
```

### Authentication failed

**Solution:**
```powershell
gh auth logout
gh auth login
```

### Permission denied

**Solution:**
Run PowerShell as Administrator

### Script execution disabled

**Solution:**
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

---

## 📞 Need Help?

- View local issues page: http://127.0.0.1:8000/issues
- GitHub CLI docs: https://cli.github.com/manual/
- Laravel docs: https://laravel.com/docs

---

## ✨ After Issues are Created

Once all issues are on GitHub, you can:

1. **Assign** issues to yourself or team members
2. **Create milestones** (e.g., "MVP", "Beta", "v1.0")
3. **Add to project board** for kanban workflow
4. **Link pull requests** to issues when fixing
5. **Track progress** with GitHub's built-in metrics

**Happy coding! 🎉**
