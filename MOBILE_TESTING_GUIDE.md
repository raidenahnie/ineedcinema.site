# 🧪 Mobile Testing Quick Reference

## 🚀 Quick Start

### 1. Compile Assets (REQUIRED FIRST)
```bash
cd c:\Users\kurtk\OneDrive\Documents\ineedcinema-fresh
npm run build
```

### 2. Start Server
```bash
php artisan serve
```

### 3. Test on iPhone SE (Chrome DevTools)
1. Open `http://localhost:8000`
2. Press `F12` to open DevTools
3. Click "Toggle Device Toolbar" (Ctrl+Shift+M)
4. Select "iPhone SE" from device dropdown
5. Test both portrait and landscape

## 🎯 Priority Test Cases

### ✅ TEST 1: Video Players (MOST IMPORTANT)

#### Anime Player
1. Go to any anime page
2. Click on an episode
3. **Check:**
   - [ ] Video loads without taking full screen height
   - [ ] Video has proper 16:9 aspect ratio
   - [ ] Back button is visible and tappable (top-left)
   - [ ] Episode overlay appears at bottom
   - [ ] Overlay can be dismissed by tapping
   - [ ] Episode grid below shows 2 columns on mobile
   - [ ] All episode cards are tappable

#### TV Show Player
1. Go to any TV show page
2. Click on an episode
3. **Check:**
   - [ ] Video loads without taking full screen height
   - [ ] Video has proper 16:9 aspect ratio
   - [ ] Back button is visible and tappable (top-left)
   - [ ] Episode overlay appears at bottom
   - [ ] Overlay can be dismissed by tapping
   - [ ] Episode grid below shows 2 columns on mobile
   - [ ] Season selector is tappable

### ✅ TEST 2: GCash Modal (HIGH PRIORITY)

1. Go to `/support` page
2. Click "View GCash Details" button
3. **Check:**
   - [ ] Modal opens and fits on screen (no overflow)
   - [ ] Close button (X) is easily tappable
   - [ ] QR code image is visible and properly sized
   - [ ] All text is readable
   - [ ] Instructions section fits without scrolling
   - [ ] Modal doesn't extend beyond screen edges

### ✅ TEST 3: Landscape Mode

#### Portrait to Landscape Test
1. Start in portrait mode (iPhone SE 375x667)
2. Rotate to landscape (667x375)
3. **Check on Video Player:**
   - [ ] Video adjusts to landscape
   - [ ] Controls are still accessible
   - [ ] No content cut off
   - [ ] Episode info still visible

4. **Check on Modal:**
   - [ ] Modal fits in landscape
   - [ ] Content is scrollable if needed
   - [ ] Close button still accessible

### ✅ TEST 4: Browse Pages

#### Movies Page (`/movies`)
- [ ] Grid shows 2 columns on iPhone SE
- [ ] Posters load and are properly sized
- [ ] Cards are tappable
- [ ] Genre tabs are tappable
- [ ] Scroll is smooth

#### TV Shows Page (`/tv-shows`)
- [ ] Grid shows 2 columns on iPhone SE
- [ ] Posters load and are properly sized
- [ ] Cards are tappable
- [ ] Genre tabs are tappable
- [ ] Scroll is smooth

#### Anime Page (`/anime`)
- [ ] Grid shows 2 columns on iPhone SE
- [ ] Posters load and are properly sized
- [ ] Cards are tappable
- [ ] Genre tabs are tappable
- [ ] Scroll is smooth

### ✅ TEST 5: Contact Form (`/contact`)
- [ ] Form fields stack properly
- [ ] All fields are tappable
- [ ] Keyboard doesn't zoom on input focus
- [ ] Submit button is large and tappable
- [ ] Success message displays correctly

### ✅ TEST 6: Landing Page (`/`)
- [ ] Hero section displays properly
- [ ] Trending grid shows proper columns
- [ ] Feature cards are tappable
- [ ] All buttons are tappable
- [ ] Footer stacks to 1 column

## 📱 Device Tests

### iPhone SE (320px - 375px)
```
Portrait:  375 x 667
Landscape: 667 x 375
```
- [ ] All pages load correctly
- [ ] No horizontal scrolling
- [ ] All buttons tappable
- [ ] Video players work

### iPhone 12/13/14 (390px)
```
Portrait:  390 x 844
Landscape: 844 x 390
```
- [ ] All pages load correctly
- [ ] Layout scales properly
- [ ] Video players work

### Small Android (360px)
```
Portrait:  360 x 640
Landscape: 640 x 360
```
- [ ] All pages load correctly
- [ ] No horizontal scrolling
- [ ] Video players work

### Tablet (768px+)
- [ ] Grid expands to 4 columns
- [ ] Layout uses available space
- [ ] Video players maintain aspect ratio

## 🔍 What to Look For

### ✅ Good Signs
- Video has black bars (letterboxing) = **GOOD** (aspect ratio working)
- Modal fits on screen with padding on sides = **GOOD**
- All buttons have good spacing = **GOOD**
- No horizontal scrollbar = **GOOD**
- Smooth scrolling = **GOOD**

### ❌ Bad Signs
- Video takes entire screen height = **BAD** (h-screen issue)
- Modal overflows screen edges = **BAD**
- Buttons too small to tap = **BAD**
- Horizontal scrollbar appears = **BAD**
- Content cut off = **BAD**

## 🐛 Common Issues & Fixes

### Issue: Changes Not Showing
**Solution:**
```bash
# Clear cache and rebuild
npm run build
php artisan cache:clear
php artisan view:clear
```

### Issue: Video Still Full Height
**Solution:**
- Check if assets compiled: `public/build/manifest.json` should exist
- Hard refresh browser: Ctrl+Shift+R
- Clear browser cache

### Issue: Modal Still Overflows
**Solution:**
- Verify CSS compiled correctly
- Check if `max-w-[calc(100vw-1.5rem)]` is applied
- Inspect element in DevTools

### Issue: Buttons Too Small
**Solution:**
- Check if `min-width: 44px; min-height: 44px;` is applied
- Verify touch-manipulation class is present
- Inspect element padding

## 📊 Chrome DevTools Testing

### Responsive Mode
1. F12 → Toggle Device Toolbar
2. Select "iPhone SE"
3. Test portrait (375x667)
4. Rotate to landscape (click rotate icon)
5. Test landscape (667x375)

### Network Throttling
1. Network tab → Throttling dropdown
2. Select "Slow 3G" or "Fast 3G"
3. Test loading performance

### Performance Testing
1. Lighthouse tab
2. Select "Mobile"
3. Run audit
4. Should score 90+ on Performance

## 🎯 Pass Criteria

### Video Players ✅
- [ ] Works on iPhone SE portrait
- [ ] Works on iPhone SE landscape
- [ ] Proper 16:9 aspect ratio
- [ ] No full screen height issue
- [ ] All controls tappable

### Modals ✅
- [ ] Fits on 320px screen
- [ ] Fits on 375px screen (iPhone SE)
- [ ] All content visible
- [ ] Close button works
- [ ] No overflow

### General Layout ✅
- [ ] No horizontal scrolling
- [ ] All touch targets ≥ 44px
- [ ] Text readable (≥ 14px)
- [ ] Proper spacing
- [ ] Smooth scrolling

### Performance ✅
- [ ] Page loads < 3 seconds
- [ ] Smooth animations
- [ ] No lag on scroll
- [ ] Images load progressively

## 📸 Screenshots to Take

1. **iPhone SE Portrait** - Video player page
2. **iPhone SE Landscape** - Video player page
3. **iPhone SE Portrait** - GCash modal open
4. **iPhone SE Portrait** - Movies grid
5. **iPhone SE Portrait** - Contact form

## ✅ Final Checklist

Before considering optimization complete:

- [ ] Compiled assets with `npm run build`
- [ ] Tested on iPhone SE (portrait)
- [ ] Tested on iPhone SE (landscape)
- [ ] Video players work correctly
- [ ] GCash modal fits on screen
- [ ] All pages tested on mobile
- [ ] No horizontal scrolling anywhere
- [ ] All buttons are tappable
- [ ] Forms work without zoom
- [ ] Footer stacks properly

---

## 🎉 Success Criteria

When all checkboxes are checked, your site is **fully mobile-optimized** and ready for iPhone SE users!

**Happy Testing!** 📱✨
