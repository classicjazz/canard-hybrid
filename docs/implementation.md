# 🚀 Canard Modernization: Comprehensive Blueprint v1.4

**Objective:** Modernize the decade-old Canard theme into a WordPress 6.7+ Hybrid Theme with full PHP 8.4 compatibility, strict typing, and high-performance, **dependency-free JavaScript**.

---

## ✅ 1. Completed Milestone Audit

### **A. Design System & Global Styles**
* **Status:** Complete.
* **Engine:** All design tokens (colors, typography, spacing) are handled by `theme.json`.
* **Optimization:** `style.css` is a lightweight file referencing CSS variables.

### **B. Core Logic & PHP 8.4 "Engine"**
* **Status:** Complete.
* **Strict Typing:** `declare(strict_types=1)` implemented in core templates and `header.php`.
* **Hybrid Features:** Full support for `appearance-tools` and block-template-parts.

### **C. Vanilla JavaScript Engine & Integration**
* **Status:** Complete.
* **Refactor:** Migrated all legacy scripts to ES6+. Enqueued a shared `utils.js` to provide a centralized `debounce` function.
* **Performance:** jQuery is now explicitly dequeued for non-logged-in frontend visitors.
* **Synchronization:** `posts.js` now dynamically pulls margin values from `theme.json` spacing presets via CSS variables.

---

## 🛠 2. Final Phase: Loop Hardening & Cleanup

Now that the JavaScript engine is modernized and integrated, the final steps involve hardening the remaining PHP logic.

| File Path | Requirement |
| --- | --- |
| `archive.php` | Implement strict type checks and modernize title logic using `get_the_archive_title()`. |
| `content-*.php` | Update metadata comparisons and ensuring strict typing across all post format templates. |
| `inc/template-tags.php`| Refactor custom tags to use strict return types. |

---

## 📋 3. Quality Assurance Checklist

* [x] **JS Dependency Check:** Verified that `jQuery` is no longer enqueued on the front-end for anonymous users.
* [x] **A11y Audit:** Mobile navigation, search toggles, and skip-links are fully keyboard accessible without jQuery.
* [x] **Design Token Audit:** JS-calculated heights in `posts.js` successfully pull from `theme.json` presets.
* [ ] **PHP 8.4 Regression:** Final check for null-pointer errors in the archive and search results loops.