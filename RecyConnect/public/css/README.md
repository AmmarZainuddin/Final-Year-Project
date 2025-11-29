# RecyConnect CSS Architecture

## File Structure

```
css/
├── style.css          # Main stylesheet (global styles)
├── dashboard.css      # Dashboard-specific styles
└── README.md         # This file
```

## File Descriptions

### `style.css` - Main Stylesheet
**Purpose:** Contains global styles used across the entire application

**Includes:**
- Global body styles and typography
- Sidebar navigation styles
- Main content area layout
- Navbar enhancements
- Card component base styles
- Utility classes
- Custom scrollbar styles
- Accessibility focus states
- Print media queries

**Used by:** All pages (loaded in `includes/header.php`)

---

### `dashboard.css` - Dashboard Stylesheet
**Purpose:** Contains styles specific to the user dashboard page

**Includes:**
- Dashboard header with gradient
- Statistics cards with hover effects
- Environmental impact summary section
- Quick actions buttons
- Activity table with modern styling
- Custom badges and icons
- Responsive media queries for mobile devices

**Used by:** `user/dashboard.php` only

---

## How to Use

### Adding Styles to an Existing Page
1. For global styles (navigation, layout, etc.), add to `style.css`
2. For page-specific styles, create a new CSS file (e.g., `profile.css`)
3. Link the page-specific CSS in the page file:
   ```php
   <link rel="stylesheet" href="../css/your-page.css">
   ```

### Creating a New Page with Custom Styles
1. Create your PHP file in the appropriate directory
2. Include the header: `<?php include '../includes/header.php'; ?>`
3. Add page-specific CSS link after the includes
4. Create corresponding CSS file in `css/` directory

### Best Practices
- **Keep it modular:** Each major page should have its own CSS file
- **Use consistent naming:** Follow the pattern `page-name.css`
- **Document your CSS:** Add comments to explain complex styles
- **Mobile-first:** Write base styles for mobile, then add `@media` queries
- **Use CSS variables:** For repeated values (colors, spacing, etc.)
- **Avoid inline styles:** Always use external CSS files

---

## CSS Organization Guidelines

### Order of Styles in Files
1. Component base styles
2. Component modifiers
3. Component states (hover, active, focus)
4. Responsive media queries

### Naming Conventions
- Use descriptive class names: `.stat-card` instead of `.sc`
- Use kebab-case for multi-word classes: `.quick-actions`
- Use BEM methodology when appropriate: `.card__title`, `.card--primary`

### Color Palette (from current design)
```css
/* Primary Colors */
--primary-purple: #667eea;
--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

/* Success/Green */
--success-green: #11998e;
--success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);

/* Warning/Pink */
--warning-pink: #f093fb;
--warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);

/* Info/Blue */
--info-blue: #4facfe;
--info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);

/* Neutral Colors */
--dark-text: #1e293b;
--muted-text: #64748b;
--light-bg: #f8f9fa;
```

---

## Performance Tips
- Minimize use of `!important`
- Avoid overly complex selectors
- Use CSS Grid and Flexbox for layouts
- Optimize for CSS specificity
- Compress CSS files for production

---

## Future Enhancements
- [ ] Add dark mode support
- [ ] Create component library CSS
- [ ] Add CSS custom properties for theming
- [ ] Optimize and minify for production
- [ ] Add CSS animations library

