# 🇵🇭 GCash Integration Guide

## ✅ What Was Added:

Your support page now has **dual payment options**:
1. **Ko-fi** - For international supporters (USD, PayPal, Cards)
2. **GCash** - For Filipino supporters (PHP, local payment)

---

## 🚀 Setup Your GCash Details:

### Step 1: Get Your GCash QR Code

1. Open your **GCash app**
2. Tap your **profile** at the top
3. Tap **My QR** or **Receive Money**
4. Take a **screenshot** of your QR code
5. Save it as `gcash-qr.png`

### Step 2: Add QR Code to Your Site

**Option A: Upload to public folder**
```
Place your QR code image at:
public/images/gcash-qr.png
```

Then in `support.blade.php`, uncomment line ~285:
```blade
<img src="{{ asset('images/gcash-qr.png') }}" alt="GCash QR Code" class="w-full max-w-xs mx-auto rounded-lg">
```

**Option B: Use online hosting (easier)**
- Upload to [imgur.com](https://imgur.com) or [imgbb.com](https://imgbb.com)
- Replace the image URL in the modal

### Step 3: Update Your GCash Details

Open `resources/views/support.blade.php` and find these lines:

**Line ~285-295:** Update GCash number
```blade
<span class="text-white font-mono" id="gcashNumber">09XX XXX XXXX</span>
```
Replace with your actual number: `0917 123 4567`

**Line ~300:** Update account name
```blade
<span class="text-white font-medium">Your Name</span>
```
Replace with your GCash registered name

**Line ~360:** Update copy function number
```javascript
const number = '09XXXXXXXXX'; // Replace with your actual GCash number
```
Replace with: `'09171234567'` (your actual number)

---

## 💡 **How It Works:**

### For Users:
1. Visit `/support` page
2. See two payment options: Ko-fi (International) and GCash (Philippines)
3. Click "GCash Donation" button
4. Beautiful modal pops up with:
   - Your QR code (scan with GCash app)
   - Your GCash number (copy button)
   - Simple instructions
5. They send money directly to your GCash
6. You receive PHP instantly! 💰

### Payment Flow:
```
International Supporters → Ko-fi (USD) → PayPal → Your PayPal account
Filipino Supporters → GCash (PHP) → Your GCash wallet (instant!)
```

---

## 📋 **GCash Best Practices:**

### DO:
✅ Use your **personal GCash** number
✅ Check your GCash regularly for donations
✅ Reply to donors with "Thank you!" message (optional)
✅ Keep your QR code updated
✅ Verify account name matches your GCash

### DON'T:
❌ Share your full GCash account number publicly (last 4 digits OK)
❌ Forget to update the placeholder text
❌ Use someone else's GCash account

---

## 💰 **Expected Donations (Philippines):**

Typical Filipino donations:
- ₱20 - Small coffee (~$0.35)
- ₱50 - Regular donation (~$0.90)
- ₱100 - Generous support (~$1.75)
- ₱200+ - Very generous! (~$3.50+)

**Tip:** Even ₱20 adds up! 10 people × ₱20 = ₱200 = Server costs covered 🎉

---

## 🎨 **Customization Options:**

### Change GCash Modal Colors:
In `support.blade.php`, find the modal div and change:
```blade
border-green-500/30  →  Change to any color (blue, purple, etc.)
text-green-400       →  Matching text color
```

### Add Suggested Amounts:
Add this before the instructions section:
```blade
<div class="grid grid-cols-3 gap-2 mb-4">
    <button class="bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-lg text-sm">₱20</button>
    <button class="bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-lg text-sm">₱50</button>
    <button class="bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-lg text-sm">₱100</button>
</div>
```

---

## 🔒 **Security Tips:**

1. **Never share your GCash PIN** or OTP
2. **Verify sender identity** if someone claims they donated
3. **Enable GCash notifications** to track donations
4. **Keep screenshots** of donations for tax records (if needed)
5. **Use a separate GCash** for donations (optional)

---

## 📊 **Tracking Donations:**

### GCash History:
- Open GCash app → **Activity**
- Filter by "Cash In" to see donations
- Check reference number if donors include "iNeedCinema" message

### Create a Simple Tracker:
Keep a note of:
- Date received
- Amount (₱)
- Sender (optional)
- Total monthly donations

---

## ❓ **FAQ:**

**Q: Do I need a GCash business account?**
A: No! Your personal GCash is fine.

**Q: Can I accept other e-wallets (PayMaya, etc.)?**
A: Yes! Just add another button and modal. GCash is most popular though.

**Q: What if I don't have a GCash QR code?**
A: Just share your mobile number. People can send via "Send Money" feature.

**Q: Should I verify donations?**
A: Only if you want to thank donors personally. Otherwise, just appreciate!

**Q: Can I add bank transfer option?**
A: Yes, but GCash is easier and more common in Philippines.

**Q: Is this legal?**
A: Yes! You're receiving personal donations, not charging for content.

---

## 🎯 **Quick Checklist:**

```
[ ] Get GCash QR code screenshot
[ ] Upload QR image to public/images/gcash-qr.png
[ ] Uncomment the QR image line in support.blade.php
[ ] Update GCash number in modal (line ~290)
[ ] Update account name in modal (line ~300)
[ ] Update copy function number in JavaScript (line ~360)
[ ] Test the modal by clicking "GCash Donation"
[ ] Verify copy button works
[ ] Check modal closes properly (X button, outside click, Escape key)
[ ] Enable GCash notifications on your phone
[ ] Tell Filipino users about the new GCash option!
```

---

## 🌟 **Marketing Tips:**

### Announce on Social Media:
```
🎉 Filipino supporters! You can now support iNeedCinema using GCash! 🇵🇭

No need for international payment methods - just ₱20+ via GCash helps keep 
the site running! Visit [yoursite.com/support] 💙

#iNeedCinema #GCash #SupportLocal
```

### Add to Your Bio/About:
```
Support the project: Ko-fi (International) | GCash (Philippines)
```

---

## 💬 **Sample Thank You Message (for donors):**

When you receive a GCash donation, you can send:
```
Hi! Thank you so much for supporting iNeedCinema via GCash! ❤️ 
Your ₱XX donation helps keep the site running and motivates me to 
keep improving it. Salamat! 🙏

- The Developer
```

---

## 🎉 **You're All Set!**

Your support page now accepts:
- ✅ Ko-fi (USD) - International
- ✅ GCash (PHP) - Philippines

**Test it now:** http://127.0.0.1:8000/support

**Both methods are legal and clearly framed as supporting the developer, not content!**

---

**Need help?** Just ask! 🚀

**Salamat and good luck! 🇵🇭💙**
