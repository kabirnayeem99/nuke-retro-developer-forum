## 📋 Project Tasks

### 🧱 Phase 1: Core Setup

1. **Initialize Laravel project**
2. **Set up authentication (Laravel Breeze or Fortify)**
3. **Create user roles: admin, moderator, member**
4. **Design database schema (models, migrations)**

---

### 🧩 Phase 2: Models & Relations

5. **Create models/migrations:**

   * `User`, `Thread`, `Post`, `Message`, `Job`, `File`, `Category`, `Notification`
6. **Define Eloquent relationships**
7. **Seed initial data (roles, categories)**

---

### 🖥️ Phase 3: Forum Functionality

8. **Thread list page (with categories)**
9. **Thread view page (with posts)**
10. **Post reply form**
11. **Create/edit thread**
12. **Lock/pin threads (admin/mod only)**

---

### 💬 Phase 4: Messaging System

13. **Inbox/sent UI**
14. **Send/receive messages**
15. **Mark as read / delete message**

---

### 💼 Phase 5: Job Board

16. **Job list and details page**
17. **Job post form**
18. **File attachments to job posts**

---

### 📂 Phase 6: File Uploads

19. **Upload files to threads/posts/jobs**
20. **Restrict allowed file types (.zip, .pdf, .txt)**
21. **Queued file/image processing**

---

### ✉️ Phase 7: Notifications

22. **Set up Laravel queue system**
23. **Email notifications:**

    * New reply
    * New message
    * Weekly digest
24. **User notification center (UI)**

---

### 🎨 Phase 8: UI & Styling

25. **Blade views in 90s style (tables, `<marquee>`, GIFs)**
26. **Vintage CSS: pixel fonts, neon buttons, blink tags**
27. **Responsive layout (optional)**

---

### 🛡️ Phase 9: Admin Panel

28. **Moderate threads/posts**
29. **User role management**
30. **View reports/logs**

---

### 🧪 Phase 10: Finalization

31. **Test full UX (posting, messaging, uploading)**
32. **Add rate-limiting/spam protection**
33. **Bug fixing & cleanup**
34. **Prepare for open-source (LICENSE, README)**


**Project Name Suggestion (Arabic-inspired):**
**منتدى المطورين العتيق** (*Muntadā al-Muṭawwirīn al-ʿAtīq*)
Meaning: *The Vintage Developers Forum* — captures both the nostalgic (90s/retro) vibe and developer identity.
Short name idea: **"ʿAtīq"** (عتيق) — simple, memorable, and thematically rich.

---

## 📦 Models & Relationships

### 1. **User**

* Fields: `id`, `name`, `email`, `password`, `role`, `bio`, `avatar`, `joined_at`
* Roles: `admin`, `moderator`, `member`
* Relations:

  * `hasMany(Thread)`
  * `hasMany(Post)`
  * `hasMany(Message, as sender/receiver)`
  * `hasMany(Job)`
  * `hasMany(File)`
  * `hasMany(Notification)`

---

### 2. **Thread**

* Fields: `id`, `user_id`, `title`, `slug`, `body`, `category_id`, `pinned`, `locked`
* Relations:

  * `belongsTo(User)`
  * `hasMany(Post)`
  * `hasMany(File)`
  * `belongsTo(Category)`

---

### 3. **Post**

* Fields: `id`, `thread_id`, `user_id`, `body`, `created_at`
* Relations:

  * `belongsTo(Thread)`
  * `belongsTo(User)`

---

### 4. **File**

* Fields: `id`, `user_id`, `thread_id (nullable)`, `post_id (nullable)`, `job_id (nullable)`, `filename`, `path`, `type`
* Relations:

  * `belongsTo(User)`
  * `belongsTo(Thread|Post|Job)` (optional, polymorphic if needed)

---

### 5. **Message**

* Fields: `id`, `sender_id`, `receiver_id`, `subject`, `body`, `read_at`
* Relations:

  * `belongsTo(User, as sender)`
  * `belongsTo(User, as receiver)`

---

### 6. **Job**

* Fields: `id`, `user_id`, `title`, `description`, `company`, `location`, `type`, `url`, `posted_at`
* Relations:

  * `belongsTo(User)`
  * `hasMany(File)`

---

### 7. **Category**

* For organizing threads.
* Fields: `id`, `name`, `slug`, `description`
* Relations:

  * `hasMany(Thread)`

---

### 8. **Notification**

* Fields: `id`, `user_id`, `type`, `data`, `read_at`, `created_at`
* Types: `reply`, `message`, `weekly_digest`
* Used with queues + mail.

---

### Optional Extras:

* **DigestJob (queue)** for sending weekly summary
* **AdminLog** for tracking moderation actions

---

Let me know if you want an Eloquent schema dump or migration scaffold next.
