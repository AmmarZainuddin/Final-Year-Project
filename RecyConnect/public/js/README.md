# RecyConnect JavaScript Files

## File Structure

```
js/
├── sidebar-toggle.js    # Sidebar collapse/expand functionality
└── README.md           # This file
```

---

## `sidebar-toggle.js` - Sidebar Toggle Functionality

### Purpose
Handles the collapsible sidebar with smooth transitions and persistent state management.

### Features

#### 1. **Desktop Behavior**
- Toggle button in navbar collapses/expands sidebar
- Main content smoothly adjusts width when sidebar is toggled
- Sidebar state is saved to localStorage and restored on page reload
- No overlay - sidebar pushes content

#### 2. **Mobile Behavior** (< 768px)
- Sidebar is hidden by default
- Toggle button opens sidebar over content
- Dark overlay appears behind sidebar
- Close button (X) in sidebar header
- Clicking overlay closes sidebar
- Body scroll is prevented when sidebar is open

#### 3. **State Persistence**
- Uses localStorage to remember user's preference (desktop only)
- State is automatically restored on page load
- Survives page refreshes and navigation

#### 4. **Responsive Handling**
- Automatically adapts behavior based on screen size
- Smooth transitions during window resize
- Prevents layout issues when switching between mobile/desktop

### How It Works

```javascript
// Elements
- #sidebar: The sidebar navigation element
- #sidebarToggle: Toggle button in navbar
- #sidebarClose: Close button (mobile only)
- #sidebarOverlay: Dark overlay (mobile only)
- #mainContent: Main content area

// Classes
- .collapsed: Sidebar is hidden (desktop)
- .expanded: Main content takes full width (desktop)
- .show: Sidebar is visible (mobile)
- .active: Overlay is visible (mobile)
```

### CSS Classes Used

```css
/* Desktop */
.sidebar.collapsed { transform: translateX(-250px); }
.main-content.expanded { margin-left: 0; }

/* Mobile */
.sidebar.show { transform: translateX(0); }
.sidebar-overlay.active { display: block; opacity: 1; }
```

### Events

1. **Toggle Button Click**
   - Desktop: Collapses/expands sidebar
   - Mobile: Shows sidebar with overlay

2. **Close Button Click** (mobile)
   - Hides sidebar
   - Removes overlay
   - Restores body scroll

3. **Overlay Click** (mobile)
   - Same as close button

4. **Window Resize**
   - Debounced with 250ms delay
   - Switches between mobile/desktop modes
   - Restores appropriate state

5. **Sidebar Link Click** (mobile)
   - Auto-closes sidebar for better UX

### localStorage Keys

- `sidebarCollapsed`: Boolean (string) - "true" or "false"

### Browser Compatibility

- Modern browsers (ES6+)
- localStorage support required
- CSS transitions support required

### Usage

The script is automatically loaded via `footer.php` and initializes on page load. No manual initialization required.

```html
<!-- Automatically loaded in footer.php -->
<script src="../js/sidebar-toggle.js"></script>
```

### Customization

#### Change Sidebar Width
Update CSS variable in `style.css`:
```css
.sidebar {
    width: 250px; /* Change this value */
}
```

#### Change Animation Speed
Update transition duration in `style.css`:
```css
.sidebar,
.main-content {
    transition: all 0.3s ease; /* Change 0.3s */
}
```

#### Disable State Persistence
Comment out localStorage calls in the JavaScript:
```javascript
// setSidebarState(collapsed);
```

---

## Best Practices

1. **Always use IDs** - The script relies on specific element IDs
2. **Don't modify class names** - They're used by both CSS and JavaScript
3. **Test responsive behavior** - Check both mobile and desktop views
4. **Maintain accessibility** - Keep ARIA labels and keyboard navigation

---

## Future Enhancements

- [ ] Add keyboard shortcuts (e.g., Ctrl+B to toggle)
- [ ] Add swipe gestures for mobile
- [ ] Add animation options
- [ ] Add callback hooks for custom events
- [ ] Add sidebar resize functionality

---

**Last Updated:** November 28, 2025
**Version:** 1.0

