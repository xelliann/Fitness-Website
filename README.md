# 💪 AI-Driven Fitness Planner

A full-stack web application that creates personalized **diet** and **exercise plans** using AI, tailored to each user's fitness goals. Built with **PHP**, **MySQL**, and modern UI design, this project helps users track their health, stay on top of goals, and receive intelligent daily recommendations.

---

## 📌 Features

- 🔐 User Registration & Login
- 🧠 AI-Based Diet & Exercise Plans (OpenAI)
- 📊 Progress Tracking: Steps, Calories, Water, Sleep, etc.
- 🥗 Daily Stats & Meal Logging
- 💬 Feedback System
- 🛠 Admin Panel (Manage Users, Plans, Feedback)
- 📱 Responsive UI (Modern Themed Design)

---

## 🧰 Tech Stack

- **Frontend:** HTML, CSS (custom + Tailwind-style), JavaScript  
- **Backend:** PHP (Core PHP, procedural & minimal OOP)  
- **Database:** MySQL  
- **AI Integration:** OpenAI API  
- **Styling:** Custom CSS with modern gradient design  
- **Icons:** Font Awesome  
- **Version Control:** Git + GitHub  

---

## 📂 Folder Structure

/auth # Login, Register, Logout logic 
/includes # DB config and utility functions
/admin # Admin dashboard & tools
/assets # Stylesheets, images, icons 
/user # User-side pages (My Plan, Profile, Stats) .env # Environment file (NOT committed)


---

## 🚀 Getting Started

### 1. Clone the Repository
``bash
git clone https://github.com/yourusername/fitness-planner.git
cd fitness-planner

### 2. Set Up .env File
Create a .env file (or use the sample provided):
  DB_HOST=localhost
  DB_USER=root
  DB_PASS=
  DB_NAME=health_planner
  OPENAI_API_KEY=your_openai_key
  Note: Don't commit your .env. Add it to .gitignore.

### 3. Import the Database
Import the SQL file into your MySQL server:

-- Example
CREATE DATABASE health_planner;
USE health_planner;

-- Then import tables from database.sql
### 4. Run the App
Host it on localhost using XAMPP, MAMP, or a local server.

http://localhost/fitness-planner/
🧪 Sample Credentials

Role	Email	Password
Admin	admin@example.com	admin123
User	mohit@example.com	user123
You can update these in your database manually for testing.

### 📸 Screenshots

### 🛡 Security Notes
Sensitive .env data is not included in Git.

Admin routes are protected and access-controlled.

### 📬 Feedback or Contributions?
Open a pull request or drop your suggestions in the Issues tab!

🧑‍💻 Author
Mohit
Student of LPU – MCA
Capstone: AI-Driven Diet & Fitness Planner

📄 License
MIT License — free to use with credit.

---
Let me know if you want:
- A visual badge section (stars, forks, license)
- GitHub Actions CI/CD badge
- Markdown screenshot embed section



"# Fitness-Website" 
"# Fitness-Website" 
