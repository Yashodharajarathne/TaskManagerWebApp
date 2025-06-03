# ✅ Task Manager – Laravel + Vue.js

A modern and responsive Task Manager web application built using **Laravel 10** (API backend) and **Vue.js 3** (frontend). This app allows users to create, toggle, and delete tasks with real-time UI updates and a stylish interface.

---

## 🚀 Features

- ✅ Add, toggle, and delete tasks via RESTful API
- 🎨 Beautiful UI with **Fredoka One** font and glassmorphism design
- ⚡ Dynamic Vue 3 frontend with Axios integration
- 🔒 Validation and error handling for clean UX

---

## 🛠️ Tech Stack

- **Backend**: Laravel 10 (API only)
- **Frontend**: Vue.js 3 with Vite
- **Database**: MySQL
- **HTTP**: Axios
- **Styling**: Scoped CSS with modern effects

---
## UI Preview

![image](https://github.com/user-attachments/assets/ed14cd32-80c9-451f-829b-9e4aebd213ad)

---

## 📦 Setup Instructions

Follow the steps below to set up the project locally:

### 🔁 Clone the Repo

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager

⚙️ Configure Environment

1. Copy the `.env` example file:

cp .env.example .env

2. Generate the Laravel application key

php artisan key:generate

3. Open the .env file and update your database configuration:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your_password

4.  Run Migrations

php artisan migrate

5.Start the Laravel Backend

php artisan serve

6.Compile the Vue Frontend

npm install
npm run dev


Project Structure

routes/
│   ├── api.php                    → Laravel API routes
resources/
│   └── js/
│       └── components/
│           └── TaskApp.vue       → Vue 3 component (frontend logic + UI)
app/
│   └── Http/
│       └── Controllers/
│           └── API/
│               └── TaskController.php → API logic (CRUD)

